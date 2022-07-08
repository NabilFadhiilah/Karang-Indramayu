<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AfterPaymentPaket extends Mailable
{
    use Queueable, SerializesModels;

    private $ReservasiPaketWisata;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ReservasiPaketWisata)
    {
        //
        $this->ReservasiPaketWisata = $ReservasiPaketWisata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Verifikasi Pembayaran Paket Wisata {$this->ReservasiPaketWisata->relationToPaketOne->nama_paket}")->markdown('emails.admin.afterPaymentPaket', [
            'paket' => $this->ReservasiPaketWisata
        ]);
    }
}
