<?php

namespace App\Jobs\Games;

use App\Models\Game;
use App\Services\GamesApiService;
use App\Services\GamesService;
use app\Services\Interfaces\IGameApiService;
use http\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;

class UpdateGameList implements ShouldQueue
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
        $this->apiService->updateGamesDatabase();
    }

}
