<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTicketWisata extends Mailable
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
        return $this->subject("E-Tiket Wisata {$this->verifikasi_wisatum->relationToWisataOne->nama_wisata}")->markdown('emails.admin.sendTicketWisata', [
            'wisata' => $this->verifikasi_wisatum
        ]);
    }
}
