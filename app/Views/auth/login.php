<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - ERM System</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    body {
      background: linear-gradient(135deg, #3b82f6 0%, #1e3a8a 100%);
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100">

  <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8">
    <div class="text-center mb-6">
      <div class="bg-blue-600 inline-flex items-center justify-center w-12 h-12 rounded-full mb-3">
        <i class="bi bi-heart-pulse text-white text-2xl"></i>
      </div>
      <h1 class="text-2xl font-bold text-gray-800">Selamat Datang</h1>
      <p class="text-gray-500 text-sm">Silakan login untuk masuk ke sistem ERM</p>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-sm text-center">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('/login') ?>" method="post" class="space-y-4">
      <?= csrf_field() ?>

      <div>
        <label class="block text-gray-700 text-sm font-medium mb-1">Username</label>
        <input type="text" name="username"
          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
          placeholder="Masukkan username..." required>
      </div>

      <div>
        <label class="block text-gray-700 text-sm font-medium mb-1">Password</label>
        <input type="password" name="password"
          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
          placeholder="Masukkan password..." required>
      </div>

      <button type="submit"
        class="w-full bg-gray-900 text-white font-semibold py-2 rounded-lg hover:bg-gray-700 transition">
        <i class="bi bi-box-arrow-in-right mr-2"></i> Login
      </button>
    </form>

    <hr class="my-6 border-gray-200">

    <p class="text-center text-gray-500 text-sm">
      © ERM System <?= date('Y') ?>
    </p>
  </div>

</body>

</html>