@extends('layout.app')

@section('title', 'Manajemen Data Pasien')

@section('content')

@if(Session::has('flash_message_update'))
    <div class="alert alert-success">
        {{ Session::get('flash_message_update') }}
    </div>
@endif

@if(Session::has('flash_message_delete'))
    <div class="alert alert-success">
        {{ Session::get('flash_message_delete') }}
    </div>
@endif

@if(Session::has('flash_message_store'))
    <div class="alert alert-success">
        {{ Session::get('flash_message_store') }}
    </div>
@endif
<div style="margin-top: 30px;">
  <input id="datepicker" type="date" width="276"  max=
  <?php
     echo date('Y-m-d', strtotime(' +1 day'))
  ?>>
  </div>


<section class="section" style="margin-bottom:25px"></section>

<section class="section" style="margin-bottom:25px"></section>


<table class="table table-bordered" style="font-size: 10px;">
    <thead>
      <tr>
        <th rowspan="2" class="align-middle text-center">No</th>
        <th rowspan="2" class="align-middle text-center">Kabupaten</th>
        <th rowspan="2" class="align-middle text-center">Kecamatan</th>
        <th rowspan="2" class="align-middle text-center">Kelurahan</th>
        <th rowspan="2" class="align-middle text-center">Level</th>
        <th colspan="5" class="text-center text-center">Penyebaran</th>
        <th colspan="4" class="text-center text-center">Kondisi</th>
        <th rowspan="2" class="align-middle text-center">Tanggal</th>
        <th rowspan="2" class="align-middle text-center">Action</th>
      </tr>
      <tr>
        <th scope="col" class="align-middle text-center">PP-LN</th>
        <th scope="col" class="align-middle text-center" >PP-DN</th>
        <th scope="col" class="align-middle text-center" >TL</th>
        <th scope="col" class="align-middle text-center">Lainya</th>
        <th scope="col" class="align-middle text-center">Total</th>
        <th scope="col" class="align-middle text-center" >Perawatan</th>
        <th scope="col" class="align-middle text-center" >Sembuh Covid</th>
        <th scope="col" class="align-middle text-center">Meninggal</th>
        <th scope="col" class="align-middle text-center">Total</th>
      </tr>
    </thead>
    <tbody  id="dataTanggal" class="align-middle text-center">
      @foreach ($pasiens as  $pasien)
      <tr>
        <td>{{ $loop->iteration}}</td>
        {{-- <td>{{ $pasien->nama }}</td> --}}
        <td>{{ $pasien->kabupaten }}</td>
        <td>{{ $pasien->kecamatan}}</td>
        <td>{{ $pasien->kelurahan}}</td>
        <td>{{ $pasien->level}}</td>
        <td>{{ $pasien->ppln}}</td>
        <td>{{ $pasien->ppdn}}</td>
        <td>{{ $pasien->tl}}</td>
        <td>{{ $pasien->lainya}}</td>
        <td>{{ $pasien->total_positif}}</td>
        <td>{{ $pasien->perawatan}}</td>
        <td>{{ $pasien->sembuh}}</td>
        <td>{{ $pasien->meninggal}}</td>
        <td>{{ $pasien->total_kondisi}}</td>
        <td>{{ date('d-m-Y', strtotime($pasien->tanggal))}}</td>
        <td>
          <div class="row">
            <div class="col">
             <button type="button"  data-id="{{$pasien->id}}"  data-level="{{  $pasien->level }}" data-ppln="{{  $pasien->ppln }}" data-ppdn="{{  $pasien->ppdn }}" data-tl="{{  $pasien->tl }}" data-lainya="{{  $pasien->lainya }}" data-perawatan="{{  $pasien->perawatan }}" data-sembuh="{{  $pasien->sembuh }}" data-meninggal="{{$pasien->meninggal}}"  data-toggle="modal" data-target="#edit-modal"> <i class="fa fa-edit" style="color: rgb(86, 86, 231)"></i></button>
            </div>
            <div class="col">
              <button type="button"  data-id="{{ $pasien->id  }}" data-toggle="modal" data-target="#delete-modal"><i class="fa fa-trash" style="color: rgb(224, 66, 66)" ></i></button>
            </div>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
