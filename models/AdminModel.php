<?php
require_once __DIR__ . '/../config/db.php';

class AdminModel {

    public static function getById($id) {
        global $pdo;

        $stmt = $pdo->prepare("
            SELECT admin_id, first_name, last_name, email, position, barangay_id
            FROM admins
            WHERE admin_id = ?
        ");
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $data) {
        global $pdo;

        $stmt = $pdo->prepare("
            UPDATE admins
            SET first_name = ?, last_name = ?, email = ?
            WHERE admin_id = ?
        ");

        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $id
        ]);
    }

    public static function delete($id) {
        global $pdo;

        $stmt = $pdo->prepare("
            DELETE FROM admins
            WHERE admin_id = ?
        ");

        return $stmt->execute([$id]);
    }
}
