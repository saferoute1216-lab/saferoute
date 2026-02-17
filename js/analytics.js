// =========================
// GLOBAL CHART STYLE
// =========================
Chart.defaults.font.family = "Poppins";
Chart.defaults.color = "#6b7280";

// dashboard palette (from your screenshot)
const DASH = {
  deepTeal:  '#4f7f77',
  teal:      '#7fa9a3',
  sage:      '#b8c2ad',
  lightSage: '#cfd8c8',
  softGrid:  '#dfe7e3',
  softRed:   '#e57373'
};

// =========================
// MULTI METRIC TREND
// =========================
const multiCtx = document.getElementById('multiTrendChart');

if (multiCtx) {
    new Chart(multiCtx, {
        type: 'line',
        data: {
            labels: ['Jan 7','Jan 8','Jan 9','Jan 10','Jan 11','Jan 12','Jan 13'],
            datasets: [
                {
                    label: 'Active Centers',
                    data: [12,14,16,18,20,21,22],
                    tension: .4,
                    pointRadius: 4,
                    borderColor: DASH.teal,
                    backgroundColor: DASH.teal
                },
                {
                    label: 'Evacuees',
                    data: [420,600,760,940,1100,1180,1250],
                    tension: .4,
                    pointRadius: 4,
                    borderColor: DASH.deepTeal,
                    backgroundColor: DASH.deepTeal
                },
                {
                    label: 'Hazards',
                    data: [5,8,12,18,22,24,28],
                    tension: .4,
                    pointRadius: 4,
                    borderColor: DASH.softRed,
                    backgroundColor: DASH.softRed
                }
            ]
        },
        options: {
            plugins: { legend: { position: 'bottom' } },
            scales: {
                y: { beginAtZero: true, grid:{ color:DASH.softGrid } },
                x: { grid:{ color:DASH.softGrid } }
            }
        }
    });
}


// =========================
// RESOURCE STACKED TREND
// =========================
const resCtx = document.getElementById('resourceTrendChart');

if (resCtx) {
    new Chart(resCtx, {
        type: 'line',
        data: {
            labels: ['Jan 7','Jan 8','Jan 9','Jan 10','Jan 11','Jan 12','Jan 13'],
            datasets: [
                {
                    label: 'Food Packs',
                    data: [200,240,300,340,420,460,480],
                    fill: true,
                    tension: .4,
                    stack: 'total',
                    borderColor: DASH.deepTeal,
                    backgroundColor: '#4f7f7744'
                },
                {
                    label: 'Medical',
                    data: [150,180,210,260,310,330,360],
                    fill: true,
                    tension: .4,
                    stack: 'total',
                    borderColor: DASH.teal,
                    backgroundColor: '#7fa9a344'
                },
                {
                    label: 'Shelter',
                    data: [120,150,200,230,280,300,320],
                    fill: true,
                    tension: .4,
                    stack: 'total',
                    borderColor: DASH.sage,
                    backgroundColor: '#b8c2ad55'
                },
                {
                    label: 'Water',
                    data: [180,200,240,260,300,310,330],
                    fill: true,
                    tension: .4,
                    stack: 'total',
                    borderColor: DASH.lightSage,
                    backgroundColor: '#cfd8c855'
                }
            ]
        },
        options: {
            plugins: { legend: { position:'bottom' } },
            scales: {
                y: { stacked:true, beginAtZero:true, grid:{ color:DASH.softGrid } },
                x: { grid:{ color:DASH.softGrid } }
            }
        }
    });
}


// =========================
// RESPONSE TIME LINE
// =========================
const responseCtx = document.getElementById('responseChart');

if (responseCtx) {
    new Chart(responseCtx, {
        type: 'line',
        data: {
            labels: ['00','03','06','09','12','15','18','21'],
            datasets: [{
                label: 'Minutes',
                data: [12,15,8,6,5,7,9,11],
                tension: .4,
                pointRadius: 4,
                borderColor: DASH.deepTeal,
                backgroundColor: DASH.deepTeal
            }]
        },
        options: {
            plugins: { legend:{ display:false } },
            scales: {
                y:{ beginAtZero:true, grid:{ color:DASH.softGrid }},
                x:{ grid:{ color:DASH.softGrid }}
            }
        }
    });
}


// =========================
// HAZARD PIE (round + not squished)
// =========================
const hazardCtx = document.getElementById('hazardChart');

if (hazardCtx) {
    new Chart(hazardCtx, {
        type: 'pie',
        data: {
            labels: [
                'Flooding 30%',
                'Power Outage 38%',
                'Road Block 20%',
                'Landslide 13%'
            ],
            datasets: [{
                data: [30,38,20,13],
                backgroundColor: [
                    DASH.deepTeal,
                    DASH.sage,
                    DASH.teal,
                    DASH.lightSage
                ],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            aspectRatio: 1,   // forces circle
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
}


// =========================
// POPULATION MOVEMENT
// =========================
const moveCtx = document.getElementById('movementChart');

if (moveCtx) {
    new Chart(moveCtx, {
        type: 'bar',
        data: {
            labels: ['06','09','12','15','18','21'],
            datasets: [
                {
                    label: 'Check-ins',
                    data: [40,90,130,100,70,35],
                    backgroundColor: DASH.deepTeal
                },
                {
                    label: 'Check-outs',
                    data: [12,18,25,35,28,20],
                    backgroundColor: DASH.teal
                }
            ]
        },
        options: {
            plugins: { legend:{ position:'bottom' } },
            scales: {
                y:{ beginAtZero:true, grid:{ color:DASH.softGrid }},
                x:{ grid:{ color:DASH.softGrid }}
            }
        }
    });
}


// =========================
// CENTER PERFORMANCE
// =========================
const centerCtx = document.getElementById('centerChart');

if (centerCtx) {
    new Chart(centerCtx, {
        type: 'bar',
        data: {
            labels: ['Brgy Hall A','School Gym','Community Ctr','Sports Complex'],
            datasets: [
                {
                    label: 'Capacity %',
                    data: [95,88,100,55],
                    backgroundColor: DASH.teal
                },
                {
                    label: 'Efficiency %',
                    data: [90,92,86,97],
                    backgroundColor: DASH.deepTeal
                }
            ]
        },
        options: {
            plugins: { legend:{ position:'bottom' } },
            scales: {
                y:{ beginAtZero:true, max:100, grid:{ color:DASH.softGrid }},
                x:{ grid:{ color:DASH.softGrid }}
            }
        }
    });
}