</table>

  <!-- Modal -->
  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{-- menampilkan error validasi --}}
          @if (count($errors) > 0)

          @endif
    
          <form action="{{ route('pasien-per-kelurahan-store')}}" method="POST">
            @csrf
            <table class="table table-bordered">
              <tbody>
              <tr>
                <div class="row">
                  <div class="col-sm">
                    <td>Kabupaten</td>
                  </div>
                  <div class="col-md">
                    <td>
                      <select class="form-control" style="width: 100%;" id="kabupaten" name="kabupaten" data-value="" tabindex="-1" aria-hidden="true" required>
                        <option value="" ></option>
                        @foreach ($kabupatens as $kabupaten)
                        <option value={{$kabupaten->kabupaten}}>{{$kabupaten->kabupaten}}</option>
                        @endforeach
                      </select>
                    </td>
                  </div>
                </div>
              </tr>
              <tr>
                <div class="row">
                  <div class="col-sm">
                    <td>Kecamatan</td>
                  </div>
                  <div class="col-md">
                    <td>
                      <select class="form-control" style="width: 100%;" id="kecamatan" name="kecamatan" data-value="" tabindex="-1" aria-hidden="true" required>
                        <option value="" ></option>
                        {{-- @foreach ($kecamatans as $kecamatan)
                        <option value={{$kecamatan->kecamatan}}>{{$kecamatan->kecamatan}}</option>
                        @endforeach --}}
                      </select>
                    </td>
                  </div>
                </div>
              </tr>
              <tr>
                <div class="row">
                  <div class="col-sm">
                    <td>Kelurahan</td>
                  </div>
                  <div class="col-md">
                    <td>
                      <select class="form-control" style="width: 100%;" id="kelurahan" name="kelurahan" data-value="" tabindex="-1" aria-hidden="true" required>
                        <option value="" ></option>
                        {{-- @foreach ($kelurahans as $kelurahan)
                        <option value={{$kelurahan->kelurahan}}>{{$kelurahan->kelurahan}}</option>
                        @endforeach --}}
                      </select>
                    </td>
                  </div>
                </div>
              </tr>
              <tr>
                <div class="row">
                  <div class="col-sm">
                    <td>Level</td>
                  </div>
                  <div class="col-md">
                    <td>
                      <select id="level" class="form-control" style="width: 100%;" name="level" data-value="" tabindex="-1" aria-hidden="true" required>
                        <option value="" disabled>Level</option>
                        @for ($i = 0; $i <= 5; $i++)          
                           <option value={{$i}}>{{$i}}</option>  
                        @endfor
                      </select>
                    </td>
                  </div>
                </div>
              </tr>
              <tr>
                <div class="row">
                  <div class="col-sm">
                    <td>PPLN</td>
                  </div>
                  <div class="col-md">
                    <td>
                      <div class="form-group">
                        <input type="number" class="form-control" id="ppln" name="ppln" required>
                      </div>
                    </td>
                  </div>
                </div>
              </tr>
              <tr>
                <div class="row">
                  <div class="col-sm">
                    <td>PPDN</td>
                  </div>
                  <div class="col-md">
                    <td>
                      <div class="form-group">
                        <input type="number" class="form-control" id="ppdn" name="ppdn" required>
                      </div>
                    </td>
                  </div>
                </div>
              </tr>
              <tr>
                <div class="row">
                  <div class="col-sm">
                    <td>Transmisi Lokal</td>
                  </div>
                  <div class="col-md">
                    <td>
                      <div class="form-group">
                        <input type="number" class="form-control" id="tl" name="tl" required>
                      </div>
                    </td>
                  </div>
                </div>
              </tr>
              <tr>
                <div class="row">
                  <div class="col-sm">
                    <td>Lainya</td>
                  </div>
                  <div class="col-md">
                    <td>
                      <div class="form-group">
                        <input type="number" class="form-control" id="lainya" name="lainya" required>
                      </div>
                    </td>
                  </div>
                </div>
              </tr>
              <tr>
                <div class="row">
                  <div class="col-sm">
                    <td>Perawatan</td>
                  </div>
                  <div class="col-md">
                    <td>
                      <div class="form-group">
                        <input type="number" class="form-control" id="perawatan" name="perawatan" required>
                      </div>
                    </td>
                  </div>
                </div>
              </tr>
              <tr>
                <div class="row">
                  <div class="col-sm">
                    <td>Sembuh</td>
                  </div>
                  <div class="col-md">
                    <td>
                      <div class="form-group">
                        <input type="number" class="form-control" id="sembuh" name="sembuh" required>
                      </div>
                    </td>
                  </div>
                </div>
              </tr>
              <tr>
                <div class="row">
                  <div class="col-sm">
                    <td>Meninggal</td>
                  </div>
                  <div class="col-md">
                    <td>
                      <div class="form-group">
                        <input type="number" class="form-control" id="meninggal" name="meninggal" required>
                      </div>
                    </td>
                  </div>
                </div>
              </tr>
                <div class="row">
                  <div class="col-sm">
                    <td>Tanggal</td>
                  </div>
                  <div class="col-md">
                    <td>
                      <input type="date" width="300px" name="tanggal" required/>
                    </td>
                  </div>
                </div>
              </tr>
              </tbody>
            </table>
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div>

 

    <!-- Modal -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="edit-form" action="" method="post">
              @csrf
              @method("PUT")
              <table class="table table-bordered">
                <tbody>
                <tr>
                  <div class="row">
                    {{-- <div class="col-sm">
                      <td>Nama</td>
                    </div>
                    <div class="col-md">
                      <td>
                        <div class="form-group">
                          <input type="text" class="form-control" id="nama">
                        </div>
                      </td>
                    </div> --}}
                  </div>
                </tr>
                <tr>
                  <div class="row">
                    <div class="col-sm">
                      <td>Level</td>
                    </div>
                    <div class="col-md">
                      <td>
                        <select id="level" class="form-control" style="width: 100%;" name="level" data-value="" tabindex="-1" aria-hidden="true">
                          <option value="" disabled>Level</option>
                          @for ($i = 0; $i <= 5; $i++)          
                             <option value={{$i}}>{{$i}}</option>  
                          @endfor
                        </select>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr>
                  <div class="row">
                    <div class="col-sm">
                      <td>PPLN</td>
                    </div>
                    <div class="col-md">
                      <td>
                        <div class="form-group">
                          <input type="number" class="form-control" id="ppln" name="ppln" required>
                        </div>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr>
                  <div class="row">
                    <div class="col-sm">
                      <td>PPDN</td>
                    </div>
                    <div class="col-md">
                      <td>
                        <div class="form-group">
                          <input type="number" class="form-control" id="ppdn" name="ppdn" required>
                        </div>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr>
                  <div class="row">
                    <div class="col-sm">
                      <td>Transmisi Lokal</td>
                    </div>
                    <div class="col-md">
                      <td>
                        <div class="form-group">
                          <input type="number" class="form-control" id="tl" name="tl" required>
                        </div>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr>
                  <div class="row">
                    <div class="col-sm">
                      <td>Lainya</td>
                    </div>
                    <div class="col-md">
                      <td>
                        <div class="form-group">
                          <input type="number" class="form-control" id="lainya" name="lainya" required>
                        </div>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr>
                  <div class="row">
                    <div class="col-sm">
                      <td>Perawatan</td>
                    </div>
                    <div class="col-md">
                      <td>
                        <div class="form-group">
                          <input type="number" class="form-control" id="perawatan" name="perawatan" required>
                        </div>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr>
                  <div class="row">
                    <div class="col-sm">
                      <td>Sembuh</td>
                    </div>
                    <div class="col-md">
                      <td>
                        <div class="form-group">
                          <input type="number" class="form-control" id="sembuh" name="sembuh" required>
                        </div>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr>
                  <div class="row">
                    <div class="col-sm">
                      <td>Meninggal</td>
                    </div>
                    <div class="col-md">
                      <td>
                        <div class="form-group">
                          <input type="number" class="form-control" id="meninggal" name="meninggal" required>
                        </div>
                      </td>
                    </div>
                  </div>
                </tr>
                </tbody>
              </table>
          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
        </div>
      </div>
    </div>

  <!-- Modal -->
  <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="delete-form" action="" method="POST">
            @csrf
            @method("DELETE")

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>
  @section('script')
 
  <script>
    $(document).ready(function(){


      $("#datepicker").change(function() {
        var selectedDate = $('#datepicker').val();
        console.log(selectedDate);

        $.ajax({
                    type:'GET',
                    url:'pasien-per-kelurahan/'+selectedDate,
                    dataType: 'json',
                    success:function(msg, status, jqXHR){
                      console.log(msg)
                      $('#data').empty()
                      var data = "";
                      if(msg[0].copy_data){
                        alert("Sukses mengcopy data H-1 ke H")
                      }

                      

                      i = 1
                      $.each(msg,function(key,value){
                        
                        data +=
                        '<tr>'+
                          '<td>'+ i +'</td>'+
                          // '<td>'+ msg[key].nama +'</td>'+
                          '<td>'+ msg[key].kabupaten +'</td>'+
                          '<td>'+ msg[key].kecamatan +'</td>'+
                          '<td>'+ msg[key].kelurahan +'</td>'+
                          '<td>'+ msg[key].level +'</td>'+
                          '<td>'+ msg[key].ppln +'</td>'+
                          '<td>'+ msg[key].ppdn +'</td>'+
                          '<td>'+ msg[key].tl +'</td>'+
                          '<td>'+ msg[key].lainya +'</td>'+
                          '<td>'+ (msg[key].ppln + msg[key].ppdn + msg[key].tl + msg[key].lainya)  +'</td>'+
                          '<td>'+ msg[key].perawatan +'</td>'+
                          '<td>'+ msg[key].sembuh +'</td>'+
                          '<td>'+ msg[key].meninggal +'</td>'+
                          '<td>'+ (msg[key].perawatan + msg[key].sembuh + msg[key].meninggal) +'</td>'+
                          '<td>'+ msg[key].tanggal +'</td>'+
                          '<td>'+
                            '<div class="row">'+
                              '<div class="col">'+
                                '<button type=button data-id='+ msg[key].id+' data-level='+ msg[key].level + ' data-ppln='+ msg[key].ppln +' data-ppdn='+ msg[key].ppdn +' data-tl='+ msg[key].tl+' data-lainya='+msg[key].lainya +' data-perawatan='+msg[key].perawatan+' data-sembuh='+msg[key].sembuh+' data-meninggal='+ msg[key].meninggal+' data-toggle="modal" data-target="#edit-modal"> <i class="fa fa-edit" style="color: rgb(86, 86, 231)"></i></button>'+
                              '</div>'+
                              '<div class="col">'+
                                  '<button type=button data-id='+ msg[key].id +' data-toggle="modal" data-target="#delete-modal"><i class="fa fa-trash" style="color: rgb(224, 66, 66)" ></i></button>'+
                              '</div>'+
                            '</div>'+
                          '</td>'+
                        '</tr>'
                        i++
                      }) 
                      $('#dataTanggal').html(data);
                   
                },
                    error: function (msg, textStatus, errorThrown) {
                        alert(errorThrown);
                    
                },
            });
      });
             
      

    })

    
