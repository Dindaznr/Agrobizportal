<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendOrderCreatedEmail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The user object.
     *
     * @var Object
     */
    public $user;
    
    /**
     * The order object.
     *
     * @var Object
     */
    public $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = 'Menunggu Pembayaran transfer untuk pembayaran'. $this->order->code;
        $greeting = 'Mohon segera selesaikan pembayaran Anda';
        $status = 'Mohon segera selesaikan pembayaran Anda ke nomor rekening Mandiri virtual account Kami : 900-00-405 0845-0';
        if ($this->order->payment == 'cod') {
            $subject = 'Menunggu Pembayaran oleh kurir untuk pembayaran'. $this->order->code;
            $greeting = 'Mohon tunggu sampai kurir tiba di lokasi Anda';
            $status = 'Silahkan lakukan pembayaran saat kurir Anda tiba';
        }
        return (new MailMessage)
                ->subject(__($subject))
                ->greeting(__($greeting))
                ->line(__('Hallo '. $this->user->customer->name))
                ->line(__($status))
                ->line(__('Checkout berhasil pada: '. Carbon::now()->format('d/m/Y H:i:s')))
                ->action(__('Check status order Anda'), url('people/order'))
                ->line(__('Email dibuat secara otomatis. Mohon tidak mengirimkan balasan ke email ini.'));
    }
}
