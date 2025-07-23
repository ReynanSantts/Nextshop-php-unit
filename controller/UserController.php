<?php
/**
 * Controlador UserController para gerenciar operações relacionadas ao usuário.
 * Preparado para futura integração com banco de dados MySQL.
 */

require_once __DIR__ . '/../model/User.php';

class UserController {
    private $userModel;
    private $pdo;

    public function __construct() {
        $this->userModel = new User();
        // Setup PDO connection (adjust DSN, username, password as needed)
        $dsn = 'mysql:host=localhost;dbname=nextshop;charset=utf8mb4';
        $username = 'root';
        $password = '';
        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erro na conexão com o banco de dados: ' . $e->getMessage());
        }
    }

    /**
     * Busca usuário pelo email, incluindo emails adicionais.
     */
    public function getUserByEmail($email) {
        $sql = "SELECT u.id, u.nome, u.email, u.senha_hash FROM users u
                WHERE u.email = :email
                UNION
                SELECT u.id, u.nome, ue.email, u.senha_hash FROM users u
                JOIN user_emails ue ON u.id = ue.user_id
                WHERE ue.email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $user = new User($row['nome'], $row['email'], $row['senha_hash']);
            return $user;
        }
        return null;
    }

    /**
     * Busca todos os emails associados a um usuário pelo ID.
     */
    public function getEmailsByUserId($userId) {
        $sql = "SELECT email FROM user_emails WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        $emails = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $emails;
    }

    /**
     * Adiciona um novo email para o usuário.
     */
    public function addEmailForUser($userId, $email) {
        $sql = "INSERT INTO user_emails (user_id, email) VALUES (:user_id, :email)";
        $stmt = $this->pdo->prepare($sql);
        try {
            $stmt->execute(['user_id' => $userId, 'email' => $email]);
            return true;
        } catch (PDOException $e) {
            // Pode ser email duplicado ou outro erro
            return false;
        }
    }

    /**
     * Método para validar login (placeholder).
     * Deve ser implementado com verificação de senha e sessão.
     */
    public function validateLogin($email, $senha) {
        // Implementar validação real com banco de dados
        return true;
    }
}
?>
