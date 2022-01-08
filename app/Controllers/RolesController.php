<?php
namespace app\Controllers;
use App\Models\Role;

class RolesController
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

       $roles = (new Role())::all($this->conn);

       include_once 'views/roles.php';
   }

   public function addForm(){
    if(!isset($_SESSION['auth'])){
        header('Location: ?action=denyaccess');
        exit();
    }
       include_once 'views/addRole.php';
   }

   public function add()
   {
    if(!isset($_SESSION['auth'])){
        header('Location: ?action=denyaccess');
        exit();
    }

       $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       if (trim($title) !== "") {
           $role = new Role($title);
           $role->add($this->conn);
       }
       header('Location: ?controller=roles');
   }

   public function show(){
    if(!isset($_SESSION['auth'])){
        header('Location: ?action=denyaccess');
        exit();
    }
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($id) !== "" && is_numeric($id)) {
         $role = (new Role())::byId($this->conn, $id);
        }
        if($role){
            include_once 'views/showRole.php';
        }else{
            include_once 'views/roles.php';
        }
    }

    public function edit(){
        if(!isset($_SESSION['auth'])){
            header('Location: ?action=denyaccess');
            exit();
        }
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $data = [
            'title' => $_POST['title'],
        ];
        if (trim($id) !== "" && is_numeric($id)) {
            $role = (new Role())::update($this->conn, $id, $data);
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
        (new Role())::delete($this->conn, $id);
    }
    header('Location: ?controller=roles');
 }
}