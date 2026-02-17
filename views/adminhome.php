<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Command Center</title>
<link rel="stylesheet" href="adminhome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

</head>


<body>

<div class="page">

    <!-- HEADER -->
    <div class="topbar">
        <div>
            <h1>Command Center</h1>

        </div>
    </div>

    <!-- ALERT BANNER -->
    <div class="alert-banner">
        <i class="fas fa-exclamation-triangle"></i>
        <div>
            <strong>Critical Alert: Typhoon Maria Intensifying</strong>
            <div>Expected landfall in 6 hours. All evacuation centers on standby. Storm surge warning in coastal barangays.</div>
        </div>
    </div>

    <!-- SUMMARY CARDS -->
    <div class="cards">

        <div class="card">
            <div class="icon red"><i class="fas fa-exclamation-triangle"></i></div>
            <div>
                <div class="card-title">Active Hazards</div>
                <div class="card-value count" data-target = "40"> 0 </div>
                <div class="card-sub">+5 in last hour</div>
            </div>
        </div>

        <div class="card">
            <div class="icon teal"><i class="fas fa-users"></i></div>
            <div>
                <div class="card-title">Total Evacuees</div>
                <div class="card-value count" data-target = "1247"> 0 </div>
                <div class="card-sub">+127 today</div>
            </div>
        </div>

        <div class="card">
            <div class="icon orange"><i class="fas fa-map-marker-alt"></i></div>
            <div>
                <div class="card-title">Evacuation Centers</div>
                <div class="card-value">
                    <span class="count" data-target="12"></span>15
                </div>

                <div class="card-sub">3 at capacity</div>
            </div>
        </div>

        <div class="card">
            <div class="icon green"><i class="fas fa-box"></i></div>
            <div>
                <div class="card-title">Relief Items</div>
                <div class="card-value count" data-target = "6350"> 0 </div>
                <div class="card-sub">85% distributed</div>
            </div>
        </div>

    </div>

    <!-- CHART GRID -->
    <div class="grid">

        <!-- LINE CHART -->
<div class="panel">
    <div class="panel-head">
        <h3>Evacuation Trend</h3>
        <i class="fas fa-chart-line"></i>
    </div>
    <p class="panel-sub">Last 24 hours</p>

    <div class="trend-chart-wrap">

        <!-- Y AXIS RULER -->
        <div class="trend-yaxis">
            <span>1400</span>
            <span>1050</span>
            <span>700</span>
            <span>350</span>
            <span>0</span>
        </div>

        <!-- CHART -->
        <div class="line-chart">

            <svg class="trend-line" viewBox="0 0 100 100" preserveAspectRatio="none">
                <polyline points="5,80 20,65 35,50 50,40 65,28 80,15 95,5"/>
            </svg>

            <div class="dot" style="left:5%; bottom:20%"></div>
            <div class="dot" style="left:20%; bottom:35%"></div>
            <div class="dot" style="left:35%; bottom:50%"></div>
            <div class="dot" style="left:50%; bottom:60%"></div>
            <div class="dot" style="left:65%; bottom:72%"></div>
            <div class="dot" style="left:80%; bottom:85%"></div>
            <div class="dot" style="left:95%; bottom:95%"></div>

            <!-- TIME LABELS -->
            <div class="trend-xaxis">
                <span>00:00</span>
                <span>04:00</span>
                <span>08:00</span>
                <span>12:00</span>
                <span>16:00</span>
                <span>20:00</span>
                <span>24:00</span>
            </div>

        </div>
    </div>
</div>


        <!-- PIE -->
        <div class="panel">
            <div class="panel-head">
                <h3>Resource Distribution</h3>
                <i class="fas fa-cube"></i>
            </div>
            <p class="panel-sub">Current inventory</p>

            <div class="pie"></div>

            <div class="legend">
                <div><span class="dot c1"></span> Food Packs — 38%</div>
                <div><span class="dot c2"></span> Water — 28%</div>
                <div><span class="dot c3"></span> Medicine — 15%</div>
                <div><span class="dot c4"></span> Blankets — 19%</div>
            </div>
        </div>

    </div>

   <!-- BAR CHART -->
