<?php


namespace App\Commands;

use App\Models\Pm;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class CreateTrelloDesk extends Command
{
    protected $name = 'create';

    protected $description = 'show command';

    public function handle()
    {
//        $result = $this->getTelegram()->getWebhookUpdate();
//        $userFirstName = isset($result["message"]["from"]["first_name"]) ? $result["message"]["from"]["first_name"] : "";
//        $userLastName = isset($result["message"]["from"]["last_name"]) ? $result["message"]["from"]["last_name"] : "";
//
//        $this->replyWithChatAction([
//            'action' => Actions::TYPING,
//        ]);
//
//
//        if (isset($userFirstName)) {
//            if (!Pm::query()->where('first_name', $userFirstName)->exists()) {
//                Pm::query()->create([
//                    'first_name' => $userFirstName,
//                    'last_name' => $userLastName,
//                ]);
//            }
//            $this->replyWithMessage([
//                'text' => 'Привіт '. $userFirstName .'! Ласкаво прошу',
//            ]);
//        }
//
//        $response = '';
//        $commands = $this->getTelegram()->getCommands();
//
//        foreach ($commands as $name => $command) {
//            $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
//        }
//
//        $this->replyWithMessage([
//            'text' => $response,
//        ]);
//    }

//        $result = $this->getTelegram()->getWebhookUpdate();
//        $userFirstName = isset($result["action"]["data"]["list_before"]) ? $result["action"]["data"]["list_before"]['name'] : "";
//        $userLastName = isset($result["message"]["from"]["last_name"]) ? $result["message"]["from"]["last_name"] : "";
//
//        $this->replyWithChatAction([
//            'action' => Actions::TYPING,
//        ]);
//
//
//        if (isset($userFirstName)) {
//
//            $this->replyWithMessage([
//                'text' => 'Привіт '. $userFirstName .'! Ласкаво прошу',
//            ]);
//        }

//        $client = new Client();
//
//        $client->authenticate(env('TRELLO_API_KEY'), env('TRELLO_TOKEN'), Client::AUTH_URL_CLIENT_ID);
//
//        $boards = $client->api('member')->boards()->all();
//
//        $this->replyWithMessage([
//            'text' =>  $request
//        ]);

//        $apiKey = env('TRELLO_API_KEY');
//        $apiToken = env('TRELLO_TOKEN');
//
//        $requestUrl = "https://api.trello.com/1/members/me/boards?key={$apiKey}&token={$apiToken}";
//
//        $response = $this->httpClient->get($requestUrl);
//
//        $data = json_decode($response->getBody(), false, 512, JSON_THROW_ON_ERROR);

//        $this->replyWithMessage([
//            'text' => $data,
//        ]);

    }


}
