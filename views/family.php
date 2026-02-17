<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Family Tracking & Food Rations</title>
<link rel="stylesheet" href="family.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

</head>

<body>

<div class="page">

    <!-- HEADER -->
<div class="topbar">
    <div>
        <h1>Family Tracking & Food Rations</h1>
    </div>
    <button class="btn-primary" id="openModalBtn">+ Register</button>
</div>

<div id="registerModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeModalBtn">&times;</span>
        <h2 style="color: var(--accent-green);">Register Family</h2>
        <hr style="border: 0; border-top: 1px solid var(--border-subtle); margin: 15px 0;">
        
        <form id="registerForm">
            <div class="form-group"><label>First Name:</label><input type="text" name="firstname" required></div>
            <div class="form-group"><label>Last Name:</label><input type="text" name="lastname" required></div>
            <div class="form-group"><label>Address:</label><input type="text" name="address" required></div>
            <div class="form-group"><label>Age:</label><input type="number" name="age" required></div>
            <div class="form-group"><label>Date of Birth:</label><input type="date" name="dob" required></div>
            
            <div class="form-group">
                <label>Sex:</label>
                <div style="display: flex; gap: 20px; font-size: 14px;">
                    <label style="font-weight: 400;"><input type="radio" name="sex" value="Male" required> Male</label>
                    <label style="font-weight: 400;"><input type="radio" name="sex" value="Female"> Female</label>
                </div>
            </div>

            <button type="submit" class="btn-primary" style="width:100%; padding: 14px; margin-top: 10px;">Save Registration</button>
        </form>
    </div>
</div>

<div id="successModal" class="modal">
    <div class="modal-content" style="text-align: center; max-width: 300px;">
        <div style="font-size: 50px; color: #2e8b57; margin-bottom: 10px;">
            <i class="fas fa-check-circle"></i>
        </div>
        <h2 style="color: var(--accent-green); margin-bottom: 10px;">Success!</h2>
        <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 20px;">
            Family has been registered successfully.
        </p>
        <button id="closeSuccessBtn" class="btn-primary" style="width: 100%;">Great!</button>
    </div>
</div>


    <!-- SUMMARY CARDS -->
    <div class="cards">

       <div class="card">
    <div class="card-icon"><i class="fas fa-users"></i></div>
    <div>
        <div class="card-title">Total Families</div>
        <div class="card-value" data-count = "247"> 0 </div>
        <div class="card-sub">Active evacuees</div>
    </div>
</div>

<div class="card">
    <div class="card-icon green"><i class="fas fa-user-check"></i></div>
    <div>
        <div class="card-title">Total Individuals</div>
        <div class="card-value" data-count = "1247"> 0 </div>
        <div class="card-sub">Including children</div>
    </div>
</div>

<div class="card">
    <div class="card-icon orange"><i class="fas fa-utensils"></i></div>
    <div>
        <div class="card-title">Food Rations Today</div>
        <div class="card-value" data-count = "542"> 0 </div>
        <div class="card-sub success">85% distributed</div>
    </div>
</div>

<div class="card">
    <div class="card-icon blue"><i class="fas fa-hands-helping"></i></div>
    <div>
        <div class="card-title">Special Needs</div>
        <div class="card-value" data-count = "78"> 0 </div>
        <div class="card-sub">Require attention</div>
    </div>
</div>


    </div>


    <!-- CHART SECTION -->
    <div class="charts">

        <div class="panel">
    <h3>Food Rations by Evacuation Center</h3>

    <div class="bar-chart">

        <div class="bar-wrap">
            <div class="bar" data-height = "140">
                <span class="bar-value">140</span>
            </div>

            <label>Barangay Hall #1</label>
        </div>

        <div class="bar-wrap">
            <div class="bar" data-height = "95">
                <span class="bar-value">95</span>
            </div>
            <label>School Gym</label>
        </div>

        <div class="bar-wrap">
            <div class="bar" data-height = "130">
                <span class="bar-value">130</span>
            </div>
            <label>Community Center</label>
        </div>

        <div class="bar-wrap">
            <div class="bar" data-height = "165">
                <span class="bar-value">165</span>
            </div>
            <label>Sports Complex</label>
        </div>

    </div>
</div>


        <div class="panel">
    <h3>Evacuee Demographics</h3>

    <div class="pie"></div>

    <div class="legend">

        <div class="legend-item">
            <span class="dot adults"></span>
            Adults — 54%
        </div>

        <div class="legend-item">
            <span class="dot children"></span>
            Children — 31%
        </div>

        <div class="legend-item">
            <span class="dot seniors"></span>
            Seniors — 12%
        </div>

        <div class="legend-item">
            <span class="dot infants"></span>
            Infants — 4%
        </div>

    </div>
