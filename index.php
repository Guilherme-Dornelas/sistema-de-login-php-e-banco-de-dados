<?php
include 'config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$input = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $input['name'] ?? '';
    $email = $input['email'] ?? '';
    $password = $input['password'] ?? '';
    $birthdate = $input['birthdate'] ?? '';

    if ($name && $email && $password && $birthdate) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO cadastros (name, email, password, birthdate) VALUES ('$name', '$email', '$password', '$birthdate')";
        
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['success' => true, 'message' => 'Cadastro bem sucedido']);
        }
        
    } else {
        echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $email = $_GET['email'] ?? '';
    $password = $_GET['password'] ?? '';

        if($email && $password) {
            $sql = "SELECT * FROM cadastros where email = ?";  

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
    
                if (password_verify($password, $user['password'])) {
                  $_SESSION['user_email'] = $user['email'];
                  
                    echo json_encode(['success' => true, 'message' => 'Login bem sucedido']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Email ou senha incorretos']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Email não encontrado']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Email e senha são obrigatórios']);
        }
} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $id = $_GET['id'];
    $sql = "DELETE FROM cadastros WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Usuário deletado com sucesso']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao deletar usuário']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Requisição inválida']);
}

$conn->close();
?>
