<?php
/******************************************************************************
 *                                                                            *
 *    This file is part of RPB Chessboard, a Wordpress plugin.                *
 *    Copyright (C) 2013-2014  Yoann Le Montagner <yo35 -at- melix.net>       *
 *                                                                            *
 *    This program is free software: you can redistribute it and/or modify    *
 *    it under the terms of the GNU General Public License as published by    *
 *    the Free Software Foundation, either version 3 of the License, or       *
 *    (at your option) any later version.                                     *
 *                                                                            *
 *    This program is distributed in the hope that it will be useful,         *
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of          *
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the           *
 *    GNU General Public License for more details.                            *
 *                                                                            *
 *    You should have received a copy of the GNU General Public License       *
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.   *
 *                                                                            *
 ******************************************************************************/


/**
 * Helper functions for dynamic class loading.
 */
abstract class RPBChessboardHelperLoader
{
	/**
	 * Load the model corresponding to the given model name.
	 *
	 * @param string $modelName Name of the model.
	 * @param mixed ... Arguments to pass to the model (optional).
	 * @return object New instance of the model.
	 */
	public static function loadModel($modelName)
	{
		$fileName  = strtolower($modelName);
		$className = 'RPBChessboardModel' . $modelName;
		require_once(RPBCHESSBOARD_ABSPATH . 'models/' . $fileName . '.php');
		$clazz = new ReflectionClass($className);
		return $clazz->newInstanceArgs(array_slice(func_get_args(), 1));
	}


	/**
	 * Load the trait corresponding to the given trait name.
	 *
	 * @param string $traitName Name of the trait.
	 * @param mixed ... Arguments to pass to the trait (optional).
	 * @return object New instance of the trait.
	 */
	public static function loadTrait($traitName)
	{
		$fileName  = strtolower($traitName);
		$className = 'RPBChessboardTrait' . $traitName;
		require_once(RPBCHESSBOARD_ABSPATH . 'models/traits/' . $fileName . '.php');
		$clazz = new ReflectionClass($className);
		return $clazz->newInstanceArgs(array_slice(func_get_args(), 1));
	}


	/**
	 * Load the view whose name is returned by `$model->getViewName()`.
	 *
	 * @param object $model
	 * @return object New instance of the view.
	 */
	public static function loadView($model)
	{
		$viewName  = $model->getViewName();
		$fileName  = strtolower($viewName);
		$className = 'RPBChessboardView' . $viewName;
		require_once(RPBCHESSBOARD_ABSPATH . 'views/' . $fileName . '.php');
		return new $className($model);
	}
}
