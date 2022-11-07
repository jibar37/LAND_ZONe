<!-- document.writeln("<script type='text/javascript' src='https://code.jquery.com/jquery-3.5.1.min.js'></script>"); -->
<script type='module'>
    import * as utils from "<?php echo (base_url()); ?>assets/List.js";

    let test = [];
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
            color: 'red',
            // fillOpacity: 0,
            fillColor: 'white'
        }).addTo(map);

    //show all polygon
    function showAll(data) {
        let l;
        allowUndo = false;
        if (line == null) {
            polyline();
            showPolyline();
        }
        if (marker != 0) {
            let markerLength = marker.length;
            for (let i = 0; i < markerLength; i++) {
                hideMarker(i);
                marker[i].off('click');
                map.off('popupopen');
            }
            marker = [];
        }
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
                makeLine(i);
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
                    makeLine(i);
                }
                showPolygon(test[polyOnClick].cord, test[polyOnClick].polygon, polyOnClick);
            }
        }

        hidePolyline();
        // line = null;
        map.off('click');
        mapStatus = false;
        polygonOnClick(polyOnClick);
        allowUndo = false;

    }
    //tambah polygon
    export function tambah() {
        let l;
        allowUndo = true;
        if (marker != 0) {
            let markerLength = marker.length;
            for (let i = 0; i < markerLength; i++) {
                hideMarker(i);
                marker[i].off('click');
                map.off('popupopen');
            }
            marker = [];
        }
        l = test.length;
        polyOnClick = l;
        let lastId = null
        if (test[0] != null) {
            lastId = parseInt(test[l - 1].id);
        } else {
            lastId = -1;
        }

        if (l == 0) {
            test[polyOnClick] = new utils.Coordinate();
            test[polyOnClick].nama = "data.nama";
            test[polyOnClick].id = lastId + 1;
            test[polyOnClick].jenis = "data.jenis";
        } else {
            if (test[polyOnClick - 1].head == null) {
                test.pop();
            } else {
                test[polyOnClick] = new utils.Coordinate();
                test[polyOnClick].nama = "data.nama";
                test[polyOnClick].id = lastId + 1;
                test[polyOnClick].jenis = "data.jenis";
            }
        }
        console.log(polyOnClick);
        if (line != null) {
            hidePolyline();
        }
        line = null;

        if (!mapStatus || polyOnClick == 0) {
            onClick();
            mapStatus = true;
            isEdit = false;
        }


    }

    //edit polygon
    export function edit() {
        map.panTo([test[polyOnClick].cord[0][0], test[polyOnClick].cord[0][1]]);
        isEdit = !isEdit;
        allowUndo = true;
        if (isEdit) {
            showPolyline();
            onClick();
            console.log('edit true');
        }


        if (!isEdit) {
            hidePolyline();
            // line = null;
            map.off('click');
            mapStatus = false;
            polygonOnClick(polyOnClick);
            allowUndo = false;
        }
        console.log('edit');
    }

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
        let a = test[l].polygon.on('click', function() {
            if (line != null) {
                hidePolyline();
                let index = test[l].cord.length - 1;
                if (!isAddAfter) {
                    map.off('mousemove');
                    makeLine(l);
                }
            }
            // line = null;
            console.log("ini polygon ke ", l);
            console.log("id ", test[l].id);
            console.log("nama ", test[l].nama);
            console.log("jenis ", test[l].jenis);

            if (marker != 0) {
                for (let i = 0; i < marker.length; i++) {
                    hideMarker(i);
                }
                marker = [];

            }
            map.off('click');
            for (let i = 0; i < test[l].cord.length; i++) {
                addMarker(i, test[l].cord[i]);
            }

            mapStatus = false;
            console.log('is null');
            console.log(a);
            polyOnClick = l;
            allowUndo = false;

        });

    }
    //help line polyline
    function makeLine(i) {
        map.on('mousemove', function(e) {

            // polyline(1, e.latlng);
            // showPolyline();
            // console.log(i);
            let index = test[polyOnClick].cord.length - 1;
            if (line != null) {
                // garis.setLatLngs([-8.53161227416715, 116.09558080792861], e.latlng);
                // while (x == 1) {
                if (isAddAfter) {
                    if (i == index) {
                        line.setLatLngs([test[polyOnClick].cord[0], e.latlng, test[polyOnClick].cord[index]]);
                    } else {
                        line.setLatLngs([test[polyOnClick].cord[i], e.latlng, test[polyOnClick].cord[i + 1]]);
                    }
                } else {
                    line.setLatLngs([test[polyOnClick].cord[0], e.latlng, test[polyOnClick].cord[index]]);
                }
                // }
                //map.off('mouseover');
                //makeLine();
            }


        })
    }


    //coordinate
    function onClick() {
        map.on('click', function(e) {
            let cord;
            let lat;
            let long;
            let head;
            let index;
            if (test.length != 0) {
                cord = e.latlng;
                lat = cord.lat;
                long = cord.lng;
                head;
                console.log("You clicked the map at latitude: " + lat + " and longitude: " + long);
                if (isAddAfter) {
                    test[polyOnClick].addAfter(indexAddAfter, [lat, long]);
                    console.log(indexAddAfter)
                    console.log(test[polyOnClick].cord);
                    delAllMarker();
                    addAllMarker(polyOnClick);
                    hidePolyline();
                    map.off('mouse');
                    mapStatus = false;
                    //polygonOnClick(polyOnClick);
                    map.off('click');
                    isAddAfter = false;
                } else {
                    test[polyOnClick].input(lat, long);
                    index = test[polyOnClick].cord.length - 1;
                    if (!isTambah) {
                        addMarker(index, [lat, long]);
                    }
                }

                head = test[polyOnClick].head;
                console.log(head.lat);
                console.log(test[polyOnClick].cord[0]);
                let latlng1 = [lat, long];
                console.log(test[polyOnClick].cord);

                showPolygon(test[polyOnClick].cord, test[polyOnClick].polygon, polyOnClick);
                if (line == null) {
                    polyline();
                    showPolyline();
                }
                makeLine(indexAddAfter);

                if (!isEdit) {
                    // polygonOnClick(polyOnClick);
                }
            }

        });
    }
    ///
    // marker[0] = L.marker(
    //     [
    //         -8.548419798171379,
    //         116.14352319794597
    //     ]
    //     , {
    //         // clickable: 'true',
    //         draggable: true
    //     }).addTo(map);
    // marker[0].on('drag', function (event) {
    //     // let marker0 = event.target;
    //     // var position = marker0.getLatLng();
    //     // marker[0].setLatLng(new L.LatLng(position.lat, position.lng), { draggable: 'true' });
    //     // map.panTo(new L.LatLng(position.lat, position.lng));
    // });
    // marker[0] = L.marker(
    //     [
    //         -8.548419798171379,
    //         116.14352319794597
    //     ], {
    //     draggable: true
    // }
    // ).addTo(map);
    // map.on('click',
    //     function mapClickListen(e) {
    //         var pos = e.latlng;
    //         console.log('map click event');
    //         var marker = L.marker(
    //             pos, {
    //             draggable: true
    //         }
    //         );
    // marker.on('drag', function (e) {
    //     console.log('marker drag event');
    // });
    // marker.on('dragstart', function (e) {
    //     console.log('marker dragstart event');
    //     map.off('click', mapClickListen);
    // });
    // marker.on('dragend', function (e) {
    //     console.log('marker dragend event');
    //     setTimeout(function () {
    //         map.on('click', mapClickListen);
    //     }, 10);
    // });
    // marker.addTo(map);
    //     }
    // );
    //add marker
    function addMarker(i, latlng) {
        let isNull = null;
        isNull = marker[i];
        if (isNull == null) {
            marker[i] = L.marker(
                latlng, {
                    index: i,
                    id: "is",
                    tittle: 'test',
                    clickable: true,
                    draggable: true
                });
            let template = `
        <label id="edit" class="btn btn-primary">
            <input class="popUp" type="radio" name="options" id=` + i + "addAfter" + `  autocomplete="off" ' > ADD AFTER
        </label>
         </br>
        <label id="edit" class="btn btn-primary">
			<input class="popUp" type="radio" name="options" id=` + i + `  autocomplete="off" '> REMOVE
		</label>
    `

            marker[i].bindPopup(template);
        }

        //add marker
        marker[i].on('drag', function(event) {
            console.log("drag berhasil");
            let marker0 = event.target;
            let position = marker0.getLatLng();
            marker[i].setLatLng(new L.LatLng(position.lat, position.lng), {
                draggable: 'true'
            });
            //map.panTo(new L.LatLng(position.lat, position.lng));
            test[polyOnClick].update(i, position.lat, position.lng);
            showPolygon(test[polyOnClick].cord, test[polyOnClick].polygon, polyOnClick);
            polygonOnClick(polyOnClick);

        });
        showMarker(i);
        let link;

        marker[i].on('popupopen', function() {
            console.log('berhasil ' + polyOnClick + " dan " + i);
            line = null;
            link = document.getElementById(i + "addAfter");
            link.addEventListener('click', e => {
                addAfter(i),
                    marker[i].closePopup()
            });
            console.log('empty');
            link = document.getElementById(i)
            link.addEventListener('click', function(e) {
                hapus(i);
            });

        });
        marker[i].on('popupclose', function() {
            console.log('pop up close');
        });
    }

    //add after
    function addAfter(index) {
        indexAddAfter = index;
        console.log('add after function');
        console.log('polyline jalan ' + index);
        isAddAfter = true;
        polyline();
        makeLine(index);
        showPolyline();
        map.off('click');
        onClick();
    }

    //hapus marker
    function hapus(index) {

        console.log('hapus');
        console.log(test[polyOnClick].cord[index])
        test[polyOnClick].remove(index);
        console.log(test[polyOnClick].cord[index]);
        hideMarker(index);
        for (let i = 0; i < marker.length; i++) {
            hideMarker(i);
            marker[i].off('click');
            map.off('popupopen');
        }
        marker = [];
        for (let i = 0; i < test[polyOnClick].cord.length; i++) {
            addMarker(i, test[polyOnClick].cord[i]);
        }

        showPolygon(test[polyOnClick].cord, test[polyOnClick].polygon, polyOnClick);
        polygonOnClick(polyOnClick);
        polyline(line);
    }

    //show marker
    function showMarker(i) {
        map.addLayer(marker[i]);
    }

    //hide marker
    function hideMarker(i) {
        map.removeLayer(marker[i]);
    }

    //cari index
    function findArray(l, lat, long) {
        let result;
        let latlng = [lat, long]
        //console.log(latlng);
        let temp = test[l];
        let length = test[l].cord.length;
        //console.log(length);
        for (let i = 0; i < length; i++) {
            if (temp.cord[i].every((val, index) => val === latlng[index])) {
                result = i;
                i = length;
            }
        }
        return result;
    }

    // Add event listener on keydown
    document.addEventListener('keydown', (event) => {
        let name = event.key;
        let code = event.code;
        let l;
        if (name === 'Control') {
            // Do nothing.
            return;
        }
        if (event.ctrlKey) {
            //alert(`Combination of ctrlKey + ${name} \n Key code Value: ${code}`);
            if (allowUndo) {
                if (test[polyOnClick].cord[0] != null) {
                    if (code == 'KeyZ') {
                        test[polyOnClick].undo();
                        console.log(polyOnClick);
                        if (marker != null) {
                            delAllMarker();
                            console.log('delete');
                        }
                        addAllMarker();
                        console.log('tambah');
                        showPolygon(test[polyOnClick].cord, test[polyOnClick].polygon, polyOnClick);
                        polygonOnClick(polyOnClick);
                        console.log("berhasil undo")
                    }
                }
            }

        }
    }, true);

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
        let content =
            `<div class="card text-center">           
            <div class="card-body">
                <h5 class="card-title">` + test[index].nama + `</h5>
                <p class="card-text">` + test[index].jenis + `</p>               
            </div>
            <div class="card-footer text-muted">
               
            </div>
        </div>`;
        let polygon = polygon1;
        if (polygon == null) {
            polygon = L.polygon([
                cord1
            ], {
                color: 'blue',
                fillColor: 'blue',
                fillOpacity: 0.2
            }).addTo(map)
            polygon.bindTooltip(content);
            console.log("berhasil menampilkan polygon");
        } else {
            polygon.remove();
            polygon = L.polygon([
                cord1
            ], {
                color: 'blue',
                fillColor: 'blue',
                fillOpacity: 0.2
            }).addTo(map)
            polygon.bindTooltip(content);
            console.log("berhasil menampilkan polygon");
        }
        test[index].polygon = polygon;
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

    //create help line to draw
    function polyline() {
        line = L.polyline([], {
            dashArray: 10
        })
        console.log("berhasil menampilkan polyline");

        console.log(line);
    }

    //show polyline
    function showPolyline() {
        map.addLayer(line);
    }

    //hide polyline
    function hidePolyline() {
        if (line != null) {
            map.removeLayer(line);
        }
    }

    function hapusPolygon() {
        test[polyOnClick].polygon.remove();
        test.splice(polyOnClick, 1);
        allData = [];
        //polyOnClick = test.length - 1;
        showAllPolygon();
        delAllMarker();
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
    document.getElementById("tambah").onclick = function() {
        //mapStyle('outdoors-v11');
        tambah();
    };
    document.getElementById("edit").onclick = function() {
        //mapStyle('outdoors-v11');
        edit();
    };
    document.getElementById("hapus").onclick = function() {
        //mapStyle('outdoors-v11');
        hapusPolygon();
    };
    document.getElementById("cancel").onclick = function() {
        //mapStyle('outdoors-v11');
        location.replace("<?php echo (base_url()); ?>Admin");
    };
    let d = <?php echo json_encode($d); ?>;
    if (d != null) {
        console.log("banyak data " + d.length);
        for (let i = 0; i < d.length; i++) {
            showAll(d[i]);
        }
    }

    //passing data javascript ke Controller dengan ajax
    // Variable to hold request
    var request;

    // Bind to the submit event of our form
    $("#save").click(function(event) {

        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        getAllData();
        // if (!isEdit) {
        hidePolyline();
        //line = null;
        map.off('click');
        mapStatus = false;
        console.log("panjang array test = ", test.length);
        //polygonOnClick(polyOnClick);
        allowUndo = false;
        // }

        // Abort any pending request
        if (request) {
            request.abort();
        }
        // setup some local variables
        // var $form = $(this);

        // Let's select and cache all the fields
        // var $inputs = $form.find("input, select, button, textarea");

        // Serialize the data in the form
        // var serializedData = $form.serialize();

        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        //$inputs.prop("disabled", true);                

        // Fire off the request to /form.php
        console.log(allData.length);
        request = $.ajax({
            url: "<?php echo (base_url()); ?>Admin/addPolygon",
            type: "post",
            data: {
                data: allData
            },

            // success: function(data) {
            //     alert(data);
            // }
            success: function(data) {
                swal({
                    icon: "success",
                    title: "Berhasil Disimpan!",
                }).then((willDelete) => {

                });
            }
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            // Log a message to the console
            console.log("Hooray, it worked!");
        });

        // Callback handler that will be called on failure
        request.fail(function(jqXHR, textStatus, errorThrown) {
            // Log the error to the console
            swal({
                icon: "warning",
                title: "Data Gagal di Update!",
            }).then((willDelete) => {

            });

            console.error(
                "The following error occurred: " +
                textStatus, errorThrown
            );
        });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
        // request.always(function() {
        //     // Reenable the inputs
        //     $inputs.prop("disabled", false);
        // });

    });

    function getAllData() {
        let l = test.length;
        console.log(test);
        for (let i = 0; i < l; i++) {
            if (test[i].id == null) {
                i++;
            }
            dataPolygon = {
                id: test[i].id,
                nama: test[i].nama,
                jenis: test[i].jenis,
                coordinate: test[i].cord,
            };
            allData[i] = dataPolygon;
        }
        console.log(allData);
    }
</script>