<?php

namespace Xbigdaddyx\BeverlySolid\Listeners;


use Illuminate\Support\Facades\Mail;
use Xbigdaddyx\BeverlySolid\Events\InvalidPolybagEvent;

class SendInvalidPolybagNotification
{
    public function handle(InvalidPolybagEvent $event)
    {
        // Send an email notification about the invalid polybag
    }
}
