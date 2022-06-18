<?php

declare(strict_types=1);

namespace Tests;

use ArrayAccess;
use JsonSerializable;
use PHPUnit\Framework\TestCase;
use SiThuSan\Transcript\Line;
use SiThuSan\Transcript\Transcription;

final class TranscriptionTest extends TestCase
{
    private Transcription $transcription;

    protected function setUp(): void
    {
        $this->transcription = Transcription::load(__DIR__ . '/stubs/basic-example.vtt');
    }

    public function testItLoadAVttFile(): void
    {
        $this->assertStringContainsString('Here is a', (string) $this->transcription);
    }


    public function testCanConvertToAnArrayOfLinesObject(): void
    {
        $lines = $this->transcription->lines();

        $this->assertCount(2, $lines);
        $this->assertContainsOnlyInstancesOf(Line::class, $lines);
    }


    public function testDiscardsIrrelevantLinesFromTheVttFile(): void
    {
        $this->assertStringNotContainsString('WEBVTT', (string) $this->transcription);
        $this->assertCount(2, $this->transcription->lines());
    }

    public function testRenderTheLinesAsHtml(): void
    {
        $excepted  = <<<EOT
        <a href="?time=00:03">Here is a</a>
        <a href="?time=00:04">example of a VTT file.</a>
        EOT;

        $result = $this->transcription->lines()->ashtml();

        $this->assertEquals($excepted, $result);
    }

    public function testSupportArrayAccess(): void
    {
        $lines = $this->transcription->lines();

        $this->assertInstanceOf(ArrayAccess::class, $lines);
        $this->assertInstanceOf(Line::class, $lines[0]);
    }

    public function testCanRenderAsJson(): void
    {
        $lines = $this->transcription->lines();

        $this->assertInstanceOf(JsonSerializable::class, $lines);
        $this->assertJson(\json_encode($lines));
    }
}
