<?php

namespace App\Http\Controllers;

use App\Diagnosis;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class DiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diagnoses = Diagnosis::all();

        return view('diagnosis.index', compact('diagnoses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('diagnosis.create');
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
            'diagnosis' => 'required',
            'diagnosisType' => 'required',
        ]);

        $diagnosis = new Diagnosis();
        $diagnosis->fill([
           'name' => $request->diagnosis,
        ]);

        $diagnosis->diagnosisType()->associate($request->diagnosisType);
        $diagnosis->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil Menambah $diagnosis->name"
        ]);

        return redirect()->route('diagnosis.index');
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
        $diagnosis = Diagnosis::find($id);

        return view('diagnosis.edit', compact('diagnosis'));
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
        $diagnosis = Diagnosis::find($id);
        $this->validate($request, [
            'diagnosis' => 'required',
            'diagnosisType' => 'required',
        ]);

        $diagnosis->update([
                'name' => $request->diagnosis,
        ]);
        $diagnosis->diagnosisType()->associate($request->diagnosisType);
        $diagnosis->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil Merubah $diagnosis->name"
        ]);

        return redirect()->route('diagnosis.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Diagnosis::find($id)->delete();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasi Dihapus",
        ]);

        return redirect()->route('diagnosis.index');
    }
}
