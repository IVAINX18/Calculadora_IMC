<?php
header('Content-Type: text/html; charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener y sanitizar datos
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_STRING);
    $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
    $peso = filter_input(INPUT_POST, 'peso', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $estatura = filter_input(INPUT_POST, 'estatura', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    // Calcular IMC
    $imc = 0;
    $categoria = '';
    $color_clase = '';
    if ($estatura > 0) {
        $imc = $peso / ($estatura * $estatura);
        
        // Determinar categoría y color
        if ($imc < 18.5) {
            $categoria = 'Bajo peso';
            $color_clase = 'bajo-peso';
        } elseif ($imc < 25) {
            $categoria = 'Peso normal';
            $color_clase = 'peso-normal';
        } elseif ($imc < 30) {
            $categoria = 'Sobrepeso';
            $color_clase = 'sobrepeso';
        } else {
            $categoria = 'Obesidad';
            $color_clase = 'obesidad';
        }
    }
    // Generar HTML de resultado
    echo '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resultado IMC</title>
        <style>
            :root {
                --primary-color: #2D3250;
                --secondary-color: #424769;
                --accent-color: #7077A1;
                --background-color: #F6B17A;
            }
            
            body {
                min-height: 100vh;
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                margin: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: "Segoe UI", system-ui, sans-serif;
                padding: 20px;
            }
            
            .result-container {
                background: rgba(255, 255, 255, 0.95);
                padding: 2.5rem;
                border-radius: 20px;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
                max-width: 480px;
                width: 100%;
                text-align: center;
            }
            
            .result-header {
                margin-bottom: 2rem;
            }
            
            .result-value {
                font-size: 3rem;
                font-weight: bold;
                margin: 1rem 0;
                color: var(--primary-color);
            }
            
            .category {
                font-size: 1.5rem;
                margin: 1rem 0;
                padding: 0.5rem 1rem;
                border-radius: 50px;
                display: inline-block;
            }
            
            .bajo-peso { background: #90caf9; color: #1565c0; }
            .peso-normal { background: #a5d6a7; color: #2e7d32; }
            .sobrepeso { background: #fff59d; color: #f9a825; }
            .obesidad { background: #ffcdd2; color: #d32f2f; }
            
            .additional-info {
                margin-top: 1.5rem;
                font-size: 1rem;
                color: var(--secondary-color);
                line-height: 1.6;
            }
            
            .back-button {
                display: inline-block;
                margin-top: 1.5rem;
                padding: 0.75rem 1.5rem;
                background-color: var(--accent-color);
                color: white;
                text-decoration: none;
                border-radius: 50px;
                transition: background-color 0.3s ease;
            }
            
            .back-button:hover {
                background-color: var(--primary-color);
            }
        </style>
    </head>
    <body>
        <div class="result-container">
            <div class="result-header">
                <h1>Resultado del Índice de Masa Corporal (IMC)</h1>
            </div>
            
            <div class="result-details">
                <h2>Datos Personales</h2>
                <p><strong>Nombre:</strong> ' . htmlspecialchars($nombre . ' ' . $apellido) . '</p>
                <p><strong>Teléfono:</strong> ' . htmlspecialchars($telefono) . '</p>
            </div>
            
            <div class="result-value">
                IMC: ' . number_format($imc, 2) . '
            </div>
            
            <div class="category ' . $color_clase . '">
                ' . htmlspecialchars($categoria) . '
            </div>
            
            <div class="additional-info">
                <p>El Índice de Masa Corporal (IMC) es una medida aproximada de la cantidad de grasa corporal.</p>
                <p>Recuerda que este es solo un indicador general y no sustituye un diagnóstico médico profesional.</p>
            </div>
            
            <a href="/" class="back-button">Volver a Calcular</a>
        </div>
    </body>
    </html>';
} else {
    // Si no es una solicitud POST, redirigir al formulario
    header('Location: index.html');
    exit();
}
?>