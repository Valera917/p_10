<?php
namespace App\Models;
class User {
   private $name;
   private $email;
   private $gender;
   private $imagePath;
   private $password;

   public function __construct($name = '', $email = '', $gender = '', $imagePath = '', $password = '')
   {
       $this->name = $name;
       $this->email = $email;
       $this->gender = $gender;
       $this->imagePath = $imagePath;
       $this->password = $password;
   }

   public function add($conn) {
       $sql = "INSERT INTO users (email, name, gender, password, path_to_img)
           VALUES ('$this->email', '$this->name','$this->gender', '$this->password', '$this->imagePath')";
           $res = mysqli_query($conn, $sql);
           if ($res) {
               return true;
           }
   }

   public static function delete($conn, $id) {
        $sql = "DELETE FROM users WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            return true;
        }
    }

    public static function update($conn, $id, $data){
        $email = $data['email'];
        $name = $data['name'];
        $gender = $data['gender'];
        $imagePath = $data['filepath'];
        $sql = "UPDATE users SET email = '$email', name = '$name', gender = '$gender', path_to_img = '$imagePath' WHERE id = $id";
        $res = mysqli_query($conn, $sql);
        if($res){
            return true;
        }
    }

 
   public static function all($conn) {
       $sql = "SELECT * FROM users";
       $result = $conn->query($sql); //виконання запиту
       if ($result->num_rows > 0) {
           $arr = [];
           while ( $db_field = $result->fetch_assoc() ) {
               $arr[] = $db_field;
           }
           return $arr;
       } else {
           return [];
       }
   }

   public static function byId($conn, $id){
       $sql = "SELECT * FROM users WHERE id = $id";
       $result = $conn->query($sql);
       if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
   }
}
