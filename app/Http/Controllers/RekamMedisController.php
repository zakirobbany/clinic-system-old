<?php

namespace App\Http\Controllers;

use App\PasienPoli;
use App\RekamMedis;
use App\RekamMedisObat;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class RekamMedisController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $cd = $now->day;
        $cm = $now->month;
        $rekams = RekamMedisObat::with('obat', 'rekamMedis')
            ->whereDay('created_at', '=', $cd)
            ->whereMonth('created_at', '=', $cm)
            ->get();
        return view('rekammedis.index', compact('rekams'));
    }
    public function bulananIndex()
    {
        $now = Carbon::now();
        $cm = $now->month;
        $rekams = RekamMedisObat::with('obat', 'rekamMedis')->whereMonth('created_at', '=', $cm)->get();
        return view('rekammedis.bulananindex', compact('rekams'));
    }

    public function create($id)
    {
        $kunjungan = PasienPoli::findOrFail($id);
        return view('rekammedis.create', compact('kunjungan'));

    }
    public function store(Request $request, $id)
    {
        ##$kunjungan = PasienPoli::findOrFail($id);
        $this->validate($request, [
            'pasien_poli_id'=>'required',
            'diagnosa'=>'required',
            'terapi'=>'required',
            'obat_id'=>'required'
        ]);
        $data = $request->all();

        RekamMedis::create($data);

        $rekam = RekamMedis::orderBy('created_at', 'desc')->first();
        $rmo[] = new RekamMedisObat();


        foreach ($request->input('obat_id') as $selected){
            foreach ($request->input('jumlah') as $jumlah){
                $rmo['rekam_medis_id'] = $rekam->id;
                $rmo['obat_id'] = $selected;
                $rmo['jumlah'] = $jumlah;
                RekamMedisObat::create($rmo);
            }
        }

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil Menambahkan Rekam Medis"
        ]);
        return redirect()->route('dokter-rekammedis.index');
    }

    public function perawatStore(Request $request, $id)
    {
        ##$kunjungan = PasienPoli::findOrFail($id);
        $this->validate($request, [
            'pasien_poli_id'=>'required',
            'diagnosa'=>'required',
            'terapi'=>'required',
        ]);
        $data = $request->all();

        RekamMedis::create($data);

        $rekam = RekamMedis::orderBy('created_at', 'desc')->first();
        $rmo[] = new RekamMedisObat();


        foreach ($request->input('array') as $selected ){
            if ($selected['jumlah'] > 0){
                $rmo['rekam_medis_id'] = $rekam->id;
                $rmo['obat_id'] = $selected['obat_id'];
                $rmo['jumlah'] = $selected['jumlah'];
                RekamMedisObat::create($rmo);
            }
        }

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil Menambahkan Rekam Medis"
        ]);
        return redirect()->route('perawat-rekammedis.index');
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
        $rekam = RekamMedisObat::findOrFail($id);
        return view('rekammedis.edit', compact('rekam'));
    }

    public function update(Request $request, $id)
    {
        $rekam = RekamMedisObat::findOrFail($id);
        $this->validate($request, [
            'diagnosa'=>'required',
            'terapi'=>'required',
            'obat'=>'required',
            'rekam_medis_id'=>'required'
        ]);
        $rekam->update($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Memperbarui Rekam Medis"
        ]);

        return redirect()->route('dokter-rekammedis.index');
    }

    public function perawatUpdate(Request $request, $id)
    {
        $r = RekamMedisObat::findOrFail($id)->get();
        $rekam = RekamMedisObat::findOrFail($id);
        $this->validate($request, [
            'rekam_medis_id' => 'required'
        ]);

        $data = $request->all();
        $rm = RekamMedis::findOrFail($rekam->rekam_medis_id);
        $rekamMedis = RekamMedis::findOrFail($rekam->rekam_medis_id)->get();
        $rekamMedis['diagnosa'] = $data['diagnosa'];
        $rekamMedis['terapi'] = $data['terapi'];
        $rm->update($rekamMedis->all());

        $r['obat_id'] = $data['obat_id'];
        $r['jumlah'] = $data['jumlah'];
        $r['rekam_medis_id'] = $rekam->rekam_medis_id;
        $rekam->update($r->all());



        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Memperbarui Rekam Medis"
        ]);

        return redirect()->route('perawat-rekammedis.index');
    }

    public function destroy($id)
    {
        RekamMedisObat::findOrFail($id)->delete();
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Rekam Medis Berhasil Dihapus"
        ]);

        return redirect()->route('dokter-rekammedis.index');
    }

    public function perawatDestroy($id)
    {
        RekamMedisObat::findOrFail($id)->delete();
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Rekam Medis Berhasil Dihapus"
        ]);

        return redirect()->route('perawat-rekammedis.index');
    }
}
