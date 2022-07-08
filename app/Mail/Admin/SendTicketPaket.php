<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTicketPaket extends Mailable
{
    use Queueable, SerializesModels;

    private $verifikasi_paket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verifikasi_paket)
    {
        //
        $this->verifikasi_paket = $verifikasi_paket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("E-Tiket {$this->verifikasi_paket->relationToPaketOne->nama_paket}")->markdown('emails.admin.sendTicketPaket', [
            'paket' => $this->verifikasi_paket
        ]);
    }
}
