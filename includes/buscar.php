<?php

if (isset($_GET['game'])) {
    $game = urlencode($_GET['game']);
    $apiKey = 'eded48e62ac60078971536552d9c6b4c9a3a69118bd4348e20329f5a23c05f0f'; // Clave API pública actualizada
    $url = "https://api.thegamesdb.net/v1/Games/ByGameName?name=$game&platform=PlayStation&apikey=$apiKey";
    
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if (isset($data['data']) && count($data['data']) > 0) {
        // Procesar los resultados
        $games = [];
        foreach ($data['data'] as $gameData) {
            $games[] = [
                'name' => $gameData['GameTitle'] ?? 'Sin título',
                'cover' => isset($gameData['Images']['thumb']) ? $gameData['Images']['thumb'] : 'no-cover.png',
                'overview' => $gameData['Overview'] ?? 'Descripción no disponible'
            ];
        }
    } else {
        $error_message = "No se encontraron resultados para '$game'.";
    }
}

?>
