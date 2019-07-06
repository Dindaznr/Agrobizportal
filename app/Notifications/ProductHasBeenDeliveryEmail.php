<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProductHasBeenDeliveryEmail extends Notification implements ShouldQueue
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
        return (new MailMessage)
                ->subject(__('Checkout Pesanan transfer bank Berhasil tanggal '. Carbon::now()->format('d/m/Y')))
                ->greeting(__('Pesanan Anda telah kami teruskan ke Penjual'))
                ->line(__('Hallo '. $this->user->customer->name))
                ->line(__('Terima kasih telah menyelesaikan transaksi di Agrobizportal. Pembayaran menggunakan transfer bank berhasil.'))
                ->action(__('Check status order Anda'), url('people/order'))
                ->line(__('Email dibuat secara otomatis. Mohon tidak mengirimkan balasan ke email ini.'));
    }
}
