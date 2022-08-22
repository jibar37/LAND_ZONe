const apiKey = 'pk.eyJ1IjoiamliYXIzNyIsImEiOiJja2tpcnZvaWYwc3J3MnVxOW84YmV0MDFkIn0.wEvaABwReIIPwPB4fhW1Ow';

var map = L.map('map').setView([-8.576937757085497, 116.09794658196444], 13);
//  Create a new map with a fullscreen button:
 
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: apiKey
}).addTo(map);

// // or, add to an existing map:
// map.addControl(new L.Control.Fullscreen());



// map.isFullscreen() // Is the map fullscreen?
// map.toggleFullscreen() // Either go fullscreen, or cancel the existing fullscreen.

// // `fullscreenchange` Event that's fired when entering or exiting fullscreen.
// map.on('fullscreenchange', function () {
//     if (map.isFullscreen()) {
//         console.log('entered fullscreen');
//     } else {
//         console.log('exited fullscreen');
//     }
// });

// Adding Marker

// const marker = L.marker([40.748708, -73.985433]).addTo(mymap);

// Add popup message
// let template = `
// <h3>Empire State Building</h3>
// <div style="text-align:center">
//     <img width="150" height="150"src="image.jpg"/>
// </div>
// `
// marker.bindPopup(template);

// Add circle 

// const circle = L.circle([40.748708, -73.985433], {
//     radius:500, 
//     color: 'green', 
//     fillColor: 'red',
//     fillOpacity:0.2
// }).addTo(mymap).bindPopup('I am a circle')

// Add Polygon

// const polygon = L.polygon([
   
//     [40.73618, -73.97545],
//     [40.731497, -73.974342],
//     [40.729324, -73.972234],
//     [40.732368, -73.981293],
// ], {
//     color:'blue',
//     fillColor:'blue',
//     fillOpacity:0.2
// }).addTo(mymap).bindPopup(' I am a polygon')

// polygon.bindPopup(' I am a polygon')