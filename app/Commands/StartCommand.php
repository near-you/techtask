<?php


namespace App\Commands;


use App\Models\Pm;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    protected $name = 'start';

    protected $description = 'Start command';

    public function handle()
    {
        $result = $this->getTelegram()->getWebhookUpdate();
//        $userFirstName = isset($result["message"]["from"]["first_name"]) ? $result["message"]["from"]["first_name"] : "";
        $userFirstName = $result->message->from->first_name ?? "";
        $userLastName = $result->message->from->last_name ?? "";

        $this->replyWithChatAction([
            'action' => Actions::TYPING,
        ]);


        if (isset($userFirstName)) {
            if (!Pm::query()->where('first_name', $userFirstName)->exists()) {
                Pm::query()->create([
                    'first_name' => $userFirstName,
                    'last_name' => $userLastName,
                ]);
            }
            $this->replyWithMessage([
                'text' => 'Привіт '. $userFirstName . ' ' . $userLastName .'! Ласкаво прошу',
            ]);
        }

        $response = '';
        $commands = $this->getTelegram()->getCommands();

        foreach ($commands as $name => $command) {
            $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
        }

        $this->replyWithMessage([
            'text' => $response,
        ]);
    }
}
