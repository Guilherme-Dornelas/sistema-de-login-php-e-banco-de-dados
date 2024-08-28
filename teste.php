<?php

include 'config.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $sql = 'SELECT * FROM cadastros';
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                echo json_encode($rows);
            } else {
                echo json_encode([]);
            }
        } else {
            echo json_encode(['error' => 'Erro ao executar a consulta.']);
        }
    } else {
        echo json_encode(['error' => 'Método de requisição não permitido.']);
    }
    
    $conn->close();
    ?>