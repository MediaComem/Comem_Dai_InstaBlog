<?php content_for('navbar'); ?>
    <li><a href="<?=url_for('/post')?>">Tous les posts</a></li>
<?php end_content_for(); ?>

<?php content_for('contentTitle'); ?>
    <h3 class="col s12">Nouveau post</h3>
<?php end_content_for(); ?>

<form action="<?= url_for('/post') ?>" method="post" class="col s12">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <!-- Date de publication du post -->
                        <div class="input-field col s12 m6">
                            <!-- Doit être inférieure ou égale à aujourd'hui -->
                            <label class="active" for="datePublication">Date de publication</label>
                            <input type="date" name="datePublication" id="datePublication" required value="<?php if (isset($flash['values'][':datePublication'])) echo $flash['values'][':datePublication']; ?>">
                        </div>
                        <!-- Texte du post -->
                        <div class="input-field col s12">
                            <textarea id="texte" name="texte" class="materialize-textarea"><?php if (isset($flash['values'][':texte'])) echo $flash['values'][':texte']; ?></textarea>
                            <label for="texte">Texte - <em>facultatif</em></label>
                        </div>
                        <div class="col s12">
                            <p>
                                Type
                            </p>
                            <p>
                                <input name="type" type="radio" id="typeFlux" value="flux" <?php if(!isset($flash['values'][':type']) or (isset($flash['values'][':type']) and $flash['values'][':type'] === "flux")) echo "checked"; ?>/>
                                <label for="typeFlux">Flux</label>
                            </p>
                            <p>
                                <input name="type" type="radio" id="typeStory" value="stories" <?php if(isset($flash['values'][':type']) and $flash['values'][':type'] === "stories") echo "checked"; ?>/>
                                <label for="typeStory">Story</label>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Rédigé par</span>
                    <!-- ID de l'utilisateur -->
                    <div class="input-field">
                        <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                        <input type="number" min="1" step="1" required name="noUtilr" id="noUtilr" value="<?php if (isset($flash['values'][':noUtilr'])) echo $flash['values'][':noUtilr']; ?>"/>
                        <label for="noUtilr">Numéro utilisateur</label>
                    </div>               
                </div>
            </div>
        </div>
        <div class="col s12 m4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Position GPS - <em>facultatif</em></span>
                    <!-- Numéro de la position GPS -->
                    <div class="input-field">
                        <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                        <input type="number" min="1" step="1" name="noPosGPS" id="noPosGPS" value="<?php if (isset($flash['values'][':noPosGPS'])) echo $flash['values'][':noPosGPS']; ?>"/>
                        <label for="noPosGPS">Numéro</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Publié dans - <em>facultatif</em></span>
                    <!-- Numéro du groupe où le post est pubié -->
                    <div class="input-field">
                        <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                        <input type="number" min="1" step="1" name="noGrpe" id="noGrpe" value="<?php if (isset($flash['values'][':noGrpe'])) echo $flash['values'][':noGrpe']; ?>"/>
                        <label for="noGrpe">Numéro du groupe</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn waves-effect waves-light amber darken-4">Mémoriser</button>
</form>