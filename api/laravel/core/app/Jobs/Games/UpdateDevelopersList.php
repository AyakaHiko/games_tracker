<?php

namespace App\Jobs\Games;

use App\Services\Interfaces\IGameApiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateDevelopersList implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected IGameApiService $apiService)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->apiService->updateDevelopersDatabase();
    }
}
