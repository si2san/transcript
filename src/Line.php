<?php

declare(strict_types=1);

namespace SiThuSan\Transcript;

final class Line
{
    public function __construct(private string $timestamp, private string $body)
    {
        //
    }

    public static function valid(string $line): bool
    {
        return $line !== '' && $line !== 'WEBVTT' && !\is_numeric($line);
    }
}
