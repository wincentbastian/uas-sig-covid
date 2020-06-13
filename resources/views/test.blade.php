<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

  
    <style> html, body, #map { height: 100%; width: 100%; padding: 0; margin: 0; } </style>
    <!-- Leaflet (JS/CSS) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>
    <!-- Leaflet-KMZ -->
    <script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>

</head>
<body>
    <div id="map"></div>

    <script>
        var map = L.map('map', {fullscreenContril:true});
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
      
        // Instantiate KMZ parser (async)
        var kmzParser = new L.KMZParser({
          onKMZLoaded: function(layer, name) {
            control.addOverlay(layer, name);
            var layers = layer.getLayers()[0].getLayers();
            layers.forEach(function(layer,index){
                var lokasi = [];
                var kabupaten  = layer.feature.properties.NAME_2;
                var kecamatan  = layer.feature.properties.NAME_3;
                var kelurahan  = layer.feature.properties.NAME_4;
                lokasi.push(kabupaten,kecamatan,kelurahan)
                console.log(lokasi)
                layer.bindPopup(kelurahan)
        
            })
            layer.addTo(map);
            console.log(layers)
            
          }
        });
        // Add remote KMZ files as layers (NB if they are 3rd-party servers, they MUST have CORS enabled)
        kmzParser.load('/kmz/bali-kelurahan.kmz');
      
        var control = L.control.layers(null, null, { collapsed:false }).addTo(map);
      </script>
</body>
</html>