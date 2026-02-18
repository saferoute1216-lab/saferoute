<?php
require_once __DIR__ . '/../config/db.php';

class AccountModel {

    public static function getAccountById($id) {
        global $pdo;

        $stmt = $pdo->prepare("
            SELECT first_name, last_name, email, address
            FROM userinfo
            WHERE id = ?
            LIMIT 1
        ");

        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
