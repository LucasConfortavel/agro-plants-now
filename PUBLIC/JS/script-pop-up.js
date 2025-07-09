function abrirPopup(link) {
   const cont_popup = document.getElementsByClassName('ym_conteudo-popup')[0];
   const popup_overlay = document.getElementsByClassName('ym_popup-overlay')[0];

   fetch(link)
     .then(response => response.text())
     .then(html => {
       cont_popup.innerHTML = html;

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
   popup_overlay.style.display = 'none';
}
