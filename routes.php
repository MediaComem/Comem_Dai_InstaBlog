<?php 

/* --- Routes --- */

/* --- Page d'accueil --- */
dispatch('/', function() {
  return render('home.html.php');
});

/* --- Utilisateurs --- */
dispatch_get('/utilisateur', 'UtilisateurCtrl::index');
dispatch_get('/utilisateur/create', 'UtilisateurCtrl::create');
dispatch_post('/utilisateur/create', 'UtilisateurCtrl::store');

/* --- Médias --- */
dispatch_get('/media', 'MediaCtrl::index');
dispatch_get('/media/create', 'MediaCtrl::create');
dispatch_post('/media/create', 'MediaCtrl::store');

/* --- Post --- */
dispatch_get('/post', 'PostCtrl::index');
dispatch_get('/post/create', 'PostCtrl::create');
dispatch_post('/post/create', 'PostCtrl::store');
