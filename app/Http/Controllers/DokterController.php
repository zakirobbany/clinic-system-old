<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Dokter;
use App\Kpi;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dokters = Dokter::get();
        return view('admin.dokter.index', compact('dokters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dokter.create');
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
            'spesialis_id' => 'required',
            'email' => 'required|email|unique:dokters'
        ]);
        $data = $request->all();
        $user = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $data['user_id'] = $user->id;
        $dokter = Dokter::create($data);
        $dokterRole = Role::where('name', 'dokter')->first();
        $user->attachRole($dokterRole);
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "berhasil menyimpan $dokter->name"
        ]);
        return redirect()->route('dokter.index');
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
        $absensi = Absensi::where('dokter_id', '=', $id)->whereMonth('created_at', '=', $cm)->count();
        $bobotAbsensi = Kpi::where('kpi', '=', 'absensi')->first();
        $minAbsensi = $bobotAbsensi->bobot;

        $absensiPercentage = ($absensi / $days) * 100;

        $absensiStatus = '';
        if ($absensiPercentage >= $minAbsensi)
            $absensiStatus = 'bg-green';
        elseif ($absensiPercentage < $minAbsensi)
            $absensiStatus = 'bg-red';

        $dokter = Dokter::findOrFail($id);
        return view('admin.dokter.show', compact('dokter', 'absensiPercentage', 'absensiStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        return view('admin.dokter.edit', compact('dokter'));
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
        $dokter = Dokter::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'display_name'=>'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'spesialis_id'=> 'required',
            'no_telepon' => 'required|digits:12'
        ]);

        $dokter->update($request->all());
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "berhasil merubah $dokter->name"
        ]);
        return redirect()->route('dokter.index');
    }
    public function dokterUpdate(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'display_name'=>'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'no_telepon' => 'required|digits:12'
        ]);

        $dokter->update($request->all());
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "berhasil merubah $dokter->name"
        ]);
        return redirect()->route('dokter-dokter.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Dokter::find($id)->delete();
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Dokter berhasil dihapus"
        ]);
        return redirect()->route('dokter.index');
    }
}
