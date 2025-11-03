<?= $this->include('layout/header') ?>
<?= $this->include('layout/sidebar') ?>
<?= $this->include('layout/topbar') ?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Data Pasien</h1>

  <a href="<?= base_url('/pasien/create') ?>" class="btn btn-primary mb-3">
    <i class="fas fa-plus"></i> Tambah Pasien
  </a>

  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>No</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Tanggal Lahir</th>
              <th>Alamat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($pasien)) : ?>
              <?php foreach ($pasien as $index => $p) : ?>
                <tr>
                  <td><?= $index + 1 ?></td>
                  <td><?= esc($p['nik']) ?></td>
                  <td><?= esc($p['nama']) ?></td>
                  <td><?= esc($p['tanggal_lahir']) ?></td>
                  <td><?= esc($p['alamat']) ?></td>
                  <td>
                    <a href="<?= base_url('/pasien/edit/' . $p['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?= base_url('/pasien/delete/' . $p['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus pasien ini?')">Hapus</a>
                  </td>
                </tr>
              <?php endforeach ?>
            <?php else : ?>
              <tr>
                <td colspan="6" class="text-center">Belum ada data</td>
              </tr>
            <?php endif ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->include('layout/footer') ?>