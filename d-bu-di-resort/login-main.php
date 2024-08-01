<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>D-bu-di-resort</title>
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
                <span onclick="click()">d-bu-di-resort</span>

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
                    <div class="col-md-5">
                        <img src="./img/logo.jpg" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <div class="brand-wrapper">

                            </div>
                            <p class="login-card-description">เข้าสู่ระบบ</p>
                            <form action="#" onsubmit="handleLogin(event)">
                                <div class="form-group">
                                    <label for="email" class="sr-only">ชื่อผู้ใช้</label>
                                    <input type="text" name="username" id="username" required class="form-control" placeholder="username">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">รหัสผ่าน</label>
                                    <input type="password" name="password" id="password" required class="form-control" placeholder="***********">
                                </div>

                                <button type="submit" class="btn btn-block login-btn mb-4">Login</button>
                            </form>
                            <p class="login-card-footer-text">คุณยังไม่ได้สมัครสมาชิกใช่ไหม? <a href="register.php" class="text-reset">สมัครสมาชิก</a></p>

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
    function handleLogin(e) {
        e.preventDefault();
        let value = {
            username: document.getElementById('username').value,
            password: document.getElementById('password').value,
        }
        var xhr = new XMLHttpRequest();
        xhr.open('POST', './db/login.php', true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onload = function() {
            if (this.status == 200) {
                let data = JSON.parse(this.responseText)
                console.log(data)
                if (data) {
                    sessionStorage.setItem('user_id', data[0].user_id)
                    sessionStorage.setItem('user_group', data[0].user_group)
                    sessionStorage.setItem('first_name', data[0].first_name)
                    sessionStorage.setItem('last_name', data[0].last_name)

                    window.location.href = "index.php"
                } else {
                    alert('username or password is incorrect')
                }
            }
        }
        xhr.send(JSON.stringify(value))
    }
</script>

</html>