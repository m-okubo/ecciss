<?php
namespace ecciss;

class Renderer
{
	public function render($model, $view)
	{
		require_once($view);
	}
}