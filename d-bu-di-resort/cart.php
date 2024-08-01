<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="./js/fontawesome-free-6.2.1-web/css/fontawesome.min.css" />


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



  <title>d-bu-di-resort</title>
  <style>
    #header-contact .section-language {
      color: #fff;
    }

    #header-contact {
      background: #57bd96;
      padding: 5px;
      max-height: 35px;
    }

    .border-right-withe {
      border-right: 1px solid #f7f7f7;
      color: #fff;
    }
  </style>
</head>

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
    <div class="row ">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ชื่อห้องพัก</th>
            <th>ราคาต่อห้อง</th>
            <th>จำนวน</th>
            <th>รวม</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="cartAll">

        </tbody>
      </table>
      <br>

    </div>
    <div id="frmCheckout">

    </div>

    <div><button onclick="handleCheckOut()" type="button" class="btn btn-success">จองห้องพัก</button></div>
    <br>
  </section>




  <script src="./css/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>



<script>
  var firstname = sessionStorage.getItem("first_name");
  const user_idx = sessionStorage.getItem("user_id");
  var datas
  getCartAll()

  function getCartAll() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './db/cart.php?id=' + user_idx, true);
    xhr.onload = function() {
      if (this.status == 200) {
        let data = JSON.parse(this.responseText)
        datas = JSON.parse(this.responseText)
        let el = document.getElementById('cartAll')
        let reuslt = ''

        for (const i in data) {
          let count = parseInt(i) + 1
          let item = data[i]

          reuslt += `<tr>
                            <td>
                            <div class="cart-info">
                                <img width="80px" hight="40px" src="./img/${
                                  item.p_img
                                }" alt="">
                                <div>   
                                <p>${
                                  item.p_name
                                }</p>                                
                                </div>
                            </div>
                            </td>
                            <td>${item.p_price}</td>
                            <td>${item.qty}</td>
                            <td>${
                              item.sumPrice
                            }</td>
                            <td><a href="#" onclick="deleteCart('${item.id}')">ลบ</a></td></tr>
                        `
        }

        el.innerHTML = reuslt

      }
    }
    xhr.onerror = function() {
      console.log('ss')
    }
    xhr.send()
  }


  function handleCheckOut() {

    if (!firstname) {
      alert('กรุณาเข้าสู่ระบบ')
      window.location.href = './login-main.php'
    } else if (datas == null) {
      alert('กรุณาเลือกห้องพัก')

    } else {
      addOrder()
    }
  }

  function addOrder() {

    var user_idToOrder = sessionStorage.getItem("user_id");

    if (user_idToOrder) {

      let o_total = 0
      for (const i of datas) {
        o_total = o_total + parseInt(i.sumPrice)
      }


      let value = {
        mem_id: user_idToOrder,
        o_total: o_total
      }

      let text = `คุณต้องการจองห้องพักใช่หรือไม่ ?`;
      if (confirm(text) == true) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', './db/order.php', true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onload = function() {
          if (this.status == 200) {
            if (xhr.responseText) {
              addOrderDetail(xhr.responseText)
            }
          }
        }
        xhr.send(JSON.stringify(value))

      }
    }


  }

  function addOrderDetail(id) {
    for (const i in datas) {
      let item = datas[i]

      let value = {
        o_id: id,
        p_id: item.p_id,
        d_qty: item.qty,
        d_subtotal: item.sumPrice,
      }

      var xhr = new XMLHttpRequest();
      xhr.open('POST', './db/order.php?order_detail=orderDetail', true);
      xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      xhr.onload = function() {
        if (this.status == 200) {

        }
      }
      xhr.send(JSON.stringify(value))
    }
    deleteAllCart()


  }

  function deleteAllCart() {

    var xhr = new XMLHttpRequest();
    xhr.open(
      "POST",
      "./db/delete-all-cart.php?id=" + user_idx,
      true
    );
    xhr.onload = function() {
      if (this.status == 200) {
        window.location.href = './cart.php'
      }
    };
    xhr.send();
  }


  function deleteCart(id) {

    var xhr = new XMLHttpRequest();
    xhr.open(
      "POST",
      "./db/delete-cart.php?id=" + id,
      true
    );
    xhr.onload = function() {
      if (this.status == 200) {
        getCartAll()
      }
    };
    xhr.send();
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
            document.getElementById('pathImage').value = item.path.replace("/toy-shop/img/img-slip/", "")
          }
        }
      }
      xhr.send(form_data)
    }
  }


  function setData() {
    if (localStorage.length != 0) {
      var base_url = window.location.origin;
      let data = JSON.parse(localStorage.sessionOrder);
      let el = document.getElementById("carts");

      let reuslt = "";
      let totalCount = 0;
      let totalPrice = 0;

      for (const i in data) {
        totalCount += data[i].count;
        totalPrice += parseInt(data[i].price) * parseInt(data[i].count);

        reuslt += `      <tr>
                            <td>
                            <div class="cart-info">
                                <img width="80px" hight="40px" src="./img/${
                                  data[i].img
                                }" alt="">
                                <div>   
                                <p>${
                                  data[i].name
                                }</p>                                
                                </div>
                            </div>
                            </td>
                            <td>${data[i].price}</td>
                            <td>${data[i].count}</td>
                            <td>${
                              parseInt(data[i].price) * parseInt(data[i].count)
                            }</td>
                            <td><a href="#" onclick="delteitem(${i},'${
        data[i].name
      }')">ลบ</a></td></tr>
                        `;
      }

      reuslt += ` <tr><td style="text-align: right;" colspan="5">รวมราคาทั้งหมด ${totalPrice} บาท</td> </tr>`;

      el.innerHTML = reuslt;
    } else {
      let el = document.getElementById("carts");

      reuslt = "ไม่พบห้องพักในตระกร้า";
      document.getElementById("cartTotal").innerText = "0";

      el.innerHTML = reuslt;
    }
    coutCart();
  }
</script>

</html>