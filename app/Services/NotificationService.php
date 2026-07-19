<?php


namespace App\Services;

use App\Models\User;
use App\Notifications\CompanyNotification;

class NotificationService {
    public function send(array $users, string $title, string $message) {
        $users = User::whereIn('id', $users)->get();

        foreach($users as $user){
            $user->notify(
                new CompanyNotification( $title, $message )
            );
        }
        
        return true;
    }
}

