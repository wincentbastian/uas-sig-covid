<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Peta Sebaran COVID-19 Bali</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>

     <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin="">
    </script>

    <!-- Leaflet-KMZ -->
    <script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>

    <style>
      #grad1 {
        height: 40px;
        width: 290px;
        background-image: linear-gradient(to right,#E56500, #E55D06, #E5560C, #E54E12, #E54718, #E5401E,#E53824,#E5312A, #E52A30); /* Standard syntax (must be last) */
      }
      </style>
</head>
<body>
  <div class="pos-f-t">
    <div class="collapse" id="navbarToggleExternalContent">
      <div class="bg-dark p-4">
        <a href="/admin/pasien"><h4 class="text-white">Kelola Data</h4></a>
      </div>
    </div>
    <nav class="navbar navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="nav navbar-nav navbar-right">
        <h4 style="color: cornsilk">Peta Sebaran COVID-19 Provinsi Bali</h4>
      </ul>
    </nav>
  </div>
    <div class="container-fluid">
        <section class="section" style="margin-bottom:15px"></section>
        {{-- <div class="row">
            <div class="col-md-3">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                      <div class="col-md-4">
                        <img src="..." class="card-img" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text"></p>
                          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                      <div class="col-md-4">
                        <img src="..." class="card-img" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text"></p>
                          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                      <div class="col-md-4">
                        <img src="..." class="card-img" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text"></p>
                          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                      <div class="col-md-4">
                        <img src="..." class="card-img" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text"></p>
                          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div> --}}

        <section class="section" style="margin-bottom:15px"></section>

        <div class="row">
            <div class="col-sm-3">
              <div class="row ml-4">
                <div class="card border-primary mb-3" style="width: 18rem">
                  <div class="card-header">Pilih Berdasarkan</div>
                  <div class="card-body text-primary">
                    <form action="{{ route('search') }}" method="get">
                      @csrf
                      <div class="row">
                        <div class="col-9">
                          <div class="form-group">
                            <label class="col-sm control-label">Tanggal</label>
                            <div class="col-sm">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="date" class="form-control" id="tanggal" placeholder="Tanggal" name="tanggal" max=
                                    <?php
                                        echo date('Y-m-d');
                                    ?>>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col mt-4">
                          <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#create">Cari</button>
                        </div>
                      </div>
                     </form>
                  </div>
                </div>
              </div>
              <div class="row ml-4">
                <div>
                  Rentang Gradasi
                  <div id="grad1">
                  </div>
                  <section class="section" style="margin-bottom:15px"></section>
                  <div >
                    <table class="table table-dark" style="width: 18rem";>
                      <thead>
                        <tr>
                          <th scope="col">Keterangan</th>
                          <th scope="col">WNA</th>
                          <th scope="col">Kabupaten Lain</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Positif</td>
                          <td id="wna"></td>
                          <td id="lain"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div> 
                </div>
              </div>
              <div class="row ml-4">
                <div class="card" style="width: 18rem;">
                  <div class="card-header">
                    Total Positif
                  </div>
                  <ul class="list-group list-group-flush">
                    <h5 class="list-group-item">{{ $total }} Orang</h5>
                  </ul>
                </div>
              </div>
            </div>

            

            <div class="col">
                <div class="card border-primary mb-3 mt-4" >
                    <div class="card-header">Peta Sebaran - {{ $tanggal }}</div>
                    <div class="card-body">
                        <div id="map" style="height: 500px; width: 100%; position: relative;"></div>  
                    </div>
                </div>
            </div>
        </div> 
        
    </div>
      
<script>
  
    var map = L.map('map',{fullscreenContril:true});
    map.setView(new L.LatLng(-8.6540914, 115.1767269), 9);
  
    var mymap = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a> | Made Hari Kesuma Arta-170551066',
        maxZoom: 30,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        opacity: 0.90,
        accessToken: 'pk.eyJ1IjoiaGFyaWtlc3VtYSIsImEiOiJjazZxMmNibnExcWluM2RvNzhndGx0YjRzIn0.cEyjePogDTkNTbiMnugU6Q'
        }).addTo(map);
 
    var dataKabupatens = {!! json_encode($dataKabupatens) !!}   
    
    if(dataKabupatens["WNA"] != undefined){
      $('#wna').html(dataKabupatens["WNA"][0].positif);
      console.log(dataKabupatens["WNA"][0].positif)
    }
    else{
      $('#wna').html(0);
    }

    if(dataKabupatens["Kabupaten lain"] != undefined){
      $('#lain').html(dataKabupatens["Kabupaten lain"][0].positif);
      console.log(dataKabupatens["Kabupaten lain"][0].positif)
    }
    else{
        $('#lain').html(0);
    }


    // Instantiate KMZ parser (async)
    var kmzParser = new L.KMZParser({
            onKMZLoaded: function(layer, name) {
            control.addOverlay(layer,name)
            
	      	  var layers = layer.getLayers()[0].getLayers();
		      	layers.forEach(function(layer, index){

                    var kabupaten  = layer.feature.properties.NAME_2;
                    if(dataKabupatens[kabupaten] !== undefined){
                      console.log(dataKabupatens[kabupaten][0].kabupaten)
                      if(dataKabupatens[kabupaten][0].positif == 0){
                      
                      }
                      else{
                        layer.setStyle({fillOpacity:'0.9',fillColor:dataKabupatens[kabupaten][0].color,color:'#E6EDEF',weight:1,opacity:1});
                      }
                        layer.addTo(map);
                        layer.bindPopup(
                          '<table class="table table-striped table-dark">'+
                            '<tbody>'+
                              '<thead>'+
                                '<tr>'+
                                  '<th scope="col">Keterangan</th>'+
                                  '<th scope="col">'+ dataKabupatens[kabupaten][0].kabupaten +'</th>'+
                                '</tr>'+
                              '</thead>'+
                              '<tr>'+
                                '<td>Positif</td>'+
                                '<td>'+ "<b>"+ dataKabupatens[kabupaten][0].positif+ "<b>" +'</td>'+
                              '</tr>'+
                              '</table>'
                          );
                    }
                      
                })
                
            },
                interactive: false, // Disable default "leaflet.js" mouse layer interactions.
                pointable: true,    // Enable optimized "geojson-vt.js" mouse layer interactions.
            });
    // Add remote KMZ files as layers (NB if they are 3rd-party servers, they MUST have CORS enabled)
    kmzParser.load('/kmz/bali-kabupaten.kmz',{ interactive: true }); 
    
    
    const control = L.control
        .layers(null, null, { collapsed: false })
        .addTo(map);

</script>

</body>
</html>