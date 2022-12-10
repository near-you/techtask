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
     * @throws \JsonException
     */
    public function __invoke(Request $request): Response
    {
        $cardInfo = $this->trelloCardInfo($request);

        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        $telegram->sendMessage([
            'chat_id' => '-873615663',
            'text' => $cardInfo
        ]);

        return response(null, Response::HTTP_OK);
    }

    private function trelloCardInfo($request): string
    {
        $data = $request->toArray();

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
