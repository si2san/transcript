<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use SiThuSan\Transcript\Line;
use SiThuSan\Transcript\Transcription;

final class TranscriptionTest extends TestCase
{
    private string $path =  __DIR__ . '/stubs/basic-example.vtt';

    public function testItLoadAVttFile(): void
    {
        $transcription = Transcription::load($this->path)->toString();

        $this->assertStringContainsString('Here is a', $transcription);
    }


    public function testCanConvertToAnArrayOfLinesObject(): void
    {
        $lines = Transcription::load($this->path)->lines();

        $this->assertCount(2, $lines);
        $this->assertContainsOnlyInstancesOf(Line::class, $lines);
    }

    public function testDiscardsIrrelevantLinesFromTheVttFile(): void
    {

        $transcription = Transcription::load($this->path);

        $this->assertStringNotContainsString('WEBVTT', $transcription->toString());
        $this->assertCount(2, $transcription->lines());
    }

    /**
     * @groupfailing
     */
    public function testRenderTheLinesAsHtml(): void
    {
        $transcription = Transcription::load($this->path);

        $excepted  = <<<EOT
        <a href='?time=00:03'>Here is a</a>
        <a href='?time=00:04'>example of a VTT file.</a>
        EOT;

        $result = $transcription->htmlLines();

        $this->assertEquals($excepted, $result);
    }
}
