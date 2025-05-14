<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class TaskAssigned extends Notification
{
    use Queueable;

    protected $tasks;
    protected $admin;
    /**
     * Create a new notification instance.
     */
    public function __construct($tasks,User $admin)
    {
        Log::info("Inside constructor");
        // dd($tasks);
        $this->tasks = $tasks;
        $this->admin = $admin;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //         ->line('The introduction to the notification.')
    //         ->action('Notification Action', url('/'))
    //         ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        // dd($this->tasks);
        // dd($this->admin);
         return [
            'tasks' => collect($this->tasks)->map(function ($task) {
                return [
                    'task_id' => $task->id,
                    'task_title' => $task->title,
                ];
            }),
            'admin_id' => $this->admin->id,
            'admin_name' => $this->admin->name,
            'message' => 'You have been assigned new tasks by ' . $this->admin->name,
        ];
    }
}
