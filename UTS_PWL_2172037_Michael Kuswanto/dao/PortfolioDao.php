<?php

namespace dao;

use entity\Portfolio;
use PDO;
class PortfolioDao
{
    function fetchPortfolioFromDb(): bool|array
    {
        $link = PDOUtil::createMySQLConnection();
        $query = "SELECT created_at, title, contribution, description, place, certificate 
            FROM portfolio";
        $stmt = $link->prepare($query);
        $stmt -> setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Portfolio::class);
        $stmt ->execute();
        $result = $stmt->fetchAll();
        $link = null;
        return $result;
    }

    function addNewPortfolio (Portfolio $portfolio): int
    {
        $result = 0;
        $link = PDOUtil::createMySQLConnection();
        $link->beginTransaction();
        $query = 'INSERT INTO portfolio(created_at, title, contribution, description, place, certificate) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1,$portfolio->getCreatedAt());
        $stmt->bindValue(2,$portfolio->getTitle());
        $stmt->bindValue(3,$portfolio->getContribution());
        $stmt->bindValue(4,$portfolio->getDescription());
        $stmt->bindValue(5,$portfolio->getPlace());
        $stmt->bindValue(6,$portfolio->getCertificate());
        if ($stmt->execute()) {
            $link->commit();
            $result = 1;
        } else {
            $link->rollBack();
        }
        $link = null;
        return $result;
    }

    function fetchOnePortfolio($created_at) {
        $link = PDOUtil::createMySQLConnection();
        $query = 'SELECT created_at, title, contribution, description, place, certificate FROM book WHERE created_at = ?';
        $stmt = $link->prepare($query);
        $stmt ->bindParam(1,$created_at);
        $stmt ->setFetchMode(PDO::FETCH_OBJ);
        $stmt ->execute();
        $result = $stmt->fetchObject(Portfolio::class);
        $link = null;
        return $result;
    }

    function updatePortfolioToDb (Portfolio $portfolio): int
    {
        $result = 0;
        $link = PDOUtil::createMySQLConnection();
        $link->beginTransaction();
        $query = 'UPDATE book SET title = ?, author = ?, publisher = ?, publish_year = ?, short_description = ?, genre_id = ? WHERE  isbn = ?';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1,$book->getTitle());
        $stmt->bindValue(2,$book->getAuthor());
        $stmt->bindValue(3,$book->getPublisher());
        $stmt->bindValue(4,$book->getYear());
        $stmt->bindValue(5,$book->getDescription());
        $stmt->bindValue(6,$book->getGenre());
        $stmt->bindValue(7,$book->getIsbn());
        if ($stmt ->execute()) {
            $link->commit();
            $result = 1;
        } else {
            $link->rollBack();
        }
        $link = null;
        return $result;
    }

    function deletePortfolioToDb ($isbn): int
    {
        $result = 0;
        $link = PDOUtil::createMySQLConnection();
        $link->beginTransaction();
        $query = 'DELETE FROM book WHERE isbn = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1,$isbn);
        if ($stmt ->execute()) {
            $link->commit();
            $result = 1;
        } else {
            $link->rollBack();
        }
        $link = null;
        return $result;
    }
}