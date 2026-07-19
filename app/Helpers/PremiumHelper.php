<?php


use App\Models\Logs;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;



class PremiumHelper {
    public static function checkPremiumStatus($userId) {
        $user = User::find($userId);
        if ($user && $user->is_premium) {
            return true;
        }
        return false;
    }


    
    public static function calculatePremium($data) {
        $basePremium = $data['base_premium'] ?? 0;
        $loading = $data['loading'] ?? 0;
        $discount = $data['discount'] ?? 0;
        // Calculate the final premium
        $finalPremium = ($basePremium + $loading) - $discount;
        return (string)$finalPremium;
    }


    public static function calculatePremiumWithContribution($data) {
        $basePremium = $data['base_premium'] ?? 0;
        $loading = $data['loading'] ?? 0;
        $discount = $data['discount'] ?? 0;
        $contribution = $data['contribution'] ?? 0;

        // Calculate the final premium with contribution
        $finalPremium = ($basePremium + $loading + $contribution) - $discount;
        return (string)$finalPremium;
    }


    public static function calculatePremiumWithContributionAndTax($data) {
        $basePremium = $data['base_premium'] ?? 0;
        $loading = $data['loading'] ?? 0;
        $discount = $data['discount'] ?? 0;
        $contribution = $data['contribution'] ?? 0;
        $tax = $data['tax'] ?? 0;

        // Calculate the final premium with contribution and tax
        $finalPremium = ($basePremium + $loading + $contribution + $tax) - $discount;
        return (string)$finalPremium;
    }

    
}



