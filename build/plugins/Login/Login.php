<?php

/**
 * @author Hendrik
 * @package Plugin
 */
class Login extends Plugin
{
	#	Metainformation
	var $creator = "Hendrik Still";
	var $version = "1.0";
	var $email = "gamma32@gmail.com";
	var $description = "This is a Login plugin";



	static private $instance;
	static public function getInstance()
	{
		if (null === self::$instance) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	#	Constructor
	private function __construct (  )
	{
		RoutingEngine::getInstance()->hookBeforeAction($this);
			
	}

	public function beforeAction($controller)
	{
		if($controller->private)
		{
			$this->checkForAccess();
		}
	}

	public function checkForAccess()
	{
		if(!$_SESSION['login'])
		{
			$this->redirectToLogin();
		}

	}
	public function redirectToLogin()
	{
		RoutingEngine::getInstance()->redirect(Utility::buildUrl("User", "logon"));
	}

	public function logon($user,$password)
	{
		Classloader::getInstance()->loadModel("User");
		$userObj = new User();
		$userObj->findWhere("name = '$user' AND password = '".md5($password)."'");
		
		if($userObj->name == $user)
		{
			$_SESSION['login'] = true;
			RoutingEngine::getInstance()->redirect('index.php');
		}else{
			echo "Wrong username";
		}
	}
	public function logoff()
	{
		$_SESSION['login'] = false;
		session_destroy();
		RoutingEngine::getInstance()->redirect('index.php');
	}



}
###

?>