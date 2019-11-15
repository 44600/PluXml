<?php
/**
 * Classe plxToken responsable du controle des formulaires
 *
 * @package PLX
 * @author	Stephane F
 **/
class plxToken {

	/**
	 * Méthode qui affiche le champ input contenant le token
	 *
	 * @return	stdio/null
	 * @author	Stephane F
	 **/
	public static function getTokenPostMethod() {

		$token = sha1(mt_rand(0, 1000000));
		$_SESSION['formtoken'][$token] = time();
		return '<input name="token" value="'.$token.'" type="hidden" />';

	}

	/**
	 * Méthode qui valide la durée de vide d'un token
	 *
	 * @param	$request	(deprecated)
	 * @return	stdio/null
	 * @author	Stephane F
	 **/
	public static function validateFormToken($request='') {

		if($_SERVER['REQUEST_METHOD']=='POST' AND isset($_SESSION['formtoken'])) {

			if(empty($_POST['token']) OR plxUtils::getValue($_SESSION['formtoken'][$_POST['token']]) < time() - 3600) { # 3600 seconds
				unset($_SESSION['formtoken']);
				die('Security error : invalid or expired token');
			}
			unset($_SESSION['formtoken'][$_POST['token']]);
		}

	}

	/**
	 * Create a token to reset user password
	 *
	 * @return	string	the token
	 * @author	Pedro "P3ter" CADETE
	 */
	public static function generateToken() {
		return sha1(mt_rand(0, 1000000));
	}

	/**
	 * Generate Token expiry date
	 *
	 * @param	int		hours before expiration
	 * @return	string	expiry date
	 * @author	Pedro "P3ter" CADETE
	 */

	public static function generateTokenExperyDate($hours = 24) {
		return date(YmdHis, mktime(date(H)+$hours, date(i), date(s), date(m), date(d), date(Y)));
	}

}