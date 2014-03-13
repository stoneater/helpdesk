<?php
//Function to validate email address...
function validate_email($string)
{
	if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$", $string))
	{
	return true;
	}
}

//Function to make sure problem text are long enough...
function validate_problem($string)
{
	$length = strlen($string);
	if ($length > 15)
	{
	return true;
	}
}
?>