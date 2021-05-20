<?php
require_once 'model/Model.php';

class User extends Model {

    public function getUserbyId($id) {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $user = $this->executeRequest($sql, array($id));
        $user = $user->fetch();
        return $user;
    }

    public function getEmailById($id) {
        $sql = "SELECT email FROM users WHERE user_id = ?";
        $user = $this->executeRequest($sql, array($id));
        $user = $user->fetch();
        return $user;
    }

    public function getIdByUsername($username) {
        $sql = "SELECT user_id FROM users WHERE username = ?";
        $id = $this->executeRequest($sql, array($username));
        $id = $id->fetch();
        return $id;
    }

    public function getIdByEmail($email) {
        $sql = "SELECT user_id FROM users WHERE email = ?";
        $id = $this->executeRequest($sql, array($email));
        $id = $id->fetch();
        return $id;
    }

    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $id = $this->executeRequest($sql, array($email));
        $id = $id->fetch();
        return $id;
    }

    public function getRoleById($id) {
        $sql = "SELECT role FROM users WHERE user_id = ?";
        $role = $this->executerequest($sql, array($id));
        $role = $role->fetch();
        return $role;
    }

    public function getRoleByEmail($email) {
        $sql = "SELECT role FROM users WHERE email = ?";
        $role = $this->executerequest($sql, array($email));
        $role = $role->fetch();
        return $role;
    }

    public function getPasswordByEmail($email) {
        $sql = "SELECT password FROM users WHERE email = ? AND confirmed_at IS NOT NULL";
        $password = $this->executeRequest($sql, array($email));
        $password = $password->fetch();
        return $password;
    }

    public function getTokenById($id) {
        $sql = "SELECT confirmation_token FROM users WHERE user_id = ?";
        $user = $this->executeRequest($sql, array($id));
        $user = $user->fetch();
        return $user['confirmation_token'];
    }

    public function setTokenById($id) {
        $sql = "UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE user_id = ?";
        $this->executeRequest($sql, array($id));
    }

    public function createUser($code, $username, $firstName, $lastName, $city, $password, $email, $token) {
        $sql = 'INSERT INTO users (code, username, email, password, contact_first_name, contact_last_name, city_id, confirmation_token) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $this->executeRequest($sql, [$code, $username, $email, $password, $firstName, $lastName, $city, $token]);
    }

    public function lastInsertId() {
        $lastId = $this->lastInsert();
        return $lastId;
    }
}