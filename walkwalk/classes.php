<?php
class DB
{
    public $conn;
    function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    function prepare($query,$type,...$params)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($type,...$params);
        return $stmt;
    }

    function getUserByID($id)
    {
        $q = $this->prepare(
            "SELECT * FROM user WHERE id = ?",
            "i",
            $id
        );
        $q->execute();
        $res = $q->get_result();
        return $res->fetch_assoc();
    }

    function getAdminByID($id)
    {
        $q = $this->prepare(
            "SELECT * FROM admin WHERE id = ?",
            "i",
            $id
        );
        $q->execute();
        $res = $q->get_result();
        return $res->fetch_assoc();
    }

    function editUser($id,$name,$email,$password,$address,$phone)
    {
        $q = $this->prepare(
            "UPDATE user SET name=?,email=?,password=?,address=?,phone=? WHERE id = ?",
            "sssssi",
            $name,$email,$password,$address,$phone,$id
        );
        $q->execute();
        return $q;
    }

    function registerUser($name,$email,$password,$address,$phone)
    {
        $q = $this->prepare(
            "INSERT INTO user (name,email,password,address,phone) VALUES (?,?,?,?,?)",
            "sssss",
            $name,$email,$password,$address,$phone
        );
        $q->execute();
        return $q;
    }

    function loginWithEmail($email,$password)
    {
        $q = $this->prepare(
            "SELECT * FROM user WHERE email = ? AND password = ?",
            "ss",
            $email,$password
        );
        $q->execute();
        return $q;
    }

    function loginAdmin($username,$password)
    {
        $q = $this->prepare(
            "SELECT * FROM admin WHERE username = ? AND password = ?",
            "ss",
            $username,$password
        );
        $q->execute();
        return $q;
    }
}