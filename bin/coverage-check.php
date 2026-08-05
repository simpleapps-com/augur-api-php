#!/usr/bin/env php
<?php

declare(strict_types=1);

/**
 * Fail the build when line coverage falls below a threshold.
 *
 * PHPUnit has no native fail-under option (unlike pytest-cov's --cov-fail-under),
 * so the threshold is enforced here against the Clover report.
 *
 * Usage: php bin/coverage-check.php <clover.xml> <min-percent>
 *
 * Coverage is computed from Clover's <metrics> totals rather than by re-walking
 * <line> elements, so it matches the percentage PHPUnit prints. Files in
 * phpunit.xml's <source> that are never loaded still appear in the report with
 * zero covered statements — which is what makes an orphaned class visible here.
 */
$cloverPath = $argv[1] ?? null;
$threshold = isset($argv[2]) ? (float) $argv[2] : 100.0;

if ($cloverPath === null) {
    fwrite(STDERR, "usage: coverage-check.php <clover.xml> <min-percent>\n");
    exit(2);
}

if (!is_file($cloverPath)) {
    fwrite(STDERR, "coverage-check: report not found: {$cloverPath}\n");
    fwrite(STDERR, "Run the suite with --coverage-clover first.\n");
    exit(2);
}

$xml = @simplexml_load_file($cloverPath);

if ($xml === false) {
    fwrite(STDERR, "coverage-check: could not parse {$cloverPath}\n");
    exit(2);
}

$metrics = $xml->xpath('/coverage/project/metrics');

// xpath() yields an empty array when the path matches nothing. Any other
// malformed shape lands on the isset() guard, which also absorbs the
// documented-but-unstubbed false return.
if ($metrics === [] || !isset($metrics[0]['statements'])) {
    fwrite(STDERR, "coverage-check: no project metrics in {$cloverPath}\n");
    exit(2);
}

$statements = (int) $metrics[0]['statements'];
$covered = (int) $metrics[0]['coveredstatements'];

// No statements at all means the source filter matched nothing. Treating that
// as 100% would let a misconfigured <source> silently pass the gate.
if ($statements === 0) {
    fwrite(STDERR, "coverage-check: report contains no statements — check <source> in phpunit.xml\n");
    exit(2);
}

$percent = $covered / $statements * 100;

// Round to the same 2dp PHPUnit reports, so a displayed "100.00%" never fails.
$rounded = round($percent, 2);

printf("Line coverage: %.2f%% (%d/%d statements), threshold %.2f%%\n", $rounded, $covered, $statements, $threshold);

if ($rounded < $threshold) {
    $uncovered = $statements - $covered;
    fwrite(STDERR, sprintf(
        "coverage-check: FAILED — %.2f%% is below the %.2f%% threshold (%d uncovered statement%s).\n",
        $rounded,
        $threshold,
        $uncovered,
        $uncovered === 1 ? '' : 's',
    ));
    fwrite(STDERR, "A class at 0% may be unreachable rather than untested — run 'composer analyse' to check\n");
    fwrite(STDERR, "before writing tests for it. See coverage/index.html for the per-class breakdown.\n");
    exit(1);
}

exit(0);
