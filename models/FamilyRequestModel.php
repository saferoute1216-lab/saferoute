<?php
require_once __DIR__ . '/../config/db.php';

class FamilyRequestModel {

    public static function createRequest($data) {
        global $conn;

        $sql = "INSERT INTO family_requests
        (user_id, request_type, family_name, join_family_id,
         relationship, contact, address, is_head, proof_file)
        VALUES (?,?,?,?,?,?,?,?,?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ississsis",
            $data['user_id'],
            $data['request_type'],
            $data['family_name'],
            $data['join_family_id'],
            $data['relationship'],
            $data['contact'],
            $data['address'],
            $data['is_head'],
            $data['proof_file']
        );

        return $stmt->execute();
    }

}
