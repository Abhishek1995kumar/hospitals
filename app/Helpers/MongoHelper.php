<?php


use App\Models\Logs;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;



class MongoHelper {
    public static function checkEnvironment () {
        $mongoEnabled = env('USE_MONGO');
        if ($mongoEnabled == true) {
            // do some other checks too, like if the configurations are proper
            return true;
        }
        return false;
    }

    public static function useMongoActivityModel () {
        if (self::checkEnvironment()) {
            // and do further checks if necessary
            // $activityConnection = env('ACTIVITY_LOGGER_MONGO_CONNECTION');
            $migrationComplete = env('MONGO_MIGRATION_COMPLETE');
            if ($migrationComplete == true  ) {
                return true;
            } else {
                // this part could be put into silent logs instead.0
                // print_r("Configuration imporper, while enabling use mongo, 'ACTIVITY_LOGGER_DB_CONNECTION' must be set to mongo");
            }
        }
        return false;
    }

    
}


