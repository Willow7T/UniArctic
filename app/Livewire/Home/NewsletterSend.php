<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Newsletter;

class NewsletterSend extends Component
{
    public $email;
    public function subscribe()
    {   
        if (empty($this->email)) {
            session()->flash('error', 'Email field is empty.');
            return;
        }
        
        $this->validate([
            'email' => 'required|email',
        ]);

        // Check if the email is already subscribed
        if (Newsletter::where('email', $this->email)->exists()) {
            session()->flash('error', 'This email is already subscribed to our newsletter.');
            return;
        }

        // Store the email in the database
        Newsletter::create(['email' => $this->email]);
        session()->flash('success', 'You have been subscribed to our newsletter.');

        // Reset the email field
        $this->email = '';
    }

    //unsubscribe
    public function unsubscribe()
    {
        if (empty($this->email)) {
            session()->flash('error', 'Email field is empty.');
            return;
        }
        
        // Validate the email
        $this->validate([
            'email' => 'required|email',
        ]);

        // Check if the email is subscribed
        $subscription = Newsletter::where('email', $this->email)->first();
        if (!$subscription) {
            session()->flash('error', 'This email is not subscribed to our newsletter.');
            return;
        }

        // Delete the subscription
        $subscription->delete();
        session()->flash('success', 'You have been unsubscribed from our newsletter.');

        // Reset the email field
        $this->email = '';
    }

    public function render()
    {
        return view('livewire.home.newsletter-send');
    }
}
