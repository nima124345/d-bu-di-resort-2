<!DOCTYPE html>
<html lang="en">

<?php include './layouts/header.php'; ?>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Admin</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="#" onsubmit="handleLogin(event)">
          <div class=" input-group mb-3">
            <input type="text" class="form-control" id="username" required placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" required placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">

            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>



        <!-- <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p> -->

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->


</body>
<script>
  function handleLogin(e) {
    e.preventDefault();
    let value = {
      username: document.getElementById('username').value,
      password: document.getElementById('password').value,
    }
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../admin/db/login.php', true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.onload = function() {
      if (this.status == 200) {
        let data = JSON.parse(this.responseText)
        console.log(data)
        if (data) {
          sessionStorage.setItem('user_id', data[0].user_id)
          sessionStorage.setItem('user_group', data[0].user_group)
          sessionStorage.setItem('first_name', data[0].first_name)
          sessionStorage.setItem('last_name', data[0].last_name)

          window.location.href = "./index.php"
        } else {
          alert('username or password is incorrect')
        }
      }
    }
    xhr.send(JSON.stringify(value))
  }
</script>

</html>