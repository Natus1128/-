<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//設定檔案路徑
require 'C:/xampp/htdocs/xampp/PHPMailer-master/src/Exception.php';
require 'C:/xampp/htdocs/xampp/PHPMailer-master/src/PHPMailer.php';
require 'C:/xampp/htdocs/xampp/PHPMailer-master/src/SMTP.php';

//建立物件
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    
    //$mail->SMTPDebug = 2; // DEBUG 訊息
    $mail->isSMTP();                                            //使用 SMTP
    $mail->Host       = 'smtp.gmail.com';                     //SMTP server 位址
    $mail->SMTPAuth   = true;                                   // 開啟 SMTP 驗證 
    $mail->Username   = 'weichiokok@gmail.com';                     //SMTP 帳號 (寄件帳號)
    $mail->Password   = 'xmzvuvxgeqrsxrxd';                               // SMTP 密碼    
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //$mail->SMTPSecure = "ssl";
    $mail->Port       = 587;                                    //SMTP TCP port
 
    //設定收件人資料
    $mail->setFrom('10824136@nhu.edu.tw', 'chen');		//收件帳號// 寄件人(透過 Gmail 發送會顯示 Gmail 帳號為寄件者) 
    $mail->addAddress('10824136@nhu.edu.tw', 'chen_chen');     //收件帳號//添加收件人
    $mail->addAddress('ellen@example.com');               // 名字非必填//添加收件人
    $mail->addReplyTo('weichiokok@gmail.com', 'chen'); //寄件帳號//回信的收件人 
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //附件
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //附件
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //插入附件可更 改檔名

    // 信件內容 
    $mail->isHTML(true);                                  //設定為 HTML 格式 
    $mail->Subject = 'I need help';					// 信件標題
    $mail->Body    = 'Help me <b>救救我</b>'; // 信件內容
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; // 對方若不支援 HTML 的信件內容 

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}