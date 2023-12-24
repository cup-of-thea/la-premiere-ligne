<?php

namespace App\BoundedContexts\Builder\Domain;

use Illuminate\Support\Facades\Storage;
use App\BoundedContexts\Builder\Domain\MarkdownFile;

class MarkdownBuilder
{
    public static function Build()
    {
        foreach(Storage::files(recursive: true) as $filename) {
            $content = Storage::get($filename);
            $markdown = MarkdownFile::From($filename, $content);
            self::createFile($markdown);
        }
    }

    public static function createFile(MarkdownFile $markdown)
    {
        Storage::put("{$markdown->filename}.html", $markdown->convertedContent());
    }
}