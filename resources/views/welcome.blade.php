<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Freelancer - Start Bootstrap Theme</title>
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('assets/css/landing.css') }}" rel="stylesheet">
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
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top">Gis Stunting Bireun</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#portfolio">Peta Penyebaran</a></li>
                        @if (Route::has('login'))
                        @auth
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/home') }}">Dashboard</a></li>
                        @else
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ route('login') }}">Login</a></li>                        
                        @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Portfolio Section-->
        <section class="page-section portfolio mt-8" id="portfolio">
            <div class="container">
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
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer text-center">
            <div class="container">
                <div class="row">
                    <!-- Footer Social Icons-->
                    <div class="col-lg-12 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Our Sosial Media</h4>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-dribbble"></i></a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright &copy; Your Website 2023</small></div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        <script>
            $(document).ready(function() {
                $.ajax({
                        url: '/user/getdata',
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
                        url: '/user/getdata',
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
    </body>
</html>
            