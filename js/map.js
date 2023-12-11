var map = L.map('mapaConJs').setView([38.98626, -3.92907], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);


var marker = L.marker([38.987102, -3.927205]).addTo(map);

marker.bindPopup("<b>Aquí estamos</b>").openPopup();