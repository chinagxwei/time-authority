<?php

namespace App\Listeners;

use App\Events\ActionLogEvent;
use App\Models\ActionLog;
use App\Models\System\SystemLog;
use App\Models\User;

class SystemLogListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param SystemLogEvent $event
     * @return void
     */
    public function handle($event)
    {
        /** @var User $user */
        $user = auth('api')->user();
        list($name, $description) = $event->getLog();
        $ip = "0.0.0.0";
        if ($request = request()) {
            $ip = $request->ip();
        }
        (new SystemLog())->generate($user->id, $name, "用户 - [ {$user->username} ] | $description", $ip);
    }
}
