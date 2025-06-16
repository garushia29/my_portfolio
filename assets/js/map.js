document.addEventListener('DOMContentLoaded', function() {
    // Verificar si mapboxgl está disponible
    if (typeof mapboxgl === 'undefined') {
        console.error('Mapbox GL JS no está cargado. Verifica la inclusión del script.');
        return;
    }

    // Configurar el token de acceso
    mapboxgl.accessToken = 'pk.eyJ1IjoiZ2FydXNoaWEyOSIsImEiOiJjbWJscWluMW8xMmZmMmtweHQ3MnlqZDhzIn0.RA-tIG-0yLuWvAJzFNkkIA';

    // Verificar si el contenedor del mapa existe
    const mapContainer = document.getElementById('map-container');
    if (!mapContainer) {
        console.error('El contenedor del mapa no está presente en esta página. Asegúrate de que existe un elemento con id="map-container"');
        return;
    }

    try {
        // Inicializar el mapa
        const map = new mapboxgl.Map({
            container: 'map-container',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [-63.175107, -17.774946], // Coordenadas de Santa Cruz
            zoom: 12,
            failIfMajorPerformanceCaveat: true // Falla si hay problemas de rendimiento
        });

        // Manejar eventos del mapa
        map.on('load', () => {
            console.log('Mapa cargado correctamente');
            
            // Crear marcador personalizado
            const customMarkerElement = document.querySelector('.custom-marker');
            if (customMarkerElement) {
                new mapboxgl.Marker({
                    element: customMarkerElement,
                    anchor: 'bottom'
                })
                .setLngLat([-63.175107, -17.774946])
                .addTo(map);
            } else {
                // Si no hay marcador personalizado, usar uno por defecto
                new mapboxgl.Marker()
                .setLngLat([-63.175107, -17.774946])
                .addTo(map);
            }
        });

        map.on('error', (e) => {
            console.error('Error en el mapa:', e.error);
        });

    } catch (error) {
        console.error('Error al inicializar el mapa:', error);
        mapContainer.innerHTML = '<div class="map-error">Error al cargar el mapa. Por favor, recarga la página.</div>';
    }
});