</script>

<script>
 $('#edit-modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') 
  var level = button.data('level') 
  var ppln = button.data('ppln')
  var ppdn = button.data('ppdn')
  var tl = button.data('tl')
  var lainya = button.data('lainya')
  var perawatan = button.data('perawatan')
  var sembuh = button.data('sembuh')
  var meninggal = button.data('meninggal') 
  console.log(level)
  var modal = $(this)

  // console.log(id)
  // console.log(kabupaten)
  // console.log(positif)
  // console.log(tanggal)
  
  modal.find('.modal-body #level').val(level)
  modal.find('.modal-body #ppln').val(ppln)
  modal.find('.modal-body #ppdn').val(ppdn)
  modal.find('.modal-body #tl').val(tl)
  modal.find('.modal-body #lainya').val(lainya)
  modal.find('.modal-body #perawatan').val(perawatan)
  modal.find('.modal-body #sembuh').val(sembuh)
  modal.find('.modal-body #meninggal').val(meninggal)
  modal.find('.modal-body #edit-form').attr('action', 'pasien-per-kelurahan/'+id);

})

$('#delete-modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id')
  var modal = $(this)
  console.log('id ' + id)
  modal.find('.modal-body #delete-form').attr('action', 'pasien-per-kelurahan/'+id);

})

