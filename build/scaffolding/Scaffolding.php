<?php

/**
 * @author Hendrik
 * @package Scaffolding
 */
class Scaffolding
{
	#	internal variables
	var $template;

	#	Constructor
	###

	function generateController($name){
		$this->loadTemplate('controller');
		$controllerName = ucwords($name).'Controller';
		$this->replaceMarks('name',$controllerName);
		$this->replaceMarks('model',$name);
		$this->replaceMarks('models',$name.'s');
		$this->writeFile('../controller/'.ucwords($name).'Controller.php');
	}

	function generateModel($name){
		$this->loadTemplate('model');
		$this->replaceMarks('model',ucwords($name));
		$this->writeFile('../model/'.ucwords($name).'.php');
	}

	function generateViews($name){
		mkdir('../views/'.ucwords($name));

		$this->loadTemplate('views/create');
		$this->replaceMarks('name',ucwords($name));
		$this->writeFile('../views/'.ucwords($name).'/create.html');

		$this->loadTemplate('views/edit');
		$this->replaceMarks('name',ucwords($name));
		$this->writeFile('../views/'.ucwords($name).'/edit.html');

		$this->loadTemplate('views/listAll');
		$this->replaceMarks('name',ucwords($name));
		$this->writeFile('../views/'.ucwords($name).'/listAll.html');

		$this->loadTemplate('views/show');
		$this->replaceMarks('name',ucwords($name));
		$this->writeFile('../views/'.ucwords($name).'/show.html');
	}

	function loadTemplate($name){
		$this->template = file_get_contents('./template/'.$name.'.temp');
	}

	function writeFile($path){
		echo $path;
		file_put_contents($path,$this->template);
	}

	function replaceMarks ( $mark,$value)
	{
		$this->template = str_replace('{'.$mark.'}',$value,$this->template);
	}


}
###

?>