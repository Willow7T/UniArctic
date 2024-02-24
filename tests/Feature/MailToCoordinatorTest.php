<?php

namespace Tests\Feature;

use App\Mail\MailToCoordinator;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Tests\TestCase;

class MailToCoordinatorTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testMailableIsSent()
    {
        // $response = $this->get('/');

        // $response->assertStatus(200);
        // Assume we have a user with ID 1

        Mail::fake();

        // Assume we have a user with ID 1

        // Get the user with id 12
        
        

        // // Get the faculty_id of the user
       

        // // Get the email of the faculty coordinator whose role is 3

        $coordinatorEmails = User::where('faculty_id', auth()->user()->faculty_id)
            ->where('role_id', 3)
            ->pluck('email')
            ->toArray();


          // Send the mailable
        Mail::to($coordinatorEmails)->send(new MailToCoordinator(auth()->user()));

        // Assert the mailable was sent
        Mail::assertSent(MailToCoordinator::class);

        // Assert the mailable was sent to each coordinator
        foreach ($coordinatorEmails as $email) {
        Mail::assertSent(MailToCoordinator::class, function ($mail) use ($email) {
            return $mail->hasTo($email);
        });
    }
    }

}
