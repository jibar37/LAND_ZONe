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
let noEdit;
let isAddAfter = false;
let cord1;
let polyOnClick;
let line = null;
let headToNew = null;
let x = 1;
let z = null;
let popUpOpen;
let popUpClose;

//api key mapbox
const apiKey = 'pk.eyJ1IjoiamliYXIzNyIsImEiOiJja2tpcnZvaWYwc3J3MnVxOW84YmV0MDFkIn0.wEvaABwReIIPwPB4fhW1Ow';

// Define map
var map = L.map('map').setView([-8.576937757085497, 116.09794658196444], 13);

//  Create a new map 
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    maxZoom: 18,
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

//bindpopup click
let eventHandlerAssigned = false
let marker = [];

// map.on('popupopen', function () {
//     if (!eventHandlerAssigned && document.querySelector('.popUp')) {
//         const link = document.querySelector('.popUp')
//         link.addEventListener('click', edit)
//         eventHandlerAssigned = true
//     }
// })

// map.on('popupclose', function () {
//     document.querySelector('.popUp').removeEventListener('click', edit)
//     eventHandlerAssigned = false
// })

// //fly to
// export function fly() {
//     map.flyTo([
//         47.57652571374621,
//         -27.333984375
//     ], 3, { animate: true, duration: 5 })

//     //someMarker.closePopup()
// }

//tambah polygon
export function tambah() {
    let l;
    if (marker != 0) {
        let markerLength = marker.length;
        for (let i = 0; i < markerLength; i++) {
            hideMarker(i);
            marker[i].off('click');
            map.off('popupopen');
        }
        marker = [];
    }
    polyOnClick = null;
    l = test.length;
    if (l == 0) {
        test[l] = new utils.Coordinate();
    }
    else {
        if (test[l - 1].head == null) {
            test.pop();
        }
        else {
            test[l] = new utils.Coordinate();
        }
    }
    console.log(l);
    if (line != null) {
        hidePolyline();
    }
    line = null;

    if (!mapStatus || l == 0) {
        onClick();
        mapStatus = true;
        isEdit = false;
    }

}

//edit polygon
export function edit() {
    isEdit = !isEdit;
    if (isEdit) {
        showPolyline();
    }

    onClick();
    if (!isEdit) {
        hidePolyline();
        //line = null;
        map.off('click');
        mapStatus = false;
        polygonOnClick(noEdit);

    }
    console.log('edit');
}

