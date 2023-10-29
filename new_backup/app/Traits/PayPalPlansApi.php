<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Pool;
use function GuzzleHttp\Promise\settle;
use GuzzleHttp\Psr7\Request;

trait PayPalPlansApi
{
    private $key;

    protected $host;

    protected $header;

    public function __construct()
    {
        $this->key = 'QVdPQ01mckhiYUd6SEtqQlhjVTZoWTJtT29YcDBlNzVfdmc1TUt3dzcwY19CUElqUVRpdkpHV0gzZmk4QnBUOTdWUmRtTnJGTmFlS0syWjM6RU1ubkthZ1diNzNkaFh1TzkxY2dJSUVVUkRBX1dzLUd4LW5WQmFHeGlvSEhzdVFCbVhfVGxEbFo3UlNVbXNZOG5IbFd4Zk1iMUlqMlpfMko=';
        $this->host = 'https://api.sandbox.paypal.com/v1/billing/plans?product_id=LiveLearning231&page_size=3&page=1&total_required=true';
        $this->header = [
            'Authorization' => 'Basic '.$this->key,
        ];
    }

    public function paypalSubscription($plan_id, $inquiry_id)
    {
        $url = 'https://api.sandbox.paypal.com/v1/billing/subscriptions';

        $client = new Client();
        $response = $client->request('POST', $url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic '.$this->key,
            ],
            'json' => [
                'plan_id' => $plan_id,

                'application_context' => [
                    'return_url' => url('paymentsuccess/'.$inquiry_id),
                    'cancel_url' => url('paymenterror'),
                ],

            ],

        ]
        );

        $response = $response->getBody()->getContents();
        $response = json_decode($response);
        //dd($response);
        $link = $response->links['0']->href;

        return redirect($link);
    }
}
