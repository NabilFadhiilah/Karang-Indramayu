<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Wisata;
use App\Http\Requests\StorePaketRequest;
use App\Http\Requests\UpdatePaketRequest;
use App\Models\PaketWisata;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Paket::with('relationToWisata')->get();
        return view('pages.admin.paket.index', ['paket' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = Wisata::all();
        return view('pages.admin.paket.create', ['wisata' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaketRequest $request)
    {
        //
        $request->request->add(['status_wisata' => 1]);
        $data = $request->all();
        $paket = Paket::create($data);
        $paketId = $paket->id;
        for ($i = 0; $i < count($request->id_wisata); $i++) {
            # code...
            $j = 0;
            while ($j < (count($request->id_wisata[$i]) - 1)) {
                PaketWisata::create([
                    'id_paket' => $paketId,
                    'id_wisata' => $request->id_wisata[$i][$j],
                    'hari' => 'hari ke ' . $i + 1,
                ]);
                $j++;
            }
        }
        $data = Paket::with(['relationToWisata'])->get();
        return view('pages.admin.paket.index', ['paket' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function show(Paket $paket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function edit(Paket $paket)
    {
        //
        // $wisata = Paket::all();
        // return view('pages.admin.paket.edit', ['item' => $paket, 'wisata' => $wisata]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaketRequest  $request
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaketRequest $request, Paket $paket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paket $paket)
    {
        //
        $paket->delete();
        return redirect()->route('admin.paket.index');
    }
}
