<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AfterCheckoutPengembangan extends Mailable
{
    use Queueable, SerializesModels;
    private $investId, $wisata;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($investId, $wisata)
    {
        //
        $this->investId = $investId;
        $this->wisata = $wisata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Pembayaran Pengembangan Wisata {$this->wisata->nama_wisata}")->markdown('emails.users.afterCheckoutPengembangan', [
            'wisata' => $this->wisata,
            'pengembangan' => $this->investId
        ]);
    }
}
