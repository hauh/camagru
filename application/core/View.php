<?php

class View
{
	function generate($content_view, $template_view, $data = null)
	{
		/*
		if(is_array($data)) {
			// преобразуем элементы массива в переменные
			extract($data);
		}
		*/
		
		include 'application/'.$template_view;
	}

	function alert($message) {
		echo "<script type='text/javascript'>alert('$message')</script>";
	}
}

?>
