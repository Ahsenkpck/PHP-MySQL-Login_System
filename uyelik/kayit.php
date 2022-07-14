<?php

include("baglanti.php");

$username_err = "";
$email_err = "";
$parola_err = "";
$parolatkr_err = "";


if (isset($_POST["kaydet"])) {

  //KULLANICI ADI DOĞRULAMA
  if (empty($_POST["username"])) {
    $username_err = "Kullanıcı adı boş geçilemez!";
  } else if (strlen($_POST["username"]) < 6) {
    $username_err = "Kullanıcı adı en az 6 karakterden oluşmaktadır.";
  } else if (!preg_match('/^[a-z\d_]{5,20}$/i', $_POST["username"])) {
    $username_err = "Kullanıcı adı büyük küçük harf ve rakamdan oluşmalıdır.";
  } else {
    $username = $_POST["username"];
  }
  //E-MAİL DOĞRULAMA

  if (empty($_POST["email"])) {
    $email_err = "E-Mail alanı boş geçilemez.";
  } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Geçersiz e-mail formatı.";
  } else {
    $email = $_POST["email"];
  }

  //PAROLA DOĞRULAMA
  if (empty($_POST["parola"])) {
    $parola_err = "Şifre Alanı boş geçilemez.";
  } else {
    $parola =password_hash($_POST["parola"], PASSWORD_DEFAULT);
  }

  //PAROLA TEKRAR DOĞRULAMA
  if (empty($_POST["parolatkr"])) {
    $parolatkr_err = "Parola Tekrar Alanı boş geçilemez.";
  } else if ($_POST["parola"] != $_POST["parolatkr"]) {
    $parolatkr_err = "Parolalar eşleşmiyor.";
  } else {
    $parolatkr =  $_POST["parolatkr"];
  }


  if(isset($username)&&isset($email)&&isset($parola)){

  $ekle = "INSERT INTO kullanicilar (kullanici_adi, email, parola) VALUES ('$username','$email','$parola')";
  $calistirekle = mysqli_query($baglanti, $ekle);

  if ($calistirekle) {
    echo '<div class="alert alert-success" role="alert">
      Kayıt başarılı bir şekilde eklendi!
    </div>';
  } else {
    echo '<div class="alert alert-danger" role="alert">
      Kayıt eklenirken bir problem oluştu!
    </div>';
  }
  mysqli_close($baglanti);
}
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ÜYE KAYIT İŞLEMİ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>

  <div class="container pt-5">
    <h2 style="text-align:center;">ÜYE KAYIT FORMU</h2>
    <div class="card p-5">
      <form action="kayit.php" method="POST">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Kullanıcı Adı</label>
          <input type="text" class="form-control
          
          <?php
          if (!empty($username_err)) {

            echo "is-invalid";
          }

          ?>
          
          " id="exampleInputEmail1" name="username">
          <div id="validationServer03Feedback" class="invalid-feedback"><?php echo $username_err;  ?></div>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">E-Posta</label>
          <input type="email" class="form-control
          
          <?php
          if (!empty($email_err)) {

            echo "is-invalid";
          }

          ?>
          
          
          " id="exampleInputEmail1" name="email">
          <div id="validationServer03Feedback" class="invalid-feedback"><?php echo $email_err; ?></div>
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Şifre</label>
          <input type="password" class="form-control
          
          <?php
          if (!empty($parola_err)) {

            echo "is-invalid";
          }

          ?>
          
          
          " id="exampleInputPassword1" name="parola">
          <div id="validationServer03Feedback" class="invalid-feedback"><?php echo $parola_err; ?></div>
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Şifre</label>
          <input type="password" class="form-control
          
          <?php
          if (!empty($parolatkr_err)) {

            echo "is-invalid";
          }

          ?>
        
          " id="exampleInputPassword1" name="parolatkr">
          <div id="validationServer03Feedback" class="invalid-feedback"><?php echo $parolatkr_err; ?></div>
        </div>

        <button type="submit" name="kaydet" class="btn btn-success">KAYDET</button>
      </form>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>