<?php

require 'models/EvacuationModel.php';
require 'config/database.php';

class EvacuationController {

    private $model;

    public function __construct() {
        global $conn;
        $this->model = new EvacuationModel($conn);
    }

    /* ==============================
       DASHBOARD
    ============================== */
    public function index() {

        $centers = $this->model->getAllCenters();

        require 'views/evacdash.php';
    }

    /* ==============================
       SEARCH FAMILY
    ============================== */
    public function search() {

        $keyword = $_POST['keyword'];
        $center_id = $_POST['center_id'];

        $families = $this->model->searchFamily($keyword);

        require 'views/search_results.php';
    }

    /* ==============================
       SHOW MEMBERS
    ============================== */
    public function showMembers() {

        $family_id = $_GET['family_id'];
        $center_id = $_GET['center_id'];

        $members = $this->model->getFamilyMembers($family_id);

        require 'views/family_members.php';
    }

    /* ==============================
       CONFIRM MEMBER CHECKIN
    ============================== */
    public function checkinMember() {

        $center_id = $_POST['center_id'];
        $member_id = $_POST['member_id'];

        $this->model->checkInMember($center_id, $member_id);

        header("Location: index.php?controller=evacuation");
        exit;
    }

    /* ==============================
       WALK-IN CHECKIN
    ============================== */
    public function walkin() {

        $center_id = $_POST['center_id'];
        $name = $_POST['walkin_name'];

        $this->model->checkInWalkin($center_id, $name);

        header("Location: index.php?controller=evacuation");
        exit;
    }

    /* ==============================
       CHECK OUT
    ============================== */
    public function checkout() {

        $checkin_id = $_GET['id'];

        $this->model->checkOut($checkin_id);

        header("Location: index.php?controller=evacuation");
        exit;
    }
}
