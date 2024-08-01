<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <div style="width: 60px; height: 60px">
                <img class="img-fluid" src="./img/logo.jpg" alt="" />
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link font-14" href="index.php">หน้าแรก <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-14" href="index.php#our-product">ห้องพักทั้งหมด</a>
                </li>
                <li id="btnlogin" class="nav-item">
                    <a class="nav-link font-14" href="login-main.php">เข้าสู่ระบบ</a>
                </li>
                <li id="btnhistory" class="nav-item">
                    <a class="nav-link font-14" href="history.php">ประวัติการจองห้องพัก</a>
                </li>
                <!-- <li id="btnprofile" class="nav-item">
                    <a class="nav-link font-14" href="profile.php">ประวัติส่วนตัว</a>
                </li> -->


                <li id="btnLogout" class="nav-item">
                    <a class="nav-link font-14" href="#" onclick="logout()">ออกจากระบบ</a>
                </li>

            </ul>
            <div onclick="openCart()" class="d-flex mt-2 mt-lg-0">
                <div class="position-relative" style="cursor: pointer">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <div class="card-cart">
                        <span id="cartTotal">0</span>
                    </div>
                </div>
                <div onclick="openCart()" class="font-12 ml-2 d-flex align-items-end" style="cursor: default">
                    <!-- <span>My Cart 0.00฿</span> -->
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    CountCart()
    var firstname = sessionStorage.getItem("first_name");

    if (firstname && firstname !== null) {
        document.getElementById('btnlogin').hidden = true
    } else {
        document.getElementById('btnhistory').hidden = true
        document.getElementById('btnprofile').hidden = true
        document.getElementById('btnLogout').hidden = true


    }

    function logout() {
        let text = `คุณต้องการออกจากระบบใช่หรือไม่ ?`;
        if (confirm(text) == true) {
            handleLogout()
        }
    }

    function handleLogout() {
        sessionStorage.clear();
        window.location.href = "index.php"
    }

    function CountCart() {
        var xhr = new XMLHttpRequest();
        const user_id = sessionStorage.getItem("user_id");
        xhr.open('GET', './db/cart.php?countCart=' + user_id, true);
        xhr.onload = function() {
            if (this.status == 200) {
                let data = JSON.parse(this.responseText)
                data = data[0]
                console.log(data.countCart)
                document.getElementById('cartTotal').textContent = data.countCart ?? 0
            }
        }
        xhr.send()
    }
</script>