<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use SiThuSan\Transcript\Line;
use SiThuSan\Transcript\Transcription;

final class TranscriptionTest extends TestCase
{
    private string $path = '/stubs/basic-example.vtt';

    public function testItLoadAVttFile(): void
    {
        $file = __DIR__ . $this->path;

        $transcription = Transcription::load($file)->toString();

        $this->assertStringContainsString('Here is a', $transcription);
    }


    public function testCanConvertToAnArrayOfLinesObject(): void
    {
        $file = __DIR__ . $this->path;
        $lines = Transcription::load($file)->lines();

        $this->assertCount(2, $lines);
        $this->assertContainsOnlyInstancesOf(Line::class, $lines);
    }

    public function testDiscardsIrrelevantLinesFromTheVttFile(): void
    {
        $file = __DIR__ . $this->path;

        $transcription = Transcription::load($file);

        $this->assertStringNotContainsString('WEBVTT', $transcription->toString());
        $this->assertCount(2, $transcription->lines());
    }
}
