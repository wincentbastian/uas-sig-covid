<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kabupaten;
use DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tanggal = date("Y-m-d");
        $dataKabupaten = DB::select("SELECT kabupaten, positif FROM tb_pasien 
        INNER JOIN tb_kabupaten ON tb_pasien.`kabupaten_id` = tb_kabupaten.`id`
        where tanggal = '$tanggal'
        GROUP BY kabupaten ORDER BY positif ASC" );
        
        $gradientColor = ['#E5A700','#E39A01','#E5A700','#E39A01','#E28D02','#E18103','#E07405','#DE6706','#DD5B07','#DC4E08','#DB420A'];
        
        $gradientColor = ['#FFC4A3', '#FCAE91','#FFC4A3', '#FCAE91','#F9987F', '#F6826D', '#F36C5B', '#F05649', '#ED4037', '#EA2A25', '#E71414'];
       
        foreach($dataKabupaten as $key=>$p){
            if($p->kabupaten != "WNA" && $p->kabupaten != "Kabupaten lain" ){
                $p->color = $gradientColor[$key];
            }
        }

        $total = 0;
        foreach($dataKabupaten as $p){
            $total += $p->positif;
        }

        $dataKabupatens = array();

        foreach($dataKabupaten as $p){
            $dataKabupatens[$p->kabupaten][] = $p;
        }

        $tanggal = date('d F Y');
        

        
        
 
        return view('index', ['total'=>$total,'tanggal' => $tanggal, 'dataKabupatens' => $dataKabupatens]); 
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
        $tanggal = $request->tanggal;
        
        $dataKabupaten = DB::select("SELECT kabupaten, positif FROM tb_pasien 
        INNER JOIN tb_kabupaten ON tb_pasien.`kabupaten_id` = tb_kabupaten.`id`
        where tanggal = '$tanggal'
        GROUP BY kabupaten ORDER BY positif ASC");
        
        $gradientColor = ['#E56500', '#E55D06','#E56500', '#E55D06', '#E5560C', '#E54E12', '#E54718', '#E5401E', '#E53824', '#E5312A', '#E52A30'];
        $gradientColor = ['#FFC4A3', '#FCAE91','#FFC4A3', '#FCAE91','#F9987F', '#F6826D', '#F36C5B', '#F05649', '#ED4037', '#EA2A25', '#E71414'];
        foreach($dataKabupaten as $key=>$p){
            if($p->kabupaten != "WNA" && $p->kabupaten != "Kabupaten lain" ){
                $p->color = $gradientColor[$key];
            }
        }

        $total = 0;
        foreach($dataKabupaten as $p){
            $total += $p->positif;
        }

        $dataKabupatens = array();

        foreach($dataKabupaten as $p){
            $dataKabupatens[$p->kabupaten][] = $p;
        }

        $tanggal = date('d F Y', strtotime($tanggal));


        return view('index', ['total'=>$total, 'tanggal' => $tanggal,'dataKabupatens' => $dataKabupatens]);  
    }

    
    public function gradient(Request $request) {
        $start = $request->start;
        $end = $request->end;
        $HexFrom = substr($start, 1);  
        $HexTo = substr($end, 1);  
        $ColorSteps = 10;

        $FromRGB['r'] = hexdec(substr($HexFrom, 0, 2));
        $FromRGB['g'] = hexdec(substr($HexFrom, 2, 2));
        $FromRGB['b'] = hexdec(substr($HexFrom, 4, 2));
      
        $ToRGB['r'] = hexdec(substr($HexTo, 0, 2));
        $ToRGB['g'] = hexdec(substr($HexTo, 2, 2));
        $ToRGB['b'] = hexdec(substr($HexTo, 4, 2));
      
        $StepRGB['r'] = ($FromRGB['r'] - $ToRGB['r']) / ($ColorSteps - 1);
        $StepRGB['g'] = ($FromRGB['g'] - $ToRGB['g']) / ($ColorSteps - 1);
        $StepRGB['b'] = ($FromRGB['b'] - $ToRGB['b']) / ($ColorSteps - 1);
      
        $GradientColors = array();
      
        for($i = 0; $i <= $ColorSteps; $i++) {
          $RGB['r'] = floor($FromRGB['r'] - ($StepRGB['r'] * $i));
          $RGB['g'] = floor($FromRGB['g'] - ($StepRGB['g'] * $i));
          $RGB['b'] = floor($FromRGB['b'] - ($StepRGB['b'] * $i));
      
          $HexRGB['r'] = sprintf('%02x', ($RGB['r']));
          $HexRGB['g'] = sprintf('%02x', ($RGB['g']));
          $HexRGB['b'] = sprintf('%02x', ($RGB['b']));
      
          $GradientColors[] = implode(NULL, $HexRGB);
        }
        $GradientColors = array_filter($GradientColors, array($this,"leng"));
        return response ()->json($GradientColors);
      }
      
      public function leng ($val){
        return (strlen($val) == 6 ? true : false );
      }
}
