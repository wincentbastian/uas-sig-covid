@extends('layout.app')

@section('title', 'Manajemen Data Pasien')

@section('content')

  <input id="datepicker" type="date" width="276"  max=
  <?php
     echo date('Y-m-d', strtotime(' +1 day'))
  ?>>


<section class="section" style="margin-bottom:25px"></section>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">Create</button>
<section class="section" style="margin-bottom:25px"></section>

<table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">No</th>
        {{-- <th scope="col">Nama</th> --}}
        <th scope="col">Kabupaten</th>
        <th scope="col">Positif</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody  id="dataTanggal">
      @foreach ($pasiens as  $pasien)
        <tr>
          <td>{{ $loop->iteration}}</td>
          {{-- <td>{{ $pasien->nama }}</td> --}}
          <td>{{ $pasien->kabupaten->kabupaten }}</td>
          <td>{{ $pasien->positif }}</td>
          <td>{{ date('d-m-Y', strtotime($pasien->tanggal))}}</td>
          <td>
            <div class="row">
              <div class="col">
               <button type="button"  data-id="{{$pasien->id}}" data-nama="{{  $pasien->nama  }}" data-kabupaten="{{  $pasien->kabupaten_id }}" data-positif="{{  $pasien->positif }}" data-tanggal="{{ $pasien->tanggal  }}" data-toggle="modal" data-target="#edit-modal"> <i class="fa fa-edit" style="color: rgb(86, 86, 231)"></i></button>
              </div>
              <div class="col">
                <button type="button"  data-id="{{ $pasien->id  }}" data-toggle="modal" data-target="#delete-modal"><i class="fa fa-trash" style="color: rgb(224, 66, 66)" ></i></button>
              </div>
            </div>
          </td>
        </tr>
      @endforeach
      <div class="paginate"> {{ $pasiens->links() }}</div>
    </tbody>
  </table>



    <!-- Modal -->
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create New Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {{-- menampilkan error validasi --}}
            @if (count($errors) > 0)
 
            @endif
            
            <form action="{{ route('pasien-store')}}" method="POST">
              @csrf
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
                          <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                      </td>
                    </div> --}}
                  </div>
                </tr>
                <tr>
                  <div class="row">
                    <div class="col-sm">
                      <td>Kabupaten</td>
                    </div>
                    <div class="col-md">
                      <td>
                        <select class="form-control" style="width: 100%;" name="kabupaten" data-value="" tabindex="-1" aria-hidden="true" required>
                          {{-- <option value="" ></option> --}}
                          @foreach ($kabupatens as $kabupaten)
                          <option value={{$kabupaten->id}}>{{$kabupaten->kabupaten}}</option>
                          @endforeach
                        </select>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr>
                  <div class="row">
                    <div class="col-sm">
                      <td>Jumlah Positif</td>
                    </div>
                    <div class="col-md">
                      <td>
                        <div class="form-group">
                          <input type="text" class="form-control" id="positif" name="positif" required>
                        </div>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr>
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
                      <td>Kabupaten</td>
                    </div>
                    <div class="col-md">
                      <td>
                        <select id="kabupaten" class="form-control" style="width: 100%;" name="kabupaten" data-value="" tabindex="-1" aria-hidden="true">
                          <option value="" disabled>Kabupaten</option>
                          @foreach ($kabupatens as $kabupaten)
                          <option value={{$kabupaten->id}}>{{$kabupaten->kabupaten}}</option>
                          @endforeach
                        </select>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr>
                  <div class="row">
                    <div class="col-sm">
                      <td>Jumlah Positif</td>
                    </div>
                    <div class="col-md">
                      <td>
                        <div class="form-group">
                          <input type="text" class="form-control" id="positif" name="positif" required>
                        </div>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr>
                  <div class="row">
                    <div class="col-sm">
                      <td>Tanggal</td>
                    </div>
                    <div class="col-md">
                      <td>
                        <input id="tanggal" type="date" width="300px" name="tanggal" required/>
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

     var pag =  $(".paginate").html
     
      $("#datepicker").change(function() {
        var selectedDate = $('#datepicker').val();
        console.log(selectedDate);

        $.ajax({
                    type:'GET',
                    url:'pasien/'+selectedDate,
                    dataType: 'json',
                    success:function(msg, status, jqXHR){
                      console.log(msg)
                      $('#data').empty()
                      var data = "";

                      const _MS_PER_DAY = 1000 * 60 * 60 * 24;
                      // a and b are javascript Date objects
                      function dateDiffInDays(a, b) {
                        // Discard the time and time-zone information.
                        const utc1 = Date.UTC(a.getFullYear(), a.getMonth(), a.getDate());
                        const utc2 = Date.UTC(b.getFullYear(), b.getMonth(), b.getDate());
                        return Math.floor((utc2 - utc1) / _MS_PER_DAY);
                      }

                        const a = new Date(),
                        b = new Date(msg[0].tanggal),
                        difference = dateDiffInDays(a, b);
                        console.log(difference)// test it
                      
                      if(difference == 1){
                        alert("Sukses mengcopy data H-1 ke H")
                      }

                      i = 1
                      $.each(msg,function(key,value){
                        
                        data +=
                        '<tr>'+
                          '<td>'+ i +'</td>'+
                          // '<td>'+ msg[key].nama +'</td>'+
                          '<td>'+ msg[key].kabupaten +'</td>'+
                          '<td>'+ msg[key].positif +'</td>'+
                          '<td>'+ msg[key].tanggal +'</td>'+
                          '<td>'+
                            '<div class="row">'+
                              '<div class="col">'+
                                '<button type=button data-id='+ msg[key].id+' data-kabupaten='+msg[key].kabupaten_id+' data-positif='+msg[key].positif+'  data-tanggal='+msg[key].tanggal+' data-toggle="modal" data-target="#edit-modal"> <i class="fa fa-edit" style="color: rgb(86, 86, 231)"></i></button>'+
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
  var kabupaten = button.data('kabupaten') 
  var positif = button.data('positif') 
  var tanggal = button.data('tanggal') 
  var modal = $(this)

  console.log(id)
  console.log(kabupaten)
  console.log(positif)
  console.log(tanggal)
  
  modal.find('.modal-body #kabupaten').val(kabupaten)
  modal.find('.modal-body #positif').val(positif)
  modal.find('.modal-body #tanggal').val(tanggal)
  modal.find('.modal-body #edit-form').attr('action', 'pasien/'+id);

})

$('#delete-modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id')
  var modal = $(this)
  console.log(id)
  modal.find('.modal-body #delete-form').attr('action', 'pasien/'+id);

})

</script>

  @endsection
@endsection