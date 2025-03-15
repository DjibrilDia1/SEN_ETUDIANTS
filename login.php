<!-- ======================= Section HEAD ======================= -->
<?php require_once("view/sections/login/head.php") ?>

<body>

    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <!-- ======================= Section HEADER ======================= -->
                            <?php require_once("view/sections/login/header.php") ?>

                            <!-- ======================= Section FORM ======================= -->
                            <?php require_once("view/sections/login/form.php") ?>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i>
    </a>

</body>

<!-- ======================= Section SCRIPT ======================= -->
<?php require_once("view/sections/login/script.php") ?>

<!-- =======================  message error And Success   ======================= -->
<?php require_once("view/sections/admin/msgErrorOrSuccess.php") ?>


