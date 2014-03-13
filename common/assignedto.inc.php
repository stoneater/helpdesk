<select name="assignedto">
	<option value="">Unassigned
<?php
	print '<option';
if ($assignedto == $assigned_to1)
	{
		print ' selected';
	}
	print '>' . $assigned_to1 . '</option>';

if (!$assigned_to2 == '')
{
	print '<option';
	if ($assignedto == $assigned_to2)
	{
		print ' selected';
	}
	print '>' . $assigned_to2 . '</option>';
}
if (!$assigned_to3 == '')
{
	print '<option';
	if ($assignedto == $assigned_to3)
	{
		print ' selected';
	}
	print '>' . $assigned_to3 . '</option>';
}
if (!$assigned_to4 == '')
{
	print '<option';
	if ($assignedto == $assigned_to4)
	{
		print ' selected';
	}
	print '>' . $assigned_to4 . '</option>';
}
if (!$assigned_to5 == '')
{
	print '<option';
	if ($assignedto == $assigned_to5)
	{
		print ' selected';
	}
	print '>' . $assigned_to5 . '</option>';
}
if (!$assigned_to6 == '')
{
	print '<option';
	if ($assignedto == $assigned_to6)
	{
		print ' selected';
	}
	print '>' . $assigned_to6 . '</option>';
}
if (!$assigned_to7 == '')
{
	print '<option';
	if ($assignedto == $assigned_to7)
	{
		print ' selected';
	}
	print '>' . $assigned_to7 . '</option>';
}
if (!$assigned_to8 == '')
{
	print '<option';
	if ($assignedto == $assigned_to8)
	{
		print ' selected';
	}
	print '>' . $assigned_to8 . '</option>';
}
if (!$assigned_to9 == '')
{
	print '<option';
	if ($assignedto == $assigned_to9)
	{
		print ' selected';
	}
	print '>' . $assigned_to9 . '</option>';
}
if (!$assigned_to10 == '')
{
	print '<option';
	if ($assignedto == $assigned_to10)
	{
		print ' selected';
	}
	print '>' . $assigned_to10 . '</option>';
}
?>
</select>

