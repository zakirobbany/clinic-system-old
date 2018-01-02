<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Registrasi;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class PerawatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        $cd = $now->day;
        $absensis = Absensi::with('registrasi')->whereNotNull('registrasi_id')->whereDay('created_at', '=', $cd)->get();
        return view('absensi-perawat.index', compact('absensis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('absensi-perawat.create');
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
            'registrasi_id' => 'required'
        ]);
        $data = $request->all();
        Absensi::create($data);
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil Melakukan Absensi"
        ]);
        return redirect()->route('absensi-perawat.index');
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
        //
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
        $registrasi = Registrasi::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'display_name'=>'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'no_telepon' => 'required|digits:12'
        ]);

        $registrasi->update($request->all());
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "berhasil merubah $registrasi->name"
        ]);
        return redirect()->route('perawat-registrasi.show', $registrasi->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Absensi::find($id)->delete();
        Session::flash("flash_notification", [
           "level"=>"success",
            "message"=>"Absensi Berhasil Dihapus"
        ]);
        return redirect()->route('absensi-perawat.index');
    }
}
