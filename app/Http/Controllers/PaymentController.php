<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\Repositories\Contracts\TransfersRepositoryInterface;

class PaymentController extends Controller
{
    public function __construct(public TransfersRepositoryInterface $transfers)
    {
    }
    const BASE_URL = 'https://api.stripe.com';
    const SECRET_KEY = 'sk_test_51JZwMrFzWXjclIq0uBjHEYo8XhVtSEQhe8eJ4Dt6Zwr7igTQ2p3MwIeUQ2RJgMtmAxBRCV6KAo5nJHYlGyoikr4s00T9dLQnId';

    public function store(PaymentRequest $request)
    {
        session()->put("data", $request->all());
        // dd($request->all());



        $input['transaction_id'] = Str::random(18);


        $payment_url = self::BASE_URL . '/v1/payment_methods';

        $payment_data = [
            'type' => 'card',
            'card[number]' => $request->card_no,
            'card[exp_month]' => $request->exp_month,
            'card[exp_year]' => $request->exp_year,
            'card[cvc]' => $request->cvc,
            'billing_details[email]' => session("email"),
            'billing_details[name]' => session("name"),
            'billing_details[phone]' => session("phone_number"),
        ];

        $payment_payload = http_build_query($payment_data);

        $payment_headers = [
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer ' . self::SECRET_KEY
        ];

        // sending curl request
        // see last function for code
        $payment_body = $this->curlPost($payment_url, $payment_payload, $payment_headers);

        $payment_response = json_decode($payment_body, true);



        if (isset($payment_response['id']) && $payment_response['id'] != null) {

            $request_url = self::BASE_URL . '/v1/payment_intents';

            switch (session("moeda")) {
                case "€":
                    $currency = "eur";
                    break;
                case '$':
                    $currency = "usd";
                    break;
                case '£':
                    $currency = "gbp";

                    break;
            }

            if (session("total")) {
                $total = number_format(session("total"), 2, '.', ',');
            } else {
                return abort(500);
            }
            $request_data = [
                'amount' => $total * 100, // multiply amount with 100
                'currency' => $currency,
                'payment_method_types[]' => 'card',
                'payment_method' => $payment_response['id'],
                'confirm' => 'true',
                'capture_method' => 'automatic',
                'return_url' => route('stripeResponse', $input['transaction_id']),
                'payment_method_options[card][request_three_d_secure]' => 'automatic',
            ];

            $request_payload = http_build_query($request_data);

            $stripe = new \Stripe\StripeClient(
                'sk_test_51JZwMrFzWXjclIq0uBjHEYo8XhVtSEQhe8eJ4Dt6Zwr7igTQ2p3MwIeUQ2RJgMtmAxBRCV6KAo5nJHYlGyoikr4s00T9dLQnId'
            );
            // dd($stripe);
            // $customer = $stripe->customers->create([
            //     'email' => session("email"),
            //     'name' => session("name"),
            //     'phone' => session("phone_number"),

            // ]);

            // dd($customer);
            // $stripe->subscriptions->create([
            //     'customer' => "cus_LSXeXojudEiFKq",
            //     'items' => [
            //         ['price' => 'price_1KlcEUFzWXjclIq0kPWaHzXs'],
            //     ],
            // ]);
            // $costumer = $stripe->customers->create([
            //     'email' => "pedordias@email.com",
            //     'name' => "pedro bastos",
            //     'phone' => 758164875,
            // ]);

            $card = $stripe->customers->createSource(
                "cus_LSYdtvTdsG4STL",
                [
                    'source' => 'tok_mastercard',[
                        "number" => "2223003122003222"
                    ]

                ],


            );

            $nome = $stripe->customers->search([
                'query' => 'name:\'pedro bastos\' ',
            ]);

            dd($card);
            // dd("done");

            $request_headers = [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer ' . self::SECRET_KEY
            ];

            // another curl request
            $response_body = $this->curlPost($request_url, $request_payload, $request_headers);

            $response_data = json_decode($response_body, true);

            // transaction required 3d secure redirect
            if (isset($response_data['next_action']['redirect_to_url']['url']) && $response_data['next_action']['redirect_to_url']['url'] != null) {

                return redirect()->away($response_data['next_action']['redirect_to_url']['url']);

                // transaction success without 3d secure redirect
            } elseif (isset($response_data['status']) && $response_data['status'] == 'succeeded') {
                dd($response_data);
                $this->transfers->store();
                return redirect()->route('stripeResponse', $input['transaction_id']);

                // transaction declined because of error
            } elseif (isset($response_data['error']['message']) && $response_data['error']['message'] != null) {

                return redirect()->route("payment")->with("errors", $response_data['error']['message']);
            } else {

                return redirect()->route("payment")->with("errors", 'Something went wrong, please try again.');
            }

            // error in creating payment method
        } elseif (isset($payment_response['error']['message']) && $payment_response['error']['message'] != null) {
            return redirect()->route("payment")->with("errors", $payment_response['error']['message']);
        }
    }

    /**
     * create curl request
     * we have created seperate method for curl request
     * instead of put code at every request
     *
     * @return Stripe response
     */
    private function curlPost($url, $data, $headers)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }
    public function response(Request $request, $transaction_id)
    {

        try {
            $stripe = new \Stripe\StripeClient(
                'sk_test_51JZwMrFzWXjclIq0uBjHEYo8XhVtSEQhe8eJ4Dt6Zwr7igTQ2p3MwIeUQ2RJgMtmAxBRCV6KAo5nJHYlGyoikr4s00T9dLQnId'
            );
            $memes = $stripe->paymentIntents->retrieve(
                $request->payment_intent,
                []
            );
            if ($memes->status == "succeeded") {
                $this->transfers->store();
            }
            return $this->task($request);
        } catch (\Throwable $th) {

            $this->task($request);
            $valor = session("valor_a_ser_enviado");
            $moeda = session("moeda");
            $receptor = session("receptor");
            session()->forget(["moeda", "name", "receptor", "address", "country", "phone_number", "email", "tax", "valor_a_ser_enviado", "total"]);

            return view("site.payment_confirm", compact("valor", "moeda", "receptor"));
        }
    }

    public function task($request)
    {
        $request_data = $request->all();

        // if only stripe response contains payment_intent
        if (isset($request_data['payment_intent']) && $request_data['payment_intent'] != null) {

            // here we will check status of the transaction with payment_intents from stripe server
            $get_url = self::BASE_URL . '/v1/payment_intents/' . $request_data['payment_intent'];

            $get_headers = [
                'Authorization: Bearer ' . self::SECRET_KEY
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $get_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $get_headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $get_response = curl_exec($ch);

            curl_close($ch);

            $get_data = json_decode($get_response, 1);


            // succeeded means transaction success
            if (isset($get_data['status']) && $get_data['status'] == 'succeeded') {
                $valor = session("valor_a_ser_enviado");
                $moeda = session("moeda");
                $receptor = session("receptor");
                session()->forget(["moeda", "name", "receptor", "address", "country", "phone_number", "email", "tax", "valor_a_ser_enviado", "total"]);

                return view("site.payment_confirm", compact("valor", "moeda", "receptor"));
            } elseif (isset($get_data['error']['message']) && $get_data['error']['message'] != null) {
                return redirect()->route("payment")->with("errors", $get_data['error']['message']);
            } else {
                return redirect()->route("payment")->with("errors", 'Payment  failed.');
            }
        } else {

            // return redirect()->route("payment")->with("errors",'Payment failed.');
        }
    }
}
