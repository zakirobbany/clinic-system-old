<?php

namespace App\Http\Controllers;

use App\Poli;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polis = Poli::get();
        return view('admin.poli.index', compact('polis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.poli.create');
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
            'nama_poli' => 'required'
        ]);
        $data = $request->all();
        $poli = Poli::create($data);
        Session::flash("flash_notification", [
           "level" => "success",
           "message" => "Berhasil Menambahkan Poli $poli->nama_poli"
        ]);
        return redirect()->route('poli.index');
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
        $poli = Poli::findOrFail($id);
        return view('admin.poli.edit', compact('poli'));
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
        $poli = Poli::findOrFail($id);
        $this->validate($request, [
           'nama_poli' => 'required'
        ]);
        $poli->update($request->all());
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil merubah $poli->nama_poli"
        ]);
        return redirect()->route('poli.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Poli::find($id)->delete();
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Poli berhasil dihapus"
        ]);
        return redirect()->route('poli.index');
    }
}
