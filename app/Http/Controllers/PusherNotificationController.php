<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Events\StatusLiked;
use App\Events\Notification;
use App\Events\Counter;
use App\Models\Counters;

class PusherNotificationController extends Controller
{
    public function sendNotification(){

        $options = array(
            'cluster' => 'mt1',
            'encrypted' => true
        );

        //Remember to set your credentials below.
        $pusher = new Pusher(
            'k4ad848c2c575b7655aa6ey',
            '4cf41498d9b12af2124c',
            '1110236', $options
        );

        $message= "Hello Cloudways";

        //Send a message to notify channel with an event name of notify-event
        $pusher->trigger('notification', 'notification-event', $message);
    }

    public function showbtn()
    {
        return view('form');
    }
    public function showlist()
    {
        return view('list');
    }

    public function sendMessage(Request $REQUEST)
    {

        // $email = $REQUEST->email;
        // $pass1 = $REQUEST->password;

        $status = Counters::all();

        // return $status;

        if($status->isEmpty())
        {
            $counter = new Counters;


            $counter->counter=$REQUEST->counter+1;

            // return $counter->counter;
            $counter->save();

            event(new Counter($counter->counter));


            // return 'hello';
            // event(new Counter($REQUEST->counter));
        }

        else
        {
            $getcounter = Counters::orderBy('created_at','Desc')->first();

            $addCounter= $getcounter->counter;

            $addCounter=$addCounter+1;
            
            $counter = new Counters;
            
            
            $counter->counter= $addCounter;
            $counter->save();
            
            event(new Counter($addCounter));
            
            return $addCounter;
            
            // return $addCounter;
        }


        // $getcounter = Counters::all();
        // event(new Notification($email,$pass1));

        // return $getcounter;

        // return redirect()->back();
    }
}