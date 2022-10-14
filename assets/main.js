// document.writeln("<script type='text/javascript' src='https://code.jquery.com/jquery-3.5.1.min.js'></script>");

// function include(file) {

//     var script  = document.createElement('script');
//     script.src  = file;
//     script.type = 'text/javascript';
//     script.defer = true;

//     document.getElementsByTagName('head').item(0).appendChild(script);

//   }

import * as utils from './List.js';

let test = [];
let indexAddAfter = null;
let mapStatus = true;
let isEdit = false;
let isAddAfter = false;
let polyOnClick;
let line = null;
let allowUndo = true;
let marker = [];
let mataramCoord = base_url + "assets/mataram.geojson";
let isTambah = false;





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
    if (l == 0) {
        test[polyOnClick] = new utils.Coordinate();
    }
    else {
        if (test[polyOnClick - 1].head == null) {
            test.pop();
        }
        else {
            test[polyOnClick] = new utils.Coordinate();
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
    let a = test[l].polygon.on('click', function () {
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
    map.on('mousemove', function (e) {

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
                }
                else {
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
    map.on('click', function (e) {
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
                polygonOnClick(polyOnClick);
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

            showPolygon(test[polyOnClick].cord, test[polyOnClick].polygon);
            if (line == null) {
                polyline();
                showPolyline();
            }
            makeLine(indexAddAfter);

            if (!isEdit) {
                polygonOnClick(polyOnClick);
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
            latlng
            , {
                index: i,
                id: "is",
                tittle: 'test',
                clickable: true,
                draggable: true
            });
        let template = `
        <label id="edit" class="btn btn-primary">
            <input class="popUp" type="radio" name="options" id=`+ i + "addAfter" + `  autocomplete="off" ' > ADD AFTER
        </label>
         </br>
        <label id="edit" class="btn btn-primary">
			<input class="popUp" type="radio" name="options" id=`+ i + `  autocomplete="off" '> REMOVE
		</label>
    `

        marker[i].bindPopup(template);
    }

    //add marker
    marker[i].on('drag', function (event) {
        console.log("drag berhasil");
        let marker0 = event.target;
        let position = marker0.getLatLng();
        marker[i].setLatLng(new L.LatLng(position.lat, position.lng), { draggable: 'true' });
        //map.panTo(new L.LatLng(position.lat, position.lng));
        test[polyOnClick].update(i, position.lat, position.lng);
        showPolygon(test[polyOnClick].cord, test[polyOnClick].polygon);
        polygonOnClick(polyOnClick);

    });
    showMarker(i);
    let link;

    marker[i].on('popupopen', function () {
        console.log('berhasil ' + polyOnClick + " dan " + i);
        line = null;
        link = document.getElementById(i + "addAfter");
        link.addEventListener('click', e => {
            addAfter(i),
                marker[i].closePopup()
        });
        console.log('empty');
        link = document.getElementById(i)
        link.addEventListener('click', function (e) {
            hapus(i);
        });

    });
    marker[i].on('popupclose', function () {
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

    showPolygon(test[polyOnClick].cord, test[polyOnClick].polygon);
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
                    showPolygon(test[polyOnClick].cord, test[polyOnClick].polygon);
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
function showPolygon(cord1, polygon1) {
    let polygon = polygon1;
    if (polygon == null) {
        polygon = L.polygon([
            cord1
        ], {
            color: 'blue',
            fillColor: 'blue',
            fillOpacity: 0.2
        }).addTo(map)
        console.log("berhasil menampilkan polygon");
    }
    else {
        polygon.remove();
        polygon = L.polygon([
            cord1
        ], {
            color: 'blue',
            fillColor: 'blue',
            fillOpacity: 0.2
        }).addTo(map)
        console.log("berhasil menampilkan polygon");
    }
    test[polyOnClick].polygon = polygon;
}

//create help line to draw
function polyline() {
    line = L.polyline([
    ], {
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
    map.removeLayer(line);
}