<?php

class View
{
	function generate($content_view, $template_view, $data = [])
	{
		include 'application/'.$template_view;
	}

	function alert($message) {
		echo "<script type='text/javascript'>alert('$message')</script>";
	}

	function redirect($where) {
		echo "<script type='text/javascript'>window.location = '".$where."'</script>";
	}
}

?>
