<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PasienPerKelurahan;
use DateTime;
use DB;

class PetaSebaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = date("Y-m-d");
        $patients = DB::select("SELECT *, SUM(ppln+ppdn+tl+lainya) AS 'total_positif', 
                                SUM(perawatan+sembuh+meninggal) AS 'total_kondisi' 
                                FROM tb_positif WHERE tanggal = '$date' GROUP BY id");
        

        foreach($patients as $pasien){
            if($pasien->total_positif == 0){
                $pasien->color = '#95FF0A';
            }
            elseif($pasien->total_positif > 0 && $pasien->perawatan == 0 ){
                $pasien->color = '#64991E'; 
            }
            elseif($pasien->tl >= 1  && $pasien->perawatan > 0){
                $pasien->color = '#920218'; 
            }

            elseif($pasien->ppln > 1 || $pasien->ppdn > 1  && $pasien->perawatan > 0){
                $pasien->color = '#E2556B'; 
            }
            
            else{
                $pasien->color = '#E6E708'; 
            }
           
        
            
        }

        $dataKelurahan = array();

        foreach($patients as $p){
            $dataKelurahan[$p->kelurahan][] = $p;
        }

        $total = DB::select("SELECT SUM(ppln+ppdn+tl+lainya) as total from tb_positif WHERE tanggal = '$date'");
        
        $positive = 0;
        foreach($total as $p){
            $positive = $p->total;
        }

        $date = date('d F Y', strtotime($date));

        return view('peta-sebaran',['dataKelurahan'=> $dataKelurahan,'total'=>$positive,'date' => $date]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $date = $request->date;
        $pasiens = DB::select("SELECT *, SUM(ppln+ppdn+tl+lainya) AS 'total_positif', 
                                SUM(perawatan+sembuh+meninggal) AS 'total_kondisi' 
                                FROM tb_positif WHERE tanggal = '$date' GROUP BY id");
        

        foreach($pasiens as $pasien){
            if($pasien->total_positif == 0){
                $pasien->color = '#95FF0A';
            }
            elseif($pasien->total_positif > 0 && $pasien->perawatan == 0 ){
                $pasien->color = '#64991E'; 
            }
            elseif($pasien->ppln == 1 || $pasien->ppdn == 1  && $pasien->perawatan > 0){
                $pasien->color = '#E6E708'; 
            }
            elseif($pasien->ppln > 1 || $pasien->ppdn > 1  && $pasien->perawatan > 0){
                $pasien->color = '#E2556B'; 
            }
            elseif($pasien->tl >= 1  && $pasien->perawatan > 0){
                $pasien->color = '#920218'; 
            }
        }

        $dataKelurahans = array();

        foreach($pasiens as $p){
            $dataKelurahans[$p->kelurahan][] = $p;
        }

        $totals = DB::select("SELECT SUM(ppln+ppdn+tl+lainya) as total from tb_positif WHERE tanggal = '$date'");
        
        $positif = 0;
        foreach($totals as $total){
            $positif = $total->total;
        }

         $tanggal = date('d F Y', strtotime($date));

        return view('peta-sebaran',['dataKelurahan'=> $dataKelurahans,'total'=>$positif,'date' => $tanggal]);

    }

}
