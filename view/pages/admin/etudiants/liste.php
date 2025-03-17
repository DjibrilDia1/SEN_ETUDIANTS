<!-- ================== SECTION HEAD ================== -->
<?php require_once(__DIR__ . "/../../../sections/admin/head.php") ?>

<body>

    <!-- ================== SECTION HEADER ================== -->
    <?php require_once(__DIR__ . "/../../../sections/admin/menuHaut.php") ?>

    <!-- ================== SECTION MENU GAUCHE ================== -->
    <?php require_once(__DIR__ . "/../../../sections/admin/menuGauche.php") ?>

    <!-- ================== SECTION CONTENT================== -->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Liste des etudiants</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <button type="button" class="btn btn-outline-primary  btn-sm" data-bs-toggle="modal"
                            data-bs-target="#">
                            Etudiants
                        </button>
                    </li>
                    <li class="breadcrumb-item">
                        <button type="button" class="btn btn-outline-primary  btn-sm" data-bs-toggle="modal"
                            data-bs-target="#">
                            Corbeille
                        </button>
                    </li>
                    <li class="breadcrumb-item">
                        <button type="button" class="btn btn-outline-primary  btn-sm" data-bs-toggle="modal"
                            data-bs-target="#addEtudiants">
                            <i class="bi bi-plus-circle me-1"></i>
                            Ajouter
                        </button>
                    </li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tableau</h5>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>email</th>
                                        <th>Matricule</th>
                                        <th>telephone</th>
                                        <th>adresse</th>
                                        <th>modifier</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($etudiants as $etudiant): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($etudiant['nom']); ?></td>
                                            <td><?= htmlspecialchars($etudiant['email']); ?></td>
                                            <td><?= htmlspecialchars($etudiant['matricule']); ?></td>
                                            <td><?= htmlspecialchars($etudiant['telephone']); ?></td>
                                            <td><?= htmlspecialchars($etudiant['adresse']); ?></td>
                                            <td><a href="etudiantMainController?action=edit&id=<?= $etudiant['id']; ?>"
                                                    class="btn btn-sm btn-outline-primary" title="Modifier">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>

    <!-- ================== SECTION FOOTER ================== -->
    <?php require_once(__DIR__ . "/../../../sections/admin/footer.php") ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- ================== SECTION MODALE TUDIANTS ================== -->
    <div class="modal fade" id="addEtudiants" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg rounded-4">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Ajouter un étudiant</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="etudiantMainController" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="formAjoutEtudiant" value="1">
                        <div class="modal-body">
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label for="nom" class="form-label fw-bold">Nom</label>
                                    <input type="text" class="form-control rounded-3" id="nom" name="nom" required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="email" class="form-control rounded-3" id="email" name="email" required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-6">
                                    <label for="password" class="form-label fw-bold">Mot de passe</label>
                                    <input type="password" class="form-control rounded-3" id="password" name="password"
                                        required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-6">
                                    <label for="matricule" class="form-label fw-bold">Matricule</label>
                                    <input type="text" class="form-control rounded-3" id="matricule" name="matricule"
                                        required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-6">
                                    <label for="telephone" class="form-label fw-bold">Téléphone</label>
                                    <input type="tel" class="form-control rounded-3" id="telephone" name="telephone"
                                        required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-6">
                                    <label for="photo" class="form-label fw-bold">Photo</label>
                                    <input type="file" class="form-control rounded-3" id="photo" name="photo"
                                        accept="image/*">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-12">
                                    <label for="adresse" class="form-label fw-bold">Adresse</label>
                                    <input type="text" class="form-control rounded-3" id="adresse" name="adresse"
                                        required>
                                    <div class="invalid-feedback"></div>
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer bg-light border-top-0">
                            <button type="reset" class="btn btn-secondary rounded-3">Annuler</button>
                            <button type="submit" class="btn btn-primary rounded-3">Enregistrer</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- ================== SECTION SCRIPT ================== -->
    <?php require_once(__DIR__ . "/../../../sections/admin/script.php") ?>
    <script src="public/js/global/Validator.js"></script>
    <script src="public/js/etudiants/addFrmValidator.js"></script>

</body>