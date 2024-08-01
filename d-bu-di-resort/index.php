<!DOCTYPE html>
<html lang="en">

<?php include './layouts/head.php'; ?>

<body>
  <section id="header-contact">
    <div class="container d-flex justify-content-between">
      <div class="section-language d-flex align-items-center justify-content-center">
        <span>D-bu-di-resort</span>
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

  <?php include './layouts/slider.php'; ?>



  <section id="our-product" class="container">
    <div class="row">
      <div class="text-center header-ourproduct col-12 mb-4">
        <br>
        <h3>ห้องพักทั้งหมด</h3>
        <div class="line-bottom"></div>

        <div class="row mt-4 m-0 mb-4">
          <div class="col-8  text-left" id="btnList">


          </div>
          <div class="col-4"><input onkeyup="searchsome()" id="txt_search" placeholder="กรอกคำค้นหา" class="form-control"></div>

        </div>

        <!-- <button class="mt-4">FEATURED</button> -->
      </div>
      <div class="col-12">
        <div class="row m-0 mb-4" id="productListAll">


        </div>
      </div>
    </div>
  </section>




  <footer id="footer">
    <div class="container">
      <div class="line-bottom"></div>
      <div class="row">
        <div class="col-sm-6 col-md-4 mb-4 mb-md-0 text-center text-sm-left">
          <div class="mb-2"><strong>ติดต่อเรา</strong>
            <div class="line-bottom"></div>
          </div>

          <div class="contact-info">
            <div class="d-table">
              <div class="d-table-cell head" style="color: var(--color-primary)">
                Address:
              </div>
              <div class="d-table-cell info">
                <span class="ml-1">บริการจองห้องพักออนไลน์</span>
              </div>
            </div>
            <div class="d-table">
              <div class="d-table-cell mr-2 head" style="color: var(--color-primary)">
                Phone:
              </div>
              <div class="d-table-cell info">
                <span class="ml-1">02-9009009</span>
              </div>
            </div>
            <div class="d-table">
              <div class="d-table-cell head" style="color: var(--color-primary)">
                Email:
              </div>
              <div class="d-table-cell info">
                <span class="ml-1">resort@mail.com</span>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="w-100 d-flex justify-content-center align-items-center border-top" style="padding-top: 20px">
      <small class="coppyright" style="color: #b9b8ba">Powered By OpenCart &copy; 2022</small>
    </div>
  </footer>

  <!-- modal product detail -->
  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">รายละเอียดห้องพัก</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-4"><img id="img_name" width="100%" height="300px" class="product-img" src="" alt="" />
            </div>
            <div class="col-8">
              <h5 id="name" class="product-name"></h5>
              <div id="formId" hidden></div>
              <p id="price"> </p>
              <p id="product_detail"> </p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="add()" class="btn btn-success">เลือกจอง</button>
          <button id="exit" type="button" data-dismiss="modal" id="closeButton" class="btn btn-secondary" data-dismiss="modal">ปิดหน้าจอ</button>

        </div>

      </div>
    </div>
  </div>

  <script src="./css/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>


