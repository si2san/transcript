<?php

declare(strict_types=1);

namespace Tests;

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
        $this->assertStringContainsString('Here is a', $this->transcription->__toString());
    }

    /**
     * @group failing
     */
    public function testCanConvertToAnArrayOfLinesObject(): void
    {
        $lines = $this->transcription->lines();
        var_dump($lines->count());
        $this->assertCount(2, $lines->count());
        $this->assertContainsOnlyInstancesOf(Line::class, $lines);
    }
    public function testDiscardsIrrelevantLinesFromTheVttFile(): void
    {
        $this->assertStringNotContainsString('WEBVTT', $this->transcription->lines()->__toString());
        $this->assertCount(2, $this->transcription->lines());
    }

    public function testRenderTheLinesAsHtml(): void
    {
        $excepted  = <<<EOT
        <a href='?time=00:03'>Here is a</a>
        <a href='?time=00:04'>example of a VTT file.</a>
        EOT;

        $result = $this->transcription->lines()->ashtml();

        $this->assertEquals($excepted, $result);
    }
}
