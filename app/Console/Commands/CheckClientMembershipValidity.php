<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\ClientMembership;
use App\Client;

class CheckClientMembershipValidity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'membership:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks a membership validity';

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
        $client_membership = ClientMembership::where('is_expired', '0')->orderBy('date_end','asc')->get();

        $today = Carbon::now();

        foreach($client_membership as $x)
        {
            $date_end = Carbon::parse($x->date_end);

            if($date_end >= $today)
            {
                $client = Client::find($x->client_id);
                $client->pricelist_id = 2;
                $client->save();
            }
            else
            {
                $client = Client::find($x->client_id);
                $client->pricelist_id = 1;
                $client->save();

                $temp = ClientMembership::find($x->id);
                $temp->is_expired = 1;
                $temp->save();
            }
        }

    }
}
