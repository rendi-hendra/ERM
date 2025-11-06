<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h1 class="text-2xl font-bold mb-2">Master Pasien</h1>
<p class="text-gray-500 mb-6">Kelola data pasien rumah sakit</p>

<div class="flex justify-between items-center mb-4">
  <form method="get" action="<?= base_url('pasien') ?>" class="inline-flex w-1/2">
    <input type="text" name="keyword" placeholder="Cari berdasarkan nama atau NIK"
      value="<?= esc($keyword ?? '') ?>"
      class="w-1/2 border border-gray-300 rounded-l-xl px-4 py-2">
    <button type="submit"
      class="bg-gray-900 text-white px-5 py-2 rounded-r-xl hover:bg-gray-700"><i class="bi bi-search"></i></button>
  </form>

  <a href="<?= base_url('/pasien/create') ?>" class="bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
    <i class="bi bi-person-plus mr-1"></i> Tambah Pasien
  </a>
</div>

<div class="bg-white shadow-sm rounded-2xl overflow-hidden">
  <table class="min-w-full text-sm">
    <thead class="bg-gray-100 text-gray-700">
      <tr>
        <th class="px-4 py-3 text-left font-semibold">NIK</th>
        <th class="px-4 py-3 text-left font-semibold">Nama</th>
        <th class="px-4 py-3 text-left font-semibold">Tanggal Lahir</th>
        <th class="px-4 py-3 text-left font-semibold">Jenis Kelamin</th>
        <th class="px-4 py-3 text-left font-semibold">No. HP</th>
        <th class="px-4 py-3 text-left font-semibold">Alamat</th>
        <th class="px-4 py-3 text-center font-semibold">Aksi</th>
      </tr>
    </thead>
    <tbody class="divide-y">
      <?php if (empty($pasien)): ?>
        <tr>
          <td colspan="7" class="px-4 py-3 text-center text-gray-500">
            Belum ada data pasien
          </td>
        </tr>
      <?php else: ?>
        <?php foreach ($pasien as $p): ?>
          <tr>
            <td class="px-4 py-3"><?= esc($p['nik']) ?></td>
            <td class="px-4 py-3"><?= esc($p['nama']) ?></td>
            <td class="px-4 py-3"><?= date('d/m/Y', strtotime($p['tanggal_lahir'])) ?></td>
            <td class="px-4 py-3"><?= esc($p['jenis_kelamin']) ?></td>
            <td class="px-4 py-3"><?= esc($p['no_hp']) ?></td>
            <td class="px-4 py-3"><?= esc($p['alamat']) ?></td>
            <td class="px-4 py-3 text-center">
              <a href="<?= base_url('/pasien/edit/' . $p['id']) ?>" class="text-blue-600 hover:bg-gray-200 p-2 rounded-lg btnEdit">
                <i class="bi bi-pencil-square text-lg"></i>
              </a>

              <a href="#"
                class="text-red-600 hover:bg-gray-200 p-2 rounded-lg ml-3 btn-delete"
                data-url="<?= base_url('/pasien/delete/' . $p['id']) ?>">
                <i class="bi bi-trash text-lg"></i>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<div class="mt-10">
  <?= $pager->links('pasien', 'pagination') ?>
</div>

<?php if (session()->getFlashdata('success')): ?>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      Toastify({
        text: "<?= session()->getFlashdata('success') ?>",
        duration: 3000,
        close: false,
        gravity: "top",
        position: "right",
        style: {
          background: "#36b526",
        }
      }).showToast();
    });
  </script>
<?php endif; ?>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();

        const url = this.getAttribute('data-url');

        Swal.fire({
          title: 'Yakin hapus data ini?',
          text: "Data yang dihapus tidak bisa dikembalikan!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, hapus!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = url;
          }
        });
      });
    });
  });
</script>


<?= $this->endSection() ?>