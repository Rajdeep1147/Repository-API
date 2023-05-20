<?php

namespace App\Http\Controllers;

use App\Events\SendMail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Contracts\EventDispatcher\Event;

class SubscribeController extends Controller
{
    public function subscribed()
    {
    //    Event::dispatch(new SendMail(1));
         event(new SendMail(133));
    }
}
