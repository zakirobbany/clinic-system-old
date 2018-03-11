<?php

namespace App\Http\Controllers;

use App\Pasien;
use App\PasienPoli;
use App\RekamMedis;
use App\Rujukan;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class KunjunganPoliController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $day = $now->day;
        $month = $now->month;
        $kunjungan = PasienPoli::with('pasien', 'poli', 'dokter', 'rekamMedis')
            ->whereDay('created_at', '=', $day)
            ->whereMonth('created_at', '=', $month)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('kunjungan.index', compact('kunjungan'));
    }

    public function create()
    {
        return view('kunjungan.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'pasien_id' => 'required',
            'poli_id' => 'required',
            'dokter_id' => 'required'
        ]);
        $data = $request->all();
        $data['pasien_id'] = strtoupper($data['pasien_id']);

        $getPasien = Pasien::find($data['pasien_id']);
        $idPasien = $getPasien['id'];

        if ($data['pasien_id'] == $idPasien) {
            PasienPoli::create($data);

            Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Berhasil Menambah Kunjungan"
            ]);
            return redirect()->route('perawat-kunjunganPoli.index');
        } else {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Periksa Kembali ID Pasien"
            ]);
            return view('kunjungan.create');
        }


    }

    public function show($id)
    {
        $kunjungan = RekamMedis::query()->where('pasien_poli_id', '=', $id)->first();
        return view('kunjungan.show', compact('kunjungan'));
    }

    public function kunjunganRujukan($id)
    {
        $rujukan = Rujukan::query()->where('pasien_poli_id', '=', $id)->first();
        return view('kunjungan.kunjunganRujukan', compact('rujukan'));
    }

    public function edit($id)
    {
        $kunjungan = PasienPoli::findOrFail($id);
        return view('kunjungan.edit', compact('kunjungan'));
    }

    public function update(Request $request, $id)
    {
        $kunjungan = PasienPoli::findOrFail($id);
        $this->validate($request, [
            'pasien_id' => 'required',
            'poli_id' => 'required',
            'dokter_id' => 'required',
        ]);
        $kunjungan->update($request->all());
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil Membarui Kunjungan"
        ]);
        return redirect()->route('perawat-kunjunganPoli.index');
    }

    public function destroy($id)
    {
        PasienPoli::findOrFail($id)->delete();
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Kunjungan Berhasil Dihapus"
        ]);
        return redirect()->route('perawat-kunjunganPoli.index');
    }

    public function umumIndex()
    {
        $now = Carbon::now();
        $cm = $now->day;
        $kunjungan = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*',
                'pasien_poli.pasien_id',
                'pasien_poli.poli_id',
                'pasien_poli.dokter_id',
                'pasien_poli.created_at',
                'pasien_poli.id',
                'pasiens.id',
                'pasiens.nama',
                'pasiens.id_kategori')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
            ->where('pasiens.id_kategori', '=', '1')->whereDay('pasien_poli.created_at', '=', $cm)->orderBy('created_at', 'desc')->get();
        return view('kunjungan.umum', compact('kunjungan'));
    }

    public function bulananUmumIndex()
    {
        $now = Carbon::now();
        $cm = $now->month;
        $kunjungan = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*',
                'pasien_poli.pasien_id',
                'pasien_poli.poli_id',
                'pasien_poli.dokter_id',
                'pasien_poli.created_at',
                'pasien_poli.id',
                'pasiens.id',
                'pasiens.nama',
                'pasiens.id_kategori')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
            ->where('pasiens.id_kategori', '=', '1')->whereMonth('pasien_poli.created_at', '=', $cm)->orderBy('created_at', 'desc')->get();
        return view('kunjungan.umumBulanan', compact('kunjungan'));
    }

    public function bpjsIndex()
    {
        $now = Carbon::now();
        $cm = $now->day;
        $kunjungan = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*',
                'pasien_poli.pasien_id',
                'pasien_poli.poli_id',
                'pasien_poli.dokter_id',
                'pasien_poli.created_at',
                'pasien_poli.id',
                'pasiens.id',
                'pasiens.nama',
                'pasiens.id_kategori')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')->whereDay('pasien_poli.created_at', '=', $cm)
            ->whereIn('pasiens.id_kategori', [2, 4])
            ->orderBy('created_at', 'desc')->get();
        return view('kunjungan.bpjs', compact('kunjungan'));
    }

    public function bulananBpjsIndex()
    {
        $now = Carbon::now();
        $cm = $now->month;
        $kunjungan = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*',
                'pasien_poli.pasien_id',
                'pasien_poli.poli_id',
                'pasien_poli.dokter_id',
                'pasien_poli.created_at',
                'pasien_poli.id',
                'pasiens.id',
                'pasiens.nama',
                'pasiens.id_kategori')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')->whereMonth('pasien_poli.created_at', '=', $cm)
            ->whereIn('pasiens.id_kategori', [2, 4])->orderBy('created_at', 'desc')->get();
        return view('kunjungan.bpjsBulanan', compact('kunjungan'));
    }

    public function hijauIndex()
    {
        $now = Carbon::now();
        $cm = $now->day;
        $kunjungan = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*',
                'pasien_poli.pasien_id',
                'pasien_poli.poli_id',
                'pasien_poli.dokter_id',
                'pasien_poli.created_at',
                'pasien_poli.id',
                'pasiens.id',
                'pasiens.nama',
                'pasiens.id_kategori')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
            ->where('pasiens.id_kategori', '=', '3')->whereDay('pasien_poli.created_at', '=', $cm)->orderBy('created_at', 'desc')->get();
        return view('kunjungan.hijau', compact('kunjungan'));
    }

    public function bulananHijauIndex()
    {
        $now = Carbon::now();
        $cm = $now->month;
        $kunjungan = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*',
                'pasien_poli.pasien_id',
                'pasien_poli.poli_id',
                'pasien_poli.dokter_id',
                'pasien_poli.created_at',
                'pasien_poli.id',
                'pasiens.id',
                'pasiens.nama',
                'pasiens.id_kategori')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
            ->where('pasiens.id_kategori', '=', '3')->whereMonth('pasien_poli.created_at', '=', $cm)->orderBy('created_at', 'desc')->get();
        return view('kunjungan.hijauBulanan', compact('kunjungan'));
    }

    public function prolanisIndex()
    {
        $now = Carbon::now();
        $cm = $now->day;
        $kunjungan = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*',
                'pasien_poli.pasien_id',
                'pasien_poli.poli_id',
                'pasien_poli.dokter_id',
                'pasien_poli.created_at',
                'pasien_poli.id',
                'pasiens.id',
                'pasiens.nama',
                'pasiens.id_kategori')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
            ->where('pasiens.id_kategori', '=', '4')->whereDay('pasien_poli.created_at', '=', $cm)->orderBy('created_at', 'desc')->get();
        return view('kunjungan.prolanis', compact('kunjungan'));
    }

    public function bulananProlanisIndex()
    {
        $now = Carbon::now();
        $cm = $now->month;
        $kunjungan = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*',
                'pasien_poli.pasien_id',
                'pasien_poli.poli_id',
                'pasien_poli.dokter_id',
                'pasien_poli.created_at',
                'pasien_poli.id',
                'pasiens.id',
                'pasiens.nama',
                'pasiens.id_kategori')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
            ->where('pasiens.id_kategori', '=', '4')->whereMonth('pasien_poli.created_at', '=', $cm)->orderBy('created_at', 'desc')->get();
        return view('kunjungan.prolanisBulanan', compact('kunjungan'));
    }


    public function bulananIndex()
    {
        $now = Carbon::now();
        $cm = $now->month;
        $kunjungan = PasienPoli::with('pasien', 'poli', 'dokter', 'rekamMedis')->whereMonth('created_at', '=', $cm)->orderBy('created_at', 'desc')->get();
        return view('kunjungan.bulanan', compact('kunjungan', 'month'));
    }

    public function kunjunganKontakBpjs()
    {
        $now = Carbon::now();
        $cm = $now->month;
        $kunjungan = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
            ->whereMonth('pasien_poli.created_at', '=', $cm)
            ->whereIn('pasiens.id_kategori', [2, 4])
            ->groupBy('pasien_poli.pasien_id')->get();
        return view('kunjungan.kunjunganKontakBpjs', compact('kunjungan'));
    }

    public function exportKunjunganKontakBpjs()
    {
        ob_end_clean();
        ob_start();
        $now = Carbon::now();
        $cm = $now->month;
        $kunjungan = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
            ->whereMonth('pasien_poli.created_at', '=', $cm)
            ->whereIn('pasiens.id_kategori', [2, 4])
            ->groupBy('pasien_poli.pasien_id')->get();

        Excel::create('Data Kunjungan Kontak', function ($excel) use ($kunjungan) {
            $excel->setTitle('Data Kunjungan')
                ->setCreator(Auth::user()->email);

            $excel->sheet('Data Kunjungan Kontak', function ($sheet) use ($kunjungan) {
                $sheet->setAutoSize(true);
                $row = 1;
                $no = 1;
                $sheet->row($row, [
                    'No',
                    'ID Pasien',
                    'Nama Pasien',
                    'Poli',
                    'Umur',
                    'Nama Dokter',
                    'Kategori Pasien',
                    'Tanggal Kunjungan'
                ]);
                foreach ($kunjungan as $k) {
                    $sheet->row(++$row, [
                        $no++,
                        $k->pasien->id,
                        $k->pasien->nama,
                        $k->poli->nama_poli,
                        $k->pasien->umur,
                        $k->dokter->name,
                        $k->pasien->kategoriPasien->nama_kategori,
                        $k->created_at
                    ]);
                }
            });
        })->download('xlsx');
        ob_flush();
    }

    public function exportKunjungan()
    {
        ob_end_clean();
        ob_start();
        $now = Carbon::now();
        $cm = $now->month;
        $kunjungan = PasienPoli::with('pasien', 'poli', 'dokter', 'rekamMedis')->whereMonth('created_at', '=', $cm)->orderBy('created_at', 'desc')->get();

        Excel::create('Data Kunjungan', function ($excel) use ($kunjungan) {
            $excel->setTitle('Data Kunjungan')
                ->setCreator(Auth::user()->email);

            $excel->sheet('Data Kunjungan', function ($sheet) use ($kunjungan) {
                $sheet->setAutoSize(true);
                $row = 1;
                $no = 1;
                $sheet->row($row, [
                    'No',
                    'ID Pasien',
                    'Nama Pasien',
                    'Poli',
                    'Umur',
                    'Nama Dokter',
                    'Kategori Pasien',
                    'Tanggal Kunjungan'
                ]);
                foreach ($kunjungan as $k) {
                    $sheet->row(++$row, [
                        $no++,
                        $k->pasien->id,
                        $k->pasien->nama,
                        $k->poli->nama_poli,
                        $k->pasien->umur,
                        $k->dokter->name,
                        $k->pasien->kategoriPasien->nama_kategori,
                        $k->created_at
                    ]);
                }
            });
        })->download('xlsx');
        ob_flush();
    }

    public function exportKunjunganUmum()
    {
        ob_end_clean();
        ob_start();
        $now = Carbon::now();
        $cm = $now->month;
        $kunjungan = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*',
                'pasien_poli.pasien_id',
                'pasien_poli.poli_id',
                'pasien_poli.dokter_id',
                'pasien_poli.created_at',
                'pasien_poli.id',
                'pasiens.id',
                'pasiens.nama',
                'pasiens.id_kategori')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
            ->where('pasiens.id_kategori', '=', '1')->whereMonth('pasien_poli.created_at', '=', $cm)->orderBy('created_at', 'desc')->get();

        Excel::create('Data Kunjungan Umum', function ($excel) use ($kunjungan) {
            $excel->setTitle('Data Kunjungan Umum')
                ->setCreator(Auth::user()->email);

            $excel->sheet('Data Kunjungan Umum', function ($sheet) use ($kunjungan) {
                $sheet->setAutoSize(true);
                $row = 1;
                $no = 1;
                $sheet->row($row, [
                    'No',
                    'ID Pasien',
                    'Nama Pasien',
                    'Poli',
                    'Umur',
                    'Nama Dokter',
                    'Kategori Pasien',
                    'Tanggal Kunjungan'
                ]);
                foreach ($kunjungan as $k) {
                    $sheet->row(++$row, [
                        $no++,
                        $k->pasien->id,
                        $k->pasien->nama,
                        $k->poli->nama_poli,
                        $k->pasien->umur,
                        $k->dokter->name,
                        $k->pasien->kategoriPasien->nama_kategori,
                        $k->created_at
                    ]);
                }
            });
        })->download('xlsx');
        ob_flush();

    }

    public function exportKunjunganBpjs()
    {
        ob_end_clean();
        ob_start();
        $now = Carbon::now();
        $cm = $now->month;
        $kunjungan = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*',
                'pasien_poli.pasien_id',
                'pasien_poli.poli_id',
                'pasien_poli.dokter_id',
                'pasien_poli.created_at',
                'pasien_poli.id',
                'pasiens.id',
                'pasiens.nama',
                'pasiens.id_kategori')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')->whereMonth('pasien_poli.created_at', '=', $cm)
            ->whereIn('pasiens.id_kategori', [2, 4])->orderBy('created_at', 'desc')->get();

        Excel::create('Data Kunjungan Bpjs', function ($excel) use ($kunjungan) {
            $excel->setTitle('Data Kunjungan Bpjs')
                ->setCreator(Auth::user()->email);

            $excel->sheet('Data Kunjungan Bpjs', function ($sheet) use ($kunjungan) {
                $sheet->setAutoSize(true);
                $row = 1;
                $no = 1;
                $sheet->row($row, [
                    'No',
                    'ID Pasien',
                    'Nama Pasien',
                    'Poli',
                    'Umur',
                    'Nama Dokter',
                    'Kategori Pasien',
                    'Tanggal Kunjungan'
                ]);
                foreach ($kunjungan as $k) {
                    $sheet->row(++$row, [
                        $no++,
                        $k->pasien->id,
                        $k->pasien->nama,
                        $k->poli->nama_poli,
                        $k->pasien->umur,
                        $k->dokter->name,
                        $k->pasien->kategoriPasien->nama_kategori,
                        $k->created_at
                    ]);
                }
            });
        })->download('xlsx');
        ob_flush();

    }

    public function exportKunjunganKartuhijau()
    {
        ob_end_clean();
        ob_start();
        $now = Carbon::now();
        $cm = $now->month;
        $kunjungan = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*',
                'pasien_poli.pasien_id',
                'pasien_poli.poli_id',
                'pasien_poli.dokter_id',
                'pasien_poli.created_at',
                'pasien_poli.id',
                'pasiens.id',
                'pasiens.nama',
                'pasiens.id_kategori')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
            ->where('pasiens.id_kategori', '=', '3')->whereMonth('pasien_poli.created_at', '=', $cm)->orderBy('created_at', 'desc')->get();

        Excel::create('Data Kunjungan Kartu Hijau', function ($excel) use ($kunjungan) {
            $excel->setTitle('Data Kunjungan Kartu Hijau')
                ->setCreator(Auth::user()->email);

            $excel->sheet('Data Kunjungan Kartu Hijau', function ($sheet) use ($kunjungan) {
                $sheet->setAutoSize(true);
                $row = 1;
                $no = 1;
                $sheet->row($row, [
                    'No',
                    'ID Pasien',
                    'Nama Pasien',
                    'Poli',
                    'Umur',
                    'Nama Dokter',
                    'Kategori Pasien',
                    'Tanggal Kunjungan'
                ]);
                foreach ($kunjungan as $k) {
                    $sheet->row(++$row, [
                        $no++,
                        $k->pasien->id,
                        $k->pasien->nama,
                        $k->poli->nama_poli,
                        $k->pasien->umur,
                        $k->dokter->name,
                        $k->pasien->kategoriPasien->nama_kategori,
                        $k->created_at
                    ]);
                }
            });
        })->download('xlsx');
        ob_flush();
    }

    public function exportKunjunganProlanis()
    {
        ob_end_clean();
        ob_start();
        $now = Carbon::now();
        $cm = $now->month;
        $kunjungan = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*',
                'pasien_poli.pasien_id',
                'pasien_poli.poli_id',
                'pasien_poli.dokter_id',
                'pasien_poli.created_at',
                'pasien_poli.id',
                'pasiens.id',
                'pasiens.nama',
                'pasiens.id_kategori')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
            ->where('pasiens.id_kategori', '=', '4')->whereMonth('pasien_poli.created_at', '=', $cm)->orderBy('created_at', 'desc')->get();

        Excel::create('Data Kunjungan Prolanis', function ($excel) use ($kunjungan) {
            $excel->setTitle('Data Kunjungan Prolanis')
                ->setCreator(Auth::user()->email);

            $excel->sheet('Data Kunjungan Prolanis', function ($sheet) use ($kunjungan) {
                $sheet->setAutoSize(true);
                $row = 1;
                $no = 1;
                $sheet->row($row, [
                    'No',
                    'ID Pasien',
                    'Nama Pasien',
                    'Poli',
                    'Umur',
                    'Nama Dokter',
                    'Kategori Pasien',
                    'Tanggal Kunjungan'
                ]);
                foreach ($kunjungan as $k) {
                    $sheet->row(++$row, [
                        $no++,
                        $k->pasien->id,
                        $k->pasien->nama,
                        $k->poli->nama_poli,
                        $k->pasien->umur,
                        $k->dokter->name,
                        $k->pasien->kategoriPasien->nama_kategori,
                        $k->created_at
                    ]);
                }
            });
        })->download('xlsx');
        ob_flush();
    }

}
