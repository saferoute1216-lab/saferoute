<?php
require_once __DIR__ . '/../config/db.php';

class FamilyMemberRequestModel {

    public static function createRequest(
        $requested_by,
        $family_id,
        $full_name,
        $relationship,
        $contact,
        $address,
        $proof_file = null
    ) {
        global $pdo;

        $stmt = $pdo->prepare("
            INSERT INTO family_member_requests
            (requested_by, family_id, full_name, relationship, contact, address, proof_file, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')
        ");

        return $stmt->execute([
            $requested_by,
            $family_id,
            $full_name,
            $relationship,
            $contact,
            $address,
            $proof_file
        ]);
    }

}
