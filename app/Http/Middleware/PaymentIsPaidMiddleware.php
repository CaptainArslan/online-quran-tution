<?php

namespace App\Http\Middleware;

use App\Models\Inquiry;
use Carbon\Carbon;
use Closure;

class PaymentIsPaidMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $inquiry = Inquiry::where('id', '=', $request->route('id'))->first();

        if (Carbon::now() > $inquiry->to) {
            return redirect()->route('student.payments.index', $request->route('id'));
        }

        return $next($request);
    }
}
