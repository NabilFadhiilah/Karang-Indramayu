<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Http\Requests\StoreWisataRequest;
use App\Http\Requests\UpdateWisataRequest;
use App\Models\Gallery;
use Clockwork\Request\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class WisataController extends Controller
{
    // public function __construct(array $attributes = [])
    // {
    //     parent::__construct($attributes);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Wisata::all();
        return view('pages.admin.wisata.index', ['wisata' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.admin.wisata.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWisataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWisataRequest $request)
    {
        $request->request->add(['status_wisata' => 1]);
        $data = $request->all();
        $wisataId = Wisata::create($data);

        if ($request->hasFile('gambar')) {
            for ($i = 0; $i < count($request->file('gambar')); $i++) {
                # code...
                $dataGallery = $request->file('gambar')[$i]->store('gambar-wisata');
                Gallery::create([
                    'id_wisata' => $wisataId->id,
                    'image' => $dataGallery
                ]);
            }
        }

        return redirect()->route('admin.wisata.index')->with('sukses', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wisata  $wisatum
     * @return \Illuminate\Http\Response
     */
    public function show(Wisata $wisatum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wisata  $wisatum
     * @return \Illuminate\Http\Response
     */
    public function edit(Wisata $wisatum)
    {
        //
        // $wisatum = Wisata::find($id);
        // dd($wisatum);
        return view('pages.admin.wisata.edit', ['item' => $wisatum]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWisataRequest  $request
     * @param  \App\Models\Wisata  $wisatum
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWisataRequest $request, Wisata $wisatum)
    {
        //
        $data = $request->all();
        // $wisatum = Wisata::find($id);
        $wisatum->update($data);
        return redirect()->route('admin.wisata.index')->with('sukses', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wisata  $wisatum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wisata $wisatum)
    {
        //
        $wisatum->delete();
        return redirect()->route('admin.wisata.index')->with('sukses', 'Data Berhasil Dihapus');
    }

    public function checkSlug(Request $request)
    {
        # code...
        $slug = SlugService::createSlug(Wisata::class, 'slug', $request->nama_wisata);
        return response()->json(['slug' => $slug]);
    }
}
