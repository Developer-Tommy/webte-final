<?php

session_start();

use App\Controller\LogController;
use App\Model\Log;

//require "../app/PHPMailer/src/Exception.php";
//require '../app/PHPMailer/src/PHPMailer.php';
//require '../app/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//use PHPMailer\PHPMailer\SMTP;

require_once('libphp-phpmailer/autoload.php');

include '../app/vendor/autoload.php';

$logController = new LogController();
$_SESSION['http'] = "server";

if (isset($_POST['octave'])){
    $script = fopen("script.m", "w");
    fwrite($script, "pkg load control;");
    fwrite($script, $_POST['octave']);
    $val = "octave-cli --eval script";
    exec($val, $output);
    if ($output == null) {
        $log = new Log();
        $log->setCommand($_POST['octave']);
        $log->setInfo("failed");
        $logController->insertLog($log);
    }
    else {
        $log = new Log();
        $log->setCommand($_POST['octave']);
        $log->setInfo("successful");
        $logController->insertLog($log);
    }
    $_SESSION['out'] = $output;
    fclose($script);
    header("Location:index.php");

}

if (isset($_POST['r'])){
    $r = $_POST['r'];
    if (isset($_SESSION['active'])){
        $output2 = null;
        $newVal = $_SESSION['active'];
        $newVal = trim($newVal[2]);
        $newVal = str_replace("   ", ";",$newVal);
        $newVal = str_replace("  ", ";",$newVal);
        $script = fopen("script2.m", "w");
        $script2 = fopen("script3.m", "w");
        fwrite($script, "pkg load control;");
        fwrite($script2, "pkg load control;");
        $val = "m1 = 2500; m2 = 320;k1 = 80000; k2 = 500000;b1 = 350; b2 = 15020;A=[0 1 0 0;-(b1*b2)/(m1*m2) 0 ((b1/m1)*((b1/m1)+(b1/m2)+(b2/m2)))-(k1/m1) -(b1/m1);b2/m2 0 -((b1/m1)+(b1/m2)+(b2/m2)) 1;k2/m2 0 -((k1/m1)+(k1/m2)+(k2/m2)) 0];B=[0 0;1/m1 (b1*b2)/(m1*m2);0 -(b2/m2);(1/m1)+(1/m2) -(k2/m2)];C=[0 0 1 0]; D=[0 0];Aa = [[A,[0 0 0 0]'];[C, 0]];Ba = [B;[0 0]];Ca = [C,0]; Da = D;K = [0 2.3e6 5e8 0 8e6];sys = ss(Aa-Ba(:,1)*K,Ba,Ca,Da);t = 0:0.01:5;r =$r;[y,t,x]=lsim(sys*[0;1],r*ones(size(t)),t,[$newVal]);[x(:,1) x(:,3)]";
        $val2 = "m1 = 2500; m2 = 320;k1 = 80000; k2 = 500000;b1 = 350; b2 = 15020;A=[0 1 0 0;-(b1*b2)/(m1*m2) 0 ((b1/m1)*((b1/m1)+(b1/m2)+(b2/m2)))-(k1/m1) -(b1/m1);b2/m2 0 -((b1/m1)+(b1/m2)+(b2/m2)) 1;k2/m2 0 -((k1/m1)+(k1/m2)+(k2/m2)) 0];B=[0 0;1/m1 (b1*b2)/(m1*m2);0 -(b2/m2);(1/m1)+(1/m2) -(k2/m2)];C=[0 0 1 0]; D=[0 0];Aa = [[A,[0 0 0 0]'];[C, 0]];Ba = [B;[0 0]];Ca = [C,0]; Da = D;K = [0 2.3e6 5e8 0 8e6];sys = ss(Aa-Ba(:,1)*K,Ba,Ca,Da);t = 0:0.01:5;r =$r;[y,t,x]=lsim(sys*[0;1],r*ones(size(t)),t,[$newVal]);[x(size(x,1),:)]";
        fwrite($script, $val);
        fwrite($script2, $val2);
        $octave = "octave-cli --eval script2";
        $octave2 = "octave-cli --eval script3";
        exec($octave, $output);
        exec($octave2, $output2);
        if ($output == null) {
            $log = new Log();
            $log->setCommand($val);
            $log->setInfo("failed");
            $logController->insertLog($log);
        }
        else {
            $log = new Log();
            $log->setCommand($val);
            $log->setInfo("successful");
            $logController->insertLog($log);
        }
        $_SESSION['output'] = $output;
        $_SESSION['active'] = $output2;
    }
    else {
        $output = $output2 = null;
        $script = fopen("script2.m", "w");
        $script2 = fopen("script3.m", "w");
        fwrite($script, "pkg load control;");
        fwrite($script2, "pkg load control;");
        $val = "m1 = 2500; m2 = 320;k1 = 80000; k2 = 500000;b1 = 350; b2 = 15020;A=[0 1 0 0;-(b1*b2)/(m1*m2) 0 ((b1/m1)*((b1/m1)+(b1/m2)+(b2/m2)))-(k1/m1) -(b1/m1);b2/m2 0 -((b1/m1)+(b1/m2)+(b2/m2)) 1;k2/m2 0 -((k1/m1)+(k1/m2)+(k2/m2)) 0];B=[0 0;1/m1 (b1*b2)/(m1*m2);0 -(b2/m2);(1/m1)+(1/m2) -(k2/m2)];C=[0 0 1 0]; D=[0 0];Aa = [[A,[0 0 0 0]'];[C, 0]];Ba = [B;[0 0]];Ca = [C,0]; Da = D;K = [0 2.3e6 5e8 0 8e6];sys = ss(Aa-Ba(:,1)*K,Ba,Ca,Da);t = 0:0.01:5;r =$r;initX1=0; initX1d=0;initX2=0; initX2d=0;[y,t,x]=lsim(sys*[0;1],r*ones(size(t)),t,[initX1;initX1d;initX2;initX2d;0]);[x(:,1) x(:,3)]";
        $val2 = "m1 = 2500; m2 = 320;k1 = 80000; k2 = 500000;b1 = 350; b2 = 15020;A=[0 1 0 0;-(b1*b2)/(m1*m2) 0 ((b1/m1)*((b1/m1)+(b1/m2)+(b2/m2)))-(k1/m1) -(b1/m1);b2/m2 0 -((b1/m1)+(b1/m2)+(b2/m2)) 1;k2/m2 0 -((k1/m1)+(k1/m2)+(k2/m2)) 0];B=[0 0;1/m1 (b1*b2)/(m1*m2);0 -(b2/m2);(1/m1)+(1/m2) -(k2/m2)];C=[0 0 1 0]; D=[0 0];Aa = [[A,[0 0 0 0]'];[C, 0]];Ba = [B;[0 0]];Ca = [C,0]; Da = D;K = [0 2.3e6 5e8 0 8e6];sys = ss(Aa-Ba(:,1)*K,Ba,Ca,Da);t = 0:0.01:5;r =$r;initX1=0; initX1d=0;initX2=0; initX2d=0;[y,t,x]=lsim(sys*[0;1],r*ones(size(t)),t,[initX1;initX1d;initX2;initX2d;0]);[x(size(x,1),:)]";
        fwrite($script, $val);
        fwrite($script2, $val2);
        $octave = "octave-cli --eval script2";
        $octave2 = "octave-cli --eval script3";
        exec($octave, $output);
        exec($octave2, $output2);
        if ($output == null) {
            $log = new Log();
            $log->setCommand($val);
            $log->setInfo("failed");
            $logController->insertLog($log);
        }
        else {
            $log = new Log();
            $log->setCommand($val);
            $log->setInfo("successful");
            $logController->insertLog($log);
        }
        $_SESSION['output'] = $output;
        $_SESSION['active'] = $output2;

    }
    header("Location:index.php");
    exit;

}

