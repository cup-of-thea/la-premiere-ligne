<?php

namespace App\BoundedContexts\Builder\Domain;

use League\CommonMark\CommonMarkConverter;

class MarkdownFile
{
    private function __construct(
        public readonly string $filename,
        public readonly string $content
    )
    {
    }

    public static function From(string $filename, string $content): self
    {
        return new self(str($filename)->beforeLast("."), $content);
    }

    public function convertedContent(): string
    {
        return (New CommonMarkConverter())->convert($this->content)->getContent();
    }
}