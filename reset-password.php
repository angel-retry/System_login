<?php require "header.php";?>

<main class="signup-form">
    <h1>重製密碼</h1>
    <p>我們會發送郵件幫您重新設定密碼。</p>
    <form action="reset-request.php" method="post">
        <input class="email-input" type="text" name="email" placeholder="請輸入您的郵箱和地址">
        <button id="send-email-button" class="btn" type="submit" name="reset-request-submit">通過郵件重設密碼</button>
    </form>
    <?php
        if(isset($_GET["reset"])) {
            if($_GET["reset"] == "success") {
                echo "<p class='success-message'>請查收重設密碼郵件。</p>";
            }
        }

    ?>
</main>


<?php require "footer.php";?>