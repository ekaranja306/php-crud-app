<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <title>Php crud app</title>

   <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">

   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
   <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

   <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

   <?php

   require_once 'config.php';

   require_once 'functions.php';

   session_start();

   $sqlFetch = "SELECT * FROM users ORDER BY id ASC";
   $result = mysqli_query($connection, $sqlFetch) or die(mysqli_error($connection));

   $sqlFetchRec = "SELECT COUNT(*) as records FROM users";
   $results = mysqli_query($connection, $sqlFetchRec) or die(mysqli_error($connection));

   ?>

   <div class="container">

      <!-- Header -->
      <header class="header">
         <img src="assets/images/logo.png" alt="PHP CRUD APP" title="Php crud app" class="logo">
      </header>

      <!-- Error container -->
      <div id="message" class="message <?php echo $_SESSION['toggle']; ?>">
         <p><?php echo $_SESSION['message']; ?></p>
         <button class="btn" id="close" onclick="closeError()"><i class="fa fa-times"></i></button>
      </div>

      <!-- The content section -->
      <section class="content">

         <!-- Where records are rendered -->
         <div class="records">

            <?php
            if (mysqli_num_rows($result) > 0) : ?>
               <div class="search-form">
                  <i class="fa fa-search"></i>
                  <input type="text" id="searchField" name="search" class="in-field" onkeyup="searchFunction()" placeholder="Search record...">
                  <span class="list-count">
                     <?php
                     while ($data = mysqli_fetch_array($results)) {
                        echo $data['records'];
                     }
                     ?>
                  </span>
               </div>
            <?php else : echo '<br><center>No records yet.</center><br><br>';
         endif; ?>
            <?php
            if (mysqli_num_rows($result) > 0) :
               while ($user = mysqli_fetch_assoc($result)) :
                  ?>
                  <div id="recordList">
                     <div class="user">
                        <div class="user-dp">
                           <img src="images/user.png" alt="<?php echo $user['firstname'] . ' ' . $user['lastname']; ?>">
                        </div>
                        <div class="user-details">
                           <h2 class="user-name item"><?php echo $user['firstname'] . ' ' . $user['lastname']; ?></h2>
                           <p class="user-det item"><i class="fa fa-envelope"></i> <?php echo $user['email']; ?> <i class="fa fa-user-alt"></i> <?php echo $user['username']; ?></p>
                        </div>
                        <div class="controlls">
                           <a href="index.php?edit=<?php echo $user['id']; ?>" class="btn edit"><i class="fa fa-edit"></i></a>
                           <a href="index.php?delete=<?php echo $user['id']; ?>" class="btn del"><i class="far fa-trash-alt"></i></a>
                        </div>
                     </div>
                  </div>
                  <hr>
               <?php endwhile;
         else :
            echo '<center>Registered persons will appear here</center>';
         endif; ?>
         </div>

         <!-- The registration form -->
         <div class="main-form">
            <header class="form-header">
               <h2>Add user</h2>
            </header>
            <form action="register.php" method="post" name="registerForm" autocomplete="off" enctype="multipart/form-data" onsubmit="return validateForm()">
               <input type="hidden" name="userId" value="<?php echo $id; ?>">
               <div class="input-cont xl">
                  <div class="input-cont">
                     <label for="fname" class="label">First name:</label>
                     <input type="text" id="fname" name="fname" class="in-field" value="<?php echo $fname; ?>" required>
                     <p class="error-msg"></p>
                  </div>
                  <div class="input-cont">
                     <label for="lname" class="label">Last name:</label>
                     <input type="text" id="lname" name="lname" class="in-field" value="<?php echo $lname; ?>" required>
                     <p class="error-msg"></p>
                  </div>
               </div>
               <div class="input-cont l">
                  <div class="input-cont">
                     <label for="username" class="label">Username:</label>
                     <input type="text" id="username" name="username" class="in-field" value="<?php echo $username; ?>" required>
                     <p class="error-msg"></p>
                  </div>
               </div>
               <div class="input-cont l">
                  <label for="email" class="label">Email:</label>
                  <input type="email" id="email" name="email" class="in-field" value="<?php echo $email; ?>" required>
                  <p class="error-msg"></p>
               </div>
               <?php if ($update == true) : ?>
                  <input type="submit" id="submit" name="update" value="UPDATE" class="btn">
               <?php else : ?>
                  <input type="submit" id="submit" name="register" value="REGISTER" class="btn">
               <?php endif; ?>
            </form>
         </div>
      </section>

      <!-- Footer -->
      <footer class="footer">
         <img src="assets/images/logoDark.png" alt="PHP CRUD APP" title="Php crud app" class="logo">
      </footer>
   </div>

   <?php
   unset($_SESSION['toggle']);
   unset($_SESSION['message']);
   ?>

   <!-- scripts -->
   <script src="assets/js/main.js"></script>

</body>

</html>