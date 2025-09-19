document.addEventListener("DOMContentLoaded", function () {
  const tabButtons = document.querySelectorAll(".po-tab-btn[data-tab]");
  const tabContents = document.querySelectorAll(".tab-content");

  if (!tabButtons.length || !tabContents.length) return;

  function showTab(tabName) {
    tabContents.forEach(c => {
      if (c.id === `${tabName}-tab-content`) {
        c.style.display = "block";
      } else {
        c.style.display = "none";
      }
    });
    
    
    tabButtons.forEach(btn => {
      if (btn.dataset.tab === tabName) {
        btn.classList.add("po-active");
      } else {
        btn.classList.remove("po-active");
      }
    });
  }

  tabButtons.forEach(btn => {
    btn.addEventListener("click", function (evt) {
      if (evt && typeof evt.preventDefault === "function") evt.preventDefault();
      const tab = this.dataset.tab;
      if (!tab) return;
      showTab(tab);
    });
  });

  const initialVisible = Array.from(tabContents).find(c => getComputedStyle(c).display !== "none");
  if (initialVisible) {
    const tabName = initialVisible.id.replace(/-tab-content$/, "");
    showTab(tabName);
  } else {
    showTab("sales");
  }



    function mostrar_categorias(id=0){ 
        let option = document.getElementsByClassName("ym_options")[id];
        let seta = document.getElementsByClassName("ym_seta-categoria")[id];
        let option_area = document.getElementsByClassName("ym_options")[id];

        if (window.getComputedStyle(option).display == 'none'){
            option.style.display = 'flex';
            seta.style.animation = 'ym_mostrar-options ease 0.4s';
            seta.style.transform = 'rotate(-90deg)';
            option_area.style.animation = 'ym_mostrar-options-area ease 0.4s';
        }
        else{
            seta.style.animation = 'ym-sumir-options ease 0.4s';
            seta.style.transform = 'rotate(90deg)';
            option_area.style.animation = 'ym-sumir-options-area ease 0.4s';
            setTimeout(() => {
                option.style.display = 'none';
            }, 390);
        }
    }

    // function trocar_categoria(id){ 
    //     let option = document.getElementsByClassName("ym_options")[id];

    // }

    function trocar_categoria(id=0,id_op=0) {
        let categoria = document.getElementsByClassName("ym_categoria-select")[id];
        let option = document.getElementsByClassName("ym_options")[id];
        let link = document.getElementsByClassName("ym_link-option")[id_op];
        let nova_op = categoria.textContent;
        let nova_cat = link.textContent;

        console.log(nova_op, nova_cat)


        link.textContent = nova_op;
        categoria.textContent = nova_cat;

        option.style.display = 'none';
    }
})