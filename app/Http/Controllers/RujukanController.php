<?php

namespace App\Http\Controllers;

use App\PasienPoli;
use App\RekamMedis;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Rujukan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class RujukanController extends Controller
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
        $rujukans = Rujukan::whereDay('created_at', '=', $cd)->get();
        return view('rujukan.index', compact('rujukans'));
    }

    public function bulananIndex(){
        $now = Carbon::now();
        $cm = $now->month;
        $rujukans = Rujukan::whereMonth('created_at', '=', $cm)->get();
        return view('rujukan.bulananindex', compact('rujukans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $kunjungan = PasienPoli::findOrFail($id);
        if (!$kunjungan->rekamMedis) {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Kunjungan Belum Memiliki Rekam Medis"
            ]);

            return redirect()->route('perawat-kunjunganPoli.index');
        }

        return view('rujukan.create', compact('kunjungan'));
        /*
        $rekammedis = RekamMedis::where('pasien_poli_id', '=', $id)->get();
        $diagnosa = $rekammedis->diagnosa;
        if (isset($diagnosa)){
            return view('rujukan.create', compact('kunjungan'));
        } else {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Kunjungan Belum Memiliki Rekam Medis"
            ]);
            return redirect()->route('dokter-rujukan.index');
        }
        */


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $kunjungan = PasienPoli::findOrFail($id);
        $this->validate($request, [
           'rujukan'=>'required',
        ]);
        $data = $request->all();
        $data['pasien_poli_id'] = $kunjungan->id;
        $data['rekam_medis_id'] = $kunjungan->rekamMedis->id;
        Rujukan::create($data);
        Session::flash("flash_notification", [
           "level" => "success",
            "message" => "Berhasil Menambah Rujukan"
        ]);
        return redirect()->route('dokter-rujukan.index');
    }

    public function perawatStore(Request $request, $id)
    {
        $kunjungan = PasienPoli::findOrFail($id);
        $this->validate($request, [
           'rujukan'=>'required',
        ]);
        $data = $request->all();
        $data['pasien_poli_id'] = $kunjungan->id;
        $data['rekam_medis_id'] = $kunjungan->rekamMedis->id;
        Rujukan::create($data);
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil Menambah Rujukan"
        ]);
        return redirect()->route('perawat-rujukan.index');
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
        $rujukan = Rujukan::findOrFail($id);
        return view('rujukan.edit', compact('rujukan'));
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
        $rujukan = Rujukan::findOrFail($id);
        $this->validate($request, [
           'rujukan'=>'required'
        ]);
        $rujukan->update($request->all());
        Session::flash("flash_notification", [
           "level"=>"success",
            "message"=>"Berhasil Memperbarui Rujukan"
        ]);
        return redirect()->route('dokter-rujukan.index');
    }

    public function perawatUpdate(Request $request, $id)
    {
        $rujukan = Rujukan::findOrFail($id);
        $this->validate($request, [
            'rujukan'=>'required'
        ]);
        $rujukan->update($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Memperbarui Rujukan"
        ]);
        return redirect()->route('perawat-rujukan.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rujukan::find($id)->delete();
        Session::flash("flash_notification",[
           "level"=>"success",
            "message"=>"Rujukan Berhasil Dihapus"
        ]);
        return redirect()->route('dokter-rujukan.index');
    }

    public function perawatDestroy($id){
        Rujukan::find($id)->delete();
        Session::flash("flash_notification",[
            "level"=>"success",
            "message"=>"Rujukan Berhasil Dihapus"
        ]);
        return redirect()->route('perawat-rujukan.index');
    }

    public function exportRujukan(){
        ob_end_clean();
        ob_start();
        $now = Carbon::now();
        $cm = $now->month;
        $rujukan = Rujukan::whereMonth('created_at','=',$cm)->get();

        Excel::create('Data Rujukan', function ($excel) use($rujukan){
            $excel->setTitle('Data Rujukan')
                ->setCreator(Auth::user()->email);

            $excel->sheet('Data Rujukan', function ($sheet) use($rujukan){
                $sheet->setAutoSize(true);
                $row = 1;
                $no = 1;
                $sheet->row($row, [
                    'No',
                    'ID Pasien',
                    'Nama Pasien',
                    'Dokter',
                    'Poli',
                    'Tujukan',
                    'Diagnosa',
                    'Tanggal'
                ]);
                foreach ($rujukan as $k){
                    $sheet->row(++$row,[
                        $no++,
                        $k->pasienPoli->pasien->id,
                        $k->pasienPoli->pasien->nama,
                        $k->pasienPoli->dokter->name,
                        $k->pasienPoli->poli->nama_poli,
                        $k->rujukan,
                        $k->rekamMedis->diagnosa,
                        $k->created_at
                    ]);
                }
            });
        })->download('xlsx');
        ob_flush();
    }
}
