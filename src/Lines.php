<?php

declare(strict_types=1);

namespace SiThuSan\Transcript;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

final class Lines implements Countable, IteratorAggregate
{
    public function __construct(private array $lines)
    {
        //
    }

    public function asHtml(): string
    {
        $formattedLines = \array_map(
            fn (Line $line) => $line->toHtml(),
            $this->lines
        );

        return (new static($formattedLines))->__toString();
    }

    public function count(): int
    {
        return \count($this->lines);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->lines);
    }

    public function __toString(): string
    {
        return \implode("\n", $this->lines);
    }
}
