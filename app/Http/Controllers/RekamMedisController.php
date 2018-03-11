<?php

namespace App\Http\Controllers;

use App\Diagnosis;
use App\Dokter;
use App\Obat;
use App\PasienPoli;
use App\RekamMedis;
use App\RekamMedisDiagnosis;
use App\RekamMedisObat;
use App\Service\StoreMedicalRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RekamMedisController extends Controller
{
    public function index()
    {
        $now = Carbon::now()->toDateString();
        $rekams = RekamMedis::with('obat', 'diagnoses')->get();
        $rekams = $rekams->filter(function ($rekam) use ($now) {
            if ($rekam->created_at->toDateString() == $now) {
                return $rekam;
            }
        });

        return view('rekammedis.index', compact('rekams'));
    }

    public function bulananIndex()
    {
        $now = Carbon::now();
        $month = $now->month;
        $year = $now->year;
        $rekams = RekamMedisObat::with('obat', 'rekamMedis')
            ->whereMonth('created_at', '=', $month)
            ->whereYear('created_at', $year)
            ->get();

        return view('rekammedis.bulananindex', compact('rekams'));
    }

    public function create($id)
    {
        $visit = PasienPoli::findOrFail($id);
        $diagnoses = Diagnosis::orderBy('name', 'asc')
            ->get();
        $obats = Obat::orderBy('nama_obat', 'asc')
            ->get();
        $dokters = Dokter::where('spesialis_id', 1)
            ->get();
        $dentists = Dokter::where('spesialis_id', 2)
            ->get();
        $medicines = 1;
        $totalDiagnoses = 1;

        return view('rekammedis.create', compact('visit', 'diagnoses', 'dokters', 'dentists', 'obats'
            , 'medicines', 'totalDiagnoses'));

    }

    public function store(Request $request)
    {
        //$kunjungan = PasienPoli::findOrFail($id);
        dd($request->all());
        $this->validate($request, [
            'pasien_poli_id' => 'required',
            'diagnosa' => 'required',
            'terapi' => 'required',
            'obat_id' => 'required'
        ]);
        $data = $request->all();

        RekamMedis::create($data);

        $rekam = RekamMedis::orderBy('created_at', 'desc')->first();
        $rmo[] = new RekamMedisObat();


        foreach ($request->input('obat_id') as $selected) {
            foreach ($request->input('jumlah') as $jumlah) {
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

    public function perawatStore(Request $request)
    {
        $rekamMedis = new RekamMedis();

        $data = [
            'pasien_poli_id' => $request->pasien_poli_id,
            'dokter_id' => $request->dokter_id,
            'terapi' => $request->terapi,
        ];
        $rekamMedis->fill($data);
        $rekamMedis->save();

        $storeMedicalRecord = new StoreMedicalRecord($request);
        $rekam = RekamMedis::orderBy('created_at', 'desc')->first();
        if ($rekam) {
            $storeMedicalRecord->store($rekam);
        }
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Gagal Menambahkan Rekam Medis, Rekam Medis Kosong"
        ]);

        return redirect()->route('perawat-rekammedis.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medicalRecord = RekamMedis::find($id);
        $visit = $medicalRecord->pasienPoli;
        $medicines = Obat::orderBy('nama_obat', 'asc')->get();
        $diagnoses = Diagnosis::orderBy('name', 'asc')->get();
        $dokters = Dokter::where('spesialis_id', 1)
            ->get();
        $dentists = Dokter::where('spesialis_id', 2)
            ->get();

        return view('rekammedis.edit', compact('medicalRecord', 'visit', 'medicines', 'diagnoses',
            'dokters', 'dentists'));
    }

    public function update(Request $request, $id)
    {
        $rekam = RekamMedisObat::findOrFail($id);
        $this->validate($request, [
            'diagnosa' => 'required',
            'terapi' => 'required',
            'obat' => 'required',
            'rekam_medis_id' => 'required'
        ]);
        $rekam->update($request->all());
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil Memperbarui Rekam Medis"
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
            "level" => "success",
            "message" => "Berhasil Memperbarui Rekam Medis"
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
        RekamMedis::findOrFail($id)->delete();
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Rekam Medis Berhasil Dihapus"
        ]);

        return redirect()->route('perawat-rekammedis.index');
    }
}
