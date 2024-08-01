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
                            <h1>รายการห้องพัก</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">รายการห้องพัก</li>
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
                                    <button class="btn  btn-success" data-toggle="modal" data-target="#modal-form-data" onclick="openModal()">
                                        เพิ่มข้อมูล
                                    </button>

                                    <div class="card-tools">

                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" id="txt_search" onkeyup="searchsome()" class=" form-control float-right" placeholder="Search">

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
                                                <th>รูปภาพ</th>
                                                <th>ชื่อห้องพัก</th>
                                                <th>ประเภทห้องพัก</th>
                                                <th>สถานะ</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="productListAll">

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
                                <h4 class="modal-title">ข้อมูลห้องพัก</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="pro" actions="#" onsubmit="handleSubmit(event)">
                                    <div id="formId" hidden></div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ชื่อ</label>
                                        <input type="text" required class="form-control" id="name" aria-describedby="emailHelp" placeholder="ป้อนชื่อ">

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">รายละเอียด</label>
                                        <input type="text" required class="form-control" id="product_detail" aria-describedby="emailHelp" placeholder="ป้อนรายละเอียด">

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">รูปภาพ</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" onchange="handleFile(event)" class="custom-file-input" id="exampleInputFile" />
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                        <input style="margin-top: 10px;" readonly class="form-control" type="text" id="pathImage">


                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ราคา</label>
                                        <input type="text" required class="form-control" id="price" aria-describedby="emailHelp" placeholder="กรอกราคา">

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">ประเภทห้อง</label>
                                        <select class="form-control" required id="product_model_id">
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">สถานะ</label>
                                        <select id="is_delete" name="is_delete" class="form-control">
                                            <option selected value="0">ใช้งาน</option>
                                            <option value="1">ปิดการใช้งาน</option>
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
    getProduct()
    var check = 0

    function handleEvent(e) {
        e.preventDefault();
        document.getElementById('btnSubmit').click()
    }

    function getProductModel() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../admin/db/productModel.php', true);
        xhr.onload = function() {
            if (this.status == 200) {
                let data = JSON.parse(this.responseText)
                let el = document.getElementById('product_model_id')
                let result = ''
                for (const i in data) {
                    result += '<option value="' + data[i].id + '">' + data[i].name + '</option>'
                }
                el.innerHTML = result
            }
        }
        xhr.send()
    }

    function getProduct() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../admin/db/product.php', true);
        xhr.onload = function() {
            if (this.status == 200) {
                let data = JSON.parse(this.responseText)
                let el = document.getElementById('productListAll')
                let reuslt = ''

                for (const i in data) {
                    let count = parseInt(i) + 1
                    let item = data[i]
                    reuslt += `               <tr>
                                                <td>${count}</td>
                                                <td > <img  src="../img/${item.img_name}"  class="img-size-50 mr-3 img-circle"></td>
                                                <td width="30%">${item.product_name}</td>

                                                <td><span class="tag tag-success">${item.product_model}</span></td>
                                                <td>${item.is_delete === "0" ? "ใช้งาน" : "ปิดการใช้งาน"}</td>
                                               
                                                <td><a id="${item.id}"   type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#modal-form-data" onclick="setData(event)">แก้ไข</td>
                                               
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
            p_name: document.getElementById('name').value,
            p_detail: String(document.getElementById('product_detail').value),
            p_price: document.getElementById('price').value,
            p_img: document.getElementById('pathImage').value,
            p_type_id: document.getElementById('product_model_id').value,
            p_deleted: document.getElementById('is_delete').value
        }
        if (value.id) {
            updateData(value)
        } else {
            insertData(value)
        }



    }

    function handleFile(e) {
        var property = e.target.files[0]
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        if (['gif', 'png', 'jpg', 'jpeg'].includes(image_extension) === false) {
            console.error('invalid file')
        }
        var image_size = property.size;
        if (image_size > 2000000000000) {
            console.error("image file size is verry Big !")
        } else {
            var form_data = new FormData();
            form_data.append("file", property);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../admin/db/upload.php', true);
            xhr.onload = function() {
                if (this.status == 200) {
                    let data = JSON.parse(this.responseText)

                    if (data.length) {
                        let item = data[0]
                        console.log(item.path)
                        document.getElementById('pathImage').value = item.path.replace("/d-bu-di-resort/img/", "").replace("/shop/img/", '')
                    }
                }
            }
            xhr.send(form_data)
        }
    }

    function setData(e) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../admin/db/product.php?id=' + e.target.id, true);
        xhr.onload = function() {
            if (this.status == 200) {
                let data = JSON.parse(this.responseText)
                var base_url = window.location.origin;
                document.getElementById('formId').textContent = data.id
                document.getElementById('name').value = data.product_name
                document.getElementById('product_detail').value = data.product_detail
                document.getElementById('price').value = data.price
                document.getElementById('product_model_id').value = data.product_model_id
                document.getElementById('pathImage').value = data.img_name;
                document.getElementById('is_delete').value = data.is_delete;


            }
        }
        xhr.send()
    }

    function openModal() {
        // clear form
        document.getElementById("formId").textContent = "";
        document.getElementById("name").value = "";
        document.getElementById("product_detail").value = "";
        document.getElementById("price").value = "";
        document.getElementById("pathImage").value = "";
        document.getElementById("product_model_id").value = "";
        document.getElementById('is_delete').value = 0;
    }

    function updateData(value) {
        var xhr = new XMLHttpRequest();
        xhr.open("PUT", "../admin/db/product.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onload = function() {
            if (this.status == 200) {
                document.getElementById("closeButton").click();
                // let data = JSON.parse(this.responseText)
                getProduct()
            }
        };
        xhr.send(JSON.stringify(value));
    }

    function insertData(value) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../admin/db/product.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onload = function() {
            if (this.status == 200) {
                document.getElementById("closeButton").click();
                // let data = JSON.parse(this.responseText)
                getProduct()
            }
        };
        xhr.send(JSON.stringify(value));
    }

    function searchsome() {
        var base_url = window.location.origin;
        console.log(document.getElementById('txt_search').value)
        var texts = document.getElementById('txt_search').value
        if (texts === '') {
            getProduct()
        } else {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', `../admin/db/product.php`, true);
            xhr.onload = function() {
                if (this.status == 200) {
                    let data = JSON.parse(this.responseText)
                    let el = document.getElementById('productListAll')
                    let reuslt = ''
                    for (const i in data) {
                        let count = parseInt(i) + 1
                        let item = data[i]
                        console.log(texts)
                        if (item.product_name.toLowerCase().includes(texts.toLowerCase())) {
                            reuslt += `               <tr>
                                                <td>${count}</td>
                                                <td> <img src="../img/${item.img_name}"  class="img-size-50 mr-3 img-circle"></td>
                                                <td>${item.product_name}</td>

                                                <td><span class="tag tag-success">${item.product_model}</span></td>
                                                <td>${item.is_delete === "0" ? "ใช้งาน" : "ปิดการใช้งาน"}</td>
                                                <td><a id="${item.id }"   type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#modal-form-data" onclick="setData(event)">แก้ไข</td>
                                                <td width="150px"><a id="${item.id }"  onclick="handleDelete(event)" type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-form-delete">ปิดการใช้งาน</a></td>
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