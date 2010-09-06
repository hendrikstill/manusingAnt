<?php

/**
 * @author Hendrik
 * @package Lib
 */
class RoutingEngine
{
	#	internal variables
	var $controller;
	var $action;
	var $classloader;
	var $beforeActionHook;
	var $afterActionHook;

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
		$this->classloader = Classloader::getInstance();
	}

	/**
	 * Routs the request to the controller
	 */
	public function route()
	{
		$this->getParameters();
		$this->classloader->loadController($this->controller);
		$controllerClass = Controller::getName($this->controller);
			
		$controller = new $controllerClass();

		
		//BeforeAction Hook execution
		if(isset($this->beforeActionHook))
		{
			foreach ($this->beforeActionHook as $hook)
			{
				$hook->beforeAction($controller);
			}
		}
			
		$controller->{$this->action}();
			
		//AfterAction Hook execution
		if(isset($this->afterActionHook))
		{
			foreach ($this->afterActionHook as $hook)
			{
				$hook->afterAction($controller);
			}
		}
			
		$controller->render();
			
			
	}

	/**
	 * loads parameters from url
	 */
	public function getParameters()
	{
		$this->controller = $_GET['controller'];
		$this->action = $_GET['action'];
		if(!isset($_GET['controller']))
		{
			$this->controller = DEFAULT_CONTROLLER;
		}
		if(!isset($_GET['action']))
		{
			$this->action = DEFAULT_ACTION;
		}
			
	}

	/**
	 * redirects the client to the defined cotnroller and action 
	 * @param string $controller
	 * @param string $action
	 * @param string $id
	 */
	public function redirectToAction($controller,$action,$id='')
	{
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = "index.php?controller=$controller&action=$action&id=$id";
		header("Location: http://$host$uri/$extra");
	}
	
	/**
	 * redirects the client to the defined url
	 * @param string $url
	 */
	public function redirect($url)
	{
		header("Location: $url");
	}

	/**
	 * The hook object has to implement the beforeRender($controller) function
	 * @param string $hook
	 */
	public function hookBeforeAction($hook)
	{
		$this->beforeActionHook[] = $hook;
	}

	/**
	 * The hook object has to implement the afterRender($controller) function
	 * @param string $hook
	 */
	public function hookAfterAction($hook)
	{
		$this->afterActionHook[] = $hook;
	}

}
###

?>