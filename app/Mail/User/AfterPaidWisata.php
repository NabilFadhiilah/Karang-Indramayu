<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AfterPaidWisata extends Mailable
{
    use Queueable, SerializesModels;
    private $reservasiWisata;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reservasiWisata)
    {
        //
        $this->reservasiWisata = $reservasiWisata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Pembayaran Wisata {$this->reservasiWisata->relationToWisataOne->nama_wisata}")->markdown('emails.users.afterPaidWisata', [
            'wisata' => $this->reservasiWisata
        ]);
    }
}
