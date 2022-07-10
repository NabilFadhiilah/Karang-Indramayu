<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AfterPaidPengembangan extends Mailable
{
    use Queueable, SerializesModels;
    private $pengembangan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pengembangan)
    {
        //
        $this->pengembangan = $pengembangan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Pengembangan Wisata {$this->pengembangan->relationToWisataOne->nama_wisata}")->markdown('emails.users.afterPaidPengembangan', [
            'wisata' => $this->pengembangan
        ]);
    }
}
