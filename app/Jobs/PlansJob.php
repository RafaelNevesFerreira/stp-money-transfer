<?php

namespace App\Jobs;

use App\Repositories\Contracts\PlansRepositoryInterface;
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
    public function __construct(public  $request, public $name, public $total)
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
        try {
            $stripe = new \Stripe\StripeClient(
                'sk_test_51JZwMrFzWXjclIq0uBjHEYo8XhVtSEQhe8eJ4Dt6Zwr7igTQ2p3MwIeUQ2RJgMtmAxBRCV6KAo5nJHYlGyoikr4s00T9dLQnId'
            );

            $client = $stripe->customers->search([
                'query' => "name:'" . $this->name . "'",
            ]);


            $date = DateTime::createFromFormat('d-m-Y H:i:s', "22-09-2022 00:00:00");
            $date = $date->getTimestamp();

            $plan = $stripe->plans->create([
                'amount' => $this->total * 100,
                'currency' => 'eur',
                'interval' => 'month',
                'product' => 'prod_LSXJFWphfFl1Cc',
            ]);

            sleep(20);


            $stripe->subscriptions->create([
                'customer' => $client->data[0]->id,
                'items' => [
                    ['price' => $plan->id],
                ],
                "cancel_at" => $date
            ]);

            sleep(20);

            $price = $stripe->paymentIntents->search([
                'query' => "customer:'" . $client->data[0]->id . "'",
            ]);

            if ($price->data[0]->status != "succeeded") {
                sleep(20);
                $stripe->paymentIntents->confirm(
                    $price->data[0]->id,
                    ['payment_method' => 'pm_card_visa']
                );
            }

            PaimentSuccess::dispatch()->delay(now()->addSecond(30));
        } catch (\Throwable $th) {
            PaimentFailed::dispatch()->delay(now()->addSecond(30));
        }
    }
}
