<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AfterCheckoutPaket extends Mailable
{
    use Queueable, SerializesModels;

    private $reservasi, $paket;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reservasi, $paket)
    {
        //
        $this->reservasi = $reservasi;
        $this->paket = $paket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Pemesanan Paket Wisata : {$this->paket->nama_paket}")->markdown('emails.users.afterCheckoutPaket', [
            'reservasi' => $this->reservasi,
            'paket' => $this->paket
        ]);
    }
}
