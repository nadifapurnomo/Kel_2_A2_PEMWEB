    <!DOCTYPE html>
<html lang="en">
<head>
    
    
    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../style/logreg.css">
         
    <!-- <title>Selamat Datang</title> -->
</head>
<body>
    
 <!-- Main Container -->
<div class="container">
    
    <div class="forms">
        <!-- Login Form -->
        <div class="form login">
            <span class="title">Login!</span>
            <!-- Login Form Fields -->
            <form action="proseslogin.php" method="post">
                <div class="input-field">
                    <input type="text" name="username" placeholder="Masukkan Username" required>
                    <i class="uil uil-envelope icon"></i>
                </div>
                <div class="input-field">
                    <input type="password" name="password" class="password" placeholder="Masukkan Password" required>
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePw"></i>
                </div>
                
                <!-- Login and Home Buttons -->
                <div class="input-field button">
                    <input type="submit" value="Login">
                </div>
                <div class="input-field button">
                    <a href="index.php" class="btn"><input type="button" value="Home"></a>
                </div>
            </form>
            <!-- Registration Link -->
            <div class="login-signup">
                <span class="text">Belum punya akun?
                    <a href="#" class="text signup-link">Daftar sekarang!</a>
                </span>
            </div>
        </div>

        <!-- Registration Form -->
        <div class="form signup">
            <span class="title">Daftar!</span>
            <!-- Registration Form Fields -->
            <form action="prosesdaftar.php" method="post">
                
               <div class="input-field">
                    <input type="text" name="username" placeholder="Masukkan Username" required>
                    <i class="uil uil-user"></i>
                </div>
                <div class="input-field">
                    <input type="password" name="password" minlength="5" maxlength="10" class="password" placeholder="Masukkan Password" required>
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePw"></i>
                </div>
                <div class="input-field">
                    <input type="password" name="konfirmasi" minlength="5" maxlength="10" class="password" placeholder="Masukkan Konfirmasi Password" required>
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePw"></i>
                </div>

                
                <!-- Registration Button -->
                <div class="input-field button">
                    <input type="submit" value="Daftar">
                </div>
            </form>
             <!-- Login Link -->
            <div class="login-signup">
                <span class "text">Sudah punya akun?
                    <a href="#" class="text login-link">Login Sekarang</a>
                </span>
            </div>
        </div>
    </div>
</div>


    <script>
  // JavaScript code to show/hide password and switch icon
const container = document.querySelector(".container"),
      pwShowHide = document.querySelectorAll(".showHidePw"),
      pwFields = document.querySelectorAll(".password"),
      signUp = document.querySelector(".signup-link"),
      login = document.querySelector(".login-link");

    //   js code to show/hide password and change icon
    pwShowHide.forEach(eyeIcon =>{
        eyeIcon.addEventListener("click", ()=>{
            pwFields.forEach(pwField =>{
                if(pwField.type ==="password"){
                    pwField.type = "text";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye-slash", "uil-eye");
                    })
                }else{
                    pwField.type = "password";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye", "uil-eye-slash");
                    })
                }
            }) 
        })
    })

    // js code to appear signup and login form
    signUp.addEventListener("click", ( )=>{
        container.classList.add("active");
    });
    login.addEventListener("click", ( )=>{
        container.classList.remove("active");
    });
    </script>

</body>
</html>