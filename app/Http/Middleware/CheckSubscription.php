<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription {
    public function handle(Request $request, Closure $next) {
        $user = auth()->user();
        $customer = DB::table('customers')->where('id', $user->customer_id)->first(); // Customer record fetch karo
        
        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->is_system == 0) { // 2. Super Admin ke liye saare checks BYPASS hai
            return $next($request);
        }

        if (!$customer) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Customer account not found.');
        }

        if($customer->status == 0) { // Customer Account Inactive Check
            auth()->logout();
            return redirect()->route('login')->with('error', 'Your company account is inactive. Please contact support.');
        }

        $isExpired = false; // Subscription Expiry Check
        if ($customer->subscription_status == 2 || $customer->subscription_status == 3) {
            $isExpired = true;

        } elseif(!empty($customer->subscription_end_date)) { // Safe Carbon parsing
            if(now()->gt(Carbon::parse($customer->subscription_end_date))) {
                $isExpired = true;
            }
        }

        if ($isExpired) {
            auth()->logout();
            return redirect()->route('subscription.expired')->with('error', 'Your subscription has expired.');
        }

        return $next($request);
    }
}


