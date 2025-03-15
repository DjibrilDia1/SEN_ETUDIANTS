<!-- ======================= Section Head ======================= -->
<?php require_once("view/sections/admin/head.php") ?>

<body>

	<!-- ================== Vérifier la session================== -->
	<?php require_once("view/sections/admin/verifierSession.php") ?>

    <!-- ======================= Section Menu haut ======================= -->
    <?php require_once("view/sections/admin/menuHaut.php") ?>

    <!-- ======================= Section Menu Gauche ======================= -->
    <?php require_once("view/sections/admin/menuGauche.php") ?>

    <!-- ======================= Base content ========================= -->
    <?php require_once("view/sections/admin/baseContent.php") ?>

    <!-- ======================= Section footer ======================= -->
    <?php require_once("view/sections/admin/footer.php") ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
    class="bi bi-arrow-up-short"></i></a>

    <!-- ======================= Section script ======================= -->
    <?php require_once("view/sections/admin/script.php") ?>

    <!-- =======================  message error And Success   ======================= -->
    <?php require_once("view/sections/admin/msgErrorOrSuccess.php") ?>

</body>
