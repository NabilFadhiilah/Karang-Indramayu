<?php

namespace App\Http\Controllers;

use App\Models\PengembanganWisata;
use App\Http\Requests\StorePengembanganWisataRequest;
use App\Http\Requests\UpdatePengembanganWisataRequest;
use App\Models\Wisata;

use function PHPUnit\Framework\returnSelf;

class PengembanganWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $data = PengembanganWisata::all();
        $data = PengembanganWisata::with('relationToWisata')->get();
        return view('pages.admin.pengembanganWisata.index', ['pengembangan' => $data]);
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
        return view('pages.admin.pengembanganWisata.create', ['wisata' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePengembanganWisataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengembanganWisataRequest $request)
    {
        //
        $data = $request->all();
        PengembanganWisata::create($data);
        return redirect()->route('admin.pengembanganWisata.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PengembanganWisata  $pengembanganWisata
     * @return \Illuminate\Http\Response
     */
    public function show(PengembanganWisata $pengembanganWisata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengembanganWisata  $pengembanganWisata
     * @return \Illuminate\Http\Response
     */
    public function edit(PengembanganWisata $pengembanganWisata, $id)
    {
        //
        $datas = PengembanganWisata::all();
        $data = $datas->find($id);
        // dd($data);
        return view('pages.admin.pengembanganWisata.edit', ['item' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePengembanganWisataRequest  $request
     * @param  \App\Models\PengembanganWisata  $pengembanganWisata
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePengembanganWisataRequest $request, PengembanganWisata $pengembanganWisata, $id)
    {
        //
        $data = $request->all();
        $pengembanganWisata = PengembanganWisata::find($id);
        $pengembanganWisata->update($data);
        return redirect()->route('admin.pengembanganWisata.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengembanganWisata  $pengembanganWisata
     * @return \Illuminate\Http\Response
     */
    public function destroy(PengembanganWisata $pengembanganWisata, $id)
    {
        //
        $pengembanganWisata = PengembanganWisata::find($id);
        $pengembanganWisata->delete();
        return redirect()->route('admin.pengembanganWisata.index');
    }
}
