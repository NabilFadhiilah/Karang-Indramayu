<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AfterCheckoutWisata extends Mailable
{
    use Queueable, SerializesModels;

    private $reservasi, $wisata;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reservasi, $wisata)
    {
        //
        $this->reservasi = $reservasi;
        $this->wisata = $wisata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Pemesanan Wisata : {$this->wisata->nama_wisata}")->markdown('emails.users.afterCheckoutWisata', [
            'reservasi' => $this->reservasi,
            'wisata' => $this->wisata
        ]);
    }
}
