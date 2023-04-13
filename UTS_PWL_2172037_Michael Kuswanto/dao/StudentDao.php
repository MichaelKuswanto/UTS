<?php
/** Kuis PWL
Michael Kuswanto - 2172037 **/
namespace dao;

use PDO;
use entity\Student;

class StudentDao
{
    public function login ($id, $password)
    {
        $link = PDOUtil::createMySQLConnection();
        $query = 'SELECT id, name, department, address, birthDate FROM student WHERE id = ? AND password = MD5(?)';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $password);
        $stmt->setFetchMode(\PDO::FETCH_OBJ);
        $stmt->execute();
        $student = $stmt->fetchObject('entity\Student');
        $link = null;
        return $student;
    }

    public function fetchOneName($id)
    {
        $link = PDOUtil::createMySQLConnection();
        $query = 'SELECT name FROM student WHERE id = ?';
        $stmt = $link->prepare($query);
        $stmt ->bindParam(1,$username);
        $stmt ->setFetchMode(PDO::FETCH_OBJ);
        $stmt ->execute();
        $result = $stmt->fetchObject(Student::class);
        $link = null;
        return $result;
    }
}