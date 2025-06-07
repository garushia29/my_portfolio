mapboxgl.accessToken = 'pk.eyJ1IjoiZ2FydXNoaWEyOSIsImEiOiJjbWJscWluMW8xMmZmMmtweHQ3MnlqZDhzIn0.RA-tIG-0yLuWvAJzFNkkIA'; // Reemplaza con tu token real de Mapbox
const map = new mapboxgl.Map({
    container: 'map-container',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [-63.175107, -17.774946], // Coordenadas de Cochabamba
    zoom: 12
});

// Marcador personalizado con tu imagen
const marker = new mapboxgl.Marker({
    element: document.querySelector('.custom-marker'),
    anchor: 'bottom'
})
.setLngLat([-63.175107, -17.774946])
.addTo(map);
new mapboxgl.Marker()
  .setLngLat([-74.5, 40])
  .addTo(map);

// Marcador personalizado
new mapboxgl.Marker({
    element: document.createElement('img'),
    anchor: 'center'
  })
  .setLngLat([-74.6, 40.1])
  .addTo(map);