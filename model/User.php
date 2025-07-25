<?php

namespace Model;

use Model\Connection;

use PDO;
use PDOException;
use Exception;

class User
{
    private $Ns;


    public function __construct()
    {
        $this->Ns = Connection::getInstance();
    }

    // FUNÇÃO DE CRIAR USUÁRIO
public function registerUser($user_fullname, $email, $cpf, $password)
{
    try {
        $sql = 'INSERT INTO user (user_name, user_email, user_cpf, user_password, created_at) VALUES (:user_name, :user_email, :user_cpf, :user_password, NOW())';

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->Ns->prepare($sql);

        $stmt->bindParam(":user_name", $user_fullname, PDO::PARAM_STR);
        $stmt->bindParam(":user_email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":user_cpf", $cpf, PDO::PARAM_STR);
        $stmt->bindParam(":user_password", $hashedPassword, PDO::PARAM_STR);

        return $stmt->execute();

    } catch (PDOException $error) {
        echo "Erro ao executar o comando " . $error->getMessage();
        return false;
    }
}

    // LOGIN
    public function getUserByEmail($email)
    {
        try {
        $sql = "SELECT * FROM user WHERE user_email = :email LIMIT 1";

        $stmt = $this->Ns->prepare($sql);

        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        // Opcional: log de erro
        return false;
    }
    }

    // // OBTER INFORMAÇÕES DO USUÁRIO
    // public function getUserInfo($id, $user_fullname, $email)
    // {
    //     try {
    //         $sql = "SELECT user_fullname, email FROM user WHERE id = :id AND user_fullname = :user_fullname AND email = :email";

    //         $stmt = $this->Ns->prepare($sql);

    //         $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    //         $stmt->bindParam(":user_fullname", $user_fullname, PDO::PARAM_STR);
    //         $stmt->bindParam(":email", $email, PDO::PARAM_STR);

    //         $stmt->execute();


    //         return $stmt->fetch(PDO::FETCH_ASSOC);

    //     } catch (PDOException $error) {
    //         echo "Erro ao buscar informações: " . $error->getMessage();
    //         return false;
    //     }
    // }
    // public function getFirstUser() {
    //     $sql = "SELECT * FROM user ORDER BY id ASC LIMIT 1";
    //     $stmt = $this->Ns->prepare($sql);
    //     $stmt->execute();
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }
}

?>