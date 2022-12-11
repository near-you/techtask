<?php


namespace App\Commands;

use Telegram\Bot\Commands\Command;
use Trello\Client;

class CreateTrelloCardToDo extends Command
{
    protected $name = 'createCardToDo';

    protected $description = 'Команда для створення нової карточки в дошці Trello, в колонці "To Do"';

    public function handle()
    {
        $client = new Client();
        $client->authenticate(env('TRELLO_API_KEY'), env('TRELLO_API_TOKEN'), Client::AUTH_URL_CLIENT_ID);

        $params = [
            'idList' => '6393844f73e54901f567b3f5',
            'name' => 'Test create card',
            'desc' => 'Description for test card'
        ];

        $client->cards()->create($params);

        $this->replyWithMessage([
            'text' => 'Привіт! Картку в "ToDo" створено',
        ]);
    }
}
