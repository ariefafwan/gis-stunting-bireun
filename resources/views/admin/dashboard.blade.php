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
  <h6 class="fw-bold">Peta Penyebaran</h6>
  <div class="col-md-2 mb-3">
    <form method="get">
      <div class="form-group">
        <label>Pilih Tahun</label>
        <select id="filterdata" class="form-select tahun" name="">
            @foreach ($pilihtahun as $index)
            <option value="{{ $index->id }}">{{ $index->tahun }}</option>
            @endforeach
        </select>
      </div>
    </form>
  </div>
  <div id="petakasus">
    <div id="map"></div>
  </div>
</section>
@endsection
@section('js')
{{-- <script>
  $.ajax({
            url: '/admin/getdata',
            type: "GET",
            dataType: "JSON",
            success:function(res) {
                console.log(res);
            }
        });
</script> --}}
<script>
  $(document).ready(function() {
    $.ajax({
            url: '/admin/getdata',
            type: "GET",
            dataType: "JSON",
            success:function(res) {

              // res = [...res];
              let map = L.map('map').setView([5.1870145, 96.709634], 10);
              // map.removeLayer(geojson);
    
              layer = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                  maxZoom: 19,
                  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
              });

              layer.addTo(map);

              /*Legend specific*/
              var legend = L.control({ position: "bottomright" });

              legend.onAdd = function(map) {
              var div = L.DomUtil.create("div", "legend");
              div.innerHTML += "<h4>Klaster Penyebaran {{ $tahun[0]->tahun_min }} s/d {{ $tahun[0]->tahun_max }}</h4>";

              <?php foreach ($cluster as $index => $any) { ?>
                  div.innerHTML += '<i style="background: {{ $any->warna }}"></i><span>{{ $any->nama_cluster }} : {{ $any->desk }}</span><br>';
              <?php } ?>

              return div;
              };

              legend.addTo(map);

              let tahun = $('#filterdata').val();
              console.log(tahun);
              res.filter((item) => {
                  // let tes = item.periode_tahun_id.toString()
                  return item.periode_tahun_id.toString().includes(tahun);
                }).map((value, key) => {
                  $.getJSON(value.filegeo, function(data) {
                      geoLayer = L.geoJson(data, {
                        style: function(feature) {
                            return {
                                "color": value.warna,
                                "weight": 1,
                                "fillOpacity": 0.8,
                            }
                        },
                      }).addTo(map);
                      geoLayer.eachLayer(function(layer) {
                              layer.bindPopup(`<span>Kec. : ${value.nama_kecamatan}</span><br><span>Total Kasus : ${value.total_kasus}</span>`);
                          });
                  });
                })
            }
        });
        $('#filterdata').on("change", function() {
          map.remove();
          document.getElementById('petakasus').innerHTML = "<div id='map'></div>";
          $.ajax({
            url: '/admin/getdata',
            type: "GET",
            dataType: "JSON",
            success:function(res) {

              // res = [...res];
              let map = L.map('map').setView([5.1870145, 96.709634], 10);
              // map.removeLayer(geojson);
    
              layer = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                  maxZoom: 19,
                  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
              });

              layer.addTo(map);

              /*Legend specific*/
              var legend = L.control({ position: "bottomright" });

              legend.onAdd = function(map) {
              var div = L.DomUtil.create("div", "legend");
              div.innerHTML += "<h4>Klaster Penyebaran {{ $tahun[0]->tahun_min }} s/d {{ $tahun[0]->tahun_max }}</h4>";

              <?php foreach ($cluster as $index => $any) { ?>
                  div.innerHTML += '<i style="background: {{ $any->warna }}"></i><span>{{ $any->nama_cluster }} : {{ $any->desk }}</span><br>';
              <?php } ?>

              return div;
              };

              legend.addTo(map);

              let tahun = $('#filterdata').val();
              console.log(tahun);
              res.filter((item) => {
                  // let tes = item.periode_tahun_id.toString()
                  return item.periode_tahun_id.toString().includes(tahun);
                }).map((value, key) => {
                  $.getJSON(value.filegeo, function(data) {
                      geoLayer = L.geoJson(data, {
                        style: function(feature) {
                            return {
                                "color": value.warna,
                                "weight": 1,
                                "fillOpacity": 0.8,
                            }
                        },
                      }).addTo(map);
                      geoLayer.eachLayer(function(layer) {
                              layer.bindPopup(`<span>Kec. : ${value.nama_kecamatan}</span><br><span>Total Kasus : ${value.total_kasus}</span>`);
                          });
                  });
                })
            }
        });
        });
  });
</script>
@endsection
