session_start();
require_once __DIR__ . '/../models/FamilyRequestModel.php';

$action = $_GET['action'] ?? null;

if ($action === 'approve') {
    FamilyRequestModel::approve($_GET['id']);
    header("Location: ../views/family.php");
    exit;
}

if ($action === 'reject') {
    FamilyRequestModel::reject($_GET['id']);
    header("Location: ../views/family.php");
    exit;
}

$requests = FamilyRequestModel::getPending();

require_once __DIR__ . '/../views/family.php';
