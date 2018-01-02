<?php

namespace App\Http\Controllers;

use App\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class absensiController extends Controller
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
        $absensis = Absensi::with('dokter')->whereNotNull('dokter_id')->whereDay('created_at', '=', $cd)->get();
        return view('absensi.index', compact('absensis'));
    }

    public function absensiDokter(){
        $now = Carbon::now();
        $cd = $now->day;
        $absensis = Absensi::with('dokter')->whereNotNull('dokter_id')->whereDay('created_at', '=', $cd)->get();
        return view('absensi.dokterindex', compact('absensis'));
    }
    public function absensiPerawat(){
        $now = Carbon::now();
        $cd = $now->day;
        $absensis = Absensi::with('registrasi')->whereNotNull('registrasi_id')->whereDay('created_at', '=', $cd)->get();
        return view('absensi.perawatindex', compact('absensis'));
    }

    public function absensiDokterBulanan(){
        $now = Carbon::now();
        $cm = $now->month;
        $absensis = Absensi::with('dokter')->whereNotNull('dokter_id')->whereMonth('created_at', '=', $cm)->get();
        return view('absensi.dokterindexbulanan', compact('absensis'));
    }
    public function absensiPerawatBulanan(){
        $now = Carbon::now();
        $cm = $now->month;
        $absensis = Absensi::with('registrasi')->whereNotNull('registrasi_id')->whereMonth('created_at', '=', $cm)->get();
        return view('absensi.perawatindexbulanan', compact('absensis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('absensi.create');
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
           'dokter_id' => 'required'
        ]);
        $data = $request->all();
        Absensi::create($data);
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil Melakukan Absensi"
        ]);
        return redirect()->route('dokter-absensi.index');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Absensi::findOrFail($id)->delete();
        Session::flash("flash_notification", [
           "level"=>"success",
            "message"=>"Absensi Berhasil Dihapus"
        ]);
        return redirect()->route('dokter-absensi.index');
    }

    public function absensiDestroy($id){
        Absensi::findOrFail($id)->delete();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Absensi Berhasil Dihapus"
        ]);
        return redirect()->route('absensidokter.index');
    }
}
