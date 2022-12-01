<?php require "header.php";?>

<main class="signup-form">
    <h1>註 冊</h1>

    <?php
        if(isset($_GET["error"])) {

            if($_GET["error"] == "emptyfields") {
                echo "<p class='error-message'>請輸入完整的訊息。</p>";
            }else if ($_GET["error"] == "invalidmail") {
                echo "<p class='error-message'>請輸入正確信箱。</p>";
            }else if ($_GET["error"] == "passwordcheck") {
                echo "<p class='error-message'>請確認第二次密碼輸入是否正確。</p>";
            }else if ($_GET["error"] == "sqlerror") {
                echo "<p class='error-message'>數據庫連接失敗。</p>";
            }else if ($_GET["error"] == "usertaken") {
                echo "<p class='error-message'>此帳號已被註冊，請輸入重新註冊新帳號。</p>";
            }
            else if ($_GET["signup"] == "success") {
                echo "<p class='error-success'>註冊成功!</p>";
            }
        }
    
    
    ?>
    <form action="signup_process.php" method="post">
        <p><input type="text" name="uid" placeholder="用戶帳號"></p> 
        <p><input type="email" name="mail" placeholder="電子信箱"></p>
        <p><input type="password" name="password" placeholder="密碼"></p>  
        <p><input type="password" name="password-repeat" placeholder="再次輸入密碼"></p>

        <button type="submit" name="signup-submit">註 冊</button>
    </form>
</main>


<?php require "footer.php";?>