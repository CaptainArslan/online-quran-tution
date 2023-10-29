<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Pool;
use function GuzzleHttp\Promise\settle;
use GuzzleHttp\Psr7\Request;

trait GoCardless
{
    public function gocardless($plan_id, $discount_value, $inquiry_id, $student_id)
    {
        $client = new \GoCardlessPro\Client([
            'access_token' => env('GOCARDLESS_ACCESS_TOKEN'),
            'environment'  => \GoCardlessPro\Environment::LIVE,
        ]);
        //go cardless code  start
        $redirectFlow = $client->redirectFlows()->create([
            'params' => [
                'description' => 'GoCardless Hosted Pages',
                'session_token' => 'client_redirected_to subscription',
                'success_redirect_url' => route('redirection_to_gocardless', [$plan_id, $discount_value, $inquiry_id, $student_id]),
            ],
        ]);
        if ($redirectFlow) {
            return redirect($redirectFlow->redirect_url);
        }
    }
}
