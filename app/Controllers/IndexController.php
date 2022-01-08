<?php
namespace app\Controllers;
use App\Models\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

 const ADMIN_PASSWORD = '111111';
 const ADMIN_EMAIL = 'admin@admin.com';
class IndexController
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db->getConnect();
    }

   public function index()
   {
       // виклик відображення
       include_once 'views/home.php';
   }

   public function auth(){
    filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if($_POST['email'] == ADMIN_EMAIL && $_POST['password'] == ADMIN_PASSWORD){
        $_SESSION['auth'] = true;
    }
    header('Location: index.php');
   }

   public function denyaccess(){
       include_once 'views/denyaccess.php';
   }

   public function logout(){
        session_unset();
        header('Location: index.php');
   }
   
   public function contacts(){
    include_once 'views/contacts.php';
   }

   public function sendmail(){

    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // var_dump($_ENV['SMTP_SERVER']);
    // var_dump($_ENV['SMTP_PORT']);
    // var_dump($_ENV['SMTP_USERNAME']);
    // var_dump($_ENV['SMTP_PASSWORD']);
    // var_dump($_ENV['SMTP_ADMIN_ADDRESS']);
    try{
        $mail = new PHPMailer(); 
        $mail->IsSMTP();
        $mail->SMTPAuth = true; 
        $mail->SMTPSecure= 'ssl';
        $mail->CharSet = 'UTF-8'; 
        $mail->Host = $_ENV['SMTP_SERVER']; 
        $mail->Port = $_ENV['SMTP_PORT'];
        $mail->isHTML(true);
        $mail->Username = $_ENV['SMTP_USERNAME']; 
        $mail->Password = $_ENV['SMTP_PASSWORD']; 
        $mail->Subject = $subject; 
        $mail->Body = "
        <h3>Author: $author</h3>
        <p>$text</p>
        "; 
        $mail->AddAddress($_ENV['SMTP_USERNAME']);
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
   }
}



