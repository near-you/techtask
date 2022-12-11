<?php


namespace App\Commands;


use App\Models\Pm;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    protected $name = 'start';

    protected $description = 'Команда для привітання нового користувача та запису його в базу даних';

    public function handle()
    {
        $result = $this->getTelegram()->getWebhookUpdate();
//        $userFirstName = isset($result["message"]["from"]["first_name"]) ? $result["message"]["from"]["first_name"] : "";
        $userId = $result->message->from->id ?? 0;
        $chatId = $result["message"]["chat"]["id"] ?? 0;
        $userFirstName = $result->message->from->first_name ?? '';
        $userLastName = $result->message->from->last_name ?? '';


        $this->replyWithChatAction([
            'action' => Actions::TYPING,
        ]);

        if (!empty($userId)) {
            if (!Pm::query()->where('user_id', $userId)->exists()) {
                Pm::query()->create([
                    'user_id' => $userId,
                    'chat_id' => $chatId,
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

        $response .= "\n\n Прейти до дошки - https://trello.com/b/vcULQAGS/tasks";
        $this->replyWithMessage([
            'text' => $response,
        ]);
    }
}
