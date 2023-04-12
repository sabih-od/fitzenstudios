<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminAssignTrainer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $trainerData;
    public function __construct($trainerData)
    {
        $this->trainerData = $trainerData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Fitzen Studio - Assign Customer')
            ->markdown('emails.admin.session.adminAssignTrainer');
    }
}
