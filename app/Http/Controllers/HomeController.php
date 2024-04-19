<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailToCoordinator;
use Illuminate\Support\Facades\Mail;
use App\Models\User;


class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()->current_team_id !== 1) {
            // This is the user's first visit to the home page
            // Set the current team id to 1
           
            // Get the emails of the faculty coordinators whose role_id is 3
            $coordinatorEmails = User::where('faculty_id', auth()->user()->faculty_id)
                ->where('role_id', 3)
                ->pluck('email')
                ->toArray();

            // Send the mailable
            if (!empty($coordinatorEmails)) {
                // Send the mailable
                Mail::to($coordinatorEmails)->send(new MailToCoordinator(auth()->user()));
            }

            // Set the session variable
            session()->put('visited_home', true);
            //message here
            session()->flash('message', 'Email has been sent to the faculty coordinators');
            $user = auth()->user();
            $user->current_team_id = 1;
            $user->save();
            
        }

        // Render the home page
        return view('home');
    }
}
