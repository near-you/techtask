<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Telegram\Bot\Actions;
use Telegram\Bot\BotsManager;
use Telegram\Bot\Exceptions\TelegramSDKException;

class WebhookController extends Controller
{
    private BotsManager $botsManager;

    public function __construct(BotsManager $botsManager)
    {
        $this->botsManager = $botsManager;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     * @throws TelegramSDKException
     */
    public function __invoke(Request $request): Response
    {
        $webhook = $this->botsManager->bot()->commandsHandler(true);

//        $test = $request->getContent();
//        $bot = $this->botsManager->bot();
//        $bot->sendMessage([
//            //'chat_id' => $chat->id,
//            'text' => $request['action'],
//        ]);

        //  $test = $this->addPmToDataBase($request);

        //$bot = $this->botsManager->bot();

//        $result = $this->getTelegram()->getWebhookUpdate();
//        $userFirstName = isset($result["action"]["data"]["list_before"]) ? $result["action"]["data"]["list_before"]['name'] : "";
//        $userLastName = isset($result["message"]["from"]["last_name"]) ? $result["message"]["from"]["last_name"] : "";
//
//        $this->replyWithChatAction([
//            'action' => Actions::TYPING,
//        ]);
//
//        $message = $webhook->getMessage();
//        $bot = $this->botsManager->bot();
//        $bot->sendMessage([
//            //'chat_id' => $chat->id,
//            'text' => $userFirstName,
//        ]);
//        if ($message->isType('action')) {
//            $action = $message->action;
//            $chat = $message->chat;
//
//            $bot->sendChatAction([
//                'chat_id' =>  -873615663,
//                'action' => Actions::TYPING,
//            ]);
//
//            //$weatherInfo = $this->weatherInformation($location->latitude, $location->longitude);
//
//            $bot->sendMessage([
//                'chat_id' => $chat->id,
//                'text' => $request['action'],
//            ]);
//        }

        return response()->noContent(Response::HTTP_OK);
    }

    private function weatherInformation($latitude, $longitude): string
    {
        $apiToken = env('WEATHER_TOKEN');

        $requestUrl = "https://api.openweathermap.org/data/2.5/weather?lat={$latitude}&lon={$longitude}&units=metric&lang=ua&appid={$apiToken}";

        $response = $this->httpClient->get($requestUrl);

        $data = json_decode($response->getBody(), false, 512, JSON_THROW_ON_ERROR);

        $city = $data->name . "\n\n";
        $temp = $data->main->temp . "℃\n";
        $pressure = $data->main->pressure . "℃\n";
        $humidity = $data->main->humidity . "℃\n";

        $weatherInfo = 'Місто : ' . $city;
        $weatherInfo .= 'Температура повітря : ' . $temp;
        $weatherInfo .= 'Атмосферній тиск : ' . $pressure;
        $weatherInfo .= 'Вологість повітря : ' . $humidity;

        return $weatherInfo;
    }

}
