<div class="card mb-3">
    <div class="card-body">

        <!-- ======================= Section Header  ======================= -->
        <div class="pt-4 pb-2">
            <h5 class="card-title text-center pb-0 fs-4">Connexion</h5>
            <p class="text-center small">Entrer votre mail et votre mot de passe</p>
        </div>

        <!-- ======================= Section Formulaire ======================= -->
        <form action="userMainController" method="POST" class="row g-3" id="formLogin">

            <!-- id email -->
            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" class="form-control"  required>
                <p class="error-message"></p>
            </div>

            <!-- mot de passe -->
            <div class="col-12">
                <label for="password" class="form-label">Mot de passe</label>
                <input id="password" type="password" minlength="8" name="password" class="form-control" required>
                <p class="error-message"></p>
            </div>

            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Se souvenir de moi </label>
                </div>
            </div>
    
            <div class="col-12">
                <button id="btnSubmit" name="formLogin" class="btn btn-primary w-100" type="submit">Connexion</button>
            </div>
        </form>

    </div>
</div>