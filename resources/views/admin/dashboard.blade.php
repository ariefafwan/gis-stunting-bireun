@extends('admin.partials.app')
@section('css')
<style>
        #map { 
                  height: 380px; 
                  width: 100%;
              }
         /*Legend specific*/
         .legend {
        padding: 6px 8px;
        font: 14px Arial, Helvetica, sans-serif;
        background: white;
        background: rgba(255, 255, 255, 0.8);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        line-height: 24px;
        color: #555;
        }
        .legend h4 {
        text-align: left;
        font-size: 12px;
        margin: 2px 12px 8px;
        color: #000000;
        }

        .legend span {
        position: relative;
        bottom: 3px;
        }

        .legend i {
        width: 18px;
        height: 18px;
        float: left;
        margin: 0 8px 0 0;
        opacity: 0.7;
        }

        .legend i.icon {
        background-size: 18px;
        background-color: rgba(255, 255, 255, 1);
        }
</style>
@endsection
@section('body')
<section class="section dashboard">
  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <!-- Card -->
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Total Kecamatan Diketahui<span> ({{ $tahun[0]->tahun_min }} s/d {{ $tahun[0]->tahun_max }})</span></h5>
  
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-buildings"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $datakecamatan }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Card -->
        <!-- Card -->
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Total Kasus Pendek <span> ({{ $tahun[0]->tahun_min }} s/d {{ $tahun[0]->tahun_max }})</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-briefcase-fill"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $datakasuspendek[0]->total_kasus_pendek }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Card -->
        <!-- Card -->
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Total Kasus Sangat Pendek <span> ({{ $tahun[0]->tahun_min }} s/d {{ $tahun[0]->tahun_max }})</span></h5>
  
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-briefcase"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $datakasussangatpendek[0]->total_kasus_sangatpendek }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Card -->
      </div>
    </div> 
  </div>
  <h6>Peta Penyebaran</h6>
  <div id="map"></div>
</section>
@endsection
@section('js')
<script>

    let map = L.map('map').setView([5.1870145, 96.709634], 12);
    
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    /*Legend specific*/
    var legend = L.control({ position: "bottomright" });

    legend.onAdd = function(map) {
    var div = L.DomUtil.create("div", "legend");
    div.innerHTML += "<h4>Klaster Penyebaran {{ $tahun[0]->tahun_min }} s/d {{ $tahun[0]->tahun_max }}</h4>";
    div.innerHTML += '<i style="background: #8B0000"></i><span>1-20</span><br>';
    div.innerHTML += '<i style="background: #FF4500"></i><span>21-40</span><br>';
    div.innerHTML += '<i style="background: #FFFF00"></i><span>41-60</span><br>';
    div.innerHTML += '<i style="background: #00FF7F"></i><span>61-80</span><br>';
    div.innerHTML += '<i style="background: #006400"></i><span>81-100</span><br>';

    return div;
    };

    legend.addTo(map);

    // <option class="text-white" style="background-color: #8B0000" value="#8B0000">1-20</option>
    //                     <option class="text-white" style="background-color: #FF4500" value="#FF4500">21-40</option>
    //                     <option style="background-color: #FFFF00" value="#FFFF00">41-60</option>
    //                     <option style="background-color: #00FF7F" value="#00FF7F">61-80</option>
    //                     <option class="text-white" style="background-color: #006400" value="#006400">81-100</option>

  
    <?php foreach ($data as $key => $row) { ?>
        $.getJSON("storage/geojson/{{ $row->kecamatan->geojson }}", function(data) {
          if ({{ $row->total_kasus }} <= 10) {
            var color = "#FFFF00"
          } else if  ({{ $row->total_kasus }} >= 11 ){
            var color = "#00FF7F"
          }
            geoLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    "color": color,
                    "weight": 1,
                    "fillOpacity": 0.8,
                }
            },
        }).addTo(map);
            geoLayer.eachLayer(function(layer) {
                layer.bindPopup("<span>Kec. : {{ $row->kecamatan->nama_kecamatan }}</span><br><span>Total Kasus : {{ $row->total_kasus }}</span>");
            });
        });
    <?php } ?>
    
    
</script>
@endsection
