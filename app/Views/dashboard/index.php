<?= $this->include('layout/header') ?>
<?= $this->include('layout/sidebar') ?>
<?= $this->include('layout/topbar') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <div class="row">
        <div class="col-lg-3 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pasien</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= esc($totalPasien ?? 0) ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?>