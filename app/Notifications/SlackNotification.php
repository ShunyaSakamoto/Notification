<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class SlackNotification extends Notification
{
    use Queueable;

    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        $url = url('/slack/complete/?id='. base64_encode($this->user->id));

        return (new SlackMessage)
            ->success()
            ->from(config('services.slack.name'), config('services.slack.icon'))
            ->content('お問い合わせがありましたよ！')
            ->attachment(function($attachment) use($url) {
                $attachment->title('お問い合わせ内容', $url)
                    ->fields([
                        'お名前' => $this->user->name,
                        'メールアドレス' => $this->user->email,
                        'お問い合わせ内容' => $this->user->content,
                    ]);
            });
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
