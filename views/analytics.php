<?php include 'header.php'; ?>

<link rel="stylesheet" href="analytics.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>

<div class="analytics-container">

    <!-- HEADER -->
    <div class="analytics-top">
        <div>
            <h1>Analytics & Reports</h1>
        </div>

        <div class="top-actions">
            <select id="rangeSelect">
                <option value="7">Last 7 Days</option>
                <option value="30">Last 30 Days</option>
                <option value="month">This Month</option>
            </select>

            <button class="export-btn">Export Report</button>
        </div>
    </div>

    <!-- KPI CARDS -->
    <div class="kpi-grid">

        <div class="kpi-card">
            <div class="kpi-head">
                <div class="kpi-icon green">
                    <i data-lucide="users"></i>
                </div>
                <span class="trend">↗</span>
            </div>
            <h3>Peak Evacuees</h3>
            <div class="kpi-value">1,247</div>
            <span class="kpi-note up">+177% increase</span>
        </div>

        <div class="kpi-card">
            <div class="kpi-head">
                <div class="kpi-icon green">
                    <i data-lucide="activity"></i>
                </div>
                <span class="trend">↗</span>
            </div>
            <h3>Avg Response Time</h3>
            <div class="kpi-value">8.2 mins</div>
            <span class="kpi-note up">32% faster than target</span>
        </div>

        <div class="kpi-card">
            <div class="kpi-head">
                <div class="kpi-icon red">
                    <i data-lucide="alert-triangle"></i>
                </div>
            </div>
            <h3>Total Hazards</h3>
            <div class="kpi-value">40</div>
            <span class="kpi-note">85% resolved</span>
        </div>

        <div class="kpi-card">
            <div class="kpi-head">
                <div class="kpi-icon orange">
                    <i data-lucide="box"></i>
                </div>
                <span class="trend">↗</span>
            </div>
            <h3>Resource Efficiency</h3>
            <div class="kpi-value">91.3%</div>
            <span class="kpi-note up">Above target</span>
        </div>

    </div>


    <!-- MAIN TREND -->
    <div class="card">
        <h2>Multi-Metric Trend Analysis</h2>
        <p class="card-sub">Evacuees, centers, and hazards over time</p>
        <canvas id="multiTrendChart"></canvas>
    </div>


    <!-- RESOURCE STACK TREND -->
    <div class="card">
        <p class="card-sub">Tracking food, water, medical supplies, and shelter items</p>
        <canvas id="resourceTrendChart"></canvas>
    </div>


    <!-- TWO COLUMN GRID -->
    <div class="grid-2x2">

        <div class="card">
            <h2>Average Response Time by Hour</h2>
            <p class="card-sub">Emergency response efficiency</p>
            <canvas id="responseChart"></canvas>
        </div>

        <div class="card">
            <h2>Hazard Distribution by Type</h2>
            <p class="card-sub">Breakdown of active incidents</p>
            <div class="pie-box">
                <canvas id="hazardChart"></canvas>
            </div>
        </div>

        <div class="card">
            <h2>Population Movement</h2>
            <p class="card-sub">Inflow and outflow at evacuation centers</p>
            <canvas id="movementChart"></canvas>
        </div>

        <div class="card">
            <h2>Evacuation Center Performance</h2>
            <p class="card-sub">Efficiency vs capacity utilization</p>
            <canvas id="centerChart"></canvas>
        </div>

    </div>


    <!-- SUMMARY -->

<div class="summary-grid">

    <div class="summary-header">Summary Statistics</div>

    <div class="summary-box">
        <span>Total Families Served</span>
        <strong>247</strong>
    </div>

    <div class="summary-box">
        <span>Relief Operations</span>
        <strong>1,542</strong>
    </div>

    <div class="summary-box">
        <span>Volunteer Hours</span>
        <strong>3,890</strong>
    </div>

    <div class="summary-box">
        <span>Avg Stay Duration</span>
        <strong>2.8 days</strong>
    </div>

</div>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="/httpdocs/js/analytics.js"></script>

<script>
lucide.createIcons();
</script>

<?php include 'footer.php'; ?>
