<?php

namespace App\Service;

use App\RekamMedis;
use Illuminate\Http\Request;

class StoreMedicalRecord
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function store(RekamMedis $rekam)
    {
        if ($rekam) {
            foreach ($this->request->diagnoses as $diagnosis) {
                $rekamMedisDiagnoses = new RekamMedisDiagnosis();
                if ($diagnosis) {
                    $data = [
                        'rekam_medis_id' => $rekam->id,
                        'diagnoses_id' => $diagnosis,
                    ];
                    $rekamMedisDiagnoses->fill($data);
                    $rekamMedisDiagnoses->save();
                }
            }

            foreach ($this->request->obat_id as $key => $obat_id) {
                $rekamMedisObat = new RekamMedisObat();
                $data = [
                    'rekam_medis_id' => $rekam->id,
                    'obat_id' => $obat_id,
                    'jumlah' => $this->request->jumlah[$key],
                ];
                $rekamMedisObat->fill($data);
                $rekamMedisObat->save();
            }

            Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Berhasil Menambahkan Rekam Medis"
            ]);
            return redirect()->route('perawat-rekammedis.index');
        }
    }
}