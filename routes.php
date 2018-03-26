<?php 

/* --- Routes --- */

/* --- Page d'accueil --- */
dispatch('/', function() {
  return render('home.html.php');
});

/* --- Utilisateurs --- */
dispatch_get('/users', 'UsersOrch::index');
dispatch_get('/users/create', 'UsersOrch::create');
