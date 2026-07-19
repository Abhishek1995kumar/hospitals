<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription {
    public function handle(Request $request, Closure $next) {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $customer = DB::table('customers')->where('id', $user->customer_id)->first();
        if (!$customer) {
            abort(403, 'Customer not found.');
        }

        // Customer Inactive
        if ($customer->status == 0) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Customer account is inactive.');
        }

        // Subscription Expired
        if ($customer->subscription_status == 2 || (!empty($customer->subscription_end_date) && now()->gt($customer->subscription_end_date))) {
            auth()->logout();
            return redirect()->route('subscription.expired');
            
        }

        return $next($request);
    }
}
