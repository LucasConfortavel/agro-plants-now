function toggleDropdown(btn) {
    const dropdown = btn.nextElementSibling;
    const isVisible = dropdown.style.display === "block";
  
    document.querySelectorAll(".jv_dropdown").forEach(d => {
        d.style.display = "none";
    });
  
    if (!isVisible) {
        dropdown.style.display = "block";
    }
}

document.addEventListener("click", function(e) {
    if (!e.target.closest(".jv_menu-btn") && !e.target.closest(".jv_dropdown")) {
        document.querySelectorAll(".jv_dropdown").forEach(d => {
            d.style.display = "none";
        });
    }
});

const customSelect = document.getElementById('customSelect');
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
        nativeSelect.value = value;
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