<?php

include "../../INCLUDE/Menu_adm.php";


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>adicionar produto</title>
</head>
<body>
   <main class="jp_main-content">
        <div class="er_box-adicionar">
            <button class="er_adicionar-btn"><a href="adicionar.php">Adicionar Produto</a></button> <button class="er_imagem-btn"><a href="imagem.php">Imagem do produto</a></button>

            <div class="er_box1">
                <div class="er_p-box1">
                    <p class="er_p1">*</p>
                </div>
                <label for="" class="er_label1">Obrigatorio</label>
                <input type="text" name="nome"  class="er_input-form">
                <br>
                <div class="er_p-box2"> 
                    <p class="er_p2">*</p>
                </div>
                <label for="" class="er_label2">Obrigatorio</label>
                <input type="text" name="categoria" class="er_input-form2">
            </div>
        <div class="er_box2">
                <div class="er_p-box3">
                    <p class="er_p3">*</p>
                </div>
                <label for="" class="er_label3">Obrigatorio</label>
                <input type="text" name="quantidade" class="er_input-form3">
                <br>
                <div class="er_p-box4">
                    <p class="er_p4">*</p>
                </div>
                <label for="" class="er_label4">Obrigatorio</label>
                <input type="text" name="preco" class="er_input-form4">
        </div>
        
            <button class="er_produto-btn"><a href="">Adicionar produto</a></button>
            <p class="er_p5">Adicione a imagem do produto</p>
            <p class="er_p6">antes de adiciona-lo</p>
        </div>

    

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

            * {
                box-sizing: border-box;
            }

            body{
                background-color: rgba(8, 8, 8, 0.575);
            }

            .er_box-adicionar{
                width: 738px;
                height: 460px;
                background-color: rgba(255, 255, 255, 1);
                margin-left: 387px;
                margin-top: 130px;
                border-radius: 10px;
                
            }
            .er_box1{
                height: 120px;
                margin-top: 40px;
                display: flex;
            }

            .er_box2{
                height:120px ;
                margin-top: 15px;
                display: flex;

            }

            .er_p-box1{
                width: 10px;
                height: 10px;
            
            }

            .er_p-box2{
                width: 10px;
                height: 10px;
            
            }

            .er_p-box3{
                width: 10px;
                height: 10px;
            
            }

            .er_p-box4{
                width: 10px;
                height: 10px;
            
            }

            .er_p-box1 .er_p1{
                color: red;
                margin-top: 10px;
                margin-left: 49px;
            }

            .er_p-box2 .er_p2{
                color: red;
                margin-top: 10px;
                margin-left: 85px;
            }

            .er_p-box3 .er_p3{
                color: red;
                margin-top: 10px;
                margin-left: 49px;
            }

            .er_p-box4 .er_p4{
                color: red;
                margin-top: 10px;
                margin-left: 85px;
            }


            .er_box1 .er_label1{
                height: 17px;
                margin-left: 49px;
                margin-top: 14px;
                font-family: 'poppins';
                font-size: 0.7rem;
            }

            .er_box1 .er_label2{
                margin-top: 14px;
                margin-left: 86px; 
                height: 17px;
                font-family: 'poppins';
                font-size: 0.7rem;
                
            }

            .er_box2 .er_label3{
                margin-top: 14px;
                margin-left: 49px;
                height: 17px;
                font-family: 'poppins';
                font-size: 0.7rem;
            
            }

            .er_box2 .er_label4{
                margin-top: 14px;
                margin-left: 86px;
                height: 17px;
                font-family: 'poppins';
                font-size: 0.7rem;
            }

            .er_input-form{
                border: 2px solid rgba(231, 230, 230, 1);;
                stroke: 20%;
                width: 274px;
                height: 41px;
                display: flex;
                margin-left: -80px;
                border-radius: 10px;
                margin-top: 34px;
                background-color: rgba(255, 255, 255, 1);
                
            }

            .er_input-form2{
                background-color: rgba(255, 255, 255, 1);
                width: 274px;
                height: 41px;
                display: flex;
                margin-left: -80px;
                margin-top: 34px;
                border-radius: 10px;
                border: 2px solid rgba(231, 230, 230, 1);
                
            }

            .er_input-form3{
                background-color: rgba(255, 255, 255, 1);
                width: 274px;
                height: 41px;
                margin-top: 29px;
                margin-left: -80px;
                display: flex;
                border-radius: 10px;
                border: 2px solid rgba(231, 230, 230, 1);
                
            }

            .er_input-form4{
                background-color: rgba(255, 255, 255, 1);
                width: 274px;
                height: 41px;
                display: flex;
                margin-top: 29px;
                margin-left: -80px;
                border-radius: 10px;
                border: 2px solid rgba(231, 230, 230, 1);
                
            }

            .er_adicionar-btn{
                width: 370px;
                height: 52px;
                display: flex;
                border-radius: 10px 0px 10px 0px;
                border: none;
                background-color: rgba(217, 217, 217, 1);
            }

            .er_adicionar-btn:hover{
                background-color: rgba(255, 255, 255, 1);
            }

            .er_imagem-btn{
                width: 370px;
                height: 52px;
                display: flex;
                margin-left: 369px; 
                margin-top: -52px;
                border-radius: 0px 10px 0px 10px ;
                border:none ;
                background-color: rgba(217, 217, 217, 1);
            }

            .er_imagem-btn:hover{
                background-color: rgba(255, 255, 255, 1);
            }

            .er_imagem-btn a{
                font-style: none;
                font-family: 'poppins';
                text-decoration: none;
                font-size: large;
                margin-left: 84px;
                margin-top: 9px;
                color: rgba(0, 0, 0, 0.5);

            }

            .er_adicionar-btn a{
                font-style: none;
                font-family: 'poppins';
                text-decoration: none;
                font-size: large;
                margin-left: 84px;
                margin-top: 9px;
                color: rgba(0, 0, 0, 0.7);
            }

            .er_produto-btn{
                width: 170px;
                height: 40px;
                background-color: rgba(69, 115, 75, 1);
                border: none;
                border-radius: 10px;
                margin-left: 458px;
                margin-top: 10px;

            }

            .er_produto-btn a{
                font-style: none;
                font-family: 'poppins';
                text-decoration: none;
                font-size: 0.8rem;
                color: rgba(255, 255, 255, 1);
            }

            .er_p5{
                width: 200px;
                margin-left: 453px;
                margin-top: -1px;
                font-size: 0.7rem;
                font-family: 'poppins';
                color: rgba(0, 0, 0, 0.4);
            }

            .er_p6{
                width: 136px;
                margin-left: 483px;
                margin-top: -13px;
                font-size: 0.7rem;
                font-family: 'poppins';
                color: rgba(0, 0, 0, 0.4);
                
            }

            @media screen and (max-width: 1024px) {
                .er_box-adicionar {
                    width: 90%;
                    height: auto;
                    margin: 100px auto;
                    padding: 20px;
                }

                .er_adicionar-btn,
                .er_imagem-btn {
                    width: 50%;
                    height: 50px;
                }

                .er_imagem-btn {
                    margin-left: 50%;
                    margin-top: -50px;
                }

                .er_box1,
                .er_box2 {
                    flex-direction: column;
                    align-items: flex-start;
                    height: auto;
                    margin-top: 20px;
                }

                .er_input-form,
                .er_input-form2,
                .er_input-form3,
                .er_input-form4 {
                    margin-left: 0;
                    width: 100%;
                }

                .er_label1,
                .er_label2,
                .er_label3,
                .er_label4 {
                    margin-left: 0 !important;
                }

                .er_produto-btn {
                    margin: 20px auto;
                    display: block;
                }

                .er_p5,
                .er_p6 {
                    text-align: center;
                    margin: 5px auto;
                }
            }

            @media screen and (max-width: 480px) {
                .er_adicionar-btn,
                .er_imagem-btn {
                    width: 100%;
                    margin-left: 0;
                    border-radius: 10px;
                }

                .er_imagem-btn {
                    margin-top: 10px;
                }

                .er_box-adicionar {
                    padding: 15px;
                }

                .er_input-form,
                .er_input-form2,
                .er_input-form3,
                .er_input-form4 {
                    height: 38px;
                }

                .er_produto-btn {
                    width: 100%;
                    height: 45px;
                }

                .er_p5,
                .er_p6 {
                    font-size: 0.65rem;
                }
            }

        </style>
  </main>
</body>
</html>