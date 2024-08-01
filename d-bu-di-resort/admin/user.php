<!DOCTYPE html>
<html lang="en">
<?php include './layouts/header.php'; ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60" />
        </div>

        <!-- Navbar -->
        <?php include './layouts/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include './layouts/sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>ช้อมูลสมาชิก</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">สมาชิก</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- /.row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <button onclick="openModal()" class="btn  btn-success" data-toggle="modal" data-target="#modal-form-data">
                                        เพิ่มข้อมูล
                                    </button>

                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="table_search" id="txt_search" onkeyup="searchsome()" class="form-control float-right" placeholder="Search">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0" style="height: 300px;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <!-- <th>รูปภาพ</th> -->
                                                <th>ชื่อ-นามสกุล</th>
                                                <th>สิทธิ์การเข้าถึง</th>
                                                <th>วันที่/เวลา</th>
                                                <th>สถานะ</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="userAll">



                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="modal-form-data">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">ช้อมูลสมาชิก</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form actions="#" onsubmit="handleSubmit(event)">
                                        <div id="formId" hidden></div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">ชื่อผู้ใช้</label>
                                            <input type="text" required class="form-control" id="user_name" aria-describedby="emailHelp" placeholder="ชื่อผู้ใช้งาน">

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">รหัสผ่าน</label>
                                            <input type="password" required class="form-control" id="password" placeholder="ป้อนรหัสผ่าน">

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">ชื่อ</label>
                                            <input type="text" required class="form-control" id="name" aria-describedby="emailHelp" placeholder="ป้อนชื่อ">

                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="text" required class="form-control" id="email" aria-describedby="emailHelp" placeholder="ป้อน Email">

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">เบอร์โทร</label>
                                            <input type="text" required class="form-control" id="tel" placeholder="ป้อนเบอร์โทรศัพท์">

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">ที่อยู่</label>
                                            <textarea id="address" class="form-control" rows="3" placeholder="ป้อนที่อยู่"></textarea>

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">สิทธิ์การเข้าถึง</label>
                                            <select required class="form-control" id="user_group">

                                                <option value="ผู้ดูแลระบบ">ผู้ดูแลระบบ</option>
                                                <option value="ผู้ใช้งานทั่วไป">ผู้ใช้งานทั่วไป</option>
                                                <option value="พนักงาน">พนักงาน</option>

                                            </select>
                                        </div>


                                        <button type="submit" id="btnSubmit" hidden>submit</button>
                                    </form>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" id="closeButton" class="btn btn-default" data-dismiss="modal">ปิดหน้าจอ</button>
                                    <button type="button" class="btn btn-primary" onclick="handleEvent(event)">บันทึก</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    <!-- Modal delete -->
                    <div class="modal fade" id="modal-form-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirm ?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">ต้องการปิดการใช้งานใช่ไหม ? </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" id="closeConfirmButton" type="button" data-dismiss="modal">ยกเลิก</button>
                                    <button class="btn btn-primary" id="deleteButton" onClick="deleteData(event)">ตกลง</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <?php include './layouts/footer.php'; ?>

</body>

