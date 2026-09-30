<?php

declare(strict_types=1);

/**
 * Report classes in src/ that no other production code references.
 *
 * PHPStan's dead-code rules analyse src/ and tests/ together, so a class used
 * only by its own tests counts as used — that is how six orphaned schema
 * classes survived. This gate ignores tests entirely: every class must be
 * referenced from another src/ file, except the entry point consumers
 * construct (AugurApiClient). Public members of reachable classes are consumer
 * API and are not judged here.
 *
 * Run: composer deadcode
 */

const ENTRY_POINTS = ['AugurApi\\AugurApiClient'];

$srcDir = dirname(__DIR__) . '/src';

/**
 * @return array<string, string> file path => contents, for every PHP file under $dir
 */
function readSources(string $dir): array
{
    $sources = [];
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS));
    foreach ($files as $file) {
        if ($file instanceof SplFileInfo && $file->getExtension() === 'php') {
            $sources[$file->getPathname()] = (string) file_get_contents($file->getPathname());
        }
    }
    ksort($sources);

    return $sources;
}

/**
 * @return array{namespace: string, class: string}|null the declared class-like, if any
 */
function declaredClass(string $code): ?array
{
    $hasNamespace = preg_match('/^namespace\s+([^;]+);/m', $code, $ns) === 1;
    $hasClass = preg_match('/^(?:final\s+|abstract\s+|readonly\s+)*(?:class|interface|trait|enum)\s+(\w+)/m', $code, $cls) === 1;
    if (!$hasNamespace || !$hasClass) {
        return null;
    }

    return ['namespace' => $ns[1], 'class' => $cls[1]];
}

/**
 * Does $code reference the class $fqcn declared in $namespace?
 * By fully-qualified name (use statements, \FQCN), or by short name from the same namespace.
 */
function references(string $code, string $fqcn, string $namespace, string $class): bool
{
    if (str_contains($code, $fqcn)) {
        return true;
    }
    $declared = declaredClass($code);
    $sameNamespace = $declared !== null && $declared['namespace'] === $namespace;

    return $sameNamespace && preg_match('/\b' . preg_quote($class, '/') . '\b/', $code) === 1;
}

/**
 * @param array<string, string> $sources
 */
function isReferenced(string $path, string $fqcn, string $namespace, string $class, array $sources): bool
{
    foreach ($sources as $otherPath => $code) {
        if ($otherPath !== $path && references($code, $fqcn, $namespace, $class)) {
            return true;
        }
    }

    return false;
}

$sources = readSources($srcDir);
$orphans = [];
foreach ($sources as $path => $code) {
    $declared = declaredClass($code);
    if ($declared === null) {
        continue;
    }
    $fqcn = $declared['namespace'] . '\\' . $declared['class'];
    if (in_array($fqcn, ENTRY_POINTS, true)) {
        continue;
    }
    if (!isReferenced($path, $fqcn, $declared['namespace'], $declared['class'], $sources)) {
        $orphans[] = substr($path, strlen(dirname($srcDir)) + 1) . ': ' . $fqcn;
    }
}

if ($orphans === []) {
    echo 'Dead code: every class in src/ is reachable from production code' . PHP_EOL;
    exit(0);
}

fwrite(STDERR, 'deadcode: FAILED — ' . count($orphans) . " class(es) referenced by no other src/ file\n\n");
foreach ($orphans as $line) {
    fwrite(STDERR, "  {$line}\n");
}
fwrite(STDERR, "\nDelete them — do not keep them alive with tests.\n");
exit(1);
