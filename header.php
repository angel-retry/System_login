<?php
    if(!session_id()) session_start();
 ?>
 
 <!DOCTYPE html>
 <html lang="zh-Hant-TW">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入系統</title>
    <link rel="stylesheet" href="./style.css">
 </head>
 <body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">主頁</a></li>
                <li><a href="#">關於我們</a></li>
                <li><a href="#">聯繫方式</a></li>
                <li class="form-inline">
                <?php

                    if(isset($_GET["error"])) {

                        if($_GET["error"] == "emptyfields") {
                            echo "<p class='error-message'>請輸入帳號密碼。</p>";
                            
                        
                        }else if($_GET["error"] == "sqlerror") {
                            echo "<p class='error-message'>數據庫連線失敗。</p>";
                        }else if($_GET["error"] == "wrongpwd") {
                            echo "<p class='error-message'>密碼輸入錯誤。</p>";
                        }else if($_GET["error"] == "nouser") {
                            echo "<p class='error-message'>沒有此用戶，是否要註冊帳號?</p>";
                        }
                    }

                    if(isset($_SESSION["userId"])) {

                        echo '
                                <form action="logout.php" method="post">
                                    <button type="submit" name="logout-submit" style="margin-top: 9px">退出登入</button>
                                </form>
                             ';
                    } else {

                        echo '
                                <form action="login.php" method="post">
                                    <input type="text" name="mailuid" placeholder="用戶帳號/電子信箱">
                                    <input type="password" name="pwd" placeholder="密碼">
                                    <button type="submit" name="login-submit">登 入</button>
                                </form>
                                <a href="signup.php">註 冊</a> 
                            ';
                    }
                
                ?>
    
                    

                </li>
            </ul>

            <div class="">
                
            </div>
        </nav>
    </header>
