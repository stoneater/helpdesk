<select name="building">
	<option value="">Select a building</option>
	<option<?php if ($building == $building1) print " selected";?>><?php print $building1?></option>
<?php
if (!$building2 == "")
{
	print "<option";
	if ($building == $building2) print " selected";
	print ">$building2</option>\n";
}
if (!$building3 == "")
{
	print "<option";
	if ($building == $building3) print " selected";
	print ">$building3</option>\n";
}
if (!$building4 == "")
{
	print "<option";
	if ($building == $building4) print " selected";
	print ">$building4</option>\n";
}
if (!$building5 == "")
{
	print "<option";
	if ($building == $building5) print " selected";
	print ">$building5</option>\n";
}
if (!$building6 == "")
{
	print "<option";
	if ($building == $building6) print " selected";
	print ">$building6</option>\n";
}
if (!$building7 == "")
{
	print "<option";
	if ($building == $building7) print " selected";
	print ">$building7</option>\n";
}
if (!$building8 == "")
{
	print "<option";
	if ($building == $building8) print " selected";
	print ">$building8</option>\n";
}
if (!$building9 == "")
{
	print "<option";
	if ($building == $building9) print " selected";
	print ">$building9</option>\n";
}
if (!$building10 == "")
{
	print "<option";
	if ($building == $building10) print " selected";
	print ">$building10</option>\n";
}
?>
</select>
