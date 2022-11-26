<?php

namespace App\Mail\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SuccessPaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public Order $order;
    public string $trackingCode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Order $order, string $trackingCode)
    {
        $this->user = $user;
        $this->order = $order;
        $this->trackingCode = $trackingCode;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(

            from: new Address(
                env("MAIL_FROM_ADDRESS", "support@snappfood.app"),
                env("APP_NAME", "SnappFood")
            ),
            subject: 'Success Payment',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'mails.users.successPayment',
            with: [
                "name" => $this->user->name,
                "total" => $this->order->total,
                "tracking_code" => $this->trackingCode
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
