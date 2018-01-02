<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Kpi;
use App\Registrasi;
use App\User;
use App\Role;
use Carbon\Carbon;
use Session;
use Illuminate\Http\Request;

use App\Http\Requests;

class RegistrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registrasis = Registrasi::get();
        return view('admin.registrasi.index', compact('registrasis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.registrasi.create');
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
            'name' => 'required',
            'display_name'=>'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'no_telepon' => 'required|digits:12',
            'email' => 'required|email|unique:registrasis'
        ]);
        $data = $request->all();
        $user = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $data['user_id'] = $user->id;
        $registrasi = Registrasi::create($data);
        $registrasiRole = Role::where('name', 'registrasi')->first();
        $user->attachRole($registrasiRole);
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "berhasil menyimpan $registrasi->name"
        ]);
        return redirect()->route('registrasi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $n = Carbon::now();
        $cm = $n->month;
        $days = $n->daysInMonth;
        $absensi = Absensi::where('registrasi_id', '=', $id)->whereMonth('created_at', '=', $cm)->count();
        $bobotAbsensi = Kpi::where('kpi', '=', 'absensi')->first();
        $minAbsensi = $bobotAbsensi->bobot;

        $absensiPercentage = ($absensi / $days) * 100;

        $absensiStatus = '';
        if ($absensiPercentage >= $minAbsensi)
            $absensiStatus = 'bg-green';
        elseif ($absensiPercentage < $minAbsensi)
            $absensiStatus = 'bg-red';
        $perawat = Registrasi::findOrFail($id);
        return view('admin.registrasi.show', compact('perawat', 'absensiStatus', 'absensiPercentage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registrasi = Registrasi::findOrFail($id);
        return view('admin.registrasi.edit', compact('registrasi'));
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
        return redirect()->route('registrasi.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Registrasi::find($id)->delete();
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "User berhasil dihapus"
        ]);
        return redirect()->route('registrasi.index');
    }
}
