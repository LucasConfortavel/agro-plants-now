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

            <div class="er_box-img">
                <img src="./PUBLIC/img/file-svgrepo-com 1.svg" alt="" class="er_img">
                <div class="er_box-img-p">
                    <p class="er_p">Imagem</p>
                </div>
            </div>

            <button type="submit" class="er_add-img-btn"><a href="">Adicionar imagem</a></button>
        </div>


        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

            * {
                box-sizing: border-box;
            }

            body {
                background-color: rgba(8, 8, 8, 0.575);
            }

            .er_box-adicionar {
                width: 738px;
                height: 460px;
                background-color: white;
                margin-left: 387px;
                margin-top: 130px;
                border-radius: 10px;
            }

            .er_adicionar-btn, .er_imagem-btn {
                width: 370px;
                height: 52px;
                display: flex;
                justify-content: center;
                align-items: center;
                border: none;
                font-family: 'Poppins';
                font-size: large;
                border-radius: 10px 0 10px 0;
                background-color: rgba(217, 217, 217, 1);
            }

            .er_adicionar-btn:hover,
            .er_imagem-btn:hover {
                background-color: white;
            }

            .er_adicionar-btn a,
            .er_imagem-btn a {
                text-decoration: none;
                font-family: 'Poppins';
                color: rgba(0, 0, 0, 0.7);
            }

            .er_imagem-btn {
                margin-left: 369px;
                margin-top: -52px;
                border-radius: 0 10px 0 10px;
            }

            .er_imagem-btn a {
                color: rgba(0, 0, 0, 0.5);
            }

            .er_box-img {
                background-color: white;
                border: 3px solid rgba(231, 230, 230, 1);
                width: 433px;
                height: 283px;
                border-radius: 10px;
                margin: 45px auto 0 auto;
                position: relative;
                text-align: center;
            }

            .er_box-img .er_img {
                height: 58px;
                width: 53px;
                margin-top: 90px;
            }

            .er_box-img .er_p {
                font-family: 'Poppins';
                font-weight: bold;
                color: rgba(0, 0, 0, 0.2);
                margin-top: -10px;
            }

            .er_add-img-btn {
                width: 170px;
                height: 40px;
                border: none;
                border-radius: 10px;
                background-color: rgba(69, 115, 75, 1);
                margin: 15px auto 0 auto;
                display: block;
                font-family: 'Poppins';
            }

            .er_add-img-btn a {
                text-decoration: none;
                color: white;
            }

            /* Responsivo para tablets e notebooks pequenos */
            @media screen and (max-width: 1024px) {
                .er_box-adicionar {
                    width: 90%;
                    height: auto;
                    margin: 100px auto;
                    padding-bottom: 30px;
                }

                .er_adicionar-btn,
                .er_imagem-btn {
                    width: 50%;
                }

                .er_imagem-btn {
                    margin-left: 50%;
                    margin-top: -52px;
                }

                .er_box-img {
                    width: 80%;
                    height: auto;
                    padding: 40px 0;
                }

                .er_box-img .er_img {
                    margin: 0 auto;
                    display: block;
                }

                .er_add-img-btn {
                    margin: 20px auto 0 auto;
                }
            }

            /* Responsivo para celulares */
            @media screen and (max-width: 480px) {
                .er_box-adicionar {
                    width: 95%;
                    margin-top: 80px;
                    padding-bottom: 20px;
                }

                .er_adicionar-btn,
                .er_imagem-btn {
                    width: 100%;
                    margin-left: 0;
                    margin-top: 0;
                    border-radius: 10px;
                }

                .er_imagem-btn {
                    margin-top: 10px;
                }

                .er_box-img {
                    width: 90%;
                }

                .er_box-img .er_img {
                    height: 48px;
                    width: 43px;
                    margin-top: 60px;
                }

                .er_box-img .er_p {
                    margin-top: 10px;
                    font-size: 0.9rem;
                }

                .er_add-img-btn {
                    width: 100%;
                    height: 45px;
                    font-size: 0.9rem;
                }
            }
        </style>
    </main>
</body>
</html>