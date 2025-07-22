<?php
/**
 * Classe modelo User para representar e manipular dados de usuários.
 * Preparada para futura integração com banco de dados MySQL.
 */

class User {
    private $id;
    private $nome;
    private $email;
    private $senhaHash;
    private $criadoEm;

    public function __construct($nome = null, $email = null, $senhaHash = null) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senhaHash = $senhaHash;
    }

    // Getters e setters
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSenhaHash() {
        return $this->senhaHash;
    }

    public function setSenhaHash($senhaHash) {
        $this->senhaHash = $senhaHash;
    }

    public function getCriadoEm() {
        return $this->criadoEm;
    }

    // Métodos para futura integração com banco de dados podem ser adicionados aqui
}
?>
