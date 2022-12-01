<?php
if(isset($_POST["login-submit"])) {

    require "database_handler.php";

    $uid = $_POST["mailuid"];
    $password = $_POST["pwd"];

    if(empty($uid) || empty($password)) {

        header("Location: index.php?error=emptyfields");
        exit();

    } else {

        $sql = "SELECT * FROM users WHERE uid=? OR userEmails=?";
        $statement = mysqli_stmt_init($connection);

        if(!mysqli_stmt_prepare($statement, $sql)) {

            header("Location: index.php?error=sqlerror");
            exit();

        } else {

            mysqli_stmt_bind_param($statement, "ss", $uid, $uid);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            if($row = mysqli_fetch_assoc($result)) {

                $pwdCheck = password_verify($password, $row["pwd"]);

                if($pwdCheck == true) {

                    
                    $_SESSION["userId"] = $row["userIds"];
                    $_SESSION["uid"] = $row["uid"];

                    header("Location: index.php?login=success");
                    exit();
                } else {

                    header("Location: index.php?error=wrongpwd");
                    exit();
                }
            } else {
                header("Location: index.php?error=nouser");
                exit();
            }
        }
    }

} else {
    header("Location: index.php");
    exit();
}

?>