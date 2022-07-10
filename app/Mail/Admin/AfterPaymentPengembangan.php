<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AfterPaymentPengembangan extends Mailable
{
    use Queueable, SerializesModels;
    private $pengembangan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pengembangan)
    {
        //
        $this->pengembangan = $pengembangan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Verifikasi Pengembangan Wisata {$this->pengembangan->relationToWisataOne->nama_wisata}")->markdown('emails.admin.afterPaymentPengembangan', [
            'wisata' => $this->pengembangan
        ]);
    }
}