<script>
    getUser()

    function handleEvent(e) {
        e.preventDefault();
        document.getElementById('btnSubmit').click()
    }

    function getUser() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../admin/db/user.php', true);
        xhr.onload = function() {
            if (this.status == 200) {
                let data = JSON.parse(this.responseText)
                let el = document.getElementById('userAll')
                let reuslt = ''

                for (const i in data) {
                    let count = parseInt(i) + 1
                    let item = data[i]

                    reuslt += `     <tr>
                                                <td>${count}</td>
     
                                                <td>${item.name}</td>
                                                <td><span class="tag tag-success">${item.user_group}</span></td>
                                                <td>${item.create_date}</td>
                                                <td>${item.is_delete === "0" ? "ใช้งาน" : "ปิดการใช้งาน"}</td>
                                                <td><a id="${item.user_id }"   type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#modal-form-data" onclick="setData(event)">แก้ไข</td>
                                                <td width="150px"><a id="${item.user_id }"  onclick="handleDelete(event)" type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-form-delete">ปิดการใช้งาน</a></td>
                                            </tr>`
                }

                el.innerHTML = reuslt

            }
        }
        xhr.onerror = function() {
            console.log('ss')
        }
        xhr.send()
    }

    function handleSubmit(e) {
        e.preventDefault();
        let value = {
            id: document.getElementById('formId').textContent,
            user_group: document.getElementById('user_group').value,
            name: document.getElementById('name').value,
            user_name: document.getElementById('user_name').value,
            password: document.getElementById('password').value,
            address: document.getElementById('address').value,
            email: document.getElementById('email').value,
            tel: document.getElementById('tel').value
        }


        if (value.id) {
            updateData(value)
        } else {
            insertData(value)
        }
    }

    function setData(e) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../admin/db/user.php?id=' + e.target.id, true);
        xhr.onload = function() {
            if (this.status == 200) {
                let data = JSON.parse(this.responseText)
                console.log(data)
                var base_url = window.location.origin;
                document.getElementById('formId').textContent = data.user_id
                document.getElementById('user_group').value = data.user_group
                document.getElementById('name').value = data.name
                document.getElementById('user_name').value = data.user_name
                document.getElementById('password').value = data.password
                document.getElementById('address').value = data.address
                document.getElementById('email').value = data.email;
                document.getElementById('tel').value = data.tel;


            }
        }
        xhr.send()
    }

    function openModal() {
        // clear form
        document.getElementById("formId").textContent = "";
        document.getElementById("user_group").value = "";
        document.getElementById("first_name").value = "";
        document.getElementById("last_name").value = "";
        document.getElementById("user_name").value = "";
        document.getElementById("password").value = "";
        document.getElementById("address").value = "";
        // document.getElementById("pathImage").value = "";
        document.getElementById("email").value = "";
        document.getElementById("tel").value = "";
    }

    function updateData(value) {
        var xhr = new XMLHttpRequest();
        xhr.open("PUT", "../admin/db/user.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onload = function() {
            if (this.status == 200) {
                document.getElementById("closeButton").click();
                // let data = JSON.parse(this.responseText)
                getUser()
            }
        };
        xhr.send(JSON.stringify(value));
    }

    function insertData(value) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../admin/db/user.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onload = function() {
            if (this.status == 200) {
                document.getElementById("closeButton").click();
                // let data = JSON.parse(this.responseText)
                getUser()
            }
        };
        xhr.send(JSON.stringify(value));
    }

    function handleDelete(e) {

        let id = e.target.id;

        document.getElementById("deleteButton").setAttribute("value", id);
    }

    function deleteData(e) {

        var xhr = new XMLHttpRequest();
        xhr.open(
            "DELETE",
            "../admin/db/user.php?id=" + e.target.value,
            true
        );
        xhr.onload = function() {
            if (this.status == 200) {
                document.getElementById("closeConfirmButton").click();
                getUser()
            }
        };
        xhr.send();
    }

    function searchsome() {
        var base_url = window.location.origin;
        console.log(document.getElementById('txt_search').value)
        var texts = document.getElementById('txt_search').value
        if (texts === '') {
            getUser()
        } else {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', `../admin/db/user.php`, true);
            xhr.onload = function() {
                if (this.status == 200) {
                    let data = JSON.parse(this.responseText)
                    let el = document.getElementById('userAll')
                    let reuslt = ''
                    for (const i in data) {
                        let count = parseInt(i) + 1
                        let item = data[i]
                        console.log(texts)
                        if (item.product_name.toLowerCase().includes(texts.toLowerCase())) {
                            reuslt += `     <tr>
                                                <td>${count}</td>
                                                <td> <img src="../img/img-user/${item.img_name}"  class="img-size-50 mr-3 img-circle"></td>
                                                <td>${item.first_name} ${item.last_name}</td>

                                                <td><span class="tag tag-success">${item.user_group}</span></td>
                                                <td>${item.create_date}</td>
                                                <td>${item.is_delete === "0" ? "ใช้งาน" : "ปิดการใช้งาน"}</td>
                                                <td><a id="${item.user_id }"   type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#modal-form-data" onclick="setData(event)">แก้ไข</td>
                                                <td width="150px"><a id="${item.user_id }"  onclick="handleDelete(event)" type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-form-delete">ปิดการใช้งาน</a></td>
                                            </tr>`
                        }
                    }
                    el.innerHTML = reuslt

                }
            }
            xhr.onerror = function() {
                console.log('ss')
            }
            xhr.send()
        }
    }
</script>

</html>