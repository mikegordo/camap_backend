<?php

/**
 * Class HomeController
 *
 * @author Mike Gordo <m.gordo@cityads.ru>
 */
class HomeController extends BaseController
{
	public function defaultAction()
	{
		/**
		 * По умолчанию мы отображаем карту
		 * вставляем всех работников в шаблон
		 */
		return View::make('base.default', [
			'employees' => Employee::where('active', true)->get()
		]);
	}

}
