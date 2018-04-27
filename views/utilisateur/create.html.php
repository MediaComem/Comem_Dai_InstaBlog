<?php content_for('navbar'); ?>
    <li><a href="<?=url_for('/utilisateur')?>">Tous les utilisateurs</a></li>
<?php end_content_for(); ?>

<?php content_for('contentTitle'); ?>
    <h3 class="col s12">Nouvel utilisateur</h3>
<?php end_content_for(); ?>

<form action="<?= url_for('/utilisateur') ?>" method="post" class="col s12">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <!-- Pseudo de l'utilisateur (doit être unique dans toute la table) -->
                        <div class="input-field col s12 m6">
                            <!-- Aucune restriction à faire pour ce champ -->
                            <input required type="text" name="pseudo" id="pseudo" pattern="[A-Z]{3}" value="<?php if (isset($flash['values'][':pseudo'])) echo $flash['values'][':pseudo']; ?>"/>
                            <label for="pseudo">Pseudo - <em>Trois lettres majuscules</em></label>
                        </div>
                        <!-- Email de l'utilisateur -->
                        <div class="input-field col s12 m6">
                            <!-- Doit être un email -->
                            <input required type="email" name="email" id="email" value="<?php if (isset($flash['values'][':email'])) echo $flash['values'][':email']; ?>"/>
                            <label for="email">Adresse e-mail</label>
                        </div>
                        <!-- Nom de l'utilisateur -->
                        <div class="input-field col s12 m6">
                            <!-- Aucune restriction à faire pour ce champ -->
                            <input required type="text" name="nom" id="nom" value="<?php if (isset($flash['values'][':nom'])) echo $flash['values'][':nom']; ?>"/>
                            <label for="nom">Nom</label>
                        </div>
                        <!-- Prénom de l'utilisateur -->
                        <div class="input-field col s12 m6">
                            <!-- Aucune restriction à faire pour ce champ -->
                            <input required type="text" name="prenom" id="prenom" value="<?php if (isset($flash['values'][':prenom'])) echo $flash['values'][':prenom']; ?>"/>
                            <label for="prenom">Prénom</label>
                        </div>
                        <!-- Date de naissance de l'utilisateur -->
                        <div class="input-field col s12 m6">
                            <!-- Doit être inférieure à aujourd'hui -->
                            <label class="active" for="dateNaissance">Date de naissance</label>
                            <input type="date" name="dateNaissance" id="dateNaissance" required value="<?php if (isset($flash['values'][':dateNaissance'])) echo $flash['values'][':dateNaissance']; ?>">
                        </div>
                        <!-- Téléphone de l'utilisateur -->
                        <div class="input-field col s12 m6">
                            <!-- Facultatif, mais doit être un numéro de téléphone -->
                            <input type="tel" placeholder="+XX XX XXX XX XX" name="telephone" id="telephone" pattern="^\+\d{2}\s\d{2}\s\d{3}(\s\d{2}){2}$" value="<?php if (isset($flash['values'][':telephone'])) echo $flash['values'][':telephone']; ?>"/>
                            <label for="telephone">Téléphone - <em>facultatif</em></label>
                        </div>
                        <!--Choix du sexe -->
                        <div class="col s12">
                            <p>
                                Sexe
                            </p>
                            <p>
                                <input name="sexe" type="radio" id="sexeF" value="f" <?php if(!isset($flash['values'][':sexe']) or (isset($flash['values'][':sexe']) and $flash['values'][':sexe'] === "F")) echo "checked"; ?>/>
                                <label for="sexeF">Femme</label>
                            </p>
                            <p>
                                <input name="sexe" type="radio" id="sexeH" value="h" <?php if(isset($flash['values'][':sexe']) and $flash['values'][':sexe'] === "H") echo "checked"; ?>/>
                                <label for="sexeH">Homme</label>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn waves-effect waves-light amber darken-4">Mémoriser</button>
</form>