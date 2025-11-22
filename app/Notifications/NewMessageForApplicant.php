<?php

namespace App\Notifications;

use App\Models\ApplicationMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessageForApplicant extends Notification
{
    use Queueable;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public ApplicationMessage $applicationMessage
    ) {}

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $application = $this->applicationMessage->application;
        $jobTitle = $application->jobPosting->title;

        return (new MailMessage)
                    ->subject("A new message regarding your application for {$jobTitle}")
                    ->greeting('Hello ' . $notifiable->first_name . ',')
                    ->line('You have received a new message from the HR team at Evergreen Solutions.')
                    ->line('Message: "' . $this->applicationMessage->message . '"') // Added quotes for clarity
                    ->action('View My Applications', route('applicant.applications.index'))
                    ->line('Thank you for your continued interest in our company.');
    }
}