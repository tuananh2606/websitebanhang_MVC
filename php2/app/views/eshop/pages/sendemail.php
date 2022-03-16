<?php
include "PHPMailer-master/src/PHPMailer.php";
include "PHPMailer-master/src/Exception.php";
include "PHPMailer-master/src/OAuth.php";
include "PHPMailer-master/src/POP3.php";
include "PHPMailer-master/src/SMTP.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'tuananh02.tlu@gmail.com';                 // SMTP username
    $mail->Password = 'tuananhbjji01';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
 
    //Recipients
    $mail->setFrom('tuananh02.tlu@gmail.com', 'Shop');
    $mail->addAddress($_SESSION['temp'][1], $_SESSION['temp'][0]);     // Add a recipient               // Name is optional

 
    //Content
	$mail->CharSet  = "utf-8";
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Thông báo đặt hàng thành công!';
	$mailContent = "<h3>Đơn hàng đã được thanh toán thành công</h3>
	<h3>Cảm ơn bạn đã mua hàng của chúng tôi!</h3> 
    <h3>Chi tiết đơn hàng ở bên dưới:</h3>
	<h3>Mã đơn hàng: {$_SESSION['temp'][2]}</h3>
	<h3>Tổng tiền: {$_SESSION['temp'][3]}đ</h3>";
    $mail->Body  = $mailContent;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
 
    $mail->send();
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>