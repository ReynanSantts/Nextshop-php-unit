<?php

namespace Controller;

use Model\User;
use Exception;

class ControllerUserR
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    // REGISTRO DE USUÁRIO
    public function createUser($user_name, $user_email, $user_cpf, $user_password)
    {

        if (empty($user_name) or empty($user_email) or empty($user_cpf) or empty($user_password)) {
            return false;
        }

        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $this->userModel->registerUser($user_name, $user_email, $user_cpf, $user_password);

    }

    // E-MAIL JÁ CADASTRADO?
    public function checkUserByEmail($user_email)
    {
         return $this->userModel->getUserByEmail($user_email);
    }

    // LOGIN DE USUÁRIO
    public function login($user_email, $user_password)
    {
        $user = $this->userModel->getUserByEmail($user_email);

        if ($user && password_verify($user_password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_email'] = $user['user_email'];
            var_dump($_SESSION);
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

?>