//change map style
export function mapStyle(id1) {
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        maxZoom: 18,
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
            makeLine(l, 0)
        }
        //line = null;
        console.log("ini polygon ke ", l);
        polyOnClick = l;
        if (marker != 0) {
            for (let i = 0; i < marker.length; i++) {
                hideMarker(i);
                // hideMarker(i);
            }
            marker = [];

        }
        map.off('click');
        for (let i = 0; i < test[l].cord.length; i++) {
            addMarker(i, l, test[l].cord[i]);
        }

        mapStatus = false;
        noEdit = l;
        console.log('is null');
        console.log(a);

    });

}
//help line polyline
function makeLine(l, i) {
    map.on('mousemove', function (e) {

        // polyline(1, e.latlng);
        // showPolyline();
        let index = test[l].cord.length - 1;
        if (line != null) {
            // garis.setLatLngs([-8.53161227416715, 116.09558080792861], e.latlng);
            // while (x == 1) {
            if (isAddAfter) {
                line.setLatLngs([test[l].cord[i], e.latlng, test[l].cord[i]]);
            } else {
                line.setLatLngs([test[l].cord[0], e.latlng, test[l].cord[index]]);
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
        let l;
        let cord;
        let lat;
        let long;
        let head;
        let index;
        if (test.length != 0) {
            cord = e.latlng;
            lat = cord.lat;
            long = cord.lng;
            cord1 = null;
            head;
            if (!isEdit) {
                if (isAddAfter) {
                    l = noEdit;
                } {
                    l = test.length - 1;
                }
            }
            else {
                l = noEdit;
            }
            console.log("You clicked the map at latitude: " + lat + " and longitude: " + long);
            if (isAddAfter) {
                test[l].addAfter(indexAddAfter, [lat, long]);
                console.log(indexAddAfter)
                console.log(test[l].cord);
                delAllMarker();
                addAllMarker(l);
                // isAddAfter = false;
            } else {
                test[l].input(lat, long);
                index = test[l].cord.length - 1;
                addMarker(index, l, [lat, long]);
            }

            // test[l].show();
            head = test[l].head;
            console.log(head.lat);
            // let temp = head;
            //cord1 = [[temp.lat, temp.long]];


            // make polygon
            // cord1 = [[temp.lat, temp.long]];
            // while (temp.next != null) {
            //     temp = temp.next;
            //     cord1.push([temp.lat, temp.long]);
            // }
            //var result = findArray(l, lat, long)
            //console.log(result);
            console.log(test[l].cord[0]);
            let latlng1 = [lat, long];


            // if (marker != null) {
            //     for (let i = 0; i < marker.length; i++) {
            //         hideMarker(i);
            //         // hideMarker(i);
            //     }
            //     marker = [];
            // }

            console.log(test[l].cord);
            showPolygon(test[l].cord, test[l].polygon, l);
            if (line == null) {
                polyline([lat, long]);
                showPolyline();

            }
            makeLine(l, indexAddAfter);

            if (!isEdit) {
                polygonOnClick(l);
            }
        }

    });
}

//add marker
function addMarker(i, l, latlng) {
    let isNull = null;
    isNull = marker[i];
    // console.log(marker[i]);
    if (isNull == null) {
        marker[i] = L.marker(
            latlng
            , {
                index: i,
                id: "is",
                tittle: 'test',
                clickable: true,
                dragabble: true
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
        //showMarker(i);

        //popUp clikck event

        // marker[i].on('click', function (e) {
        //     // const link = document.getElementById(i)
        //     map.on('popupopen', function () {
        //         const link = document.getElementById(i)
        //         link.addEventListener('click', function (e) {
        //             //hapus(l, i)
        //             console.log('hapus ');
        //         })
        //         // link.addEventListener('click', edit())
        //         // eventHandlerAssigned = false;
        //     })
        //     //     console.log(marker[i].options.index);
        //     // map.on('popupopen', function () {
        //     //     const link = document.getElementById(i)
        //     //     link.addEventListener('click', function (e) {
        //     //         hapus(l, i)
        //     //         //console.log('hapus ' + marker[i].options.index);
        //     //     })
        //     //     // link.addEventListener('click', edit())
        //     //     // eventHandlerAssigned = false;
        //     // })

        //     // map.on('popupclose', function () {
        //     //     document.querySelector('.popUp').removeEventListener('click', function (e) {
        //     //         hapus(l, i)
        //     //     })
        //     //     // document.querySelector('.popUp').removeEventListener('click', edit())
        //     //     eventHandlerAssigned = false
        //     // })
        // });
    }
    showMarker(i);
    let link;

    marker[i].on('popupopen', function () {
        console.log('berhasil ' + l + " dan " + i);
        line = null;
        link = document.getElementById(i + "addAfter");
        link.addEventListener('click', e => { addAfter(l, i, marker[i].closePopup()) });
        console.log('empty');

        // console.log(link);
        // if (link != null) {
        // link.addEventListener('click', addAfter(l, i));
        // addAfter(l, i);
        // console.log('add after');
        // } else {
        // console.log('empty');
        // }
        // map.off('popupclose');

    });
    marker[i].on('popupclose', function () {
        // document.getElementById(i + "addAfter").removeEventListener('click', addAfter(l, i));
        //let link = document.getElementById(i + "addAfter");
        // if (link != null) {
        //     link.remove();
        //     console.log("close")
        // }

        // console.log(link);
        // map.off('popupopen');
        // marker[i].off('click');
        console.log('pop up close');
    });
    // marker[i].on('click', function (e) {

    //     marker[i].on('popupopen', function () {
    //         console.log('berhasil ' + l + " dan " + i);

    //         link = document.getElementById(i + "addAfter");
    //         // console.log(link);
    //         if (link != null) {
    //             // link.addEventListener('click', addAfter(l, i));
    //             addAfter(l, i);
    //             console.log('add after');
    //         } else {
    //             console.log('empty');
    //         }
    //         // map.off('popupclose');

    //     });
    //     marker[i].on('popupclose', function () {
    //         // document.getElementById(i + "addAfter").removeEventListener('click', addAfter(l, i));
    //         //let link = document.getElementById(i + "addAfter");
    //         // if (link != null) {
    //         //     link.remove();
    //         //     console.log("close")
    //         // }

    //         // console.log(link);
    //         // map.off('popupopen');
    //         // marker[i].off('click');
    //         console.log('pop up close');
    //     });
    // });

}
//add after
function addAfter(l, index) {
    console.log('add after function');
    if (line == null) {
        polyline([test[l].cord[index].lat, test[l].cord[index].long]);
        showPolyline();
        console.log('polyline jalan');
        isAddAfter = true;

    }
    // isAddAfter = true;
    makeLine(l, index);
    // indexAddAfter = index;
    // noEdit = l;

    // onClick();

    // delAllMarker();
    // addAllMarker(l);
    // isAddAfter = false;
    // indexAddAfter = null;
    // noEdit = null;
}

//hapus marker
function hapus(l, index) {

    console.log('hapus');
    console.log(test[l].cord[index])
    test[l].remove(index);
    console.log(test[l].cord[index]);
    hideMarker(index);
    for (let i = 0; i < marker.length; i++) {
        hideMarker(i);
        marker[i].off('click');
        map.off('popupopen');
    }
    marker = [];
    for (let i = 0; i < test[l].cord.length; i++) {
        addMarker(i, l, test[l].cord[i]);
    }

    showPolygon(test[l].cord, test[l].polygon, l);
    polygonOnClick(l);
}

//bind Button
function bindButton() {
    console.log('bind button');
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
    let indexMarker;
    if (name === 'Control') {
        // Do nothing.
        return;
    }
    if (event.ctrlKey) {
        //alert(`Combination of ctrlKey + ${name} \n Key code Value: ${code}`);
        if (isEdit) {
            l = noEdit;
        }
        else {
            // if (polyOnClick == null) {
            l = test.length - 1;
            // }
            // else {
            // l = polyOnClick;
            // }

            indexMarker = marker.length - 1;
        }
        if (test[l].head != null) {
            if (code == 'KeyZ') {
                test[l].undo();
                console.log(l);
                if (marker != null) {
                    delAllMarker();

                }
                addAllMarker(l);
                showPolygon(test[l].cord, test[l].polygon, l);
                polygonOnClick(l);
                console.log("berhasil undo")
            }
        }
    }
    // else {
    //   alert(`Key pressed ${name} \n Key code Value: ${code}`);
    // }
}, true);
//add All Marker
function addAllMarker(l) {
    for (let i = 0; i < test[l].cord.length; i++) {
        addMarker(i, l, test[l].cord[i]);
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
// Add event listener on keyup
//   document.addEventListener('keyup', (event) => {
//     var name = event.key;
//     if (name === 'Control') {
//       alert('Control key released');
//     }
//   }, false);

//add polygon to map
function showPolygon(cord1, polygon1, l) {
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
    test[l].polygon = polygon;
}

//create help line to draw
function polyline(latlng) {
    line = L.polyline([
        // [-8.53161227416715, 116.09558080792861],
        // // latlng2
        // [-8.570808441786568, 116.12577876082713]

    ], {
        dashArray: 10
    })
    // headToNew = tailToNew;
    console.log("berhasil menampilkan polyline");

    console.log(line);
}
function showPolyline() {
    // map.addLayer(headToNew);
    map.addLayer(line);
}
function hidePolyline() {
    map.removeLayer(line);
    // map.removeLayer(headToNew);
}

//add marker

// Adding Marker

// const marker = L.marker([40.748708, -73.985433]).addTo(map);

// // Add popup message
// let template = `
// <h3>Empire State Building</h3>
// <div style="text-align:center">
//     <img width="150" height="150"src="image.jpg"/>
// </div>
// `
// marker.bindPopup(template);

// // Add circle

// const circle = L.circle([40.748708, -73.985433], {
//     radius:500,
//     color: 'green',
//     fillColor: 'red',
//     fillOpacity:0.2
// }).addTo(map).bindPopup('I am a circle')

// // Add Polygon



// // polygon.bindPopup(' I am a polygon')