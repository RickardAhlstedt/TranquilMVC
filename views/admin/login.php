<?php
require_once( PATH_MODELS . '/admin/login.php' );

require_once( PATH_CORE . '/clRouter.php' );

$oLogin = new login();
$oRouter = new clRouter();

// if( isset($_COOKIE['username']) && isset($_COOKIE['userpass']) ) {
// 	$aResult = $oLogin->loginFromCookies( $_COOKIE['username'], $_COOKIE['userpass'] );
// 	if( $aResult == true ) {
// 		$oRouter->redirect( '/admin' );
// 	} else {
// 	}
// }

if( !empty($_POST) ) {
	$aLoginResult = $oLogin->login( $_POST['username'], $_POST['password'] );
	if( $aLoginResult == true ) {
		// if( isset($_POST['remember']) ) {
		// 	setcookie( 'username', $_POST['username'] );
		// 	setcookie( 'userpass', $oLogin->saltPassword($_POST['password']) );
		// }
		$oRouter->redirect( '/admin' );
	} else {
		$aErr = array(
			'Invalid username or password'
		);
	}
}
?>
<div id="backgroundImage"></div>
<form action="/admin/login" method="post" id="formLogin" class="center panel">
	<h1>Login</h1>
	&nbsp;
	<?php 
		if( !empty($aErr) ) {
			echo '<div class="error panel" style="background-color: red;">';
			foreach( $aErr as $sError ) {
				echo $sError;
			}
			echo '</div><br />';
		}
	?>
	<label for="username">Username</label>
	<br />
	<input type="text" value="" required id="username" name="username" />
	<br />
	<label for="password">Password</label>
	<br />
	<input type="password" value="" required id="password" name="password" />
	<br />
	<!-- <label for="remember" class="inline">Remember me</label>
	<input type="checkbox" checked="checked" id="remember" class="inline" name="remember" value="true"/>
	<br /> -->
	<input type="hidden" name="frmLogin" value="true" />
	<input type="hidden" name="ajax" value="false" />
	<button class="formLoginButton raised">Login</button>
</form>