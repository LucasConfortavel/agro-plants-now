function mostrarPopup(){
   const popup = document.getElementsByClassName("ym_modal-pop-up-area")[0]
   const close = document.getElementsByClassName("ym_fechar-popup")[0]
   close.style.display = none;

   console.log("acho") 
   popup.style.display = "block"
}
function ocultarPopup(){
   const popup = document.getElementsByClassName("ym_modal-pop-up-area")[0]
   popup.style.display = "none"
   console.log("cade?") 

}