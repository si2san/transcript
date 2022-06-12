<?php

declare(strict_types=1);

namespace SiThuSan\Transcript;

final class Line
{
    public function __construct(private string $timestamp, private string $body)
    {
        //
    }

    public function toAnchorTag(): string
    {
        return "<a href='?time={$this->getBeginningTimestamp()}'>{$this->body}</a>";
    }

    public function getBeginningTimestamp(): string
    {
        \preg_match('/^\d{2}:(\d{2}:\d{2})\.\d{3}/', $this->timestamp, $matches);

        return $matches[1];
    }

    public static function valid(string $line): bool
    {
        return $line !== '' && $line !== 'WEBVTT' && !\is_numeric($line);
    }
}
