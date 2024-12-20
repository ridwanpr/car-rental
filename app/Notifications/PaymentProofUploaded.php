<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentProofUploaded extends Notification implements ShouldQueue
{
    use Queueable;

    public $payment;

    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('A new payment request is waiting for confirmation')
            ->line('A new payment request has been created by user: ' . $this->payment->user->name)
            ->line('Payment ID: ' . $this->payment->id)
            ->line('Payment Code: ' . $this->payment->payment_code)
            ->line('Total Amount: ' . $this->payment->total_amount)
            ->action('View Payment', route('payment-request.index'))
            ->line('Please review the payment proof.');
    }
}
