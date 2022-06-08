<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use SiThuSan\Transcript\Transcription;

final class TranscriptionTest extends TestCase
{
    public function testItLoadAVttFile(): void
    {
        $path = '/stubs/basic-example.vtt';
        $transcription = Transcription::load(__DIR__ . $path);
        $excepted = \file_get_contents(__DIR__ . $path);

        $this->assertEquals($excepted, $transcription);
    }
}
