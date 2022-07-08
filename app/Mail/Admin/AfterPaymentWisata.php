<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AfterPaymentWisata extends Mailable
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
        return $this->subject("Verifikasi Pembayaran Wisata {$this->reservasiWisata->relationToWisataOne->nama_wisata}")->markdown('emails.admin.afterPaymentWisata', [
            'wisata' => $this->reservasiWisata
        ]);
    }
}
