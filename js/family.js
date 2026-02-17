document.addEventListener('DOMContentLoaded', () => {
    
    // 1. SELECT ELEMENTS
    const regModal = document.getElementById("registerModal");
    const successModal = document.getElementById("successModal");
    const openBtn = document.getElementById("openModalBtn");
    const closeRegBtn = document.getElementById("closeModalBtn");
    const closeSuccessBtn = document.getElementById("closeSuccessBtn");
    const registerForm = document.getElementById("registerForm");
    const familyTable = document.getElementById("familyTable");

    // 2. MODAL TOGGLE LOGIC
    if (openBtn) {
        openBtn.onclick = (e) => {
            e.preventDefault();
            regModal.style.display = "block";
        };
    }

    if (closeRegBtn) {
        closeRegBtn.onclick = () => regModal.style.display = "none";
    }

    if (closeSuccessBtn) {
        closeSuccessBtn.onclick = () => successModal.style.display = "none";
    }

    window.onclick = (event) => {
        if (event.target === regModal) regModal.style.display = "none";
        if (event.target === successModal) successModal.style.display = "none";
    };

    // 3. FORM SUBMISSION
    if (registerForm) {
        registerForm.onsubmit = function(e) {
            e.preventDefault();

            const formData = new FormData(registerForm);
            const fname = formData.get('firstname');
            const lname = formData.get('lastname');
            const sex = formData.get('sex');
            
            const newID = "F-00" + (familyTable.querySelectorAll('tr').length + 1);
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${newID}</td>
                <td>${lname} Family</td>
                <td>${fname} ${lname}</td>
                <td>1 <span class="tag">${sex}</span></td>
                <td>Pending Assignment</td>
                <td>0/10 <div class="progress"><div style="width:0%"></div></div></td>
                <td>${new Date().toLocaleDateString()}</td>
                <td>None</td>
                <td><span class="status active">ACTIVE</span></td>
            `;

            familyTable.prepend(newRow);

            const familyCountEl = document.querySelector('.card:nth-child(1) .card-value');
            if (familyCountEl) {
                let currentTotal = parseInt(familyCountEl.dataset.count) || 0;
                familyCountEl.dataset.count = currentTotal + 1;
                familyCountEl.textContent = (currentTotal + 1).toLocaleString();
            }

            regModal.style.display = "none";
            registerForm.reset();
            successModal.style.display = "block";
            
            updatePagination();
        };
    }

    // 4. ANIMATIONS & PAGINATION
    const rowsPerPage = 5;
    let currentPage = 1;

    function runAnimations() {
        document.querySelectorAll('.card-value').forEach(el => {
            const target = +el.dataset.count;
            let current = 0;
            const inc = target / 50;
            const timer = setInterval(() => {
                current += inc;
                if (current >= target) {
                    el.textContent = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    el.textContent = Math.ceil(current).toLocaleString();
                }
            }, 20);
        });

        setTimeout(() => {
            document.querySelectorAll('.bar').forEach(bar => {
                bar.style.height = bar.dataset.height + 'px';
            });
        }, 500);
    }

    function updatePagination() {
        const allRows = familyTable.querySelectorAll('tr');
        const totalPages = Math.ceil(allRows.length / rowsPerPage) || 1;
        
        allRows.forEach((row, index) => {
            row.style.display = (index >= (currentPage - 1) * rowsPerPage && index < currentPage * rowsPerPage) ? '' : 'none';
        });

        const info = document.getElementById('pageInfo');
        if (info) info.textContent = `Showing page ${currentPage} of ${totalPages}`;
    }
    document.getElementById('prevBtn')?.addEventListener('click', () => { if (currentPage > 1) { currentPage--; updatePagination(); } });
    document.getElementById('nextBtn')?.addEventListener('click', () => { 
        const totalPages = Math.ceil(familyTable.querySelectorAll('tr').length / rowsPerPage);
        if (currentPage < totalPages) { currentPage++; updatePagination(); } 
    });

    runAnimations();
    updatePagination();
});
