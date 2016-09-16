<?php

namespace App\Listeners;

use App\Events\Log;
use App\Models\Activity;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogListener
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
     * @param  Log  $event
     * @return void
     */
    public function handle(Log $event)
    {
        $data = [
            'target_id' => $event->target,
            'action_type' => $event->action,
            'user_id' => auth()->user()->id,
        ];
        Activity::create($data);
    }
}
