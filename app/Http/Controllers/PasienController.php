<?php

namespace App\Http\Controllers;

use App\KategoriPasien;
use App\Pasien;
use App\PasienPoli;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class PasienController extends Controller
{
    public function index(Request $request)
    {

        $pasiens = Pasien::paginate();
        if ($request->has('nama') && !$request->has('id')) {
            $pasiens = Pasien::where('nama', 'like', '%' . $request->nama . '%')
                ->paginate();
        }

        if ($request->has('nama') && $request->has('id')){
            $pasiens = Pasien::where([
                ['id', 'like', '%'. $request->id .'%'],
                ['nama', 'like', '%'. $request->nama .'%'],
            ])
                ->paginate();
        }

        if ($request->has('id') && !$request->has('nama')){
            $pasiens = Pasien::where('id', 'like', '%'. $request->id . '%')
                ->paginate();
        }

        $pasiens->appends($request->all());

        return view('pasien.index', compact('pasiens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pasien.create');
    }

    public function bpjsCreate(){
        return view('pasien.bpjsCreate');
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
            'id'=>'required|unique:pasiens,id',
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'id_kategori' => 'required'
        ]);
        $data = $request->all();
        $data['id'] = strtoupper($data['id']);
        $data['nama'] = strtoupper($data['nama']);
        $pasien = Pasien::create($data);

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menyimpan $pasien->nama"
            ]);
        return redirect()->route('pasien.index');
    }
    public function perawatStore(Request $request)
    {
        $this->validate($request, [
            'id'=>'required|unique:pasiens,id',
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'id_kategori' => 'required'
        ]);
        $data = $request->all();

        $data['id'] = strtoupper($data['id']);
        $data['nama'] = strtoupper($data['nama']);

        if ($data['id_kategori'] == 4){
            $umur = 50;
            if ($data['umur'] > $umur){
                $pasien = Pasien::create($data);
                Session::flash("flash_notification", [
                    "level" => "success",
                    "message" => "Berhasil menyimpan $pasien->nama"
                ]);
                return redirect()->route('perawat-pasien.index');
            } else {
                Session::flash("flash_notification", [
                    "level" => "danger",
                    "message" => "Pasien Masih Dibawah Umur"
                ]);
                return view('pasien.create');
            }
        } else {
            $pasien = Pasien::create($data);
            Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Berhasil menyimpan $pasien->nama"
            ]);
            return redirect()->route('perawat-pasien.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rmHistorys = PasienPoli::query()
            ->select('pasien_poli.*')
            ->join('rekam_medis', 'rekam_medis.pasien_poli_id', '=', 'pasien_poli.id')
            ->join('pasiens', 'pasiens.id', '=', 'pasien_poli.pasien_id')
            ->where('pasiens.id', '=', $id)->get();
        $rHistorys = PasienPoli::query()
            ->select('pasien_poli.*')
            ->join('rujukans', 'rujukans.pasien_poli_id', '=', 'pasien_poli.id')
            ->join('pasiens', 'pasiens.id', '=', 'pasien_poli.pasien_id')
            ->where('pasiens.id', '=', $id)->get();
        $pasien = Pasien::findOrFail($id);
        return view('pasien.show', compact('pasien', 'rmHistorys', 'rHistorys'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.edit', compact('pasien'));
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
        $pasien = Pasien::findOrFail($id);
        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'id_kategori' => 'required'
        ]);

        $pasien->update($request->all());
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "berhasil merubah $pasien->nama"
        ]);
        return redirect()->route('pasien.index');
    }
    public function perawatUpdate(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);
        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'id_kategori' => 'required'
        ]);

        $pasien->update($request->all());
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "berhasil merubah $pasien->nama"
        ]);
        return redirect()->route('perawat-pasien.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pasien::find($id)->delete();
        Session::flash("flash_notification", [
           "level" => "success",
            "message" => "Pasien berhasil dihapus"
        ]);
        return redirect()->route('pasien.index');
    }
    public function perawatDestroy($id)
    {
        Pasien::find($id)->delete();
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Pasien berhasil dihapus"
        ]);
        return redirect()->route('perawat-pasien.index');
    }

    public function umumIndex(Request $request)
    {
        $pasiens = Pasien::where('id_kategori', '=', 1)->paginate();
        if ($request->has('nama') && !$request->has('id')) {
            $pasiens = Pasien::where('id_kategori', '=', 1)
                ->where('nama', 'like', '%' . $request->nama . '%')
                ->paginate();
        }

        if ($request->has('nama') && $request->has('id')){
            $pasiens = Pasien::where([
                ['id_kategori', '=', 1],
                ['id', 'like', '%'. $request->id .'%'],
                ['nama', 'like', '%'. $request->nama .'%'],
            ])
                ->paginate();
        }

        if ($request->has('id') && !$request->has('nama')){
            $pasiens = Pasien::where('id_kategori', '=', 1)
                ->where('id', 'like', '%'. $request->id . '%')
                ->paginate();
        }

        $pasiens->appends($request->all());

        return view('pasien.index', compact('pasiens'));
    }

    public function kartuhijauIndex(Request $request){
        $pasiens = Pasien::where('id_kategori', '=', 3)->paginate();
        if ($request->has('nama') && !$request->has('id')) {
            $pasiens = Pasien::where('id_kategori', '=', 3)
                ->where('nama', 'like', '%' . $request->nama . '%')
                ->paginate();
        }

        if ($request->has('nama') && $request->has('id')){
            $pasiens = Pasien::where([
                ['id_kategori', '=', 3],
                ['id', 'like', '%'. $request->id .'%'],
                ['nama', 'like', '%'. $request->nama .'%'],
            ])
                ->paginate();
        }

        if ($request->has('id') && !$request->has('nama')){
            $pasiens = Pasien::where('id_kategori', '=', 3)
                ->where('id', 'like', '%'. $request->id . '%')
                ->paginate();
        }
        return view('pasien.index', compact('pasiens'));
    }

    public function exportPasien(){
        ob_end_clean();
        ob_start();
        $pasien = Pasien::get();

        Excel::create('Data Pasien', function ($excel) use($pasien){
            $excel->setTitle('Data Pasien')
                ->setCreator(Auth::user()->email);

            $excel->sheet('Data Pasien', function ($sheet) use($pasien){
                $sheet->setAutoSize(true);
                $row = 1;
                $no = 1;
                $sheet->row($row, [
                    'No',
                    'ID Pasien',
                    'Nama Pasien',
                    'Alamat',
                    'No Telepon',
                    'Umur',
                    'Jenis Kelamin',
                    'Riwayat Alergi',
                    'Kategori Pasien'
                ]);
                foreach ($pasien as $k){
                    $sheet->row(++$row,[
                        $no++,
                        $k->id,
                        $k->nama,
                        $k->alamat,
                        $k->no_telepon,
                        $k->umur,
                        $k->jenis_kelamin,
                        $k->riwayat_alergi,
                        $k->kategoriPasien->nama_kategori
                    ]);
                }
            });
        })->download('xlsx');
        ob_flush();
    }
    public function exportPasienBpjs(){
        ob_end_clean();
        ob_start();
        $pasien = Pasien::where('id_kategori', '=', 2)->get();

        Excel::create('Data Pasien Bpjs', function ($excel) use($pasien){
            $excel->setTitle('Data Pasien Bpjs')
                ->setCreator(Auth::user()->email);

            $excel->sheet('Data Pasien Bpjs', function ($sheet) use($pasien){
                $sheet->setAutoSize(true);
                $row = 1;
                $no = 1;
                $sheet->row($row, [
                    'No',
                    'ID Pasien',
                    'Nama Pasien',
                    'Alamat',
                    'No Telepon',
                    'Umur',
                    'Jenis Kelamin',
                    'Riwayat Alergi',
                    'Kategori Pasien'
                ]);
                foreach ($pasien as $k){
                    $sheet->row(++$row,[
                        $no++,
                        $k->id,
                        $k->nama,
                        $k->alamat,
                        $k->no_telepon,
                        $k->umur,
                        $k->jenis_kelamin,
                        $k->riwayat_alergi,
                        $k->kategoriPasien->nama_kategori
                    ]);
                }
            });
        })->download('xlsx');
        ob_flush();
    }
    public function exportPasienProlanis(){
        ob_end_clean();
        ob_start();
        $pasien = Pasien::where('id_kategori', '=', 4)->get();

        Excel::create('Data Pasien Prolanis', function ($excel) use($pasien){
            $excel->setTitle('Data Pasien Prolanis')
                ->setCreator(Auth::user()->email);

            $excel->sheet('Data Pasien Prolanis', function ($sheet) use($pasien){
                $sheet->setAutoSize(true);
                $row = 1;
                $no = 1;
                $sheet->row($row, [
                    'No',
                    'ID Pasien',
                    'Nama Pasien',
                    'Alamat',
                    'No Telepon',
                    'Umur',
                    'Jenis Kelamin',
                    'Riwayat Alergi',
                    'Kategori Pasien'
                ]);
                foreach ($pasien as $k){
                    $sheet->row(++$row,[
                        $no++,
                        $k->id,
                        $k->nama,
                        $k->alamat,
                        $k->no_telepon,
                        $k->umur,
                        $k->jenis_kelamin,
                        $k->riwayat_alergi,
                        $k->kategoriPasien->nama_kategori
                    ]);
                }
            });
        })->download('xlsx');
        ob_flush();
    }


}
