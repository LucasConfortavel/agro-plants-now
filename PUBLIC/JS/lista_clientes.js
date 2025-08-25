
let currentOpenDropdown = null;
function showDropdown(event, customerId){
    event.stopPropagation();
    const menu = document.getElementById('dropdownMenu');
    if(currentOpenDropdown===customerId && menu.style.display==='block'){ menu.style.display='none'; currentOpenDropdown=null; return; }
    const rect = event.target.getBoundingClientRect();
    menu.style.display='block';
    menu.style.left = rect.left - 70 + 'px';
    menu.style.top = rect.bottom + window.scrollY + 5 + 'px';
    currentOpenDropdown = customerId;

    menu.querySelectorAll('.dropdown-item').forEach(item=>{
        item.onclick = ()=>{
            handleDropdownAction(item.dataset.action, customerId);
            menu.style.display='none';
        }
    });
}

document.addEventListener('click',()=>{
    document.getElementById('dropdownMenu').style.display='none';
    currentOpenDropdown=null;
});

function handleDropdownAction(action, customerId){
    let name = document.querySelector(`button[onclick*='${customerId}']`).closest('tr').querySelector('h4').innerText;
    switch(action){
        case 'view': alert('Visualizando '+name); break;
        case 'edit': alert('Editando '+name); break;
        case 'delete': if(confirm('Deseja remover '+name+'?')) alert(name+' removido'); break;
    }
}
