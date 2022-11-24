<?php

namespace App\Jobs;

use App\Mail\User\OrderStatus\DeliveredMail;
use App\Mail\User\OrderStatus\PendingMail;
use App\Mail\User\OrderStatus\PreparingMail;
use App\Mail\User\OrderStatus\SendingMail;
use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class OrderStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private User $user;
    private Order $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Order $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        match ($this->order->status) {
            "PENDING" => Mail::to($this->user->email)->send(new PendingMail($this->user)),

            "PREPARING" => Mail::to($this->user->email)->send(new PreparingMail($this->user)),

            "SEND_TO_DESTINATION" => Mail::to($this->user->email)->send(new SendingMail($this->user)),

            "DELIVERED" => Mail::to($this->user->email)->send(new DeliveredMail($this->user)),

            default => "wrong status"
        };
    }
}
