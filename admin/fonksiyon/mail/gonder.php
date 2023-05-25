<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require'src/Exception.php';
require'src/PHPMailer.php';
require'src/SMTP.php';
include_once ('../baglan.php');


$ayarlar=$baglanti->prepare("select * from gelenmailayar");
$ayarlar->execute();
$ayarson=$ayarlar->fetch();
// tercih al


$mail= new PHPMailer(true);
$mail->SMTPDebug=0;
$mail->isSMTP();
$mail->CharSet = 'UTF-8';
$mail->Host= $ayarson["host"];
$mail->SMTPAuth =true;
$mail->Username=$ayarson["mailadres"];
$mail->Password=$ayarson["sifre"];
$mail->SMTPSecure ='tls';
$mail->Port = 587 ;



if($_POST):
    $mailadres=htmlspecialchars(strip_tags($_POST["mail"]));


    $varmi=$baglanti->prepare("select * from admins where mail='$mailadres'");
    $varmi->execute();
    if ($varmi->rowCount()){

        $sifirlamakodu=uniqid("sifresifirla");
        $sifirlamalink="https://www.yusufoz.net/admin/sifdegistir.php?kod=".$sifirlamakodu;
        $sifirlamakoduekle=$baglanti->prepare("update admins set sifre_sifirlama=:k where mail=:e");
        $sifirlamakoduekle->execute([':k'=> $sifirlamakodu, ':e'=>$mailadres]);


        $mail->addAddress($mailadres);
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );


        $mail->setFrom($mailadres);
        $mail->addReplyTo($mailadres,"Yanıt");
        $mail->Subject="Şifremi Sıfırla";

        $mail->Body = 'Lütfen linke tıklayınız : '.$sifirlamalink."\r\n";






        if($mail->send()) {
            echo '<div class="alert alert-success mt-5 text-center">
            Şifre sıfırlama Linkiniz Başarıyla Gönderilmiştir...Lütfen Maili Spam alanından da kontrol ediniz<br>
             </div>';

        }
        else{
            echo '<div class="alert alert-success mt-5 text-center">
            Mesajınız hata.<br>  .
             </div>';

        }



    }
    else{
        echo "<p class='text-danger'>Girdiğiniz mail adresine ait bir kayıt yoktur lütfen tekrar deneyiniz</p>";
    }


endif;








?>



