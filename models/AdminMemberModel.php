<?php
require_once __DIR__ . '/../config/db.php';

class AdminMemberModel {

    public static function approve($request_id) {
        global $pdo;

        $stmt = $pdo->prepare("
            SELECT * FROM family_member_requests 
            WHERE request_id = ?
        ");
        $stmt->execute([$request_id]);
        $req = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$req) return false;

        // Insert into family_member (MATCH YOUR TABLE)
        $insert = $pdo->prepare("
            INSERT INTO family_member
            (family_id, user_id, full_name, age, sex, is_in_evacuation)
            VALUES (?, ?, ?, NULL, NULL, 0)
        ");

        $insert->execute([
            $req['family_id'],
            $req['requested_by'],
            $req['full_name']
        ]);

        // Update status
        $update = $pdo->prepare("
            UPDATE family_member_requests
            SET status = 'approved'
            WHERE request_id = ?
        ");

        return $update->execute([$request_id]);
    }

    public static function reject($request_id) {
        global $pdo;

        $stmt = $pdo->prepare("
            UPDATE family_member_requests
            SET status = 'rejected'
            WHERE request_id = ?
        ");

        return $stmt->execute([$request_id]);
    }
}
