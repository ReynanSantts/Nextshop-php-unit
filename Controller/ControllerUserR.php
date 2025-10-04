<?php

namespace Controller;

use Model\User;
use Exception;

class ControllerUserR
{
    private $userModel;

    // CONSTRUTOR MODIFICADO para injeção de dependência
    public function __construct(?User $userModel = null)
    {
        $this->userModel = $userModel ?: new User();
    }

    // REGISTRO DE USUÁRIO
    public function createUser($user_name, $user_email, $user_cpf, $user_password)
    {
        if (empty($user_name) or empty($user_email) or empty($user_cpf) or empty($user_password)) {
            return false;
        }

        return $this->userModel->registerUser($user_name, $user_email, $user_cpf, $user_password);
    }

    // E-MAIL JÁ CADASTRADO?
    public function checkUserByEmail($user_email)
    {
         return $this->userModel->getUserByEmail($user_email);
    }

    // LOGIN DE USUÁRIO - ATUALIZADO
    public function login($email, $password)
    {
        $user = $this->userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['user_fullname'] = $user['user_name']; // Novo campo para testes
            $_SESSION['user_name'] = $user['user_name'];     // Mantido para compatibilidade
            $_SESSION['email'] = $user['user_email'];        // Novo campo para testes  
            $_SESSION['user_email'] = $user['user_email'];   // Mantido para compatibilidade
            return true;
        }
        return false;
    }

    // USUÁRIO LOGADO?
    public function isLoggedIn()
    {
        return isset($_SESSION['id']);
    }

    // RESGATAR DADOS DO USUÁRIO
    public function getUserData($id, $user_name, $user_email)
    {
        return $this->userModel->getUserInfo($id, $user_name, $user_email);
    }

    public function getFirstUser() {
        return $this->userModel->getFirstUser();
    }
} 