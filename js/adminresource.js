document.addEventListener("DOMContentLoaded", () => {

  // =========================
  // MODAL LOGIC
  // =========================
  const modal = document.getElementById("resourceModal");
  const modalClose = document.getElementById("modalClose");

  const ids = [
    "m_title","m_org","m_contact","m_email",
    "m_city","m_barangay","m_location",
    "m_type","m_weight","m_exp","m_serving"
  ];

  const el = {};
  ids.forEach(id => el[id] = document.getElementById(id));

  const stepsOrder = ["requested","packed","shipped","otw","delivered"];

  document.querySelectorAll(".resource-row").forEach(row => {
    row.addEventListener("click", () => {

      if (!modal) return;

      Object.keys(el).forEach(k => {
        if (el[k]) el[k].textContent = row.dataset[k.replace("m_","")] || "";
      });

      updateTracker(row.dataset.shipstatus || "requested");
      modal.classList.add("show");
    });
  });

  function updateTracker(status) {
    const steps = document.querySelectorAll("#m_status .step");
    const index = stepsOrder.indexOf(status);

    steps.forEach((s,i) => {
      s.classList.remove("done","active");
      if (i < index) s.classList.add("done");
      if (i === index) s.classList.add("active");
    });
  }

  if (modalClose && modal) {
    modalClose.onclick = () => modal.classList.remove("show");
    modal.onclick = e => {
      if (e.target === modal) modal.classList.remove("show");
    };
  }

  // =========================
  // CHART.JS CHECK
  // =========================
  if (typeof Chart === "undefined") {
    console.error("Chart.js not loaded — charts will not render.");
    return;
  }

  // =========================
  // DISTRIBUTION CHART
  // =========================
  const distCanvas = document.getElementById("distributionChart");

  if (distCanvas) {
    new Chart(distCanvas, {
      type: "line",
      data: {
        labels: ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"],
        datasets: [
          {
            data: [320,380,450,520,610,590,560],
            borderColor: "#6f7f7a",
            tension: 0.35,
            pointRadius: 4,
            pointBackgroundColor: "#ffffff",
            borderWidth: 3
          },
          {
            data: [180,220,290,340,420,400,370],
            borderColor: "#4f7f73",
            tension: 0.35,
            pointRadius: 4,
            pointBackgroundColor: "#ffffff",
            borderWidth: 3
          },
          {
            data: [90,105,130,150,195,210,220],
            borderColor: "#b7beaa",
            tension: 0.35,
            pointRadius: 4,
            pointBackgroundColor: "#ffffff",
            borderWidth: 3
          },
          {
            data: [45,55,70,80,92,95,95],
            borderColor: "#8fb3ad",
            tension: 0.35,
            pointRadius: 4,
            pointBackgroundColor: "#ffffff",
            borderWidth: 3
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          x: {
            grid: { borderDash: [4,4], color: "#d8e0db" }
          },
          y: {
            beginAtZero: true,
            ticks: { stepSize: 200 },
            grid: { borderDash: [4,4], color: "#d8e0db" }
          }
        }
      }
    });
  }

  // =========================
  // STOCK LEVEL CHART (with sanitation added)
  // =========================
  const stockCanvas = document.getElementById("stockChart");

  if (stockCanvas) {
    new Chart(stockCanvas, {
      type: "bar",
      data: {
        labels: ["Food","Water","Medical","Shelter","Sanitation"],
        datasets: [
          {
            label: "Current",
            data: [2400,5800,900,600,700],
            backgroundColor: "#4B7B74"
          },
          {
            label: "Target",
            data: [3000,6000,1200,800,1000],
            backgroundColor: "#9EC3BF"
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: true } }
      }
    });
  }

  // =========================
// TABLE SEARCH FILTER
// =========================

const searchInput = document.getElementById("resourceSearch");

if (searchInput) {
  searchInput.addEventListener("input", function () {
    const term = this.value.toLowerCase();

    document.querySelectorAll(".table-card tbody tr").forEach(row => {
      const text = row.innerText.toLowerCase();
      row.style.display = text.includes(term) ? "" : "none";
    });
  });
}

});
