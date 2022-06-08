<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Http\Requests\StoreWisataRequest;
use App\Http\Requests\UpdateWisataRequest;
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
        //
        $request->request->add(['status_wisata' => 1]);
        $data = $request->all();
        // dd($data);
        Wisata::create($data);
        return redirect()->route('admin.wisata.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function show(Wisata $wisata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function edit(Wisata $wisata, $id)
    {
        //
        $wisata = Wisata::find($id);
        // dd($wisata);
        return view('pages.admin.wisata.edit', ['item' => $wisata]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWisataRequest  $request
     * @param  \App\Models\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWisataRequest $request, Wisata $wisata, $id)
    {
        //
        $data = $request->all();
        $wisata = Wisata::find($id);
        $wisata->update($data);
        return redirect()->route('admin.wisata.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wisata $wisata, $id)
    {
        //
        $wisata = Wisata::find($id);
        $wisata->delete();
        return redirect()->route('admin.wisata.index');
    }

    public function checkSlug(Request $request)
    {
        # code...
        $slug = SlugService::createSlug(Wisata::class, 'slug', $request->nama_wisata);
        return response()->json(['slug' => $slug]);
    }
}
