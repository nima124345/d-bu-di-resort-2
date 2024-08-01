<!DOCTYPE html>
<html lang="en">
<?php include './layouts/header.php'; ?>



<body class="hold-transition sidebar-mini">
  <div class="wrapper">


    <!-- Navbar -->
    <?php include './layouts/navbar.php'; ?>
    <!-- /.navbar -->


    <!-- Main Sidebar Container -->

    <!-- Main Sidebar Container -->
    <?php include './layouts/sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>รายการจองห้องพัก</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">รายการจองห้องพัก</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">

                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>ชื่อลูกค้า</th>
                        <th>จำนวนที่สั่ง</th>
                        <th>ราคารวม</th>
                        <th>การขนส่ง</th>
                        <th>วันที่/เวลา</th>
                        <th>สถานะ</th>
                        <th>จัดการ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Trident</td>
                        <td>Internet Explorer 4.0</td>
                        <td>Win 95+</td>
                        <td>4</td>
                        <td>X</td>
                        <td>Win 95+</td>
                        <td>4</td>
                        <td>X</td>
                      </tr>


                    </tbody>

                  </table>
                </div>
                <!-- /.card-body -->
              </div>

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <?php include './layouts/footer.php'; ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="./plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="./plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="./plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="./plugins/jszip/jszip.min.js"></script>
  <script src="./plugins/pdfmake/pdfmake.min.js"></script>
  <script src="./plugins/pdfmake/vfs_fonts.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(function() {

      $("#example2").DataTable({
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
      });
    });


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

            // reuslt += `<tr>
            //                                 <td>${count}</td>
            //                                 <td>${item.first_name} ${item.last_name}</td>
            //                                 <td>${item.sumamount}
            //                                 </td>
            //                                 <td>${item.sumprice}฿</td>
            //                                 <td>${item.transport_chanel}</td>
            //                                 <td>${item.order_date}</td>
            //                                 <td><span class="right badge badge-danger">${item.status}</span></td>
            //                                 <td   width="150px"><button onclick="onClickDetail(${item.id})" type="button" class="btn btn-block btn-secondary">ดูรายละเอียด</td>
            //                             </tr>`
            reuslt += `<tr>
                        <td>Trident</td>
                        <td>Internet Explorer 4.0</td>
                        <td>Win 95+</td>
                        <td>4</td>
                        <td>X</td>
                        <td>Win 95+</td>
                        <td>4</td>
                        <td>X</td>
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

    function htmlTableToExcel(type) {
      var data = document.getElementById('tblToExcl');

      var excelFile = XLSX.utils.table_to_book(data, {
        sheet: "sheet1"
      });
      XLSX.write(excelFile, {
        bookType: type,
        bookSST: true,
        type: 'base64'
      });
      XLSX.writeFile(excelFile, 'ExportedFile:HTMLTableToExcel.' + type);
    }
  </script>
</body>

</html>