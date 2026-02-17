<?php require 'header.php'; ?>
<link rel="stylesheet" href="../views/signup.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<main class="signup-page">
  <div class="signup-container">

    <!-- LEFT FORM -->
    <section class="form-section">
      <h1>Welcome Admin!</h1>
      <p class="subtitle">Please make an account.</p>

       <?php if (isset($_GET['error'])): ?>
    <div class="form-error">Admin signup failed. Email may already exist.</div>
<?php endif; ?>
      <form action="/httpdocs/controllers/admin_signup_process.php" method="POST">

        <div class="input-group">
          <label>First Name</label>
          <input type="text" name="firstname" placeholder="Enter your first name" required>
        </div>

        <div class="input-group">
          <label>Last Name</label>
          <input type="text" name="lastname" placeholder="Enter your last name" required>
        </div>

        <div class="input-group">
          <label>Email Address</label>
          <input type="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="input-group">
          <label>Position/Role</label>
            <select name="role" required>
              <option value="" disabled selected>Select your role</option>
              <option value="Barangay Captain">Barangay Captain</option>
              <option value="Barangay Staff">Barangay Staff</option>
              <option value="Barangay SK"> Barangay SK Chairman</option>
              <option value="DRRM Officer">DRRM Officer</option>
              <option value="Administrator">Administrator</option>
            </select>
        </div>


        <div class="input-group">
          <label>Employee/Barangay ID</label>
          <input type="text" name="empid" placeholder="Enter your number" required>
        </div>

        <div class="input-group">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter password" required>
        </div>

        <p class="login-link">
          Already have an account? <a href="adminsignin.php">Log In</a>
        </p>

        <button type="submit" class="signup-btn">Sign Up</button>

      </form>
    </section>

    <!-- RIGHT IMAGE -->
    <section class="image-section">
      <img src="../assets/1stBG.jpg" alt="">
    </section>

  </div>
</main>

<?php require '../views/footer.php'; ?>
