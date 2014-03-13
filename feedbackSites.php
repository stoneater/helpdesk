<?php
include_once 'header.php';

if ($_POST['building']){ $building = $_POST['building'];}
if ($_POST['name']){ $name = $_POST['name'];}
if ($_POST['email']){ $email = $_POST['email'];}
if ($_POST['feedback']){ $feedback = $_POST['feedback'];}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

require_once("common/class.phpmailer.php");
	$mail = new phpmailer();

	$mail->IsSMTP();
	$mail->Host = $smtp_server;
	$mail->AddAddress("" . $email ."", "" . $from . "");
	$mail->AddAddress("" . $admin_email . "", "Administrator");

		//Configure email...
		$mail->From = $email;
		$mail->FromName = $from;
		if ($priority == 1)
		{
			$mail->Priority = 1;
			$mail->AddAddress("fletcher@smithville.k12.mo.us", "Richard Fletcher");
		}
		$mail->Subject = "District Splash Page - Feedback";
		$mail->Body = "Name: " . $name . "\r\n";
		$mail->Body .= "Building: " . $building . "\r\n";
		$mail->Body .= "Email: " . $email . "\r\n";
		$mail->Body .= "Comments: " . $feedback . "\r\n";
		
	if(!$mail->Send())
	{
    	$error_message .= "<li>".$mail->ErrorInfo;
	}
?>
<div data-role="dialog">
	<div data-role="header" data-theme="a">
			<h1>Thanks!!</h1>
	</div><!-- /header -->	
	<div data-role="content">
		<p>Thank you for your comments!  We'll be in touch soon!</p>
	</div>
</div>

<?php
} else {
?>
<div data-role="dialog">
	<div data-role="header" data-theme="a">
			<h1>Send Feedback</h1>
	</div><!-- /header -->	
	<div data-role="content" class="mybg">
	<label for="basic"><b>We value your comments!!</b></label><br />
	<label for="basic">Please submit any comments, suggestions, or ideas for new features that you would find useful, innovative, or intuitive on the district homepage!!  We will be back in touch soon!  Thanks!</label>
	<br />
	<br />
	<form action="feedbackSites.php" method="post">
		<label for="basic"><b>Building:</b></label>
			<select name="building" onChange="sendForm()">
				<option value="">Select Building</option>
				<option value="High">High</option>
				<option value="Middle">Middle</option>
				<option value="Upper">Upper</option>
				<option value="Primary">Primary</option>	
				<option value="Central">Central</option>
			</select>
		<label for="basic"><b>Your Name:</b></label>
			<input type="text" name="name" value="" data-mini="true" maxlength="255" />
		<label for="basic"><b>Email:</b></label>
			<input type="text" name="email" value="" data-mini="true" maxlength="255" />
		<label for="basic"><b>Feedback:</b></label>
			<textarea name="feedback"></textarea>
		<input type="button" value="Back" class="button" title="Go back" onClick="history.go(-1)" data-inline="true">
		<input type="submit" name="Submit" value="Submit" class="button" title="Submit Feedback" data-inline="true" data-theme="d">		
	</form>
	</div> <!-- content -->
</div><!-- dialog -->
<?php
}
include_once 'footer.php';
include_once 'common/end.inc.php';
?>
