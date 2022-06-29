<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use App\Http\Requests\StoreRekeningRequest;
use App\Http\Requests\UpdateRekeningRequest;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Rekening::all();
        return view('pages.admin.rekening.index', ['rekening' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.admin.rekening.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRekeningRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRekeningRequest $request)
    {
        //
        $data = $request->all();
        Rekening::create($data);
        return redirect()->route('admin.rekening.index')->with('sukses', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function show(Rekening $rekening)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function edit(Rekening $rekening)
    {
        //
        // return $rekening;
        return view('pages.admin.rekening.edit', ['item' => $rekening]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRekeningRequest  $request
     * @param  \App\Models\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRekeningRequest $request, Rekening $rekening)
    {
        //
        $data = $request->all();
        $rekening->update($data);

        return redirect()->route('admin.rekening.index')->with('sukses', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rekening $rekening)
    {
        //
        $rekening->delete();
        return redirect()->route('admin.rekening.index')->with('sukses', 'Data Berhasil Dihapus');
    }
}
