<!DOCTYPE html>
<html lang="en">

<?php include './layouts/head.php'; ?>


<body>
  <section id="header-contact">
    <div class="container d-flex justify-content-between">
      <div class="section-language d-flex align-items-center justify-content-center">
        <span>d-bu-di-resort</span>

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

  <?php include './layouts/navbar.php'; ?>



  <section id="content" class="container">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">วันที่ทำรายการ</th>
          <th scope="col">จำนวนเงิน</th>
          <th scope="col">สถานะ</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody id="orderById">


      </tbody>
    </table>
  </section>

  <!-- modal  timline -->
  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4>อัพโหลดหลักฐานการชำระเงิน</h4>
        </div>
        <div class="modal-body">
          <form actions="#" onsubmit="handleSubmit(event)">

            <div class="form-group">
              <h5>คุณสามารถแสกน QR Code เพื่อทำการชำระเงินได้ตามด้านล่างนี้</h5>
              <img src="./img/qr/qr.jpg" width="30%">

            </div>
            <div class="form-group">
              <img id="bankImg" src="" width="30%">

            </div>
            <label>เลือกไฟล์เพื่อทำการ Upload</label>
            <input type="file" class="form-control-file" onchange="handleFile(event)">
            <input hidden id="pathImage">


            <button type="submit" id="btnSubmit" hidden>submit</button>
          </form>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-primary" onclick="handleEvent(event)">บันทึก</button>
          <button id="closeButton" type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้าจอ</button>

        </div>
      </div>
    </div>
  </div>



  <script src="./css/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
<script src="./js/product.js"></script>

<script>
  var ids
  var user_id = sessionStorage.getItem("user_id");
  if (user_id) {
    getProductHistory()
    // getBank()
  }

  coutCart();

  function handleEvent(e) {
    e.preventDefault();
    document.getElementById('btnSubmit').click()
  }

  function setData(e) {
    ids = e.target.id
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
      xhr.open('POST', './db/upload.php', true);
      xhr.onload = function() {
        if (this.status == 200) {
          let data = JSON.parse(this.responseText)
          if (data.length) {
            let item = data[0]
            document.getElementById('pathImage').value = item.path.replace("/d-bu-di-resort/img/img-slip/", "")
          }
        }
      }
      xhr.send(form_data)
    }
  }

  function handleSubmit(e) {

    let value = {
      id: ids,
      o_img_name: document.getElementById("pathImage").value
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./db/update-slip.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.onload = function() {
      if (this.status == 200) {
        document.getElementById("closeButton").click();
        getProductHistory()
      }
    };
    xhr.send(JSON.stringify(value));

  }

  function getProductHistory() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './db/order.php?id=' + user_id, true);
    xhr.onload = function() {
      if (this.status == 200) {
        let data = JSON.parse(this.responseText)
        let el = document.getElementById('orderById')
        let reuslt = ''

        for (const i in data) {
          let count = parseInt(i) + 1
          let item = data[i]

          reuslt += `        <tr>
          <th scope="row">${count}</th>
          <td>${item.order_date}</td>
          <td>${item.totalPrice}</td>
          <td>${item.status}</td>
        `
          if (!item.img_name) {
            reuslt += `<td><button id="${item.Order_id}" onclick="setData(event)" type="button" class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg">อัพโหลดหลักฐานชำระเงิน</button></td></tr>`
          } else {
            reuslt += '<td></td></tr>'
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
</script>

</html>