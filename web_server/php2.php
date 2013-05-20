<?php


$user_name = "root";
$password = "honeybee";
$database = 'MySwitches';
$databaseTable = 'SwitchTable';
$server = "192.168.1.10";

$db_handle=mysql_connect($server,$user_name,$password)
  or die("Unable to connect to MySQL");
	
$db_found=mysql_select_db($database);
if ($db_found)
{

	$gotName  = mysql_real_escape_string($_POST['name']);
	$gotState = mysql_real_escape_string($_POST['state']);
	if ($gotState == NULL)
		echo  "Please enter a Device State";
	else
	{
		$state = mysql_query("SELECT DeviceState FROM $databaseTable where DeviceName = '".$gotName."'");
		$state_num_rows = mysql_num_rows($state);
		if ($state_num_rows == 0)
		{
			echo "Device not found";
		}
		else
		{
			$state = mysql_result($state,0);
			if ($state == $gotState)
				echo "Device $gotName State is already $state";
			else
			{
			mysql_query("UPDATE $databaseTable SET DeviceState = '".$gotState."' WHERE DeviceName = '".$gotName."'");
				if ($gotName == 'SARSWITCH')
				{
					if ($gotState == 'OFF')
					{
						shell_exec('sudo -u root -S ./sar_switch_off');
					}
					else
					{
						shell_exec('sudo -u root -S ./sar_switch_on');	
					}
				}
				else if ($gotName == 'NIKHILSWITCH2')
				{
					shell_exec('sudo -u root -S ./nikhil_switch_2');
				}
				else if ($gotName == 'NIKHILSWITCH3')
				{
					shell_exec('sudo -u root -S ./nikhil_switch_3');
				}
				echo "Device $gotName state switched to $gotState";
			}
		}
	}
}	
else
{
	echo "Database not found";
}
?>
