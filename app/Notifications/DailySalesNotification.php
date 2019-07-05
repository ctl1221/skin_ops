<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;

class DailySalesNotification extends Notification
{
    use Queueable;

    private $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        $date = new \Carbon\Carbon($this->date);
        $date_string = $date->toFormattedDateString();

        $branches = \App\Branch::where('is_active', 1)->get();

        foreach($branches as $branch)
        {
            $total = 0;

            $sales_orders = \App\SalesOrder::where('branch_id', $branch->id)
                            ->where('date', $date->toDateString())
                            ->get();

            $payments = \App\Payment::where('branch_id', $branch->id)
                        ->where('parent_type', 'App\\Client')
                        ->where('date', $date->toDateString())
                        ->get();

            foreach($sales_orders as $sales_order)
            {
                $total += $sales_order->quota_included();
            }

            foreach($payments as $payment)
            {
                if($payment->payment_type->is_direct)
                {
                    $total += $payment->amount;
                }
            }

            $field[$branch->name] = "₱ " . number_format($total,2);
            $field[$branch->name . ' (' . $date->format("M 'y") . ')'] = "₱ " . number_format($branch->currentMonthlySales(),2);
        }

        return (new SlackMessage)
            ->success()
            ->to('#daily_sales')
            ->content('Daily Sales Report - ' . $date_string)
            ->attachment(function ($attachment) use ($field) {
                    $attachment->fields($field);
            });
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
