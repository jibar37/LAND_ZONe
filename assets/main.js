// document.writeln("<script type='text/javascript' src='https://code.jquery.com/jquery-3.5.1.min.js'></script>");
const apiKey = 'pk.eyJ1IjoiamliYXIzNyIsImEiOiJja2tpcnZvaWYwc3J3MnVxOW84YmV0MDFkIn0.wEvaABwReIIPwPB4fhW1Ow';
// function include(file) {

//     var script  = document.createElement('script');
//     script.src  = file;
//     script.type = 'text/javascript';
//     script.defer = true;

//     document.getElementsByTagName('head').item(0).appendChild(script);

//   }

import * as utils from './List.js';

var map = L.map('map').setView([-8.576937757085497, 116.09794658196444], 13);
//  Create a new map with a fullscreen button:

let test=[];
let mapStatus=true;
let isEdit=false;
let noEdit;
//tambah polygon
export function tambah() {
    let l;
    l = test.length;
    if(l==0){
        test[l] = new utils.Coordinate();
    }
    else{
        if(test[l-1].head==null){
            test.pop();
        }
        else{
            test[l] = new utils.Coordinate();
        }
    }
    console.log(l)
    if(!mapStatus || l==0){
        onClick();
    }
    
}
export function edit(){
    isEdit = !isEdit;
    onClick();
    if(!isEdit){
        // map.off();
        mapStatus=false;
    }
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

//polygon click event
function polygonOnClick(){
    let l = test.length-1;
    test[l].polygon.on('click', function () {
        console.log("ini polygon ke ", l);
        map.off();
        mapStatus = false;
        noEdit=l;
    });
    
}

//coordinate
function onClick(){
    let l;
    map.on('click', function (e) {
        if(test.length!=0){
            let cord = e.latlng;
            let lat = cord.lat;
            let lng = cord.lng;
            let cord1=null;
            let head;
            if(!isEdit){
                l = test.length-1;
            }
            else{
                l=noEdit;
            }
            console.log("You clicked the map at latitude: " + lat + " and longitude: " + lng);
            test[l].input(lat, lng);
            test[l].show();
            head = test[l].head;
            console.log(head.lat);
            let temp = head;
            //cord1 = [[temp.lat, temp.long]];
            

            // make polygon
            cord1 = [[temp.lat, temp.long]];
            while (temp.next != null) {
                temp = temp.next;
                cord1.push([temp.lat, temp.long]);
            }
            console.log(cord1)
          
            
            showPolygon(cord1, test[l].polygon, l);
            if(!isEdit){
                polygonOnClick();
            }
            
        }   
    

    });
}
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
            console.log("berhasil");
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
            console.log("berhasil");
        }
            test[l].polygon=polygon;
    // polygon = polygon1;
    // if (polygon == null) {
    //     polygon = L.polygon([
    //         cord1
    //     ], {
    //         color: 'blue',
    //         fillColor: 'blue',
    //         fillOpacity: 0.2
    //     }).addTo(map)
    //     console.log("berhasil");
    // }
    // else {
    //     polygon.remove();
    //     polygon = L.polygon([
    //         cord1
    //     ], {
    //         color: 'blue',
    //         fillColor: 'blue',
    //         fillOpacity: 0.2
    //     }).addTo(map)
    //     console.log("berhasil");
    // }
}



// Add event listener on keydown
// document.addEventListener('keydown', (event) => {
//     let name = event.key;
//     let code = event.code;
//     if (name === 'Control') {
//         // Do nothing.
//         return;
//     }
//     if (event.ctrlKey) {
//         //alert(`Combination of ctrlKey + ${name} \n Key code Value: ${code}`);
//         if (head != null) {
//             if (code == 'KeyZ') {
//                 utils.undo();
//                 utils.show();
//                 cord1.pop();
//                 head = utils.head;
//                 showPolygon(cord1, polygon);
//                 console.log(cord1)
//             }
//         }
//     }
//     // else {
//     //   alert(`Key pressed ${name} \n Key code Value: ${code}`);
//     // }
// }, false);
  // Add event listener on keyup
//   document.addEventListener('keyup', (event) => {
//     var name = event.key;
//     if (name === 'Control') {
//       alert('Control key released');
//     }
//   }, false);
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