<script>
  getProduct()
  getProductType()
  coutCart();

  var img_names = ''
  var prices = 0

  function openCart() {
    window.location.href = "cart.php"
  }


  function getProduct() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './db/product.php', true);
    xhr.onload = function() {
      if (this.status == 200) {
        let data = JSON.parse(this.responseText)
        let el = document.getElementById('productListAll')
        let reuslt = ''

        for (const i in data) {
          let count = parseInt(i) + 1
          let item = data[i]

          reuslt += `<div class="col-6 col-lg-4 product-box mb-3">
            <img id="${item.p_id }" onclick="setDataDetail(event)" class="product-img" data-toggle="modal" data-target=".bd-example-modal-lg" src="./img/${item.p_img}" alt="" />
            <span style="color: white;" class="badge bg-danger position-absolute start-0 top-0">ห้องพักยอดนิยม</span>
            <div class="product-detail">
              <a href="#" id="${item.p_id }" onclick="setDataDetail(event)" class="product-name" data-toggle="modal" data-target=".bd-example-modal-lg">${item.p_name}</a>
              <div class="product-price">${item.p_price}฿</div>
              <div class="product-rating">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
            </div>
          </div>`
        }

        el.innerHTML = reuslt

      }
    }
    xhr.onerror = function() {
      console.log('ss')
    }
    xhr.send()
  }

  function getProductType() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './db/product-type.php', true);
    xhr.onload = function() {
      if (this.status == 200) {
        let data = JSON.parse(this.responseText)
        let el = document.getElementById('btnList')
        let result = `<button id="0" onclick="filterProduct(event)" type="button" class="btn btn-success mb-2 mr-2">
         ห้องพักทั้งหมด
            </button>`
        for (const i in data) {
          // result += '<option value="' + data[i].id + '">' + data[i].name + '</option>'
          result += `<button onclick="filterProduct(event)" id="${data[i].id}" type="button" class="btn btn-success mb-2 mr-2">
          ${data[i].name}
            </button>`
        }
        el.innerHTML = result
      }
    }
    xhr.send()
  }

  function filterProduct(e) {
    if (e.target.id === "0") {
      getProduct()
    } else {

      var xhr = new XMLHttpRequest();
      xhr.open('GET', './db/product.php', true);
      xhr.onload = function() {
        if (this.status == 200) {
          let data = JSON.parse(this.responseText)
          let el = document.getElementById('productListAll')
          let reuslt = ''

          for (const i in data.filter((x) => parseInt(x.p_type_id) === parseInt(e.target.id))) {
            let count = parseInt(i) + 1
            let item = data.filter((x) => parseInt(x.p_type_id) === parseInt(e.target.id))[i]


            reuslt += `<div class="col-6 col-lg-4 product-box mb-3">
            <img id="${item.p_id }" onclick="setDataDetail(event)" class="product-img" data-toggle="modal" data-target=".bd-example-modal-lg" src="./img/${item.p_img}" alt="" />
            <span style="color: white;" class="badge bg-danger position-absolute start-0 top-0">ห้องพักยอดนิยม</span>
            <div class="product-detail">
              <a href="#" id="${item.p_id }" onclick="setDataDetail(event)" class="product-name" data-toggle="modal" data-target=".bd-example-modal-lg">${item.p_name}</a>
              <div class="product-price">${item.p_price}฿</div>
              <div class="product-rating">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
            </div>
          </div>`

          }
          if (reuslt === '') {
            reuslt = '<h5 class="text-center">ไม่พบห้องพักในหมวดหมู่นี้</h5>'
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

  function searchsome() {
    var base_url = window.location.origin;

    var texts = document.getElementById('txt_search').value
    if (texts === '') {
      getProduct()
    } else {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', './db/product.php', true);
      xhr.onload = function() {
        if (this.status == 200) {
          let data = JSON.parse(this.responseText)
          let el = document.getElementById('productListAll')
          let reuslt = ''
          for (const i in data) {
            let count = parseInt(i) + 1
            let item = data[i]
            if (item.p_name.toLowerCase().includes(texts.toLowerCase())) {
              reuslt += `<div class="col-6 col-lg-4 product-box mb-3">
            <img id="${item.p_id }" onclick="setDataDetail(event)" class="product-img" data-toggle="modal" data-target=".bd-example-modal-lg" src="./img/${item.p_img}" alt="" />
            <span style="color: white;" class="badge bg-danger position-absolute start-0 top-0">ห้องพักยอดนิยม</span>
            <div class="product-detail">
              <a href="#" id="${item.p_id }" onclick="setDataDetail(event)" class="product-name" data-toggle="modal" data-target=".bd-example-modal-lg">${item.p_name}</a>
              <div class="product-price">${item.p_price}฿</div>
              <div class="product-rating">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
            </div>
          </div>`
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

  function setDataDetail(e) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './db/product.php?id=' + e.target.id, true);
    xhr.onload = function() {
      if (this.status == 200) {
        let data = JSON.parse(this.responseText)
        var base_url = window.location.origin;
        document.getElementById('formId').textContent = data.p_id
        document.getElementById('name').innerHTML = data.p_name
        document.getElementById('product_detail').innerHTML = data.p_detail
        document.getElementById('price').innerHTML = `ราคา ${data.p_price} ฿`
        document.getElementById('img_name').src = `./img/${data.p_img}`
        img_names = data.p_img
        prices = data.p_price
      }
    }
    xhr.send()
  }


  function add() {
    var firstname = sessionStorage.getItem("first_name");
    let id = document.getElementById('formId').textContent
    const user_id = sessionStorage.getItem("user_id");
    if (!firstname) {
      alert('กรุณาเข้าสู่ระบบ')
      window.location.href = './login-main.php'
    } else {
      let value = {
        mem_id: user_id,
        p_id: id,
        qty: 1
      }
      var xhr = new XMLHttpRequest();
      xhr.open('POST', './db/cart.php', true);
      xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      xhr.onload = function() {
        if (this.status == 200) {
          alert('เลือกห้องเรียบร้อยแล้ว')
          CountCart()
          document.getElementById('exit').click()
        }
      }
      xhr.send(JSON.stringify(value))

    }


  }
</script>

</html>