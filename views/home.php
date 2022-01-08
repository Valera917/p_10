<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Login</title>
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
       <?php if(!isset($_SESSION['auth'])):?>
       <h3>Login</h3>
       <form action="?action=auth" method="post">
           <div class="row">
               <div class="field">
                   <label>Email: <input type="email" name="email"></label>
               </div>
           </div>
           <div class="row">
               <div class="field">
                   <label>Password: <input type="password" name="password"><br></label>
               </div>
           </div>
           <input type="submit" class="btn" value="Login">
       </form>
       <div>
           <a href="?controller=users">List of all Users</a><br>
           <a href="?controller=roles">List of all Roles</a>
       </div>
       <?php else:?>
        <h3>You are logged in.</h3>
        <a href="?action=logout">Logout</a><br>
        <a href="?controller=users">List of all Users</a><br>
        <a href="?controller=roles">List of all Roles</a><br>
        <a href="?action=contacts">Send mail</a>
        <?php endif;?>
</div>
</body>
</html>
