<?php
ob_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';

if(isset($_POST["reset-request-submit"])) {

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "https://fuzzed-screen.000webhostapp.com/create-new-password.php?selector=". $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 60 * 30;

    require "database_handler.php";

    $userEmail = $_POST["email"];
    $subject = "Reset your password";
    $message = "<p>Please use below link to reset your password: <br/> ";
    $message .= $url;
    

    $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
    $statement = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($statement, $sql)) {
       echo "伺服器連接失敗!1";
       exit();

    } else {
        mysqli_stmt_bind_param($statement, "s", $userEmail);
        mysqli_stmt_execute($statement);
    }

    $sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUE (?, ?, ?, ?);";
    $statement = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($statement, $sql)) {
        echo "伺服器連接失敗!2";
        exit();
    } else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($statement, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($statement);
    }

    mysqli_stmt_close($statement);
    mysqli_close($connection);
    
    //PHPMailer送信系統
    
    $mail = new PHPMailer;
    $mail->isSMTP(); 
    $mail->SMTPDebug = 2;
    $mail->Host = "smtp.gmail.com"; 
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'a27657060@gmail.com'; 
    $mail->Password = 'raretrjssewhculc'; 
    $mail->setFrom('a27657060@gmail.com', 'LoginSystem'); 
    $mail->addAddress($userEmail); 
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->IsHTML(true); 
    // $mail->SMTPOptions = array(
    //                     'ssl' => array(
    //                         'verify_peer' => false,
    //                         'verify_peer_name' => false,
    //                         'allow_self_signed' => true
    //                     )
    //                 );
    $mail->send();
    header("Location: reset-password.php?reset=success");
    

    
    
    //mail() php內建

//     $to = $userEmail;

//     $subject = "Reset your password";

//     $message = "<p>Please use below link to reset your password: <br/> ";
//     $message .= "<a href='".$url."'>".$url."</a></p>";

//     $header = "From: angel <a27657060@gmail.com> \r\n";
//     $header .= "Reply-To : a27657060@gmail.com \r\n";
//     $header .= "Content-type: text/html \r\n"; 

//     mail($to, $subject, $message, $header);

//     header("Location: reset-password.php?reset=success");

} else {
    header("Location: index.php");
}
ob_end_flush();
?>

