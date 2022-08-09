<?php 

require_once("config.php");

if(isset($_POST['login'])){

    $ussername = filter_input(INPUT_POST, 'ussername', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM users WHERE ussername=:ussername";
    $stmt = $db->prepare($sql);
    
    // bind parameter ke query
    $params = array(
        ":ussername" => $ussername,
        
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if($user){
        // verifikasi password
        if(password_verify($password, $user["password"])){
            // buat Session
            session_start();
            $_SESSION["user"] = $user;
            // login sukses, alihkan ke halaman timeline
            header("Location: isi.php");
        }
    }
}
?>


<link type="text/css" rel="stylesheet" href="style.css">
<form action="" method="post">
  <div class="background">
    <div class="imgcontainer">
      <img src="logoskola.png" alt="Avatar" class="avatar">
    </div>
  
    <div class="container">
      <label for="ussername"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="ussername" required>
  
      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
  
      <button type="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>
  
    <div class="container">
      <button type="button" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </div>
  </form>
  