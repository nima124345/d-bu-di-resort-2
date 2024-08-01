<?php include './layouts/header.php'; ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="./../img/logo.jpg" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: 0.8" />
        <span class="brand-text font-weight-light">ระบบจัดการจองห้องพัก</span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">

            </div>
            <div class="info">
                <a id="fullName" href="#" class="d-block"></a>
                <button data-toggle="modal" data-target="#modal-form-dataxyz" onclick="setProfile()" class="btn btn-primary btn-sm">แก้ไขข้อมูลส่วนตัว</button>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li id="0" class="nav-item">
                    <a href="index.php" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Home

                        </p>
                    </a>
                </li>


                <li id="1" class="nav-item">
                    <a href="order.php" class="nav-link">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>รายการจองห้อง</p>
                    </a>
                </li>
                <li id="2" class="nav-item">
                    <a href="product.php" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>ข้อมูลห้อง</p>
                    </a>
                </li>


                <li id="3" class="nav-item">
                    <a href="productType.php" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>ข้อมูลประเภทห้อง</p>
                    </a>
                </li>


                <li id="5" class="nav-item">
                    <a href="user.php" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>ข้อมูลสมาชิก</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a onclick="logout()" href="#" class="nav-link">
                        <i class="nav-icon fas fa-arrow-circle-right "></i>

                        <p>ออกจากระบบ</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Modal -->
<div class="modal fade" id="modal-form-dataxyz">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ช้อมูลสมาชิก</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmProfile" actions="#" onsubmit="handleSubmitProfile(event)">
                    <div id="formId_pro" hidden></div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">ชื่อผู้ใช้</label>
                        <input type="text" class="form-control" id="user_name_pro" placeholder="ชื่อผู้ใช้งาน">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">รหัสผ่าน</label>
                        <input type="password" required class="form-control" id="password_pro" placeholder="ป้อนรหัสผ่าน">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">ชื่อ</label>
                        <input type="text" class="form-control" id="name_pro" placeholder="ป้อนชื่อ">

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" id="email_pro" placeholder="ป้อน Email">

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">เบอร์โทร</label>
                        <input type="text" class="form-control" id="tel_pro" placeholder="ป้อนเบอร์โทรศัพท์">

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">ที่อยู่</label>
                        <textarea id="address_pro" class="form-control" rows="3" placeholder="ป้อนที่อยู่"></textarea>

                    </div>


                    <button type="submit" id="btnSubmitPro" hidden>submit</button>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" id="closeButtonProfile" class="btn btn-default" data-dismiss="modal">ปิดหน้าจอ</button>
                <button type="button" class="btn btn-primary" onclick="handleSubmitProfile(event)">บันทึก</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    var user_id = sessionStorage.getItem("user_id");
    var user_group = sessionStorage.getItem("user_group");
    var firstname = sessionStorage.getItem("first_name");
    var last_name = sessionStorage.getItem("last_name");
    if (!firstname) {
        alert('คุณยังไม่ได้เข้าสู่ระบบ')
        window.location.href = 'login.php'
    } else {
        var fullName = document.getElementById("fullName");
        fullName.textContent = `คุณ ${firstname}`

    }


    function setProfile() {

        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../admin/db/user.php?id=' + user_id, true);
        xhr.onload = function() {
            if (this.status == 200) {
                let data = JSON.parse(this.responseText)
                document.getElementById('formId_pro').textContent = data.user_id
                document.getElementById('name_pro').value = data.name
                document.getElementById('user_name_pro').value = data.user_name
                document.getElementById('password_pro').value = data.password
                document.getElementById('address_pro').value = data.address
                document.getElementById('email_pro').value = data.email;
                document.getElementById('tel_pro').value = data.tel;
            }
        }
        xhr.send()
    }

    function handleSubmitProfile(e) {
        e.preventDefault();
        let valueProfile = {
            id: document.getElementById('formId_pro').textContent,
            user_group: user_group,
            name: document.getElementById('name_pro').value,
            user_name: document.getElementById('user_name_pro').value,
            password: document.getElementById('password_pro').value,
            address: document.getElementById('address_pro').value,
            email: document.getElementById('email_pro').value,
            tel: document.getElementById('tel_pro').value
        }



        if (valueProfile.id) {
            updateDataProfile(valueProfile)
        }
    }

    function updateDataProfile(value) {
        var xhr = new XMLHttpRequest();
        xhr.open("PUT", "../admin/db/user.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onload = function() {
            if (this.status == 200) {
                document.getElementById("closeButtonProfile").click();
            }
        };
        xhr.send(JSON.stringify(value));
    }
</script>