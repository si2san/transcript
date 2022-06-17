<?php

declare(strict_types=1);

namespace SiThuSan\Transcript;

final class Line
{
    public function __construct(
        private int $position,
        private string $timestamp,
        private string $body
    ) {
        //
    }

    public function toHtml()
    {
        return "<a href=\"?time={$this->beginningTimestamp()}\">{$this->body}</a>";
    }

    public function beginningTimestamp()
    {
        \preg_match('/^\d{2}:(\d{2}:\d{2})\.\d{3}/', $this->timestamp, $matches);

        return $matches[1];
    }
}
