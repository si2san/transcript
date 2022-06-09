<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use SiThuSan\Transcript\Transcription;

final class TranscriptionTest extends TestCase
{
    private string $path= '/stubs/basic-example.vtt';

    public function testItLoadAVttFile(): void
    {
        $file = __DIR__ . $this->path;

        $transcription = Transcription::load($file)->toString();

        $this->assertStringContainsString('Here is a', $transcription);
    }

    public function testCanConvertToAnArrayOfLines(): void
    {
        $file = __DIR__ . $this->path;

        $this->assertCount(4, Transcription::load($file)->lines());
    }

    public function testDiscardsIrrelevantLinesFromTheVttFile(): void
    {
        $file = __DIR__ . $this->path;

        $transcription = Transcription::load($file);

        $this->assertStringNotContainsString('WEBVTT', $transcription->toString());
        $this->assertCount(4, $transcription->lines());
    }
}
