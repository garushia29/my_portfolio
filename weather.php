<?php require_once 'includes/header.php'; ?>

<div class="weather-container">
    <div class="weather-card">
        <div id="current-weather" class="weather-section">
            <h2>Clima Actual</h2>
            <div class="weather-info"></div>
        </div>
        <div id="forecast-weather" class="weather-section">
            <h2>Pronóstico Semanal</h2>
            <div class="forecast-info"></div>
        </div>
        <div class="location-search">
            <input type="text" id="location-input" placeholder="Buscar ubicación...">
            <button onclick="searchLocation()">Buscar</button>
        </div>
    </div>
</div>

<script>
const API_KEY = '87af9a9f42364e67b56183310251606'; // Reemplazar con tu API key de WeatherAPI

async function getCurrentLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            getWeatherData(position.coords.latitude, position.coords.longitude);
        }, error => {
            console.error('Error getting location:', error);
            document.querySelector('.weather-info').innerHTML = 'Error al obtener la ubicación';
        });
    } else {
        document.querySelector('.weather-info').innerHTML = 'Geolocalización no soportada';
    }
}

async function searchLocation() {
    const location = document.getElementById('location-input').value;
    if (location) {
        try {
            const response = await fetch(`https://api.weatherapi.com/v1/forecast.json?key=${API_KEY}&q=${encodeURIComponent(location)}&days=7&aqi=yes&lang=es`);
            const data = await response.json();
            
            if (data.error) {
                throw new Error(data.error.message);
            }
            
            displayWeatherData(data);
        } catch (error) {
            console.error('Error fetching weather data:', error);
            document.querySelector('.weather-info').innerHTML = `
                <div class="error-message">
                    <p>Error al obtener datos del clima</p>
                    <p class="error-details">${error.message || 'Ubicación no encontrada'}</p>
                </div>
            `;
            document.querySelector('.forecast-info').innerHTML = '';
        }
    }
}

async function getWeatherData(lat, lon) {
    try {
        const response = await fetch(`https://api.weatherapi.com/v1/forecast.json?key=${API_KEY}&q=${lat},${lon}&days=7&aqi=yes&lang=es`);
        const data = await response.json();
        
        if (data.error) {
            throw new Error(data.error.message);
        }
        
        displayWeatherData(data);
    } catch (error) {
        console.error('Error fetching weather data:', error);
        document.querySelector('.weather-info').innerHTML = `
            <div class="error-message">
                <p>Error al obtener datos del clima</p>
                <p class="error-details">${error.message || 'No se pudo obtener la información del clima'}</p>
            </div>
        `;
        document.querySelector('.forecast-info').innerHTML = '';
    }
}

function displayWeatherData(data) {
    const currentWeather = document.querySelector('.weather-info');
    const forecastWeather = document.querySelector('.forecast-info');

    // Mostrar clima actual
    currentWeather.innerHTML = `
        <h3>${data.location.name}, ${data.location.country}</h3>
        <img src="${data.current.condition.icon}" alt="${data.current.condition.text}">
        <p class="temperature">${data.current.temp_c}°C</p>
        <p class="condition">${data.current.condition.text}</p>
        <div class="details">
            <p>Humedad: ${data.current.humidity}%</p>
            <p>Viento: ${data.current.wind_kph} km/h</p>
            <p>Sensación térmica: ${data.current.feelslike_c}°C</p>
        </div>
    `;

    // Mostrar pronóstico
    let forecastHTML = '<div class="forecast-grid">';
    data.forecast.forecastday.forEach(day => {
        const date = new Date(day.date);
        forecastHTML += `
            <div class="forecast-day">
                <p>${date.toLocaleDateString('es-ES', {weekday: 'short'})}</p>
                <img src="${day.day.condition.icon}" alt="${day.day.condition.text}">
                <p>${day.day.maxtemp_c}°C / ${day.day.mintemp_c}°C</p>
            </div>
        `;
    });
    forecastHTML += '</div>';
    forecastWeather.innerHTML = forecastHTML;
}

// Iniciar con la ubicación actual
document.addEventListener('DOMContentLoaded', getCurrentLocation);
</script>

<?php require_once 'includes/footer.php'; ?>