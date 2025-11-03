<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login - ERM System</title>

  <!-- SB Admin 2 CSS -->
  <link href="<?= base_url('assets/sb-admin-2/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/sb-admin-2/css/sb-admin-2.min.css') ?>" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    }
  </style>
</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-5 col-lg-6 col-md-8">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-5">
            <!-- Login Form -->
            <div class="text-center mb-4">
              <h1 class="h4 text-gray-900 mb-2">Selamat Datang</h1>
              <p class="text-muted mb-4">Silakan login untuk masuk ke sistem ERM</p>
            </div>

            <?php if (session()->getFlashdata('error')) : ?>
              <div class="alert alert-danger text-center">
                <?= session()->getFlashdata('error') ?>
              </div>
            <?php endif; ?>

            <form class="user" method="post" action="<?= base_url('/login') ?>">
              <?= csrf_field() ?>
              <div class="form-group">
                <input type="text" name="username" class="form-control form-control-user" placeholder="Masukkan Username..." required>
              </div>
              <div class="form-group">
                <input type="password" name="password" class="form-control form-control-user" placeholder="Masukkan Password..." required>
              </div>
              <button type="submit" class="btn btn-primary btn-user btn-block">
                <i class="fas fa-sign-in-alt"></i> Login
              </button>
            </form>

            <hr>
            <div class="text-center">
              <small class="text-muted">© ERM System <?= date('Y') ?></small>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- SB Admin 2 JS -->
  <script src="<?= base_url('assets/sb-admin-2/vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/sb-admin-2/js/sb-admin-2.min.js') ?>"></script>
</body>

</html>