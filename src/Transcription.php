<?php

declare(strict_types=1);

namespace SiThuSan\Transcript;

final class Transcription
{
    public function __construct(private array $lines)
    {
        $this->lines = $this->discardInvalidLines(\array_map('trim', $lines));
    }

    public static function load(string $path): self
    {
        return new static(\file($path));
    }

    public function lines(): array
    {
        $lines = [];

        for ($i = 0; $i < count($this->lines); $i += 2) {
            $lines[] = new Line($this->lines[$i], $this->lines[$i + 1]);
        }

        return $lines;
    }

    public function toString(): string
    {
        return \implode("", $this->lines);
    }

    private function discardInvalidLines(array $lines): array
    {
        // rekey the array
        return \array_values(\array_filter(
            $lines,
            fn ($line) => Line::valid($line)
        ));
    }
}
