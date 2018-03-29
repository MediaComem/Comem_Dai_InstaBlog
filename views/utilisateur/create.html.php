<?php content_for('navbar'); ?>
    <li><a href="<?=url_for('/utilisateur')?>">Tous les utilisateurs</a></li>
<?php end_content_for(); ?>

<?php content_for('contentTitle'); ?>
    <h3 class="col s12">Nouvel utilisateur</h3>
<?php end_content_for(); ?>

<form action="<?= url_for('/utilisateur/create') ?>" method="post" class="col s12">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <!-- Pseudo de l'utilisateur (doit être unique dans toute la table) -->
                        <div class="input-field col s12 m6">
                            <!-- Aucune restriction à faire pour ce champ -->
                            <input required type="text" name="pseudo" id="pseudo" value="<?php if (isset($flash['inputs']['pseudo'])) echo $flash['inputs']['pseudo']; ?>"/>
                            <label for="pseudo">Pseudo</label>
                        </div>
                        <!-- Email de l'utilisateur -->
                        <div class="input-field col s12 m6">
                            <!-- Doit être un email -->
                            <input required type="email" name="email" id="email" value="<?php if (isset($flash['inputs']['email'])) echo $flash['inputs']['email']; ?>"/>
                            <label for="email">Adresse e-mail</label>
                        </div>
                        <!-- Nom de l'utilisateur -->
                        <div class="input-field col s12 m6">
                            <!-- Aucune restriction à faire pour ce champ -->
                            <input required type="text" name="nom" id="nom" value="<?php if (isset($flash['inputs']['nom'])) echo $flash['inputs']['nom']; ?>"/>
                            <label for="nom">Nom</label>
                        </div>
                        <!-- Prénom de l'utilisateur -->
                        <div class="input-field col s12 m6">
                            <!-- Aucune restriction à faire pour ce champ -->
                            <input required type="text" name="prenom" id="prenom" value="<?php if (isset($flash['inputs']['prenom'])) echo $flash['inputs']['prenom']; ?>"/>
                            <label for="prenom">Prénom</label>
                        </div>
                        <!-- Date de naissance de l'utilisateur -->
                        <div class="input-field col s12 m6">
                            <!-- Doit être inférieure à aujourd'hui -->
                            <label class="active" for="dateNaissance">Date de naissance</label>
                            <input type="date" name="dateNaissance" id="dateNaissance" required value="<?php if (isset($flash['inputs']['date'])) echo $flash['inputs']['date']; ?>">
                        </div>
                        <!-- Téléphone de l'utilisateur -->
                        <div class="input-field col s12 m6">
                            <!-- Facultatif, mais doit être un numéro de téléphone -->
                            <input type="tel" name="telephone" id="telephone" value="<?php if (isset($flash['inputs']['telephone'])) echo $flash['inputs']['telephone']; ?>"/>
                            <label for="telephone">Téléphone - <em>facultatif</em></label>
                        </div>
                        <!--Choix du sexe -->
                        <div class="col s12">
                            <p>
                                Sexe
                            </p>
                            <p>
                                <input name="sexe" type="radio" id="sexeF" value="F" <?php if(isset($flash['inputs']['sexe']) and $flash['inputs']['sexe'] === "F") echo "checked"; ?>/>
                                <label for="sexeF">Femme</label>
                            </p>
                            <p>
                                <input name="sexe" type="radio" id="sexeH" value="H" <?php if(isset($flash['inputs']['sexe']) and $flash['inputs']['sexe'] === "H") echo "checked"; ?>/>
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