<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DeleteSeriesCover implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Make the seriesCoverPath nullable by changing the type hint to ?string
    public function __construct(private readonly ?string $seriesCoverPath)
    { }

    public function handle()
    {
        // Check if $seriesCoverPath is not null before attempting to delete the file
        if ($this->seriesCoverPath) {
            Storage::disk('public')->delete($this->seriesCoverPath);
        } else {
            // Optionally log a warning if seriesCoverPath is null
            \Log::warning('Attempted to delete series cover, but the path is null.');
        }
    }
}
