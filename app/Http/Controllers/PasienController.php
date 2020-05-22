<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pasien;
use App\Kabupaten;
use DateTime;
use DB;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasiens = Pasien::orderBy('id','DESC')->paginate(10);
        $kabupatens = Kabupaten::get();
        return view('admin/pasien-view',['pasiens'=>$pasiens,'kabupatens'=>$kabupatens]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pasien = new Pasien;
        //    $pasien->nama = $request->nama;
           $pasien->kabupaten_id = $request->kabupaten;
           $pasien->positif = $request->positif;
           $pasien->tanggal = $request->tanggal;
           $pasien->save();
           return redirect('admin/pasien');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tanggal)
    {
        try{
            $pasiens = DB::table('tb_pasien')
            ->select('tb_pasien.id','kabupaten_id','positif','tanggal','kabupaten')
            ->join('tb_kabupaten', 'tb_pasien.kabupaten_id', '=', 'tb_kabupaten.id')
            ->where('tb_pasien.tanggal', $tanggal)
            ->orderBy('id', 'DESC')
            ->get();

            if($pasiens->isEmpty()){
                $yesterday = new DateTime($tanggal);
                $yesterday->modify('-1 day');
                $pasiens = DB::table('tb_pasien')
                            ->select('tb_pasien.id','kabupaten_id','positif','tanggal','kabupaten')
                            ->join('tb_kabupaten', 'tb_pasien.kabupaten_id', '=', 'tb_kabupaten.id')
                            ->where('tb_pasien.tanggal', $yesterday)
                            ->get();
                
                foreach($pasiens as $pasien){
                    $addPasien = new Pasien;
                    $addPasien->kabupaten_id = $pasien->kabupaten_id;
                    $addPasien->positif = $pasien->positif;
                    $addPasien->tanggal = $tanggal;
                    $addPasien->save();
                }
                $pasiens = DB::table('tb_pasien')
                                ->select('tb_pasien.id','kabupaten_id','positif','tanggal','kabupaten')
                                ->join('tb_kabupaten', 'tb_pasien.kabupaten_id', '=', 'tb_kabupaten.id')
                                ->where('tb_pasien.tanggal', $tanggal)
                                ->orderBy('id', 'DESC')
                                ->get();
                return response()->json($pasiens);
            }
            return response()->json($pasiens);
        }catch(\Exception $e){
            return response ()->json($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $pasien->update([
            'kabupaten_id' => $request->kabupaten,
            'positif' => $request->positif,
            'tanggal' => $request->tanggal
        ]);
        return redirect('admin/pasien');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pasien = Pasien::where('id',$id)->delete();
        return redirect('admin/pasien');
    }
}
