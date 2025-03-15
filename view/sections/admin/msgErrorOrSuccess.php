<!-- ====== CDN Sweet alert 2 ======= -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- ====== Message Error ======= -->
<!-- : meme chose que  { ; endif -> } -->
<?php if(
    isset($_GET["error"]) && $_GET["error"] == 1 &&
    isset($_GET["message"]) && !empty($_GET["message"]) &&
    isset($_GET["title"]) && !empty($_GET["title"])
) : ?>
    <script>
        Swal.fire({
            title: '<?= $_GET["title"] ?>',
            text: '<?= $_GET["message"] ?>',
            icon: 'error',
            timerProgressBar: true,
            timer: 3000,
            showConfirmButton: false
        });
    </script>
<?php endif; ?>

<!-- ====== Message success ======= -->
<?php if(
    isset($_GET["success"]) && $_GET["success"] == 1 &&
    isset($_GET["message"]) && !empty($_GET["message"]) &&
    isset($_GET["title"]) && !empty($_GET["title"])
) : ?>
    <script>

        Swal.fire({
            title: '<?= $_GET["title"] ?>',
            text: '<?= $_GET["message"] ?>',
            icon: 'success',
            timerProgressBar: true,
            timer: 3000,
            showConfirmButton: false
        });
    </script>
<?php endif; ?>