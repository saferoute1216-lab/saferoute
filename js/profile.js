function performLogout() {
    window.location.replace("profile.php?action=logout");
}

/* ===== MAIN FAMILY MODAL ===== */

function openFamilyModal() {
    document.getElementById("familyModal").style.display = "flex";
}

function closeFamilyModal() {
    document.getElementById("familyModal").style.display = "none";
}

/* ===== CHOICE MODAL ===== */

function openChoiceModal() {
    document.getElementById("choiceModal").style.display = "flex";
}

function closeChoiceModal() {
    document.getElementById("choiceModal").style.display = "none";
}

/* ===== JOIN MODAL ===== */

function openJoinModal() {
    closeChoiceModal();
    document.getElementById("joinModal").style.display = "flex";
}

function closeJoinModal() {
    document.getElementById("joinModal").style.display = "none";
}

/* ===== REGISTER MODAL ===== */

function openRegisterModal() {
    closeChoiceModal();
    document.getElementById("registerModal").style.display = "flex";
}

function closeRegisterModal() {
    document.getElementById("registerModal").style.display = "none";
}

/* ===== CLICK OUTSIDE TO CLOSE ===== */

window.onclick = function(event) {
    const ids = ["familyModal", "choiceModal", "joinModal", "registerModal"];

    ids.forEach(id => {
        const modal = document.getElementById(id);
        if (modal && event.target === modal) {
            modal.style.display = "none";
        }
    });
};
