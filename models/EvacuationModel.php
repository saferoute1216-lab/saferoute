<?php

class EvacuationModel {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /* ==============================
       GET ALL CENTERS
    ============================== */
    public function getAllCenters() {
        $sql = "SELECT * FROM evacuation_center ORDER BY name ASC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* ==============================
       GET ACTIVE OCCUPANTS PER CENTER
    ============================== */
    public function getActiveOccupants($center_id) {

        $stmt = $this->conn->prepare("
            SELECT e.*, 
                   COALESCE(m.full_name, e.walkin_name) AS evacuee_name
            FROM evac_checkin e
            LEFT JOIN family_member m 
                ON e.member_id = m.member_id
            WHERE e.center_id = ? 
            AND e.checkout_time IS NULL
            ORDER BY e.checkin_time DESC
        ");

        $stmt->bind_param("i", $center_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /* ==============================
       SEARCH FAMILY BY NAME
    ============================== */
    public function searchFamily($keyword) {

        $like = "%$keyword%";

        $stmt = $this->conn->prepare("
            SELECT * FROM family
            WHERE family_name LIKE ?
        ");
        $stmt->bind_param("s", $like);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /* ==============================
       GET MEMBERS OF FAMILY
    ============================== */
    public function getFamilyMembers($family_id) {

        $stmt = $this->conn->prepare("
            SELECT * FROM family_member
            WHERE family_id = ?
        ");
        $stmt->bind_param("i", $family_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /* ==============================
       CHECK IN MEMBER
    ============================== */
    public function checkInMember($center_id, $member_id, $type = "family") {

        // Insert checkin record
        $stmt = $this->conn->prepare("
            INSERT INTO evac_checkin 
            (center_id, member_id, checkin_type, checkin_time)
            VALUES (?, ?, ?, NOW())
        ");
        $stmt->bind_param("iis", $center_id, $member_id, $type);
        $stmt->execute();

        // Increase occupancy
        $this->conn->query("
            UPDATE evacuation_center 
            SET current_occupancy = current_occupancy + 1
            WHERE center_id = $center_id
        ");
    }

    /* ==============================
       CHECK IN WALK-IN
    ============================== */
    public function checkInWalkin($center_id, $name) {

        $stmt = $this->conn->prepare("
            INSERT INTO evac_checkin 
            (center_id, walkin_name, checkin_type, checkin_time)
            VALUES (?, ?, 'walkin', NOW())
        ");
        $stmt->bind_param("is", $center_id, $name);
        $stmt->execute();

        $this->conn->query("
            UPDATE evacuation_center 
            SET current_occupancy = current_occupancy + 1
            WHERE center_id = $center_id
        ");
    }

    /* ==============================
       CHECK OUT
    ============================== */
    public function checkOut($checkin_id) {

        // Get center id first
        $result = $this->conn->query("
            SELECT center_id 
            FROM evac_checkin
            WHERE checkin_id = $checkin_id
        ");
        $row = $result->fetch_assoc();
        $center_id = $row['center_id'];

        // Update checkout time
        $this->conn->query("
            UPDATE evac_checkin
            SET checkout_time = NOW()
            WHERE checkin_id = $checkin_id
        ");

        // Decrease occupancy
        $this->conn->query("
            UPDATE evacuation_center
            SET current_occupancy = current_occupancy - 1
            WHERE center_id = $center_id
        ");
    }
}
