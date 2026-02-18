<?php
require_once __DIR__ . '/../config/db.php';

class FamilyRequestModel {

    // -------------------
    // USER → submit request
    // -------------------
    public static function createRequest($data) {
        global $pdo;

        $sql = "INSERT INTO family_requests
                (requested_by, family_name, address, barangay, proof_file, status)
                VALUES (?, ?, ?, ?, ?, 'pending')";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $data['requested_by'],
            $data['family_name'],
            $data['address'],
            $data['barangay'],
            $data['proof_file']
        ]);
    }


    // -------------------
    // ADMIN → get pending list
    // -------------------
    public static function getPending() {
        global $pdo;

        $sql = "SELECT fr.*, u.first_name, u.last_name, u.email
                FROM family_requests fr
                JOIN userinfo u ON fr.requested_by = u.id
                WHERE fr.status = 'pending'
                ORDER BY fr.submitted_at DESC";

        return $pdo->query($sql)->fetchAll();
    }


    // -------------------
    // ADMIN → approve request
    // -------------------
public static function approve($request_id) {
    global $pdo;

    $pdo->beginTransaction();

    // get request data
    $stmt = $pdo->prepare("SELECT * FROM family_requests WHERE request_id = ?");
    $stmt->execute([$request_id]);
    $req = $stmt->fetch();

    if (!$req) {
        $pdo->rollBack();
        return false;
    }

    // insert into family table
    $stmt = $pdo->prepare("
        INSERT INTO family (user_id, family_name, address, barangay)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([
        $req['requested_by'],
        $req['family_name'],
        $req['address'],
        $req['barangay']
    ]);

    $family_id = $pdo->lastInsertId();

    // insert requester as first family member
    $stmt = $pdo->prepare("
        INSERT INTO family_member (family_id, full_name, age, sex, is_in_evacuation)
        SELECT ?, CONCAT(first_name,' ',last_name), age, sex, 0
        FROM userinfo WHERE id = ?
    ");

    $stmt->execute([$family_id, $req['requested_by']]);

    // ✅ DELETE request instead of updating status
    $stmt = $pdo->prepare("DELETE FROM family_requests WHERE request_id = ?");
    $stmt->execute([$request_id]);

    $pdo->commit();
    return true;
}

    // -------------------
    // ADMIN → reject request
    // -------------------
public static function reject($request_id) {
    global $pdo;

    $stmt = $pdo->prepare("
        DELETE FROM family_requests
        WHERE request_id = ?
    ");

    return $stmt->execute([$request_id]);
}
}
