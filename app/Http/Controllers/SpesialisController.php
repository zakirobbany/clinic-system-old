<?php

namespace App\Http\Controllers;

use App\Spesialis;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class SpesialisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spesialises = Spesialis::get();
        return view('admin.spesialis.index', compact('spesialises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.spesialis.create');
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
           'nama_spesialis' => 'required'
        ]);
        $data = $request->all();
        $spesialis = Spesialis::create($data);
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambahkan spesialis $spesialis->nama_spesialis"
        ]);
        return redirect()->route('spesialis.index');
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
        $spesialis = Spesialis::findOrFail($id);
        return view('admin.spesialis.edit', compact('spesialis'));
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
        $spesialis = Spesialis::findOrFail($id);
        $this->validate($request, [
           'nama_spesialis'=>'required'
        ]);
        $spesialis->update($request->all());
        Session::flash("flash_notification", [
           "level"=>"success",
            "message"=>"Berhasil merubah $spesialis->nama_spesialis"
        ]);
        return redirect()->route('spesialis.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Spesialis::findOrFail($id)->delete();
        Session::flash("flash_notification", [
           "level"=>"success",
            "message"=>"Spesialis berhasil dihapus"
        ]);
        return redirect()->route('spesialis.index');
    }
}
