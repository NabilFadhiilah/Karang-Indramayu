<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AfterVerifiedPengembangan extends Mailable
{
    use Queueable, SerializesModels;
    private $verifikasi_pengembangan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verifikasi_pengembangan)
    {
        //
        $this->verifikasi_pengembangan = $verifikasi_pengembangan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Verifikasi Pengembangan Wisata {$this->verifikasi_pengembangan->relationToPengembanganOne->nama_wisata}")->markdown('emails.admin.afterVerifiedPengembangan', [
            'pengembangan' => $this->verifikasi_pengembangan
        ]);
    }
}
