<?php
namespace app\Controllers;
use App\Models\User;

class UsersController
{
   private $conn;
   public function __construct($db)
   {
       $this->conn = $db->getConnect();
   }

   public function index()
   {
       if(!isset($_SESSION['auth'])){
           header('Location: ?action=denyaccess');
           exit();
       }

       // отримання користувачів
       $users = (new User())::all($this->conn);

       include_once 'views/users.php';
   }

   public function addForm(){
    if(!isset($_SESSION['auth'])){
        header('Location: ?action=denyaccess');
        exit();
    }
       include_once 'views/addUser.php';
   }

   public function add()
   {
    if(!isset($_SESSION['auth'])){
        header('Location: ?action=denyaccess');
        exit();
    }
       // блок з валідацією
       $target_dir = 'public/uploads/images';
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $filePath = $target_file;
        } else {
            $filePath = 'https://www.secondcity.com/wp-content/uploads/2014/09/SC_Alumni_Murray_Bill_600x600_001-150x150.jpg';
        }

       $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
       $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       if (trim($name) !== "" && trim($email) !== "" && trim($gender) !== "") {
           // додати користувача
           $user = new User($name, $email, $gender, $filePath);
           $user->add($this->conn);
       }
       header('Location: ?controller=users');
   }

   public function show(){
    if(!isset($_SESSION['auth'])){
        header('Location: ?action=denyaccess');
        exit();
    }
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($id) !== "" && is_numeric($id)) {
         $user = (new User())::byId($this->conn, $id);
        }
        if($user){
            include_once 'views/showUser.php';
        }else{
            include_once 'views/users.php';
        }
    }

    public function edit(){
        if(!isset($_SESSION['auth'])){
            header('Location: ?action=denyaccess');
            exit();
        }
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $target_dir = 'public/uploads/images';
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $filePath = $target_file;
        } else {
            $filePath = 'https://www.secondcity.com/wp-content/uploads/2014/09/SC_Alumni_Murray_Bill_600x600_001-150x150.jpg';
        }

        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'gender' => $_POST['gender'],
            'filepath'=> $filePath
        ];
        if (trim($id) !== "" && is_numeric($id)) {
            $user = (new User())::update($this->conn, $id, $data);
        }
        
        $this -> index();
    }


   public function delete() {
    if(!isset($_SESSION['auth'])){
        header('Location: ?action=denyaccess');
        exit();
    }
    // блок з валідацією
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (trim($id) !== "" && is_numeric($id)) {
        (new User())::delete($this->conn, $id);
    }
    header('Location: ?controller=users');
 }
 
}
