
    function loadMore(centerId, button) {
        const table = document.getElementById('table-' + centerId);
        const hiddenRows = table.querySelectorAll('.hidden-row');
        
        for (let i = 0; i < 20 && i < hiddenRows.length; i++) {
            hiddenRows[i].classList.remove('hidden-row');
        }

        if (table.querySelectorAll('.hidden-row').length === 0) {
            button.style.display = 'none';
        }
    }

    window.onload = function() {
        if (window.location.hash) {
            const id = window.location.hash.substring(1);
            const element = document.getElementById(id);
            if (element) {
                setTimeout(() => {
                    element.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 200);
            }
        }
    };