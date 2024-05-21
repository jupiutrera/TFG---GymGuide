<?php
require 'vendor/autoload.php'; // Asegúrate de tener instalado el SDK de OpenAI

use OpenAI\OpenAI;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST['message'];
    
    $openai = new OpenAI('sk-proj-LXkti381GSdmTgkMRcWaT3BlbkFJRCK2O1CcsOmjLxl7aMVE'); // Reemplaza con tu clave de API

    $response = $openai->complete([
        'model' => 'text-davinci-003',
        'prompt' => $input,
        'max_tokens' => 150,
        'temperature' => 0.7
    ]);

    echo json_encode($response['choices'][0]['text']);
} else {
    echo json_encode(['error' => 'Método no permitido']);
}
?>