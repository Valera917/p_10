<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Add User</title>
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
       <!-- Form to add User -->
       <h3>Add New User</h3>
       <form action="?controller=users&action=add" method="post" enctype="multipart/form-data">
           <div class="row">
               <div class="field">
                   <label>Name: <input type="text" name="name"></label>
               </div>
           </div>
           <div class="row">
               <div class="field">
                   <label>E-mail: <input type="email" name="email"><br></label>
               </div>
           </div>
           <!-- <div class="row">
               <div class="field">
                   <label>Role: <select name="role">
                       <option value="1">Admin</option>
                       <option value="2">Default</option>
                   </select></label>
               </div>
            </div> -->
           <div class="row">
               <div class="field">
                   <label>
                       <input class="with-gap" type="radio" name="gender" value="female"/>
                       <span>Female</span>
                   </label>
               </div>
               <div class="field">
                   <label>
                       <input class="with-gap"  type="radio" name="gender" value="male"/>
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
                       <input class="file-path validate" type="text">
                   </div>
               </div>
           </div>
           <input type="submit" class="btn" value="Add">
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
