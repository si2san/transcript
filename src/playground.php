<?php

declare(strict_types=1);

use SiThuSan\Transcript\Transcription;

require 'vendor/autoload.php';

$path = __DIR__ . '/../tests/stubs/basic-example.vtt';

Transcription::load($path)->htmlLines();
