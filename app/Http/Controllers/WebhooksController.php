<?php

namespace App\Http\Controllers;

use Telegram\Bot\Api;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Telegram\Bot\BotsManager;
use Telegram\Bot\Exceptions\TelegramSDKException;

class WebhooksController extends Controller
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
        $data = $request->toArray();
        if (isset($data['action']['type']) && $data['action']['type'] == 'updateCard') {
            if (isset($data['action']['data']['listBefore'])) {
                $cardInfo = $this->trelloCardInfo($data);
                $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
                $telegram->sendMessage([
                    'chat_id' => '-873615663',
                    'text' => $cardInfo
                ]);
            }
        }

        return response(null, Response::HTTP_OK);
    }

    private function trelloCardInfo($data): string
    {

        $board = $data['action']['data']['board']['name'] . "\n\n";
        $cardName = $data['action']['data']['card']['name']. "\n";
        $listBefore = $data['action']['data']['listBefore']['name'] . "\n";
        $listAfter = $data['action']['data']['listAfter']['name'] . "\n";

        $cardInfo = 'Board : ' . $board;
        $cardInfo .= 'Card name : ' . $cardName;
        $cardInfo .= 'Before : ' . $listBefore;
        $cardInfo .= 'After : ' . $listAfter;

        return $cardInfo;



    }

}
