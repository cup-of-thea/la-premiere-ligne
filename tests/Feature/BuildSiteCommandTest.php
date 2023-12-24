<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use App\Console\Commands\BuildSiteCommand;

class BuildSiteCommandTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Storage::fake();

        // Given we have markdown files
        foreach(TestEntries::GetCases() as $case) {
            Storage::put("$case->name.md", $case->originalContent);
        }

        BuildSiteCommand::Build();
    }

    public function test_it_creates_a_html_content_file_for_each_markdown_file(): void
    {
        foreach(TestEntries::GetCases() as $case) {
            Storage::assertExists("$case->name.html");
            
            $this->assertStringContainsString($case->expectedContent, Storage::get("$case->name.html"));
        }
    }
}

class TestEntries
{
    /**
     * @return array<TestEntry>
     */
    public static function GetCases()
    {
        return [
            TestEntry::Build('test', '# Hello World', '<h1>Hello World</h1>'),
            TestEntry::Build('test2', '# Hello World 2', '<h1>Hello World 2</h1>')
        ];
    }
}

class TestEntry
{
    private function __construct(
        public readonly string $name,
        public readonly string $originalContent,
        public readonly string $expectedContent
    ) {}

    public static function Build(...$args): self
    {
        return new self(...$args);
    }
}
