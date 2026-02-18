<?php
require_once __DIR__ . '/../config/db.php';

class FamilyModel {

    /* find family where user is OWNER */
    public static function getUserFamilyId($user_id) {
        global $pdo;

        $stmt = $pdo->prepare("
            SELECT family_id
            FROM family
            WHERE user_id = ?
            LIMIT 1
        ");

        $stmt->execute([$user_id]);
        return $stmt->fetchColumn() ?: null;
    }

    public static function getFamilyMembers($family_id) {
        global $pdo;

        $stmt = $pdo->prepare("
            SELECT *
            FROM family_member
            WHERE family_id = ?
        ");

        $stmt->execute([$family_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function userHasFamily($user_id) {
        return self::getUserFamilyId($user_id) !== null;
    }
}
