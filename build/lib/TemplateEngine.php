<?php

/**
 * @author Hendrik
 * @package Lib
 */
class TemplateEngine
{
	#	internal variables
	var $design;
	var $view;
	var $marks;
	var $beforeRenderHooks;

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
		# code...
	}

	public function loadDesign (  )
	{
		$this->design = file_get_contents(DESIGN_PATH);
	}
	
	/**
	 *  Writes just the String {content} as design.
	 *  This is usefull if you want render just the view without the design template
	 */
	public function loadPartDesign ( )
	{
		$this->design = '{content}';
	}

	public function replaceMarks ( $mark,$value)
	{
		$this->marks[$mark] = $value;
		//$this->design = str_replace('{'.$mark.'}',$value,$this->design);
	}

	public function loadView($controller,$view)
	{
		$this->view = $this->getViewContent($controller,$view);
	}

	public function getViewContent($controller,$view)
	{
		$controller = ucfirst($controller);
		return file_get_contents('./views/'.$controller.'/'.$view.'.html');
	}

	public function setTitle ($title)
	{
		$this->replaceMarks('title',$title);
	}

	public function flash ($text)
	{
		$session['flash'] = $text;
	}

	/**
	 * The hook object has to implement the beforeRender() function
	 * @param Object $hook
	 */
	public function hookBeforeRender($hook){
		$this->beforeRenderHooks[] = $hook;
	}

	public function render($controller)
	{
		//Executing hooks
		if(isset($this->beforeRenderHooks) )
		foreach ($this->beforeRenderHooks as $hook){
			$hook->beforeRender();
		}
			
		//Adding Flashes and the content view
		$this->replaceMarks('flash',$session['flash']);
		$this->replaceMarks('content',$this->view);
			
		//Replacing all marks with values
		foreach ($this->marks as $mark => $value)
		{
			$this->design = str_replace('{'.$mark.'}',$value,$this->design);
		}
		eval('?>'.$this->design.'<?');
	}
		
}
###

?>