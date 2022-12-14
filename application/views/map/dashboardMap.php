<!-- document.writeln("<script type='text/javascript' src='https://code.jquery.com/jquery-3.5.1.min.js'></script>"); -->
<script type='module'>
    import * as utils from "<?php echo (base_url()); ?>assets/List.js";

    let test = [];
    let namaPolygon = null;
    let jenisPolygon = null;
    let indexAddAfter = null;
    let mapStatus = true;
    let isEdit = false;
    let isAddAfter = false;
    let polyOnClick;
    let line = null;
    let allowUndo = true;
    let marker = [];
    let mataramCoord = "<?php echo (base_url()); ?>assets/mataram.geojson";
    let isTambah = false;
    let dataPolygon = [];
    let allData = [];
    // let coba3 = Array.from(Array(), () => new Array());
    // coba3[0][0] = "test";

    //api key mapbox
    const apiKey = 'pk.eyJ1IjoiamliYXIzNyIsImEiOiJja2tpcnZvaWYwc3J3MnVxOW84YmV0MDFkIn0.wEvaABwReIIPwPB4fhW1Ow';

    // Define map
    var map = L.map('map').setView([-8.576937757085497, 116.09794658196444], 13);
    // var map1 = L.map('map1').setView([-8.576937757085497, 116.09794658196444], 13);

    //  Create a new map 
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        maxZoom: 18,
        minZoom: 13,
        id: 'mapbox/streets-v11',
        // id: 'mapbox/satellite-v9',
        // id: 'mapbox/light-v10',
        // id: 'mapbox/dark-v10',
        // id: 'mapbox/satellite-streets-v11',
        // id: 'mapbox/navigation-day-v1',
        // id: 'mapbox/navigation-night-v1',
        // id: 'mapbox/outdoors-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: apiKey
    }).addTo(map);

    let coba = null;

    async function getData(url) {
        const response = await fetch(url);

        return response.json();
    }

    function getFetch(data) {
        coba = data;
        console.log(data);
    }
    coba = await getData(mataramCoord);
    console.log(coba);
    // add GeoJSON layer to the map once the file is loaded
    L.geoJson(
        coba, {
            dashArray: 10,
            color: 'yellow',
            // fillOpacity: 0,
            fillColor: 'white'
        }).addTo(map);
    //activate onclick
    onClick();
    //show all polygon
    function showAll(data) {
        let l;
        allowUndo = false;
        l = test.length;
        console.log("polygon = ", l);
        polyOnClick = l;
        if (l == 0) {
            test[polyOnClick] = new utils.Coordinate();
            test[polyOnClick].nama = data.nama;
            test[polyOnClick].id = data.id;
            test[polyOnClick].jenis = data.jenis;

            for (let i = 0; i < data.coordinate.length; i++) {
                test[polyOnClick].input(data.coordinate[i][0], data.coordinate[i][1]);
            }
            showPolygon(test[polyOnClick].cord, test[polyOnClick].polygon, polyOnClick);
        } else {
            if (test[polyOnClick - 1].head == null) {
                test.pop();
            } else {
                test[polyOnClick] = new utils.Coordinate();
                test[polyOnClick].nama = data.nama;
                test[polyOnClick].id = data.id;
                test[polyOnClick].jenis = data.jenis;

                for (let i = 0; i < data.coordinate.length; i++) {
                    test[polyOnClick].input(data.coordinate[i][0], data.coordinate[i][1]);
                }
                showPolygon(test[polyOnClick].cord, test[polyOnClick].polygon, polyOnClick);
            }
        }

    }
    //tambah polygon

    //change map style
    export function mapStyle(id1) {
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            maxZoom: 18,
            minZoom: 13,
            id: 'mapbox/'.concat(id1),
            tileSize: 512,
            zoomOffset: -1,
            accessToken: apiKey
        }).addTo(map);
    }

    //polygon click event
    function polygonOnClick(l) {
        let a = test[l].polygon.on('click', function(e) {

            // line = null;
            console.log("ini polygon ke ", l);
            console.log("id ", test[l].id);
            console.log("nama ", test[l].nama);
            console.log("jenis ", test[l].jenis);

            polyOnClick = l;
        });

    }

    //coordinate
    function onClick() {
        map.on('click', function(e) {
            let cord = e.latlng;
            addMarker(cord);
        });
    }

    //add marker
    function addMarker(latlng) {
        let isNull = null;
        let i = null;
        let content = null;

        if (marker == null) {
            i = 0;
        } else {
            i = marker.length;
        }


        marker[i] = L.marker(
            latlng, {
                index: i,
                id: "is",
                tittle: 'test',
            });
        //add marker
        showMarker(i);
        let l = test.length;
        let hasil;
        let nama;
        let jenis;
        for (let x = 0; x < l; x++) {
            hasil = isMarkerInsidePolygon(marker[i], test[x].polygon);
            if (hasil == true) {
                nama = test[x].nama;
                jenis = test[x].jenis;
                break;
            }
        }
        if (hasil) {
            content =
                `<div class="card text-center">           
                <div class="card-body">            
                    <p class="card-text text-danger"> <b>Lokasi ini berada di kawasan tidak layak permukiman</b></p>
                    <p class="card-text text-danger"> <b>Karena berada di kawasan lindung.</b></p>
                    <p class="card-text text-left"> Nama Kawasan : ` + nama + `</p>
                    <p class="card-text text-left"> Jenis Kawasan : ` + jenis + `</p>  
                </div>
                <div class="card-footer text-muted">
                <button type="button" class="btn btn-danger btn-sm" id="delMarker` + i + `">Hapus Tanda</button>
                </div>
            </div>`;
        } else {
            content =
                `<div class="card text-center">           
                <div class="card-body">            
                    <p class="card-text text-success"> <b>Lokasi ini berada di kawasan layak permukiman.</b></p>               
                </div>
                <div class="card-footer text-muted">
                <button type="button" class="btn btn-danger btn-sm" id="delMarker` + i + `">Hapus Tanda</button>
                </div>
            </div>`;

        }

        marker[i].on('popupopen', function() {
            let link = document.getElementById("delMarker" + i);
            link.addEventListener('click', function(e) {
                hideMarker(i);
            });

        });
        marker[i].on('popupclose', function() {
            console.log('pop up close');
        });
        marker[i].bindPopup(content).openPopup();
        console.log(marker.length);
    };

    //check if marker inside polygon or not
    function isMarkerInsidePolygon(marker, poly) {
        var inside = false;
        var x = marker.getLatLng().lat,
            y = marker.getLatLng().lng;
        for (var ii = 0; ii < poly.getLatLngs().length; ii++) {
            var polyPoints = poly.getLatLngs()[ii];
            for (var i = 0, j = polyPoints.length - 1; i < polyPoints.length; j = i++) {
                var xi = polyPoints[i].lat,
                    yi = polyPoints[i].lng;
                var xj = polyPoints[j].lat,
                    yj = polyPoints[j].lng;

                var intersect = ((yi > y) != (yj > y)) &&
                    (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
                if (intersect) inside = !inside;
            }
        }

        return inside;
    };



    //show marker
    function showMarker(i) {
        map.addLayer(marker[i]);
    }

    //hide marker
    function hideMarker(i) {
        map.removeLayer(marker[i]);
    }


    // Add event listener on keydown

    //add All Marker
    function addAllMarker() {
        for (let i = 0; i < test[polyOnClick].cord.length; i++) {
            addMarker(i, test[polyOnClick].cord[i]);
        }
    }

    //delete all marker
    function delAllMarker() {
        let lengthMarker = marker.length;
        for (let i = 0; i < lengthMarker; i++) {
            hideMarker(i);
            marker[i].off('click');
            map.off('popupopen');
            map.off('popupopen');
        }
        marker = [];
    }

    //add polygon to map
    function showPolygon(cord1, polygon1, index) {
        let polyColor = null;
        let content =
            `<div class="card text-center">           
            <div class="card-body">
                <h5 class="card-title">` + test[index].nama + `</h5>
                <p class="card-text">` + test[index].jenis + `</p>               
            </div>
            <div class="card-footer text-muted">            
            </div>
        </div>`;
        switch (test[index].jenis) {
            case "Kawasan RTH":
                polyColor = 'green';
                break;
            case "Kawasan Sempadan Sungai":
                polyColor = 'blue';
                break;
            case "Kawasan Sempadan Pantai":
                polyColor = 'blue';
                break;
            case "Kawasan Cagar Budaya":
                polyColor = '777480';
                break;
            case "Kawasan Rawan Ancaman Bencana":
                polyColor = 'red';
                break;
            default:
                polyColor = 'black';
                break;
        }
        var tooltip = L.tooltip({
            direction: 'center',
            interactive: true,
            noWrap: true,
            opacity: 0.9
        });
        tooltip.setContent(content);
        let polygon = polygon1;
        if (polygon == null) {
            polygon = L.polygon([
                cord1
            ], {
                color: null,
                fillColor: polyColor,
                fillOpacity: 0.3
            }).addTo(map)
            polygon.bindTooltip(tooltip);
            test[index].polygon = polygon;
            polygonOnClick(index);
            console.log(test[index]);
            console.log("berhasil menampilkan polygon");
        } else {
            polygon.remove();
            polygon = L.polygon([
                cord1
            ], {
                color: null,
                fillColor: polyColor,
                fillOpacity: 0.3
            }).addTo(map)
            polygon.bindTooltip(tooltip);
            polygonOnClick(index);
            console.log("berhasil menampilkan polygon");
        }

    }
    //show all polygon
    function showAllPolygon() {
        let l = test.length;
        if (l > 0) {
            console.log(test);
            for (let i = 0; i < l; i++) {
                test[i].polygon.remove();
                test[i].polygon = null;
                showPolygon(test[i].cord, test[i].polygon, i);
                polygonOnClick(i);
            }
        }
    }

    document.getElementById("satellite-v9").onclick = function() {
        mapStyle('satellite-v9');

    };
    document.getElementById("streets-v11").onclick = function() {
        mapStyle('streets-v11');

    };
    document.getElementById("outdoors-v11").onclick = function() {
        mapStyle('outdoors-v11');

    };


    let d = <?php echo json_encode($d); ?>;
    if (d != null) {
        console.log("banyak data " + d.length);
        for (let i = 0; i < d.length; i++) {
            showAll(d[i]);
        }
    }
</script>