<div class="panel full">
    <div class="panel-head">
        <h3>Active Hazards by Type</h3>
        <i class="fas fa-exclamation-triangle"></i>
    </div>

    <p class="panel-sub">Current reported incidents</p>

    <div class="hazard-chart-wrap">

        <!-- Y AXIS -->
        <div class="hazard-yaxis">
            <span>16</span>
            <span>12</span>
            <span>8</span>
            <span>4</span>
            <span>0</span>
        </div>

        <!-- BARS -->
        <div class="hazard-chart">

            <!-- Flooding = 12 -->
            <div class="hazard-bar-wrap">
                <div class="hazard-bar" style="height:75%"></div>
                <label>Flooding</label>
            </div>

            <!-- Landslide = 5 -->
            <div class="hazard-bar-wrap">
                <div class="hazard-bar" style="height:31%"></div>
                <label>Landslide</label>
            </div>

            <!-- Road Block = 8 -->
            <div class="hazard-bar-wrap">
                <div class="hazard-bar" style="height:50%"></div>
                <label>Road Block</label>
            </div>

            <!-- Power Out = 15 -->
            <div class="hazard-bar-wrap">
                <div class="hazard-bar" style="height:94%"></div>
                <label>Power Out</label>
            </div>

        </div>
    </div>
</div>


    <!-- TABLE -->
    <div class="panel full">
        <div class="panel-head">
            <h3>Evacuation Center Status</h3>
            <button class="btn-view">
    <i class="fas fa-arrow-right"></i> View All
</button>
        </div>

        <table>
            <tr>
                <th>Center Name</th>
                <th>Capacity</th>
                <th>Occupied</th>
                <th>Utilization</th>
                <th>Status</th>
            </tr>

            <tr>
                <td>Barangay Hall #1</td>
                <td>500</td>
                <td>320</td>
                <td><div class="progress"><div style="width:64%"></div></div> 64%</td>
                <td><span class="status ok">AVAILABLE</span></td>
            </tr>

            <tr>
                <td>School Gym</td>
                <td>300</td>
                <td>285</td>
                <td><div class="progress red"><div style="width:95%"></div></div> 95%</td>
                <td><span class="status warn">NEAR FULL</span></td>
            </tr>

            <tr>
                <td>Community Center</td>
                <td>400</td>
                <td>398</td>
                <td><div class="progress red"><div style="width:100%"></div></div> 100%</td>
                <td><span class="status bad">FULL</span></td>
            </tr>

            <tr>
    <td>Sports Complex</td>
    <td>600</td>
    <td>324</td>
    <td>
        <div class="progress">
            <div style="width:54%"></div>
        </div>
        54%
    </td>
    <td><span class="status ok">AVAILABLE</span></td>
</tr>


        </table>
    </div>

    <!-- QUICK ACTIONS -->
<div class="quick-actions">

    <a href="#" class="qa-card">
        <i class="fas fa-location-dot"></i>
        <div class="qa-text">
            <div class="qa-title">View Live Map</div>
            <div class="qa-sub">Monitor all incidents</div>
        </div>
    </a>

    <a href="#" class="qa-card">
        <i class="fas fa-box"></i>
        <div class="qa-text">
            <div class="qa-title">Manage Resources</div>
            <div class="qa-sub">Track supplies</div>
        </div>
    </a>

    <a href="#" class="qa-card">
        <i class="fas fa-users"></i>
        <div class="qa-text">
            <div class="qa-title">Family Tracking</div>
            <div class="qa-sub">Monitor evacuees</div>
        </div>
    </a>

    <a href="#" class="qa-card">
        <i class="fas fa-arrow-trend-up"></i>
        <div class="qa-text">
            <div class="qa-title">View Analytics</div>
            <div class="qa-sub">Detailed reports</div>
        </div>
    </a>

</div>


</div>

<script src = "adminhome.js"> </script>
</body>
</html>


<?php include 'footer.php'; ?>
