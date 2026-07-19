<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class PlanValidationMiddleware {
    public function handle(Request $request, Closure $next, string $type): Response {
        $user = auth()->user();
        if (!$user) {
            abort(401);
        }

        $customer = DB::table('customers')->where('id', $user->customer_id)->first();
        if (!$customer) {
            abort(404,'Customer not found.');
        }

        switch ($type) {
            case 'user':
                $totalUsers = DB::table('users')->where('customer_id',$customer->id)->count();
                if($totalUsers >= $customer->max_users){
                    return back()->with('error','Your user limit has been reached.');
                }
            break;

            case 'hospital':
                $totalHospitals = DB::table('hospitals')->where('customer_id',$customer->id)->count();

                if($totalHospitals >= $customer->max_hospitals){
                    return back()->with('error','Hospital limit exceeded.');
                }
            break;

            case 'firm':
                // $hospitalIds = DB::table('hospitals')->where('customer_id', $customer->id)->pluck('id')->toArray();
                $totalFirms = DB::table('firm_locations')->where('customer_id',$customer->id)->count();

                if($totalFirms >= $customer->max_firms){
                    return back()->with('error','Firm limit exceeded.');
                }
            break;

        }
        return $next($request);
    }
}