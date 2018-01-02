<?php

namespace App\Http\Controllers;

use App\Pasien;
use App\Prolanis;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ProlanisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        $cm = $now->month;
        $prolanis = Prolanis::whereMonth('created_at', '=', $cm)->get();
        return view('prolanis.index', compact('prolanis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prolanis.create');
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
           'pasien_id'=>'required'
        ]);
        $data = $request->all();
        $idPasien = $data['pasien_id'];
        $pasien = Pasien::query()->where('id', '=', $idPasien)->first();
        $kp = $pasien['id_kategori'];

        if ($kp == 4){
            $data['registrasi_id'] = Auth::user()->registrasi->id;

            Prolanis::create($data);
            Session::flash("flash_message", [
                "level" => "success",
                "message" => "Absensi berhasil ditambahkan"
            ]);
            return redirect()->route('perawat-prolanis.index');
        } else {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Pasien Tidak Terdaftar Sebagai Anggota Prolanis"
            ]);
            return view('prolanis.create');
        }

    }

    /*public function store(Request $request)
    {

        $this->validate($request, [
            'pasien_id'=>'required'
        ]);
        $data = $request->all();
        $data['registrasi_id'] = Auth::user()->registrasi->id;
        Prolanis::create($data);
        Session::flash("flash_message", [
            "level" => "success",
            "message" => "Absensi berhasil ditambahkan"
        ]);
        return redirect()->route('perawat-prolanis.index');
    }*/

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
        Prolanis::findOrFail($id)->delete();
        Session::flash("flash_message", [
            "level" => "success",
            "message" => "Absensi berhasil dihapus"
        ]);
        return redirect()->route('perawat-prolanis.index');
    }

    public function exportProlanis(){
        ob_end_clean();
        ob_start();
        $now = Carbon::now();
        $cm = $now->month;

        $prolanis = Prolanis::whereMonth('created_at', '=', $cm)->get();

        Excel::create('Data Prolanis', function ($excel) use($prolanis){
            $excel->setTitle('Data Prolanis')
                ->setCreator(Auth::user()->email);

            $excel->sheet('Data Prolanis', function ($sheet) use($prolanis){
               $sheet->setAutoSize(true);
               $row = 1;
               $no = 1;
               $sheet->row($row, [
                  'No',
                   'ID Pasien',
                   'Nama Pasien',
                   'Petugas',
                   'Tanggal'
               ]);
               foreach ($prolanis as $p){
                   $sheet->row(++$row, [
                      $no++,
                       $p->pasien_id,
                       $p->pasien->nama,
                       $p->registrasi->name,
                       $p->created_at
                   ]);
               }
            });
        })->download('xlsx');
        ob_flush();
    }
}
