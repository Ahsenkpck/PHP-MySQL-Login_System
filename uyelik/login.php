<?php

include("baglanti.php");

$username_err = "";
$parola_err = "";


if (isset($_POST["giris"])) {

    //KULLANICI ADI DOĞRULAMA
    if (empty($_POST["username"])) {
        $username_err = "Kullanıcı adı boş geçilemez!";
    } else {
        $username = $_POST["username"];
    }

    //PAROLA DOĞRULAMA
    if (empty($_POST["parola"])) {
        $parola_err = "Şifre Alanı boş geçilemez.";
    } else {
        $parola = $_POST["parola"];
    }


    if (isset($username) && isset($parola)) {

        $secim = "SELECT * FROM kullanicilar WHERE kullanici_adi= '$username'";
        $calistir = mysqli_query($baglanti, $secim);
        $kayitsayisi = mysqli_num_rows($calistir); //ya 0 ya 1

        if ($kayitsayisi > 0) {
            $ilgilikayit=mysqli_fetch_assoc($calistir);
            $hashlisifre=$ilgilikayit["parola"];

            if(password_verify($parola,$hashlisifre)){
            session_start();
            $_SESSION["kullanici_adi"]=$ilgilikayit["kullanici_adi"];
            $_SESSION["email"]=$ilgilikayit["email"];
            header("location:profile.php");

            }else{
                echo '<div class="alert alert-danger" role="alert"> Parola uyuşmuyor! </div>';

            }
        } else {
            echo '<div class="alert alert-danger" role="alert"> Kullanıcı adı yanlış! </div>';
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
    <title>ÜYE GİRİŞ İŞLEMİ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>

    <div class="container pt-5">
        <h2 style="text-align:center;">GİRİŞ YAP</h2>
        <div class="card p-5">
            <form action="login.php" method="POST">
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


                <button type="submit" name="giris" class="btn btn-success">GİRİŞ YAP</button>
            </form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>