if (isset($_POST['toCSV'])){

    $data = $logController->getAllLogs();
    createCSV($data);
    header("Location:index.php");
}

if (isset($_POST['sendEmail'])){

    header("Location:index.php");
    sendEmail();
}

function createCSV($data): void
{
    $header_args = array('ID', 'Command', 'Timestamp', 'Info');

    ob_start();

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');

    $output = fopen( 'php://output', 'w' );
    $csv = fopen( 'output.csv', 'w' );
    ob_end_clean();
    fputcsv($output, $header_args);
    fputcsv($csv, $header_args);

    foreach($data AS $data_item){
        fputcsv($output, $data_item);
        fputcsv($csv, $data_item);
    }
    exit;
}

function sendEmail(): void
{
    try {
        //Server settings
        //                      //Enable verbose debug output
        $mail = new PHPMailer(true);
        //$mail->SMTPDebug = 2;

        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->SMTPSecure = "tsl";
        $mail->Host = 'mail.stuba.sk';  //gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Port = 25;
        $mail->Username = "xknapcok@stuba.sk";   //username
        $mail->Password = "7TOMAS7knapcok7";   //password


        //Recipients
        $mail->setFrom('xknapcok@stuba.sk', 'TestMail');
        $mail->addAddress('lejkoivan@gmail.com');               //Name is optional
        //$mail->addReplyTo('xknapcok@stuba.sk', 'Information');

        //Attachments
        $mail->addAttachment('output.csv');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $result = $mail->send();
        if(!$result) {
            echo "failed";
        } else {
            echo "Email successful";

        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}
