<?php

namespace App\Console\Commands;

use App\Mail\Admin\SendCronEmailInvest;
use App\Models\Pengembangan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class cronEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pengembangan = Pengembangan::leftJoin('users', 'pengembangan.id_user', '=', 'users.id')
            ->leftJoin('pengembangan_wisata', 'pengembangan.id_pengembangan', '=', 'pengembangan_wisata.id')
            ->leftJoin('wisata', 'pengembangan_wisata.id_wisata', '=', 'wisata.id')
            ->select('pengembangan.*', 'users.email', 'users.nama', 'pengembangan_wisata.imbal_hasil', 'wisata.nama_wisata')
            ->where('status', '=', 'TERIMA')
            ->get();
        if (!empty($pengembangan)) {
            foreach ($pengembangan as $invest) {
                # code...
                Mail::to($invest->email)->send(new SendCronEmailInvest($invest));
            }
        }
        return 0;
    }
}
