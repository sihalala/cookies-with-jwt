<?php
/*
 * Functions to interface with `books` table
 */
function getAllBooks()
{
    global $db;

    try {
        $query = "SELECT books.*, COALESCE(SUM(votes.value),0) as score "
            . " FROM books "
            . " LEFT JOIN votes ON (books.id = votes.book_id) "
            . " GROUP BY books.id "
            . " ORDER BY score DESC";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (\Exception $e) {
        throw $e;
    }
}

function getBook($id)
{
    global $db;

    try {
        $query = "SELECT * FROM books WHERE id = :bookId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':bookId', $id);
        $stmt->execute();
        return $stmt->fetch();
    } catch (\Exception $e) {
        throw $e;
    }
}

function addBook($title, $description, $ownerId = null)
{
    global $db;
    if (empty($ownerId)) {
        $ownerId = 0;
    }

    try {
        $query = "INSERT INTO books (name, description, owner_id) VALUES (:name, :description, :ownerId)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':ownerId', $ownerId);
        return $stmt->execute();
    } catch (\Exception $e) {
        throw $e;
    }
}

function updateBook($bookId, $title, $description)
{
    global $db;

    try {
        $query = "UPDATE books SET name=:name, description=:description WHERE id=:bookId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':bookId', $bookId);
        return $stmt->execute();
    } catch (\Exception $e) {
        throw $e;
    }
}

function deleteBook($bookId)
{
    global $db;

    try {
        $query = "DELETE FROM books WHERE id=:bookId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':bookId', $bookId);
        return $stmt->execute();
    } catch (\Exception $e) {
        throw $e;
    }
}