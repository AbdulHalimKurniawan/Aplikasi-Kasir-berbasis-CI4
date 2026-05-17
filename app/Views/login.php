<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <?= view('partials/head') ?>
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">Login</div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Login untuk masuk</p>
        <div class="alert alert-danger d-none"></div>
        <form>
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-user"></span></div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
          </div>
          <div class="form-group">
            <button class="btn btn-block btn-primary">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?= view('partials/footer') ?>
<script src="<?= base_url('assets/vendor/adminlte/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
<script>
  $('form').validate({
    errorElement: 'span',
    errorPlacement: (error, element) => {
      error.addClass('invalid-feedback')
      element.closest('.input-group').append(error)
    },
    submitHandler: () => {
      $.ajax({
        url: '<?= site_url('auth/login') ?>',
        type: 'post',
        dataType: 'json',
        data: $('form').serialize(),
        success: res => {
          if (res == 'tidakada') {
            $('.alert').html('Username tidak terdaftar').removeClass('d-none')
          } else if (res == 'passwordsalah') {
            $('.alert').html('Password Salah').removeClass('d-none')
          } else if (res.status == 'sukses') {
            $('.alert').html('Sukses').addClass('alert-success').removeClass('d-none alert-danger')
            setTimeout(() => window.location.replace(res.redirect), 300)
          }
        }
      })
    }
  })
</script>
</body>
</html>
