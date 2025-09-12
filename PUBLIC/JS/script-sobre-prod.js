document.addEventListener('DOMContentLoaded', function() {
    const imagemPrincipal = document.querySelector('.gs_product-image');
    const miniaturas = document.querySelectorAll('.gs_product-image-select');
    
    miniaturas.forEach(miniatura => {
        miniatura.addEventListener('click', function() {
            imagemPrincipal.src = this.src;
            imagemPrincipal.alt = this.alt;
            
            miniaturas.forEach(img => img.classList.remove('active'));
            
            this.classList.add('active');
        });
    });
    
    if (miniaturas.length > 0) {
        miniaturas[0].classList.add('active');
    }
});