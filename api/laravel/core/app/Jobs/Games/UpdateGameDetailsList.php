<?php

namespace App\Jobs\Games;

use App\Services\Interfaces\IGameUpdateService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateGameDetailsList implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected IGameUpdateService $apiService, protected $id)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->apiService->updateGameDetailsDatabase($this->id);
    }
}
