<?php
include 'connect.php';

?>
<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/21/2017
 * Time: 2:01 AM
 */

function login_session($query){
    global $connect;
    $res = $connect->query($query);
    $get_ans = $res->fetch_assoc();
    $_SESSION['serial'] = $get_ans['serial'];
    return $res;
}
function validation($value){
    $back_value = trim($value);
    $back_value = htmlspecialchars($back_value);
    $back_value = stripcslashes($back_value);
    $back_value = mysql_real_escape_string($back_value);
    return $back_value;

}
function query($query){
    global  $connect;
    return $connect->query($query);


}
function percentage($value_class,$value_atten){

    return @$result = ($value_atten * 100)/$value_class;

}
function warning($progress){
   // progress-bar-danger
    $alert = '';
    if ($progress<40){
        $alert = 'progress-bar-danger';
    }
    elseif($progress>40 && $progress <70){
        $alert = 'progress-bar-info';
    }
    elseif ($progress>70){
        $alert = 'progress-bar-success';
    }
    return $alert;
}
function month($progress){
    $month = '';
    if ($progress == 1){
        $month = 'January';
    }
    elseif ($progress == 2){
        $month = 'February';
    }
    elseif ($progress == 3){
        $month = 'March';
    }
    elseif ($progress == 4){
        $month = 'April';
    }
    elseif ($progress == 5){
        $month = 'May';
    }
    elseif ($progress == 6){
        $month = 'June';
    }
    elseif ($progress == 7){
        $month = 'July';
    }
    elseif ($progress == 8){
        $month = 'August';
    }
    elseif ($progress == 9){
        $month = 'September';
    }
    elseif ($progress == 10){
        $month = 'October';
    }
    elseif ($progress == 11){
        $month = 'November';
    }
    elseif ($progress == 12){
        $month = 'December';
    }
    return $month;

}
function mark($atten){
    return @$result = ($atten*7)/100;
}
function mail_send($mail_f,$mailc_f,$sendname_f,$state_f,$name){


require'../PHPMailer-master/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = "smtp.$mailc_f.com";  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'riaz.i3214@gmail.com';                 // SMTP username
$mail->Password = 'intelriaz14';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('from@example.com', 'Diu School');
$mail->addAddress($mail_f, $sendname_f);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Attendance of '.date('d M Y');
$mail->Body    = " Dear Parent,\nYour Child {$name} is $state_f in the Today";
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

$mail->send();



}

function mail_which($string){

    $ans  = substr($string,strpos($string,'@')+1,strpos($string,'.')+1);

    return $ans;
}


?>