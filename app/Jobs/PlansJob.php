<?php

namespace App\Jobs;

use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class PlansJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public  $request, public $name)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $stripe = new \Stripe\StripeClient(
            'sk_test_51JZwMrFzWXjclIq0uBjHEYo8XhVtSEQhe8eJ4Dt6Zwr7igTQ2p3MwIeUQ2RJgMtmAxBRCV6KAo5nJHYlGyoikr4s00T9dLQnId'
        );

        $client = $stripe->customers->search([
            'query' => "name:'" . $this->name . "'",
        ]);

        // $have_a_plan = $this->plans->ifExist();

        $date = DateTime::createFromFormat('d-m-Y H:i:s', "22-09-2022 00:00:00");
        $date = $date->getTimestamp();

        $stripe->subscriptions->create([
            'customer' => $client->data[0]->id,
            'items' => [
                ['price' => 'plan_LTTW2Nne4lQtDt'],
            ],
            "cancel_at" => $date
        ]);

        sleep(20);

        $price = $stripe->paymentIntents->search([
            'query' => "customer:'" . $client->data[0]->id . "'",
        ]);

        sleep(20);
        $stripe->paymentIntents->confirm(
            $price->data[0]->id,
            ['payment_method' => 'pm_card_visa']
        );
    }
}