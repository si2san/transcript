<?php

declare(strict_types=1);

namespace SiThuSan\Transcript;

final class Lines extends Collection
{
    public function asHtml(): string
    {
        return (string) $this->map(fn (Line $line) => $line->toHtml());
    }

    public function __toString(): string
    {
        return \implode("\n", $this->items);
    }
}
