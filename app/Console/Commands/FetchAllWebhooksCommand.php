<?php

namespace App\Console\Commands;

use App\DataObjects\WebhookData;
use Illuminate\Console\Command;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class FetchAllWebhooksCommand extends Command
{

    protected $signature = 'trello-webhooks:all';

    protected $description = 'fetch all trello webhooks';

    public function handle()
    {
        $authHeader = 'OAuth oauth_consumer_key="';
        $authHeader .= config('services.trello.key');
        $authHeader .= '",oauth_token="'.config('services.trello.token').'"';

        $response = Http::withHeaders([
            'Authorization' => $authHeader,
        ])->get('https://api.trello.com/1/tokens/'.config('services.trello.token').'/webhooks');

        if ($response->status() !== Response::HTTP_OK) {
            $this->error('Failed to fetch webhooks.');

            return Command::FAILURE;
        }

        $webhookRows = WebhookData::collection($response->json())
            ->only('id', 'idModel', 'active', 'consecutiveFailures');

        $this->table(
            [
                'id',
                'idModel',
                'active',
                'consecutiveFailures',
            ],
            $webhookRows,
        );

        $this->line('Total number of webhooks: '.count($response->json()));

        return Command::SUCCESS;
    }
}
