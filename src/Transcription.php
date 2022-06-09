<?php

declare(strict_types=1);

namespace SiThuSan\Transcript;

final class Transcription
{
    private array $lines;

    public static function load(string $path): self
    {
        $instance = new static();

        $instance->lines = $instance->discardIrrelevantLines(\file($path));

        return $instance;
    }

    public function lines(): array
    {
        return $this->lines;
    }

    public function toString(): string
    {
        return \implode("", $this->lines);
    }

    private function discardIrrelevantLines(array $lines): array
    {
        // rekey the array
        return \array_values(\array_filter(
            \array_map('trim', $lines),
            fn ($line) => $line !== '' && $line !== 'WEBVTT' && !is_numeric($line)
        ));
    }
}
