<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>

<div class="min-h-screen">
  <main class="flex-grow max-w-7xl mx-auto px-6 py-8">
    <?= $this->renderSection('content') ?>
  </main>
</div>

<?= $this->include('layouts/footer') ?>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.btn-logout');

    deleteButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault(); // cegah langsung redirect

        const url = this.getAttribute('data-url');

        Swal.fire({
          title: 'Anda Yakin Logout?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, Logout!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            // Arahkan ke URL delete
            window.location.href = url;
          }
        });
      });
    });
  });
</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</div>
</body>

</html>