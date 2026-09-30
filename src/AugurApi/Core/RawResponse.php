<?php

declare(strict_types=1);

namespace AugurApi\Core;

/**
 * An HTTP response as received: status, content type and body text.
 *
 * The body is parsed once; $isJson says whether the text is valid JSON and
 * $json holds the decoded value (objects as associative arrays), else null.
 */
final class RawResponse
{
    public readonly bool $isJson;
    public readonly mixed $json;

    public function __construct(
        public readonly int $status,
        public readonly string $contentType,
        public readonly string $text,
    ) {
        try {
            $this->json = json_decode($text, true, 512, JSON_THROW_ON_ERROR);
            $this->isJson = true;
        } catch (\JsonException) {
            $this->json = null;
            $this->isJson = false;
        }
    }
}
