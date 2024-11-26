document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('imc-form');
    const errorMessage = document.getElementById('error-message');
    
    // Función para validar el formato del teléfono
    function isValidPhone(phone) {
        return /^[\d\s()-]{8,15}$/.test(phone);
    }
    
    // Función para validar números
    function isValidNumber(value) {
        return !isNaN(value) && value > 0;
    }
    
    // Animación de carga del botón
    function setLoadingState(button, loading) {
        const text = button.querySelector('.button-text');
        const icon = button.querySelector('.button-icon');
        
        if (loading) {
            text.textContent = 'Calculando...';
            icon.textContent = '↻';
            button.disabled = true;
            icon.style.animation = 'spin 1s linear infinite';
        } else {
            text.textContent = 'Calcular';
            icon.textContent = '→';
            button.disabled = false;
            icon.style.animation = '';
        }
    }
    
    // Validación del formulario
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        errorMessage.textContent = '';
        
        const nombre = document.getElementById('nombre').value.trim();
        const apellido = document.getElementById('apellido').value.trim();
        const telefono = document.getElementById('telefono').value.trim();
        const peso = parseFloat(document.getElementById('peso').value);
        const estatura = parseFloat(document.getElementById('estatura').value);
        
        // Validaciones
        if (!nombre || !apellido) {
            errorMessage.textContent = 'Por favor, ingresa tu nombre completo';
            return;
        }
        
        if (!isValidPhone(telefono)) {
            errorMessage.textContent = 'Por favor, ingresa un número de teléfono válido';
            return;
        }
        
        if (!isValidNumber(peso)) {
            errorMessage.textContent = 'Por favor, ingresa un peso válido';
            return;
        }
        
        if (!isValidNumber(estatura)) {
            errorMessage.textContent = 'Por favor, ingresa una estatura válida';
            return;
        }
        
        // Si todo está correcto, enviar el formulario
        const submitButton = form.querySelector('button[type="submit"]');
        setLoadingState(submitButton, true);
        
        // Simular delay de red y enviar el formulario
        setTimeout(() => {
            form.submit();
        }, 800);
    });
    
    // Efectos visuales para los inputs
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        // Remover placeholder por defecto
        input.setAttribute('placeholder', ' ');
        
        // Añadir efecto de onda al hacer focus
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });

    // Efecto de parallax suave para el círculo decorativo
    const circle = document.querySelector('.circle-decoration');
    document.addEventListener('mousemove', function(e) {
        const x = e.clientX / window.innerWidth;
        const y = e.clientY / window.innerHeight;
        
        circle.style.transform = `translateX(calc(-50% + ${x * 20}px)) translateY(${y * 10}px)`;
    });
});