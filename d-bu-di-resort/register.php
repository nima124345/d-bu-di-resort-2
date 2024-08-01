<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>d-bu-di-resort</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/login.css">
</head>
<?php include './layouts/head.php'; ?>

<body>
    <section id="header-contact">
        <div class="container d-flex justify-content-between">
            <div class="section-language d-flex align-items-center justify-content-center">
                <span href="index.php">d-bu-di-resort</span>
            </div>
            <div class="d-flex">
                <div class="border-right-withe px-2">
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="border-right-withe px-2">
                    <i class="fa-brands fa-line"></i>
                </div>
                <div class="border-right-withe px-2">
                    <i class="fa-brands fa-facebook"></i>
                </div>
            </div>
        </div>
    </section>


    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <img src="./img/logo.jpg" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="brand-wrapper">

                            </div>
                            <p class="login-card-description">Register</p>
                            <form action="#" onsubmit="handleRegister(event)">
                                <div class="form-group">
                                    <label for="email" class="sr-only">Username</label>
                                    <input type="text" class="form-control" id="re_username" required placeholder="Username">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" class="form-control" id="re_password" required placeholder="Password">
                                </div>

                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">ชื่อ</label>
                                    <input type="text" class="form-control" id="re_first_name" required placeholder="ชื่อ">
                                </div>


                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">email</label>
                                    <input type="email" class="form-control" id="re_email" required placeholder="Email">
                                </div>


                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">เบอร์โทรศัพท์</label>
                                    <input type="tel" minlength="10" class="form-control" id="re_tel" required placeholder="เบอร์โทรศัพท์">
                                </div>

                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">ที่อยู่ในการจัดส่ง</label>
                                    <input type="text" class="form-control" id="re_address" required placeholder="ที่อยู่ในการจัดส่ง">
                                </div>


                                <button type="submit" class="btn btn-block login-btn mb-4">Register</button>
                            </form>
                            <p class="login-card-footer-text"> If you already have a user account, you can <a href="login-main.php" class="text-reset">Login</a></p>



                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

<script>
    function handleRegister() {
        submitRegister()
    }


    function submitRegister() {
        let text = `คุณต้องการสมัครสมาชิกใช่หรือไม่ ?`;
        if (confirm(text) == true) {
            let value = {
                user_name: document.getElementById('re_username').value,
                password: document.getElementById('re_password').value,
                name: document.getElementById('re_first_name').value,
                email: document.getElementById('re_email').value,
                tel: document.getElementById('re_tel').value,
                address: document.getElementById('re_address').value,

            }
            var xhr = new XMLHttpRequest();
            xhr.open('POST', './db/register.php', true);
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.onload = function() {
                if (this.status == 200) {
                    alert('สมัครสมาชิกเรียบร้อยแล้ว')
                    window.location.href = "./login-main.php"
                }
            }
            xhr.send(JSON.stringify(value))

        }
    }
</script>

</html>