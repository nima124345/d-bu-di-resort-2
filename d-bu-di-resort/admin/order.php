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
                            <h1>รายการจองห้อง</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">รายการจองห้อง</li>
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


                                    <!-- <div class="card-tools"> -->


                                    <div class="row">
                                        <div class="col-1">
                                            <label>วันที่เริ่มต้น</label>
                                        </div>
                                        <div class="col-2 ml-0">
                                            <input id="startDate" class="orm-control" type="date">
                                        </div>
                                        <div class="col-1">
                                            <label>วันที่สิ้นสุด</label>
                                        </div>
                                        <div class="col-2 ml-0">
                                            <input id="endDate" class="orm-control" type="date">
                                        </div>
                                        <div class="col">
                                            <button onclick="handleSearch()" class="btn btn-primary">ค้นหา</button>
                                        </div>

                                        <!-- </div> -->



                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- <div style="margin-bottom: 10px;"> <button class="btn btn-secondary" id="button" onclick="htmlTableToExcel('xlsx')">ออกรายงาน</button></div> -->

                                    <table id="tblToExcl" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>ชื่อลูกค้า</th>
                                                <th>จำนวนห้องที่จอง</th>
                                                <th>ราคารวม</th>
                                                <th>วันที่/เวลา</th>
                                                <th>สถานะ</th>
                                                <th>จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="orderAll">


                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
        </div><!-- /.container-fluid -->
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
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script>
    getOrder()

    function onClickDetail(id) {
        window.location.href = `./order-detail.php?id=${id}`
    }

    function getOrder() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../admin/db/order.php', true);
        xhr.onload = function() {
            if (this.status == 200) {
                let data = JSON.parse(this.responseText)
                let el = document.getElementById('orderAll')
                let reuslt = ''

                for (const i in data) {
                    let count = parseInt(i) + 1
                    let item = data[i]

                    reuslt += `<tr>
                                                <td>${count}</td>
                                                <td>${item.first_name}</td>
                                                <td>${item.sumamount}
                                                </td>
                                                <td>${item.sumprice}฿</td>
                                                <td>${item.order_date}</td>
                                                <td><span class="right badge badge-danger">${item.status}</span></td>
                                                <td   width="150px"><button onclick="onClickDetail(${item.id})" type="button" class="btn btn-block btn-secondary">ดูรายละเอียด</td>
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


    function handleSearch() {
        let startDate = document.getElementById('startDate').value
        let endDate = document.getElementById('endDate').value
        if (startDate === "" || endDate === "") {
            alert('คุณเลือกเงื่อนไขไม่ครบ')
        } else {
            let value = {
                startDate: startDate,
                endDate: endDate
            }
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../admin/db/order.php', true);
            xhr.onload = function() {
                if (this.status == 200) {
                    let data = JSON.parse(this.responseText)
                    let el = document.getElementById('orderAll')
                    let reuslt = ''

                    for (const i in data) {
                        let count = parseInt(i) + 1
                        let item = data[i]

                        reuslt += `<tr>
                                                <td>${count}</td>
                                                <td>${item.first_name} ${item.last_name}</td>
                                                <td>${item.sumamount}
                                                </td>
                                                <td>${item.sumprice}฿</td>

                                                <td>${item.order_date}</td>
                                                <td><span class="right badge badge-danger">${item.status}</span></td>
                                                <td   width="150px"><button onclick="onClickDetail(${item.id})" type="button" class="btn btn-block btn-secondary">ดูรายละเอียด</td>
                                            </tr>`
                    }

                    el.innerHTML = reuslt

                }
            }
            xhr.onerror = function() {
                console.log('ss')
            }
            xhr.send(JSON.stringify(value))
        }



    }
</script>

</html>