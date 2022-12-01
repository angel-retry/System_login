<?php require "header.php";?>

<main class="signup-form">
    <?php
        $selector = $_GET["selector"];
        $validator = $_GET["validator"];
    
        if (empty($selector) || empty($validator)) {
            echo "我們無法驗證您的連接";
        } else {

            if(ctype_xdigit($selector) !== false &&ctype_xdigit($validator) !== false) {
    
    ?>
    
             <form action="reset-password-validate.php" method="post">

                <input type="hidden" name="selector" value="<?php echo $selector;?>">
                <input type="hidden" name="validator" value="<?php echo $validator;?>">
                <input class="password-input" type="password" name="pwd" placeholder="請輸入新密碼">
                <input class="password-input" style="margin-top: 10px;" type="password" name="pwd-repeat" placeholder="請再次輸入新密碼">
                <button class="btn"type="submit" name="reset-password-submit">重設密碼</button>
             </form> 

             <?php 
                
            }
        }
    ?>
</main>


<?php require "footer.php";?>