</script>

<script>
   $(document).ready(function(){
        $('#kabupaten').change(function(){
            var kabupaten = $(this).val()
            console.log(kabupaten)

            // $("#kelurahan")
            //     .prop('disabled', false)

            // $("#area")
            //     .val("")
            //     .prop('disabled', false)


                $.ajax({
                  type:'get',
                  url:'pasien-per-kelurahan/getKecamatan/'+kabupaten,
                  // data:{kabupaten:kabupaten},
                  dataType:'json',
                  success:function(msg, status, jqXHR){
                    console.log(jqXHR)
                    $("#kecamatan")
                    .find('option')
                    .remove()
                    .end()
                    msg.forEach(element => {
                        var name = element.kecamatan
                        $("#kecamatan")
                        .append("<option value='"+name+"'>"+name+"</option>");
                    });
                },
                error: function (msg, textStatus, errorThrown) {
                        alert(errorThrown);
                }
            });
        })
            
        $('#kecamatan').change(function(){
            var kecamatan = $(this).val()
            console.log(kecamatan)

            // $("#kelurahan")
            //     .prop('disabled', false)

            // $("#area")
            //     .val("")
            //     .prop('disabled', false)

        
                
          
            $.ajax({
                  type:'get',
                  url:'pasien-per-kelurahan/getKelurahan/'+kecamatan,
            
                  dataType:'json',
                  success:function(msg, status, jqXHR){
                    console.log(jqXHR)
                    $("#kelurahan")
                    .find('option')
                    .remove()
                    .end()
                    msg.forEach(element => {
                        var name = element.kelurahan
                        $("#kelurahan")
                        .append("<option value='"+name+"'>"+name+"</option>");
                    });
                },
                error: function (msg, textStatus, errorThrown) {
                        alert(errorThrown);
                }
            });
    })
  })


    // jQuery(function ($) {        
    // $('form').bind('submit', function () {
    //     $(this).find(':input').prop('disabled', false);
    // });
    // });

</script>
  @endsection
@endsection