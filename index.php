<?php require_once 'includes/header.php'; ?>

<div class="floating-weather-card" id="floating-weather">
    <div class="weather-preview"></div>
</div>

<section class="hero-section">
    <div class="hero-content">
        <div class="profile-photo">
            <img src="assets/images/profile/jimmy.png" alt="Mi Foto de Perfil" class="dynamic-photo">
        </div>
        <h1 class="typing-effect">Desarrollador Web Full-Stack</h1>
        <p>Apacionado por crear experiencias web únicas y funcionales</p>
        <div class="cta-buttons">
            <a href="projects.php" class="btn btn-primary">Ver Proyectos</a>
            <a href="contact.php" class="btn btn-secondary">Contactar</a>
        </div>
    </div>
</section>

<section class="skills-section">
    <h2>Mis Habilidades</h2>
    <div class="skills-container">
        <div class="skill-card">
            <i class="fas fa-code"></i>
            <h3>Frontend</h3>
            <p>HTML5, CSS3, JavaScript</p>
        </div>
        <div class="skill-card">
            <i class="fas fa-database"></i>
            <h3>Backend</h3>
            <p>PHP, MySQL, PDO</p>
        </div>
        <div class="skill-card">
            <i class="fas fa-paint-brush"></i>
            <h3>Diseño</h3>
            <p>UI/UX, Responsive Design</p>
        </div>
    </div>
</section>

<script>
const WEATHER_API_KEY = '87af9a9f42364e67b56183310251606'; // Reemplazar con tu API key de WeatherAPI

async function getFloatingWeatherData() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(async position => {
            try {
                const response = await fetch(`https://api.weatherapi.com/v1/current.json?key=${WEATHER_API_KEY}&q=${position.coords.latitude},${position.coords.longitude}&lang=es`);
                const data = await response.json();
                displayFloatingWeather(data);
            } catch (error) {
                console.error('Error fetching weather data:', error);
                document.querySelector('.weather-preview').innerHTML = 'Error al obtener datos del clima';
            }
        }, error => {
            console.error('Error getting location:', error);
            document.querySelector('.weather-preview').innerHTML = 'Error al obtener la ubicación';
        });
    }
}

function displayFloatingWeather(data) {
    const weatherPreview = document.querySelector('.weather-preview');
    weatherPreview.innerHTML = `
        <div class="location">${data.location.name}</div>
        <img src="${data.current.condition.icon}" alt="${data.current.condition.text}">
        <div class="temperature">${data.current.temp_c}°C</div>
        <div class="condition">${data.current.condition.text}</div>
    `;
}

// Inicializar el clima flotante
document.addEventListener('DOMContentLoaded', getFloatingWeatherData);

// Actualizar cada 30 minutos
setInterval(getFloatingWeatherData, 1800000);

// Redirigir a la página del clima al hacer clic en la tarjeta flotante
document.getElementById('floating-weather').addEventListener('click', () => {
    window.location.href = 'weather.php';
});
</script>

<?php require_once 'includes/footer.php'; ?>