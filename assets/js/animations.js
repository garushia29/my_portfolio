const typeWriter = (element, text, speed = 100) => {
    let i = 0;
    const originalText = text;
    let isDeleting = false;
    let loopNum = 0;
    const wait = 3000; // Tiempo de espera antes de borrar

    const type = () => {
        // Aseguramos que el elemento siempre tenga un espacio para mantener la altura
        if (!element.innerHTML) {
            element.innerHTML = '&nbsp;';
        }

        if (!isDeleting && i < text.length) {
            // Escribiendo
            element.innerHTML = text.substring(0, i + 1);
            i++;
            setTimeout(type, speed);
        } else if (isDeleting && i > 0) {
            // Borrando
            element.innerHTML = text.substring(0, i - 1) || '&nbsp;';
            i--;
            setTimeout(type, speed / 2);
        } else if (!isDeleting) {
            // Esperar antes de empezar a borrar
            isDeleting = true;
            setTimeout(type, wait);
        } else {
            // Reiniciar el ciclo
            isDeleting = false;
            i = 0;
            text = originalText;
            setTimeout(type, 500);
        }
    };

    type();
};