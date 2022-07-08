<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AfterVerifiedWisata extends Mailable
{
    use Queueable, SerializesModels;

    private $verifikasi_wisatum;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verifikasi_wisatum)
    {
        //
        $this->verifikasi_wisatum = $verifikasi_wisatum;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Perubahan Status Pembayaran Wisata")->markdown('emails.admin.afterVerifiedWisata', [
            'wisata' => $this->verifikasi_wisatum
        ]);
    }
}
