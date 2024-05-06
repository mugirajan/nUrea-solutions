<?php
require_once("./vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class sndMail
{
    private $f;
    private $valid = array("success" => false, "message" => "");

    public function __construct() {
        if (!session_id()) {
            session_start();
        }
        $this->f = "file.txt";
        file_put_contents($this->f, "file ready" . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    private function configureMailer() {
        $mail = new PHPMailer(true); // Passing true enables exceptions
        $mail->isSMTP();
        $mail->Host = "smtp.hostinger.com";
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = "contact@blackitechs.com";
        $mail->Password = "Contact@bits#737";
        $mail->setFrom("contact@blackitechs.com", "Mail from BITS");

        return $mail;
    }

    public function contactEnquiry($data) {
        
        $mail = $this->configureMailer();

        try {
            // Send email to enquirer
            $mail->addAddress($data['email']);
            $mail->Subject = "Your enquiry is taken into consideration - " . $data['name'];
            $mail->Body = "<br /><br />Will get back to you shortly<br /><br />Thanks and Regards, <br />Team BITS";

            $mail->send();
            $this->valid['success'] = true;
            $this->valid['message'] = "Mail sent successfully to enquirer.";
        } catch (Exception $e) {
            $this->valid['message'] = "Failed to send mail to enquirer: " . $mail->ErrorInfo;
        }

        // Send email to admin
        try {
            $mail->clearAddresses(); // Clear previous recipient

            $mail->addAddress("mugirajan95@gmail.com"); // Admin's email address
            $mail->addAddress("kamalrajganesan2000@gmail.com"); // Admin's email address
            $mail->Subject = "New enquiry - " . $data['name'];
            $mail->Body = "
                <h3>Contact details:</h3>
                <strong>Name:</strong> {$data['name']} <br />
                <strong>Email:</strong> {$data['email']} <br />
                <strong>Phone:</strong> {$data['phone']} <br />
                <strong>Message:</strong> {$data['comments']} <br />
            ";

            $mail->send();
            $this->valid['success'] = true;
            $this->valid['message'] = "Mail sent successfully to admin.";
        } catch (Exception $e) {
            $this->valid['message'] = "Failed to send mail to admin: " . $mail->ErrorInfo;
        }

        return $this->valid;
    }
}
?>
