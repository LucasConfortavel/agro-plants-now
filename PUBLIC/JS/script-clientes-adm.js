function toggleDropdown(btn) {
    const dropdown = btn.nextElementSibling;
    const isVisible = dropdown.style.display === "block";

    document.querySelectorAll(".jv_dropdown").forEach(d => {
        if (d !== dropdown) {
            d.style.display = "none";
        }
    });

    if (!isVisible) {
        dropdown.style.display = "block";
        
        setTimeout(() => {
            adjustDropdownPosition(btn, dropdown);
        }, 10);
    } else {
        dropdown.style.display = "none";
    }
}

function adjustDropdownPosition(btn, dropdown) {
    const btnRect = btn.getBoundingClientRect();
    const dropdownRect = dropdown.getBoundingClientRect();
    const viewportHeight = window.innerHeight;
    const viewportWidth = window.innerWidth;
    
    dropdown.style.top = '';
    dropdown.style.bottom = '';
    dropdown.style.left = '';
    dropdown.style.right = '';
    dropdown.style.marginTop = '';
    dropdown.style.marginBottom = '';
    
    if (btnRect.bottom + dropdownRect.height > viewportHeight - 20) {
        dropdown.style.bottom = '100%';
        dropdown.style.marginBottom = '5px';
    } else {
        dropdown.style.top = '100%';
        dropdown.style.marginTop = '5px';
    }
    
    if (btnRect.right + dropdownRect.width > viewportWidth - 20) {
        dropdown.style.right = '0';
    } else {
        dropdown.style.right = '0';
    }
}

document.addEventListener("click", function(e) {
    if (!e.target.closest(".jv_menu-btn") && !e.target.closest(".jv_dropdown")) {
        document.querySelectorAll(".jv_dropdown").forEach(d => {
            d.style.display = "none";
        });
    }
});

document.addEventListener("keydown", function(e) {
    if (e.key === "Escape") {
        document.querySelectorAll(".jv_dropdown").forEach(d => {
            d.style.display = "none";
        });
    }
});

window.addEventListener('resize', function() {
    document.querySelectorAll('.jv_dropdown').forEach(dropdown => {
        if (dropdown.style.display === 'block') {
            const btn = dropdown.previousElementSibling;
            adjustDropdownPosition(btn, dropdown);
        }
    });
});

const customSelect = document.getElementById('customSelect');
if (customSelect) {
    const selectTrigger = customSelect.querySelector('.select-trigger');
    const selectOptions = customSelect.querySelector('.select-options');
    const selectValue = customSelect.querySelector('.select-value');
    const options = customSelect.querySelectorAll('.select-option');
    const nativeSelect = document.getElementById('nativeSelect');

    selectTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        selectTrigger.classList.toggle('active');
        selectOptions.classList.toggle('active');
    });

    options.forEach(option => {
        option.addEventListener('click', function() {
            options.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            const value = this.getAttribute('data-value');
            const text = this.textContent;
            selectValue.textContent = text;
            if (nativeSelect) nativeSelect.value = value;
            selectTrigger.classList.remove('active');
            selectOptions.classList.remove('active');
            
            const url = new URL(window.location.href);
            if (value && value !== "") {
                url.searchParams.set('status', value);
            } else {
                url.searchParams.delete('status');
            }
            url.searchParams.delete('pagina');
            window.location.href = url.toString();
        });
    });

    document.addEventListener('click', function(e) {
        if (!customSelect.contains(e.target)) {
            selectTrigger.classList.remove('active');
            selectOptions.classList.remove('active');
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            selectTrigger.classList.remove('active');
            selectOptions.classList.remove('active');
        }
    });

    if (nativeSelect) {
        nativeSelect.addEventListener('change', function() {
            const value = this.value;
            const url = new URL(window.location.href);

            if (value && value !== "") {
                url.searchParams.set('status', value);
            } else {
                url.searchParams.delete('status');
            }
            url.searchParams.delete('pagina');
            window.location.href = url.toString();
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.jv_dropdown').forEach(dropdown => {
        dropdown.style.display = 'none';
    });
});