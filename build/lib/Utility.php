<?php

/**
 * @author Hendrik
 * @package Lib
 * @static
 */
class Utility
{
	#	internal variables

	/**
	 * Returns url with the given parameters
	 * @param string $controller
	 * @param string $action
	 * @param string $id
	 * @return string
	 */
	public static function buildUrl($controller,$action,$id = "")
	{
		return "./index.php?controller=$controller&action=$action&id=$id";
	}

	/**
	 * Returns url to the show action of the model
	 * @param model $model
	 * @return string
	 */
	public static function buildUrlToObject($model)
	{
		return Utility::buildUrl(get_class($model), 'show',$model->id);
	}

	/**
	 * Returns simple href link. Use a params array to define tag attributes like array('class'=>'myclass','id'=>'myid')
	 * @param string $text
	 * @param string $link
	 * @param array $params
	 */
	public static function buildLink($text,$link,$params = null)
	{
		$string = '<a href="'.$link.'" ';
		if(isset($params))
		{
			foreach ($params as $key => $value)
			{
				$string .= $key.'="'.$value.'" ';
			}
		}
		$string .= '>'.$text.'</a>';

		return $string;

	}

	/**
	 * Generates html table with the meta information from the models and returns the string
	 * @param model $models
	 * @param boolean $showActions
	 * @param array $params
	 * @return string
	 */
	public static function buildTable($models,$showActions = true,$params = null)
	{
		$attributes = $models[null]->getAttributes();

		$string = '<table ';

		if(isset($params))
		{
			foreach ($params as $key => $value)
			{
				$string .= $key.'="'.$value.'" ';
			}
		}
		$string .= '>';

		//Creating table header
		$string .= '<tr>';
		foreach ($attributes as $attribute)
		{
			$string .= '<th>'.$attribute[0].'</th>';

		}
		if($showActions)
		{
			$string .= '<th> actions </th>';
		}
		$string .= '</tr>';

		//Adding model data to the table
		foreach ($models as $model)
		{

			$string .= '<tr>';
			foreach ($model->attributes as $attribute)
			{
				$string .= '<td>'.$model->{$attribute[0]}.'</td>';
			}
			if($showActions)
			{
				$string .= '<td>';
				$string .= Utility::buildLink('delete ', Utility::buildUrl(get_class($model), 'delete',$model->id));
				$string .= Utility::buildLink('show ', Utility::buildUrl(get_class($model), 'show',$model->id));
				$string .= Utility::buildLink('edit ', Utility::buildUrl(get_class($model), 'edit',$model->id));
				$string .= '</td>';
			}
			$string .= '</tr>';
		}

		$string .= '</table>';

		return $string;

	}

	/**
	 * Generates html form with the meta information from the model. Use $params as html parameters for the form and the $tableparams as parameters for the table
	 * @param model $model
	 * @param array $params
	 * @param array $tableparams
	 * @return string
	 */
	public static function buildForm($model,$params = null,$tableparams = null)
	{
		$string = '<form ';
		if(isset($params))
		{
			foreach ($params as $key => $value)
			{
				$string .= $key.'="'.$value.'" ';
			}
		}
		$string .= '>';
		$string .= '<table ';
		if(isset($tableparams))
		{
			foreach ($tableparams as $key => $value)
			{
				$string .= $key.'="'.$value.'" ';
			}
		}
		$string .= '>';

		foreach ($model->attributes as $attribute)
		{
			$string .= '<tr>';
			$string .= '<td>'.$attribute[0].'</td>';
			if($attribute[0] == 'id')
			{
				$string .= '<td>'.$model->{$attribute[0]}.'</td>';
			}else{
				$string .= '<td><input type="text" name="'.$attribute[0].'">'.$model->{$attribute[0]}.'</td>';
			}
			$string .= '</tr>';
		}

		$string .= '</table>';
		$string .= '<input type="submit">';
		$string .= '</form>';
		return $string;

	}


}
###
?>