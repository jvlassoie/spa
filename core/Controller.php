<?php
/**
* 
*/
class Controller
{



	public function render($template, $tab = [] ) {
		ob_start();
		extract($tab);
		require "../app/view/$template";
		echo ob_get_clean();
		return true;
	}
	
}