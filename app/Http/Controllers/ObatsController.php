<?php

namespace App\Http\Controllers;

use App\Obat;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class ObatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obats = Obat::get();
        return view('obat.index', compact('obats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('obat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'nama_obat' => 'required'
        ]);
        $data = $request->all();
        $obat = Obat::create($data);
        Session::flash("flash_notification", [
           "level" => "success",
            "message" => "Berhasil Menambah $obat->nama_obat"
        ]);
        return redirect()->route('perawat-obat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obats = Obat::findOrFail($id);
        return view('obat.edit', compact('obats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);
        $this->validate($request, [
            'nama_obat' => 'required'
        ]);
        $obat->update($request->all());
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil merubah $obat->nama_obat"
        ]);
        return redirect()->route('perawat-obat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Obat::find($id)->delete();
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Obat berhasil dihapus"
        ]);
        return redirect()->route('perawat-obat.index');
    }
}
