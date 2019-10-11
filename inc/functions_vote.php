<?php
/**
 * Functions to interface with `votes` table
 */
function getUserVote($bookId, $userId = 0) {
  global $db;
  
  try {
        $query = "SELECT value FROM votes "
          . " WHERE book_id = :bookId"
          . " AND user_id = :userId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':bookId', $bookId);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    } catch (\Exception $e) {
        throw $e;
    }
}
function vote($bookId, $score, $userId = 0)
{
    global $db;
    if (clearVote($bookId, $userId)) {
        return true;
    }

    try {
        $query = 'INSERT INTO votes (book_id, user_id, value) VALUES (:bookId, :userId, :score)';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':bookId', $bookId);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':score', $score);
        $stmt->execute();
    } catch (\Exception $e) {
        throw $e;
    }
}
function clearVote($bookId, $userId)
{
    global $db;

    try {
        $query = "DELETE FROM votes WHERE book_id = :bookId AND user_id = :userId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':bookId', $bookId);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->rowCount();
    } catch (\Exception $e) {
        throw $e;
    }
}