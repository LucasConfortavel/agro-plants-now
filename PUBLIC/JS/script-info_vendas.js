const valor = document.getElementById("valor");
const mais = document.getElementById("mais");
const menos = document.getElementById("menos");

let contador = 0;

mais.addEventListener("click", () => {

    contador++;
    valor.textContent = contador;

});

menos.addEventListener("click", () => {

    if(contador > 0){
    contador--;
    valor.textContent = contador;
    }

});