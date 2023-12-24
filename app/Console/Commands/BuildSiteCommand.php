<?php

namespace App\Console\Commands;

use App\BoundedContexts\Builder\Domain\MarkdownBuilder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\BoundedContexts\Builder\Domain\MarkdownFile;

class BuildSiteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:build-site';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build the site from markdown files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        MarkdownBuilder::Build();
    }
}
