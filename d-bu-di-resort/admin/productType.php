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
                            <h1>รายการประเภทห้อง</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">รายการประเภทห้อง</li>
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

                                    <button class="btn  btn-success" data-toggle="modal" data-target="#modal-form-data">
                                        เพิ่มข้อมูล
                                    </button>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" id="txt_search" onkeyup="searchsome()" class="form-control float-right" placeholder="Search">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0" style="height: 100%;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>ประเภทห้อง</th>
                                                <th>สถานะ</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="productModelListAll">

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div><!-- /.container-fluid -->

                <!-- Modal -->
                <div class="modal fade" id="modal-form-data">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">ข้อมูลประเภทห้องพัก</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form actions="#" onsubmit="handleSubmit(event)">
                                    <div id="formId" hidden></div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ข้อมูลประเภทห้องพัก</label>
                                        <input type="text" required class="form-control" id="name" aria-describedby="emailHelp" placeholder="ป้อนชื่อ">

                                    </div>

                                    <button type="submit" id="btnSubmit" hidden>submit</button>
                                </form>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button id="closeButton" type="button" class="btn btn-default" data-dismiss="modal">ปิดหน้าจอ</button>
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
    getProductModel()

    function getProductModel() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../admin/db/productModel.php', true);
        xhr.onload = function() {
            if (this.status == 200) {
                let data = JSON.parse(this.responseText)
                let el = document.getElementById('productModelListAll')
                let reuslt = ''

                for (const i in data) {
                    let count = parseInt(i) + 1
                    let item = data[i]
                    reuslt += `            <tr>
                                                <td>${count}</td>
                                                <td><span class="tag tag-success">${item.name}</span></td>
                                                <td>${item.is_deleted === "0" ? "ใช้งาน" : "ปิดการใช้งาน"}</td>
                                                <td width="150px"><button id=${item.id} type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#modal-form-data" onclick="setData(event)">แก้ไข</td>
                                                <td width="150px"></button><button id=${item.id} type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-form-delete" onclick="handleDelete(event)">ปิดการใช้งาน</button></td>
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

    function handleEvent(e) {
        e.preventDefault();
        document.getElementById('btnSubmit').click()
    }

    function handleSubmit(e) {
        e.preventDefault();
        let value = {
            id: document.getElementById('formId').textContent,
            name: document.getElementById('name').value
        }
        if (value.id) {
            updateData(value)
        } else {
            insertData(value)
        }


    }


    function setData(e) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../admin/db/productModel.php?id=' + e.target.id, true);
        xhr.onload = function() {
            if (this.status == 200) {
                let data = JSON.parse(this.responseText)
                var base_url = window.location.origin;
                document.getElementById('formId').textContent = data.id
                document.getElementById('name').value = data.name
            }
        }
        xhr.send()
    }

    function openModal() {
        // clear form
        document.getElementById("formId").textContent = "";
        document.getElementById("name").value = "";
    }

    function updateData(value) {
        var xhr = new XMLHttpRequest();
        xhr.open("PUT", "../admin/db/productModel.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onload = function() {
            if (this.status == 200) {
                document.getElementById("closeButton").click();
                getProductModel()
            }
        };
        xhr.send(JSON.stringify(value));
    }

    function insertData(value) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../admin/db/productModel.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onload = function() {
            if (this.status == 200) {
                document.getElementById("closeButton").click();
                // let data = JSON.parse(this.responseText)
                getProductModel()
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
            "../admin/db/productModel.php?id=" + e.target.value,
            true
        );
        xhr.onload = function() {
            if (this.status == 200) {
                document.getElementById("closeConfirmButton").click();
                getProductModel()
            }
        };
        xhr.send();
    }

    function searchsome() {
        var base_url = window.location.origin;
        console.log(document.getElementById('txt_search').value)
        var texts = document.getElementById('txt_search').value
        if (texts === '') {
            getProductModel()
        } else {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', `../admin/db/productModel.php`, true);
            xhr.onload = function() {
                if (this.status == 200) {
                    let data = JSON.parse(this.responseText)
                    let el = document.getElementById('productModelListAll')
                    let reuslt = ''
                    for (const i in data) {
                        let count = parseInt(i) + 1
                        let item = data[i]
                        console.log(texts)
                        if (item.name.toLowerCase().includes(texts.toLowerCase())) {
                            reuslt += `            <tr>
                                                <td>${count}</td>
                                                <td><span class="tag tag-success">${item.name}</span></td>
                                                <td>${item.is_delete === "0" ? "ใช้งาน" : "ปิดการใช้งาน"}</td>
                                                <td>${item.create_date}</td>
                                                <td width="150px"><button id=${item.id} type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#modal-form-data" onclick="setData(event)">แก้ไข</td>
                                                <td width="150px"></button><button id=${item.id} type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-form-delete" onclick="handleDelete(event)">ปิดการใช้งาน</button></td>
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