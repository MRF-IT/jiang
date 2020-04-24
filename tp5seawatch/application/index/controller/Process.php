<?php
$text = "The data that you submit:";
$text .= "<br>Username: " . $_POST['username'];
$text .= "<br>Password: " . $_POST['password'];
$text .= "<br>Gender: " . $_POST['gender'];
$text .= "<br>Interest:";
for($i=0; $i<count($_POST["interest"]); $i++) {
	$text .= " " . $_POST["interest"][$i];
}
echo $text;
?>