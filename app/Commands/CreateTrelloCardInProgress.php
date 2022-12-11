<?php


namespace App\Commands;

use App\Models\Pm;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;
use Trello\Client;

class CreateTrelloCardInProgress extends Command
{
    protected $name = 'createCardInProgress';

    protected $description = 'Команда для створення нової карточки в дошці Trello, в колонці "In Progress"';

    public function handle()
    {
        $client = new Client();
        $client->authenticate(env('TRELLO_API_KEY'), env('TRELLO_API_TOKEN'), Client::AUTH_URL_CLIENT_ID);

        $params = [
            'idList' => '6393844f73e54901f567b3f6',
            'name' => 'Test create card in "In Progress"',
            'desc' => 'Description for test card'
        ];

        $client->cards()->create($params);

        $this->replyWithMessage([
            'text' => 'Привіт! Картку в "In Progress" створено',
        ]);
    }
}
