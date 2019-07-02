<?php ob_start(); ?>

<?php 
$adminTitle = L_DASHBOARD_TITLE;
?>

<?php eval($plxAdmin->plxPlugins->callHook('AdminIndexTop')) # Hook Plugins ?>

<div class="autogrid has-gutter mbm">
	<div class="pas bk-white">
		<h3 class="">Mes brouillons</h3>
        <div class="">
			<?php
                # Récupération des articles
                $plxAdmin->prechauffage($plxAdmin->motif('draft','all'));
                $arts = $plxAdmin->getArticles('all');
                # Liste des articles
               	if($arts) {
               	   while($plxAdmin->plxRecord_arts->loop()) { # Pour chaque article
                   	   $idArt = $plxAdmin->plxRecord_arts->f('numero');
                          $author = plxUtils::getValue($plxAdmin->aUsers[$plxAdmin->plxRecord_arts->f('author')]['name']);
                   	   echo plxDate::formatDate($plxAdmin->plxRecord_arts->f('date'));
                   	   echo '<a href="article.php?a='.$idArt.'" title="'.L_ARTICLE_EDIT_TITLE.'">'.plxUtils::strCheck($plxAdmin->plxRecord_arts->f('title')).'</a>';
                   	   echo plxUtils::strCheck($author);
                   	   echo '<a href="article.php?a='.$idArt.'" title="'.L_ARTICLE_EDIT_TITLE.'">'.L_ARTICLE_EDIT.'</a>';
                      }
               	} else { # Aucun article dans la liste
               		  echo L_NO_ARTICLE;
               	}
           	?>
    	</div>
	</div>
	<div class="pas bk-white">
       	<h3 class="">Actualités</h3>
    	<div class="">
          	<p>Blog</p>
        	<p>Forum</p>
		</div>
   	</div>
</div>

<div class="autogrid has-gutter">
    <!-- Affichages des commentaires en modération -->
    <?php if($_SESSION['profil'] <= PROFIL_MODERATOR): ?>
    	<div class="pas bk-white">
    		<h3 class="">Articles en modération</h3>
    		<div class="">
               	<?php 	
                    # Récupération des articles
                    $plxAdmin->prechauffage($plxAdmin->motif('mod','all', $userId));
                    $arts = $plxAdmin->getArticles('all');
                    # Liste des articles
                  	if($arts) {
                   	   while($plxAdmin->plxRecord_arts->loop()) { # Pour chaque article
                   	       $idArt = $plxAdmin->plxRecord_arts->f('numero');
                  		   $author = plxUtils::getValue($plxAdmin->aUsers[$plxAdmin->plxRecord_arts->f('author')]['name']);
                   		   echo plxDate::formatDate($plxAdmin->plxRecord_arts->f('date'));
                   		   echo '<a href="article.php?a='.$idArt.'" title="'.L_ARTICLE_EDIT_TITLE.'">'.plxUtils::strCheck($plxAdmin->plxRecord_arts->f('title')).'</a>';
                   		   echo plxUtils::strCheck($author);
                   		   echo '<a href="article.php?a='.$idArt.'" title="'.L_ARTICLE_EDIT_TITLE.'">'.L_ARTICLE_EDIT.'</a>';
                   		}
                   	} else { # Aucun article dans la liste
                   		echo L_NO_ARTICLE;
                   	}
               	?>
           	</div>
    	</div>
	<?php endif; ?>
    <!--  Affichages des articles en modération -->
    <?php if($_SESSION['profil'] <= PROFIL_MODERATOR): ?>
        <div class="pas bk-white">
            <h3 class="">Commenaires en modération</h3>
			<div class="">
            	<p>Liste des commantaires</p>
			</div>
        </div>
	<?php endif; ?>
</div>

<?php
# Hook Plugins
eval($plxAdmin->plxPlugins->callHook('AdminIndexFoot'));
?>

<?php $mainContent = ob_get_clean(); ?>