</div>


    </div>


    <!-- SEARCH -->
<div class="search-row">

    <input type="text" placeholder="Search by family name, head of family, or ID...">

    <button class="btn-secondary">
        <i class="fas fa-download"></i> Export
    </button>

</div>



    <!-- TABLE -->
    <div class="table-panel">

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Family Name</th>
                <th>Head of Family</th>
                <th>Members</th>
                <th>Evacuation Center</th>
                <th>Rations</th>
                <th>Check-in</th>
                <th>Special Needs</th>
                <th>Status</th>
            </tr>
            </thead>

            <tbody id="familyTable">

            <tr>
                <td>F-001</td>
                <td>Dela Cruz Family</td>
                <td>Juan Dela Cruz</td>
                <td>5 <span class="tag">2 children</span> <span class="tag">1 senior</span></td>
                <td>Barangay Hall #1</td>
                <td>3/10 <div class="progress"><div style="width:30%"></div></div></td>
                <td>1/10/2025</td>
                <td><span class="need">Senior (Medication)</span></td>
                <td><span class="status active">ACTIVE</span></td>
            </tr>

            <tr>
                <td>F-002</td>
                <td>Santos Family</td>
                <td>Maria Santos</td>
                <td>3 <span class="tag">1 child</span></td>
                <td>School Gym</td>
                <td>2/10 <div class="progress"><div style="width:20%"></div></div></td>
                <td>1/11/2025</td>
                <td><span class="need">Infant (Formula)</span></td>
                <td><span class="status active">ACTIVE</span></td>
            </tr>

            <tr>
                <td>F-003</td>
                <td>Reyes Family</td>
                <td>Pedro Reyes</td>
                <td>4 <span class="tag">2 seniors</span></td>
                <td>Community Center</td>
                <td>5/10 <div class="progress"><div style="width:50%"></div></div></td>
                <td>1/9/2025</td>
                <td><span class="need">Diabetic Diet</span></td>
                <td><span class="status active">ACTIVE</span></td>
            </tr>

            <tr>
                <td>F-004</td>
                <td>Garcia Family</td>
                <td>Ana Garcia</td>
                <td>6 <span class="tag">3 children</span></td>
                <td>Sports Complex</td>
                <td>4/10 <div class="progress"><div style="width:40%"></div></div></td>
                <td>1/11/2025</td>
                <td>None</td>
                <td><span class="status active">ACTIVE</span></td>
            </tr>

            <tr>
                <td>F-005</td>
                <td>Lopez Family</td>
                <td>Carlos Lopez</td>
                <td>2</td>
                <td>Barangay Hall #1</td>
                <td>10/10 <div class="progress"><div style="width:100%"></div></div></td>
                <td>1/8/2025</td>
                <td>None</td>
                <td><span class="status done">DISCHARGED</span></td>
            </tr>

            <tr class="page-2">
                <td>F-006</td>
                <td>Navarro Family</td>
                <td>Luis Navarro</td>
                <td>4 <span class="tag">1 senior</span></td>
                <td>School Gym</td>
                <td>6/10 <div class="progress"><div style="width:60%"></div></div></td>
                <td>1/12/2025</td>
                <td><span class="need">Hypertension</span></td>
                <td><span class="status active">ACTIVE</span></td>
            </tr>

            <tr class="page-2">
                <td>F-007</td>
                <td>Morales Family</td>
                <td>Elena Morales</td>
                <td>3 <span class="tag">1 infant</span></td>
                <td>Barangay Hall #1</td>
                <td>3/10 <div class="progress"><div style="width:30%"></div></div></td>
                <td>1/12/2025</td>
                <td><span class="need">Infant Formula</span></td>
                <td><span class="status active">ACTIVE</span></td>
            </tr>

            </tbody>
        </table>

        <div class="pagination">
            <span id="pageInfo">Showing page 1 of 2</span>

                <div class="pages">
                    <button id="prevBtn">Previous</button>
                    <button class="current" id="page1">1</button>
                    <button id="page2">2</button>
                    <button id="nextBtn">Next</button>
                </div>
            </div>


    </div>

</div>

<script src = "/httpdocs/js/family.js"></script>
</body>
</html>


<?php include 'footer.php'; ?>
