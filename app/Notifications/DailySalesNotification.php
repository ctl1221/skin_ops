<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;

class DailySalesNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        $date = \Carbon\Carbon::now()->addDay(-1);
        $date_string = $date->toFormattedDateString();

        $branches = \App\Branch::where('is_active', 1)->get();

        foreach($branches as $branch)
        {
            $total = 0;

            $sales_orders = \App\SalesOrder::where('branch_id', $branch->id)
                            ->where('date', $date->toDateString())
                            ->get();

            foreach($sales_orders as $sales_order)
            {
                $total += $sales_order->total_pay();
            }

            $field[$branch->name] = "₱ " . number_format($total,2);
            $field[$branch->name . ' (' . $date->format("M 'y") . ')'] = "₱ " . number_format($branch->currentMonthlySales(),2);
        }

        return (new SlackMessage)
            ->success()
            ->to('#daily_sales')
            ->content('Daily Report - ' . $date_string)
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
