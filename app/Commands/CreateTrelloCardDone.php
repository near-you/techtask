<?php


namespace App\Commands;


use Telegram\Bot\Commands\Command;
use Trello\Client;


class CreateTrelloCardDone extends Command
{
    protected $name = 'createCardDone';

    protected $description = 'Команда для створення нової карточки в дошці Trello, в колонці "Done"';

    public function handle()
    {
        $client = new Client();
        $client->authenticate(env('TRELLO_API_KEY'), env('TRELLO_API_TOKEN'), Client::AUTH_URL_CLIENT_ID);

        $params = [
            'idList' => '6393844f73e54901f567b3f7',
            'name' => 'Test create card in "Done"',
            'desc' => 'Description for test card'
        ];

        $client->cards()->create($params);

        $this->replyWithMessage([
            'text' => 'Привіт! Картку в "Done" створено',
        ]);
    }
}
