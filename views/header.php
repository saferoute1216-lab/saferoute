<?php require_once __DIR__ . '/../controllers/HeaderAuth.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SafeRoute Analytics</title>
  <link rel="stylesheet" href="/views/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

</head>

<body class="sidebar-collapsed">

  <header class="analytics-header">
    <div class="header-left">
      <div class="hamburger" onclick="toggleMenu()">
        <span></span><span></span><span></span>
      </div>
      <a href="/index.php">
        <img src="/imgs/logo.png" alt="SafeRoute" class="brand-logo">
      </a>
      <div class="brand-text">
		  <h1><b>SafeRoute Analytics</b></h1>
        <span class="subtext"><?= $isAdmin ? 'Admin Portal' : ($isUser ? 'User Portal' : 'Public Portal') ?></span>
      </div>
    </div>
    <div class="header-right-icon">
      <i class="fas fa-tornado"></i>
    </div>
  </header>

  <aside class="side-nav" id="sideNav">
    <nav class="nav-links">
      
      <?php if ($isUser): ?>
        <a href="home.php" class="nav-link <?= $page=='home.php'?'active':'' ?>">
          <i class="fas fa-home"></i> Home
        </a>
        <a href="map.php" class="nav-link <?= $page=='map.php'?'active':'' ?>">
          <i class="fas fa-map"></i> Live Map
        </a>
        <a href="resource.php" class="nav-link <?= $page=='resource.php'?'active':'' ?>">
          <i class="fas fa-box"></i> Resource Locator
        </a>
        <a href="evacuation.php" class="nav-link <?= $page=='evacuation.php'?'active':'' ?>">
          <i class="fas fa-hospital"></i> Evacuation Centers
        </a>

      <?php elseif ($isAdmin): ?>
        <a href="adminhome.php" class="nav-link <?= $page=='adminhome.php'?'active':'' ?>">
          <i class="fas fa-home"></i> Admin Dashboard
        </a>
        <a href="adminmap.php" class="nav-link <?= $page=='adminmap.php'?'active':'' ?>">
          <i class="fas fa-map"></i> Admin Map
        </a>
        <a href="family.php" class="nav-link <?= $page=='family.php'?'active':'' ?>">
          <i class="fas fa-users"></i> Family Tracking
        </a>
        <a href="adminresource.php" class="nav-link <?= $page=='adminresource.php'?'active':'' ?>">
          <i class="fas fa-box"></i> Manage Resources
        </a>
        <a href="analytics.php" class="nav-link <?= $page=='analytics.php'?'active':'' ?>">
          <i class="fas fa-chart-line"></i> Analytics
        </a>
      
      <?php else: ?>
        <a href="/index.php" class="nav-link">
          <i class="fas fa-sign-in-alt"></i> Sign In to Access
        </a>
      <?php endif; ?>

      <?php if ($isLoggedIn): ?>
        <div class="nav-footer">
          <a href="javascript:void(0)" id="darkModeToggle" class="nav-link">
            <i class="fas fa-moon" id="theme-icon"></i> <span id="theme-text">Dark Mode</span>
          </a>
          
          <div class="nav-divider"></div>
          
          <a href="profile.php" class="nav-link <?= $page=='profile.php'?'active':'' ?>">
            <i class="fas fa-user-circle"></i> Profile
          </a>
          <a href="?logout=true" class="nav-link">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </div>
      <?php endif; ?>

    </nav>
</aside>

  <div id="loginModal" class="modal">
    <div class="modal-content">
      <span class="close-btn">&times;</span>
      <h2>Login Required</h2>
      <p>You need to log in to access this feature.</p>
      <a href="signin.php" class="modal-login-btn">Sign In</a>
    </div>
  </div>

  <script src="/httpdocs/js/header.js"></script>
</body>

</html>
