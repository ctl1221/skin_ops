<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendDailySales extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:daily_sales {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily sales';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = $this->argument('date');
        \Notification::send(\App\SkinProSlack::find(1) , new \App\Notifications\DailySalesNotification($date));
    }
}
