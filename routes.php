<?php 

/* --- Routes --- */
dispatch('/', 'ArticlePublicitaireOrchestrateur::index');
dispatch_get('/test/:name/:value', 'ArticlePublicitaireOrchestrateur::show');
