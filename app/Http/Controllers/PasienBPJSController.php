<?php

namespace App\Http\Controllers;

use App\Pasien;
use App\PasienPoli;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class PasienBPJSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pasiens = Pasien::where('id_kategori', '=', 2)->paginate();
        if ($request->has('nama') && !$request->has('id')) {
            $pasiens = Pasien::where('id_kategori', '=', 2)
                ->where('nama', 'like', '%' . $request->nama . '%')
                ->paginate();
        }

        if ($request->has('nama') && $request->has('id')){
            $pasiens = Pasien::where([
                ['id_kategori', '=', 2],
                ['id', 'like', '%'. $request->id .'%'],
                ['nama', 'like', '%'. $request->nama .'%'],
            ])
                ->paginate();
        }

        if ($request->has('id') && !$request->has('nama')){
            $pasiens = Pasien::where('id_kategori', '=', 2)
                ->where('id', 'like', '%'. $request->id . '%')
                ->paginate();
        }
        $pasiens->appends($request->all());
        return view('pasienbpjs.index', compact('pasiens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pasienbpjs.create');
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
        ]);
        $data = $request->all();
        $pasien = Pasien::create($data);
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menyimpan $pasien->nama"
        ]);
        return redirect()->route('pasienbpjs.index');
    }
    public function perawatStore(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|unique:pasiens,id',
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
        ]);
        $data = $request->all();
        $data['id_kategori'] = 2;
        $pasien = Pasien::create($data);
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menyimpan $pasien->nama"
        ]);
        return redirect()->route('perawat-pasienbpjs.index');
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
        return view('pasienbpjs.show', compact('pasien', 'rmHistorys', 'rHistorys'));
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
        return view('pasienbpjs.edit', compact('pasien'));
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
        ]);
        $pasien->update($request->all());
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "berhasil merubah $pasien->nama"
        ]);
        return redirect()->route('pasienbpjs.index');
    }

    public function perawatUpdate(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);
        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
        ]);
        $pasien->update($request->all());
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "berhasil merubah $pasien->nama"
        ]);
        return redirect()->route('perawat-pasienbpjs.index');
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
        return redirect()->route('pasienbpjs.index');
    }
    public function perawatDestroy($id)
    {
        Pasien::find($id)->delete();
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Pasien berhasil dihapus"
        ]);
        return redirect()->route('perawat-pasienbpjs.index');
    }
}
