<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Show User</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <style>
       body{
           padding-top: 3rem;
       }
       .container {
           width: 400px;
       }
   </style>
</head>
<body>
<div class="container">
       <h3>Show User Form</h3>
       <form action="?controller=users&action=edit" method="post" enctype="multipart/form-data">
           <input type="hidden" name="id" value="<?=$user['id']?>" />
           <div class="row">
               <div class="field">
                   <label>Name: <input type="text" name="name" value="<?=$user['name']?>"></label>
               </div>
           </div>
           <div class="row">
               <div class="field">
                   <label>E-mail: <input type="email" name="email" value="<?=$user['email']?>"><br></label>
               </div>
           </div>
           <div class="row">
               <div class="field">
                   <label>
                       <input class="with-gap" type="radio" name="gender" 
                       <?php if($user['gender'] == 'female'){
                           echo 'checked';
                       }
                       ?>
                        value="female"/>
                       <span>Female</span>
                   </label>
               </div>
               <div class="field">
                   <label>
                       <input class="with-gap"  type="radio" name="gender"
                       <?php if($user['gender'] == 'male'){
                           echo 'checked';
                       }
                       ?> 
                       value="male"/>
                       <span>Male</span>
                   </label>
               </div>
           </div>
           <div class="row">
               <div class="file-field input-field">
                   <div class="btn">
                       <span>Photo</span>
                       <input type="file" name="photo"  accept="image/png, image/gif, image/jpeg">
                   </div>
                   <div class="file-path-wrapper">
                       <input class="file-path validate" type="text" value="Upload new image">
                   </div>
               </div>
           </div>
           <input type="submit" class="btn" value="Update">
       </form>
</div>
<script>
    const fileInput = document.querySelector('input[type="file"]');
    const filePathField = document.querySelector('.file-path');

    fileInput.addEventListener('input', (e) => {
        if(e.currentTarget.value){
            filePathField.value = e.currentTarget.value;
        }else{
            filePathField.value = 'Invalid file';
        }
    });
</script>
</body>
</html>
