function abrirPopup(link,titulo) {
   const cont_popup = document.getElementsByClassName('ym_conteudo-popup')[0];
   const popup_overlay = document.getElementsByClassName('ym_popup-overlay')[0];
   const area_superior = document.getElementsByClassName('ym_area-superior-popup')[0];
   const main = document.getElementsByClassName('jp_main-content')[0];
  
   main.style.position = 'fixed';

   fetch(link)
     .then(response => response.text())
     .then(html => {
       cont_popup.innerHTML = html;
       area_superior.innerHTML = `<h1 class="ym_titulo-popup">${titulo}</h1> <p class="ym_icon-fechar" onclick="fecharPopup()">✖</p>`;

       const scripts = cont_popup.querySelectorAll('script');
       scripts.forEach(script => {
         const newScript = document.createElement('script');
         if (script.src) {
           newScript.src = script.src;
         } else {
           newScript.textContent = script.textContent;
         }
         document.body.appendChild(newScript);
         document.body.removeChild(newScript);
       });

       popup_overlay.style.display = 'flex';
     });
}

function fecharPopup() {
   const popup_overlay = document.getElementsByClassName('ym_popup-overlay')[0];
   const main = document.getElementsByClassName('jp_main-content')[0];
   popup_overlay.style.display = 'none';
   main.style.position = 'relative';
}
