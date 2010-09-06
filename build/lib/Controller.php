<?php

/**
 * @author Hendrik
 * @package Lib
 * @abstract
 */
class Controller
{
	#	internal variables
	var $renderType = 'html';

	#	Constructor
	function __construct (  )
	{
		# code...
	}
	###



	/**
	 * Loads model and creates instance of it.
	 * e.g.:
	 * $this->useModel('Post');
	 * $this->post->doSomePostThings();
	 * 
	 * @param string $modelName
	 */
	public function useModel ( $modelName )
	{
		Classloader::getInstance()->loadModel($modelName);
		$modelName = strtolower($modelName);
		$this->$modelName = new $modelName();
	}

	/**
	 * Returns controller name.
	 * 'post' => 'PostController'
	 * @param string $name
	 * @return string
	 */
	static public function getName ( $name='' )
	{
		return ucfirst($name).'Controller';
	}

	/**
	 * Returns all methods
	 * @return multitype:
	 */
	public function getAllActions (  )
	{
		$methods = get_class_methods(get_class($this));
			
		return $methods;
	}

	/**
	 * Triggers rendering of the page.
	 * Normaly you don't need this function.
	 * @param string $view
	 */
	public function render ( $view = 'index' )
	{
		
		switch ($this->renderType)
		{
			case 'part':
				$this->renderAsPart($view);
				break;
			default:
				$this->renderAsHTML($view);
				break;
		}
			
	}

	/**
	 * Not used at the moment
	 * @param string $text
	 */
	public function flash ( $text )
	{
		$templateEngine = TemplateEngine::getInstance();
		$templateEngine->flash($text);
	}

	public function includeAction($controller,$action)
	{
		$templateEngine = TemplateEngine::getInstance();
		$templateEngine->loadView($controller,$action);
	}

	/**
	 * Returns a json coded instead of rendering a complete view.
	 * This method shoud be usefull for ajax action ;-)
	 * @param object $object
	 */
	public function renderAsJson($object)
	{
		$this->renderType = 'json';
		$json_string = json_encode($object);

		echo $json_string;
	}
	
	/**
	 * Renders just the view instead of the full design + the view.
	 * Could be interessting for ajax things.
	 * @param string $view
	 */
	public function renderAsPart ($view = 'index')
	{
		$routingEngine = RoutingEngine::getInstance();
		$templateEngine = TemplateEngine::getInstance();
		$templateEngine->loadPartDesign( );
		$templateEngine->loadView( $routingEngine->controller,$routingEngine->action );
		$templateEngine->render($this);
	}

	/**
	 * Normal render 
	 * @param string $view
	 */
	public function renderAsHTML ($view = 'index')
	{
		$routingEngine = RoutingEngine::getInstance();
		$templateEngine = TemplateEngine::getInstance();
		$templateEngine->loadDesign();
		$templateEngine->loadView( $routingEngine->controller,$routingEngine->action );
		$templateEngine->setTitle($routingEngine->controller.' > '.$routingEngine->action);
		$templateEngine->render($this);
	}
		
}
###

?>