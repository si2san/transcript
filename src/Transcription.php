<?php

declare(strict_types=1);

namespace SiThuSan\Transcript;

final class Transcription
{
    private string $file;

    public static function load(string $path): self
    {
        $instance = new static();
        $instance->file = \file_get_contents($path);

        return $instance;
    }

    public function __toString(): string
    {
        return $this->file;
    }
}
