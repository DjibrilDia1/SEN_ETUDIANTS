<!-- ================== SECTION HEAD ================== -->
<?php require_once(__DIR__ . "/../../../sections/admin/head.php") ?>

<body>
    <!-- ================== SECTION HEADER ================== -->
    <?php require_once(__DIR__ . "/../../../sections/admin/menuHaut.php") ?>

    <!-- ================== SECTION MENU GAUCHE ================== -->
    <?php require_once(__DIR__ . "/../../../sections/admin/menuGauche.php") ?>

    <!-- ================== SECTION CONTENT ================== -->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>#Evaluations/Notes</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <button type="button" class="btn btn-outline-primary  btn-sm" data-bs-toggle="modal"
                        data-bs-target="#">
                        Evaluations
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
                        data-bs-target="#addEvaluation">
                        <i class="bi bi-plus-circle me-1"></i>
                        Ajouter
                    </button>
                </li>
            </ol>
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
                                        <th>Semestre</th>
                                        <th>Type</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($evaluations as $evaluation): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($evaluation['nom']); ?></td>
                                            <td><?= htmlspecialchars($evaluation['semestre']); ?></td>
                                            <td><?= htmlspecialchars($evaluation['type']); ?></td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                    data-bs-target="#addNotes" title="Ajouter une note">
                                                    <i class="bi bi-plus-circle me-1"></i>
                                                    Ajouter
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
        class="bi bi-arrow-up-short"></i>
    </a>

    <!-- ================== SECTION MODALE EVALUATIONS ================== -->
    <div class="modal fade" id="addEvaluation" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg rounded-4">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Ajouter une évaluation</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Changez l'action en fonction de votre contrôleur (ex. evaluationMainController) -->
                    <form action="evaluationMainController" method="POST" enctype="multipart/form-data"
                        id="formAjoutEvaluation">
                        <!-- Champ caché pour détecter la soumission dans le contrôleur -->
                        <input type="hidden" name="formAjoutEvaluation" value="1">

                        <div class="modal-body">
                            <div class="row g-3">
                                <!-- Nom de l'évaluation -->
                                <div class="col-md-6">
                                    <label for="nom" class="form-label fw-bold">Nom de l'évaluation</label>
                                    <input type="text" class="form-control rounded-3" id="nom" name="nom" required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <!-- Semestre -->
                                <div class="col-md-6">
                                    <label for="semestre" class="form-label fw-bold">Semestre</label>
                                    <select class="form-select rounded-3" id="semestre" name="semestre" required>
                                        <option value="">-- Sélectionner --</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <!-- Type d'évaluation -->
                                <div class="col-md-6">
                                    <label for="type" class="form-label fw-bold">Type d'évaluation</label>
                                    <select class="form-select rounded-3" id="type" name="type" required>
                                        <option value="">-- Sélectionner --</option>
                                        <option value="CC">Contrôle Continu</option>
                                        <option value="Examen">Examen</option>
                                        <option value="TP">TP</option>
                                        <!-- Ajoutez d'autres types si besoin -->
                                    </select>
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

    <!-- ================== SECTION MODALE AJOUTER NOTES ================== -->
    <div class="modal fade" id="addNotes" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg rounded-4">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Ajout des notes pour l'évaluation</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="evaluationMainController" method="POST" id="formAjoutNotes">
                        <input type="hidden" name="formAjoutNotes" value="1">
                        <input type="hidden" name="idEvaluation" value="<?= htmlspecialchars($evaluation['id']) ?>">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Étudiant</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($etudiants)): ?>
                                    <?php foreach ($etudiants as $etudiant): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($etudiant['prenom'] . " " . $etudiant['nom']) ?></td>
                                            <td>
                                                <input type="number" name="notes[<?= $etudiant['id'] ?>]" min="0" max="20"
                                                    step="0.01" class="form-control" required>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="2" class="text-center">Aucun étudiant trouvé</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <div class="modal-footer bg-light border-top-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Enregistrer les notes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ================== SECTION SCRIPT ================== -->
    <?php require_once(__DIR__ . "/../../../sections/admin/script.php") ?>
</body>

</html>