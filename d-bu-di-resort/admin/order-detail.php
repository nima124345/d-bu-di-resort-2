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
                            <h1>รายละเอียดการจอง</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item">รายการจอง</li>
                                <li class="breadcrumb-item active">รายละเอียดการจอง</li>
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


                                    <div class="card-tools">

                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ชื่อ</label>
                                        <input disabled type="text" required class="form-control" id="first_name_detail" placeholder="ป้อนชื่อ">

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">นามสกุล</label>
                                        <input disabled type="text" required class="form-control" id="last_name_detail" placeholder="ป้อนนามสกุล">

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">เบอร์โทร</label>
                                        <input disabled type="text" required class="form-control" id="tel_detail" placeholder="ป้อนเบอร์โทรศัพท์">

                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input disabled type="text" required class="form-control" id="email_detail">

                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ที่อยู่</label>
                                        <textarea id="address_detail" disabled class="form-control" rows="3" placeholder="ป้อนที่อยู่"></textarea>

                                    </div>


                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>ชื่อห้อง</th>
                                                <th>ประเภทห้อง</th>
                                                <th>ราคาต่อห้อง</th>
                                                <th>จำนวน</th>
                                                <th>รวมราคา</th>

                                            </tr>
                                        </thead>
                                        <tbody id="itemList">



                                        </tbody>
                                    </table>
                                    <br>


                                    <div id="formId" hidden></div>


                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">สถานะการสั่งซื้อ</label>
                                        <select required class="form-control" id="status_detail">

                                            <option value="กำลังตรวจสอบ">กำลังตรวจสอบ</option>
                                            <option value="ชําระเงินแล้ว">ชําระเงินแล้ว</option>
                                            <option value="ยกเลิก">ยกเลิก</option>

                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-3"> <button onclick="updateStatus()" class="btn btn-block btn-success">บันทึกข้อมูล</button>
                                        </div>
                                        <div class="col-3"> <button id="transport" data-toggle="modal" data-target="#modal-form-data-img" class="btn btn-block btn-primary">ดูหลักฐานการจอง</button></div>
                                        <div class="col-3"> <button onclick="back()" class="btn btn-block btn-secondary">ย้อนกลับ</button></div>
                                    </div>


                                </div>

                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
        </div><!-- /.container-fluid -->
        </section>


        <!-- Modal slip-->
        <div class="modal fade" id="modal-form-data-img">
            <div class="modal-dialog modal-l">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">หลักฐานการจอง</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <img id="img_name_detail" src="" width="100%" height="600">


                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" id="closeButton" class="btn btn-default" data-dismiss="modal">ปิดหน้าจอ</button>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


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
    var urlParams;
    (window.onpopstate = function() {
        var match,
            pl = /\+/g, // Regex for replacing addition symbol with a space
            search = /([^&=]+)=?([^&]*)/g,
            decode = function(s) {
                return decodeURIComponent(s.replace(pl, " "));
            },
            query = window.location.search.substring(1);

        urlParams = {};
        while (match = search.exec(query))
            urlParams[decode(match[1])] = decode(match[2]);
    })();

    var id = urlParams.id
    var code = ''
    setData()

    getItemList()


    function back() {
        window.location.href = ' ./order.php'

    }


    function setData() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../admin/db/order.php?id=' + id, true);
        xhr.onload = function() {
            if (this.status == 200) {

                let data = JSON.parse(this.responseText)
                var base_url = window.location.origin;
                document.getElementById('first_name_detail').value = data.first_name
                document.getElementById('last_name_detail').value = data.last_name
                document.getElementById('email_detail').value = data.email
                document.getElementById('tel_detail').value = data.tel
                document.getElementById('address_detail').value = data.address
                document.getElementById('tel_detail').value = data.tel;
                document.getElementById('status_detail').value = data.status;
                document.getElementById('img_name_detail').src = `../img/img-slip/${data.img_name}`

                if (!data.img_name) {
                    document.getElementById('transport').disabled = true
                }


            }
        }
        xhr.send()
    }

    function updateStatus() {
        if (document.getElementById('status_detail').value) {
            let value = {
                status: document.getElementById('status_detail').value
            }
            var xhr = new XMLHttpRequest();
            xhr.open(
                "PUT",
                "../admin/db/order.php?id=" + id,
                true
            );
            xhr.onload = function() {
                if (this.status == 200) {
                    alert('ปรับสถานะเรียบร้อยแล้ว')
                    setData()
                    getItemList()
                }
            };
            xhr.send(JSON.stringify(value));

        } else {
            alert('กรุณากรอกข้อมูลให้ครบ')
        }





    }

    function getItemList() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../admin/db/order-detail.php?id=' +
            id, true);
        xhr.onload = function() {
            if (this.status == 200) {
                let data = JSON.parse(this.responseText)
                let el = document.getElementById('itemList')
                let reuslt = ''
                let total = 0
                for (const i in data) {
                    let count = parseInt(i) + 1
                    let item = data[i]
                    total = total + parseInt(item.sum_price)
                    reuslt += ` <tr>
                                                <td>${count}</td>
                                                <td>${item.product_name}</td>
                                                <td>${item.productModel}</td>
                                                <td>${item.price}</td>
                                                <td>${item.count}</td>
                                                <td>${item.sum_price}฿</td>


                                </tr>`
                }
                reuslt += `<tr>
                                                <td colspan="6">
                                                    <h4>รวมจำนวนเงินทั้งหมด :${total} บาท</h4>
                                                </td>
                           </tr>`

                el.innerHTML = reuslt

            }
        }
        xhr.onerror = function() {
            console.log('ss')
        }
        xhr.send()
    }
</script>

</html>