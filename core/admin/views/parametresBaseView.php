<?php 
$adminTitle = L_CONFIG_BASE_CONFIG_TITLE;
?>

<?php ob_start(); ?>
	<ul class="bk-white pan">
		<li class="prs inbl"><a href="<?php echo PLX_CORE.'admin/parametresBase.php' ?>" title="<?php echo L_MENU_CONFIG_BASE_TITLE ?>"><?php echo L_MENU_CONFIG_BASE ?></a></li>
    	<li class="prs inbl"><a href="<?php echo PLX_CORE.'admin/parametresAffichage.php' ?>" title="<?php echo L_MENU_CONFIG_VIEW_TITLE ?>"><?php echo L_MENU_CONFIG_VIEW ?></a></li>
    	<li class="prs inbl"><a href="<?php echo PLX_CORE.'admin/parametresUsers.php' ?>" title="<?php echo L_MENU_CONFIG_USERS_TITLE ?>"><?php echo L_MENU_CONFIG_USERS ?></a></li>
    	<li class="prs inbl"><a href="<?php echo PLX_CORE.'admin/parametresAvances.php' ?>" title="<?php echo L_MENU_CONFIG_ADVANCED_TITLE?>"><?php echo L_MENU_CONFIG_ADVANCED ?></a></li>
    	<li class="prs inbl"><a href="<?php echo PLX_CORE.'admin/parametresThemes.php' ?>" title="<?php echo L_THEMES_TITLE ?>"><?php echo L_THEMES ?></a></li>
    	<li class="prs inbl"><a href="<?php echo PLX_CORE.'admin/parametresPlugins.php' ?>" title="<?php echo L_MENU_CONFIG_PLUGINS_TITLE ?>"><?php echo L_MENU_CONFIG_PLUGINS ?></a></li>
    	<li class="prs inbl"><a href="<?php echo PLX_CORE.'admin/parametresInfos.php' ?>" title="<?php echo L_MENU_CONFIG_INFOS_TITLE ?>"><?php echo L_MENU_CONFIG_INFOS ?></a></li>
	</ul>
<?php $adminSubMenu = ob_get_clean(); ?>

<?php eval($plxAdmin->plxPlugins->callHook('AdminSettingsBaseTop')) # Hook Plugins ?>

<?php ob_start(); ?>

<form action="parametres_base.php" method="post" id="form_settings">

	<div class="inline-form admin-title">
		<input type="submit" value="<?php echo L_CONFIG_BASE_UPDATE ?>" />
	</div>

	<fieldset class="config">
		<div class="grid">
			<div class="col sml-12 med-5 label-centered">
				<label for="id_title"><?php echo L_CONFIG_BASE_SITE_TITLE ?>&nbsp;:</label>
			</div>
			<div class="col sml-12 med-7">
				<?php plxUtils::printInput('title', plxUtils::strCheck($plxAdmin->aConf['title'])); ?>
			</div>
		</div>
		<div class="grid">
			<div class="col sml-12 med-5 label-centered">
				<label for="id_description"><?php echo L_CONFIG_BASE_SITE_SLOGAN ?>&nbsp;:</label>
			</div>
			<div class="col sml-12 med-7">
				<?php plxUtils::printInput('description', plxUtils::strCheck($plxAdmin->aConf['description'])); ?>
			</div>
		</div>
		<div class="grid">
			<div class="col sml-12 med-5 label-centered">
				<label for="id_meta_description"><?php echo L_CONFIG_META_DESCRIPTION ?>&nbsp;:</label>
			</div>
			<div class="col sml-12 med-7">
				<?php plxUtils::printInput('meta_description', plxUtils::strCheck($plxAdmin->aConf['meta_description'])); ?>
			</div>
		</div>
		<div class="grid">
			<div class="col sml-12 med-5 label-centered">
				<label for="id_meta_keywords"><?php echo L_CONFIG_META_KEYWORDS ?>&nbsp;:</label>
			</div>
			<div class="col sml-12 med-7">
				<?php plxUtils::printInput('meta_keywords', plxUtils::strCheck($plxAdmin->aConf['meta_keywords'])); ?>
			</div>
		</div>
		<div class="grid">
			<div class="col sml-12 med-5 label-centered">
				<label for="id_default_lang"><?php echo L_CONFIG_BASE_DEFAULT_LANG ?>&nbsp;:</label>
			</div>
			<div class="col sml-12 med-7">
				<?php plxUtils::printSelect('default_lang', plxUtils::getLangs(), $plxAdmin->aConf['default_lang']) ?>
			</div>
		</div>
		<div class="grid">
			<div class="col sml-12 med-5 label-centered">
				<label for="id_timezone"><?php echo L_CONFIG_BASE_TIMEZONE ?>&nbsp;:</label>
			</div>
			<div class="col sml-12 med-7">
				<?php plxUtils::printSelect('timezone', plxTimezones::timezones(), $plxAdmin->aConf['timezone']); ?>
			</div>
		</div>
		<div class="grid">
			<div class="col sml-12 med-5 label-centered">
				<label for="id_allow_com"><?php echo L_CONFIG_BASE_ALLOW_COMMENTS ?>&nbsp;:</label>
			</div>
			<div class="col sml-12 med-7">
				<?php plxUtils::printSelect('allow_com',array('1'=>L_YES,'0'=>L_NO), $plxAdmin->aConf['allow_com']); ?>
			</div>
		</div>
		<div class="grid">
			<div class="col sml-12 med-5 label-centered">
				<label for="id_mod_com"><?php echo L_CONFIG_BASE_MODERATE_COMMENTS ?>&nbsp;:</label>
			</div>
			<div class="col sml-12 med-7">
				<?php plxUtils::printSelect('mod_com',array('1'=>L_YES,'0'=>L_NO), $plxAdmin->aConf['mod_com']); ?>
			</div>
		</div>
		<div class="grid">
			<div class="col sml-12 med-5 label-centered">
				<label for="id_mod_art"><?php echo L_CONFIG_BASE_MODERATE_ARTICLES ?>&nbsp;:</label>
			</div>
			<div class="col sml-12 med-7">
				<?php plxUtils::printSelect('mod_art',array('1'=>L_YES,'0'=>L_NO), $plxAdmin->aConf['mod_art']); ?>
			</div>
		</div>
	</fieldset>
	<?php eval($plxAdmin->plxPlugins->callHook('AdminSettingsBase')) # Hook Plugins ?>
	<?php echo plxToken::getTokenPostMethod() ?>

</form>

<?php
# Hook Plugins
eval($plxAdmin->plxPlugins->callHook('AdminSettingsBaseFoot'));
?>

<?php $mainContent = ob_get_clean(); ?>