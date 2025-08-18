 function mostrar_categorias(){
    let option = document.getElementsByClassName("ym_options")[0];
    let seta = document.getElementsByClassName("ym_seta-categoria")[0];
    let option_area = document.getElementsByClassName("ym_options")[0];

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

let clicks_1 = 1
let clicks_2 = 1

function slideGo(qntProduto,indexArea){
    let btn_go = document.getElementsByClassName("ym_slideGo")[indexArea];
    let btn_back = document.getElementsByClassName("ym_slideBack")[indexArea];
    if (indexArea == 0){
        var clicks = clicks_1;
    }
    else if (indexArea == 1){
        var clicks = clicks_2;
    }

    let produtos = document.getElementsByClassName("ym_todos-produtos")[indexArea];
    let slides = 66 * clicks;
    let max_clicks = qntProduto/3;
    produtos.style.transform = `translatex(-${slides}%)`;
    if (clicks< Math.floor(max_clicks)){
        if (indexArea == 0){
            clicks_1++
        }
        else if (indexArea == 1){
            clicks_2++
    }
    }
    else{
        btn_go.style.opacity = "0"
    }
    if (clicks_1>1 || clicks_2>1){
        btn_back.style.opacity = "1"
    }
}

function slideBack(qntProduto,indexArea){
    let btn_go = document.getElementsByClassName("ym_slideGo")[indexArea];
    let btn_back = document.getElementsByClassName("ym_slideBack")[indexArea];
    if (indexArea == 0){
        var clicks = clicks_1;
    }
    else if (indexArea == 1){
        var clicks = clicks_2;
    }

    let produtos = document.getElementsByClassName("ym_todos-produtos")[indexArea];
    let slides = 66 * clicks;
    slides = slides - 66
    if (indexArea == 0){
            clicks_1 = clicks_1 - 1
        }
    else if (indexArea == 1){
        clicks_2 = clicks_2 - 1
    }

    if (clicks_1 <= 0 || clicks_2 <= 0){
        if (indexArea == 0){
            clicks_1 = 1
        }
        else if (indexArea == 1){
            clicks_2 = 1
        }
        produtos.style.transform = `translatex(0)`;
        btn_back.style.opacity = "0"
    }
    produtos.style.transform = `translatex(-${slides}%)`;
    btn_go.style.opacity = "1"
}

