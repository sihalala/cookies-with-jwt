<?php
/*
 * Functions to interface with `user` table
 */
function getAllUsers()
{
    global $db;

    try {
        $query = "SELECT * FROM users";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (\Exception $e) {
        throw $e;
    }
}
function findUserByUsername($username)
{
    global $db;

    try {
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch();

    } catch (\Exception $e) {
        throw $e;
    }
}
function findUserById($userId)
{
    global $db;

    try {
        $query = "SELECT * FROM users WHERE id = :userId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetch();

    } catch (\Exception $e) {
        throw $e;
    }
}
function createUser($username, $password)
{
    global $db;

    try {
        $query = "INSERT INTO users (username, password, role_id) VALUES (:username, :password, 2)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return findUserByUsername($username);
    } catch (\Exception $e) {
        throw $e;
    }
}
function updatePassword($password, $userId)
{
    global $db;

    try {
        $query = 'UPDATE users SET password = :password WHERE id = :userId';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
          return true;
        } else {
          return false;
        }
    } catch (\Exception $e) {
        throw $e;
    }

    return true;
}

function changeRole($userId, $roleId)
{
    global $db;

    try {
        $query = "UPDATE users SET role_id = :roleId WHERE id = :userId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':roleId', $roleId);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return findUserById($userId);
    } catch (\Exception $e) {
        throw $e;
    }
}