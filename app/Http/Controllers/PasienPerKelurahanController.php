<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PasienPerKelurahan;
use DateTime;
use DB;
use Session;
use App\KabupatenNew;
use App\Kecamatan;
use App\Kelurahan;


class PasienPerKelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tanggal = date("Y-m-d");

        $pasiens = DB::select("SELECT *, SUM(ppln+ppdn+tl+lainya) AS 'total_positif', 
        SUM(perawatan+sembuh+meninggal) AS 'total_kondisi' 
        FROM tb_positif WHERE tanggal = '$tanggal' GROUP BY id");

        $kabupatens = KabupatenNew::get();
        $kecamatans = Kecamatan::get();
        $kelurahans = Kelurahan::get();
        
        return view('admin/pasien-per-kelurahan-view',['pasiens'=>$pasiens,'kabupatens'=>$kabupatens,'kecamatans'=> $kecamatans, 'kelurahans'=>$kelurahans]);
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
        
        $pasien = new PasienPerKelurahan;
        $pasien->kabupaten = $request->kabupaten;
        $pasien->kecamatan = $request->kecamatan;
        $pasien->kelurahan = $request->kelurahan;
        $pasien->level = $request->level;
        $pasien->ppln = $request->ppln;
        $pasien->ppdn = $request->ppdn;
        $pasien->tl = $request->tl;
        $pasien->lainya = $request->lainya;
        $pasien->perawatan = $request->perawatan;
        $pasien->sembuh = $request->sembuh;
        $pasien->meninggal = $request->meninggal;
        $pasien->tanggal = $request->tanggal;
        $pasien->save();

        Session::flash('flash_message_store', 'Data berhasil ditambahkan!');
        return redirect('admin/pasien-per-kelurahan');
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
            $pasiens = DB::table('tb_positif')
            ->select('*')
            ->where('tb_positif.tanggal', $tanggal)
            ->get();
      
            if($pasiens->isEmpty()){
                $yesterday = new DateTime($tanggal);
                $yesterday->modify('-1 day');
                $pasiens = DB::table('tb_positif')
                ->select('*')
                ->where('tb_positif.tanggal', $yesterday)
                ->get();
                
                foreach($pasiens as $pasien){
                    $addPasien = new PasienPerKelurahan;
                    $addPasien->kabupaten = $pasien->kabupaten;
                    $addPasien->kecamatan = $pasien->kecamatan;
                    $addPasien->kelurahan = $pasien->kelurahan;
                    $addPasien->level = $pasien->level;
                    $addPasien->ppln = $pasien->ppln;
                    $addPasien->ppdn = $pasien->ppdn;
                    $addPasien->tl = $pasien->tl;
                    $addPasien->lainya = $pasien->lainya;
                    $addPasien->perawatan = $pasien->perawatan;
                    $addPasien->sembuh = $pasien->sembuh;
                    $addPasien->meninggal = $pasien->meninggal;
                    $addPasien->tanggal = $tanggal;
                    $addPasien->save();
                }
                $pasiens = DB::table('tb_positif')
                ->select("*")
                ->where('tb_positif.tanggal', $yesterday)
                ->get();
                foreach($pasiens as $key=>$p){
                    $p->copy_data = "sukses"; 
                }
                
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
        $pasien = PasienPerKelurahan::findOrFail($id);
        $pasien->update([
            'level' => $request->level,
            'ppln' => $request->ppln,
            'ppdn' => $request->ppdn,
            'tl' => $request->tl,
            'lainya' => $request->lainya,
            'perawatan' => $request->perawatan,
            'sembuh' => $request->sembuh,
            'meninggal' => $request->meninggal,
        ]);
        Session::flash('flash_message_update', 'Data berhasil diupdate!');
        return redirect('admin/pasien-per-kelurahan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pasien = PasienPerKelurahan::where('id',$id)->delete();
        Session::flash('flash_message_delete', 'Data berhasil dihapus!');
        return redirect()->back();
    }

    public function getKecamatan($kabupaten){
        $kabupatenId = KabupatenNew::where('kabupaten','=',$kabupaten)->pluck('id');
        // $kabupatenId = $kabupatenNew['id'];

        $kecamatans = Kecamatan::where('kabupaten_id','=',$kabupatenId)->get();
        return response()->json($kecamatans);
    }

    
    public function getKelurahan($kecamatan){
        $kecamatanId = Kecamatan::where('kecamatan','=',$kecamatan)->pluck('id');
        $kelurahans = Kelurahan::where('kecamatan_id','=',$kecamatanId)->get();
        return response ()->json($kelurahans);
    }
}
