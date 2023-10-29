<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Plan;
use App\Traits\PayPalPlansApi;
use GuzzleHttp\Client;
use function GuzzleHttp\Promise\settle;
use Illuminate\Http\Request;

class CoupanController extends Controller
{
    use PayPalPlansApi;

    public function validatePromo(Request $request)
    {
        //dd($request);
        $promo = Coupon::where('code', $request->promo)->first();
        if ($promo) {
            $plan = Plan::where('id', $request->plan_id)->first();

            $new_discounted_price = $plan->price_per_month - $plan->discount;

            $promo_discount_value = $new_discounted_price - $promo->discount_value;

            return response()->json(['discount' => $promo_discount_value]);
        }

        return response()->json(['error' => 'Promo Code is not Valid']);
    }

    public function validatePromoPaypal(Request $request)
    {
        //dd($request);
        $promo = Coupon::where('code', $request->promo)->first();
        if ($promo) {
            $uri = 'https://api.sandbox.paypal.com/v1/billing/plans/P-7JW45276T0402174UL52KUCI';

            $client = new Client();
            $response = $client->get($uri, [
                'headers' => $this->header,
            ]);

            $response = json_decode($response->getBody(), true);

            $promo_discount_value = $response['billing_cycles'][0]['pricing_scheme']['fixed_price']['value'];

            return response()->json(['discount' => $promo_discount_value, 'new_plan_id' => $response['id']]);
        }

        return response()->json(['error' => 'Promo Code is not Valid']);
    }
}
