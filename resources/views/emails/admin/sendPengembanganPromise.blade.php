@component('mail::message')
    # Hallo {{ $pengembangan->relationToUser->nama }}

    Terimakasih Sudah Melakukan Pengembangan Wisata Di Gokarang.
    Berikut Kami Rincikan Pengembangan Wisata Anda.

    Nama Pengembangan Wisata : {{ $pengembangan->relationToPengembanganOne->nama_wisata }}
    Besar Pendanaan : Rp.{{ number_format($pengembangan->pendanaan) }}
    Besar Imbal Balik : {{ $pengembangan->relationToPengembanganOne->imbal_hasil }}% Per-tahun
    Tanggal Pendanaan : {{ $pengembangan->tgl_investasi }}
    Harapan Imbal Balik Tahun Depan :
    Rp.{{ number_format($pengembangan->pendanaan * ($pengembangan->relationToPengembanganOne->imbal_hasil / 100)) }}
    Total Pendanaan + Imbal Balik :
    Rp.{{ number_format($pengembangan->pendanaan + $pengembangan->pendanaan * ($pengembangan->relationToPengembanganOne->imbal_hasil / 100)) }}

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
