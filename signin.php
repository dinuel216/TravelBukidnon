<?php

// Your database connection
$db = mysqli_connect('localhost:3306', 'root', '', 'travel');

// Your secret key
$secret_key = '6LcSt_ApAAAAAKHGSJAg7xY9vCsusQetNA-5sLnQ';

if (isset($_POST['submit'])) {
    // Verify CAPTCHA
    $captcha_response = $_POST['g-recaptcha-response'];
    $verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$captcha_response");
    $response_data = json_decode($verify_response);

    if (!$response_data->success) {
        echo '<script>alert("Captcha verification failed. Please try again."); history.back();</script>';
        exit;
    }

    $username = $_POST["user"];
    $password = $_POST["pass"];
    $d = date("Y-m-d h:i:sa");
    $i = 0;
    $usern = "";
    $passd = "";

$que="INSERT INTO `login` (`user`,`pass`,`date_time`) VALUES ('$username','$password','$d')";

$sql="SELECT fname, password FROM `customer` WHERE fname='$username' and password='$password'";
$result2 = mysqli_query($db, $sql);

if(isset($_POST['submit'])){
	if($username == 'admin' and $password == 'ad123'){
		$result = mysqli_query($db, $que);
		header('location:admin.php');
	}
	elseif($result2) {
		while($rows = mysqli_fetch_assoc($result2) and $i==0)
		{

			$usern = $rows['fname'];
			$passd = $rows['password'];
			$i= $i+1;
		}
		if ($usern==$username and $passd==$password) {
			$result = mysqli_query($db, $que);
			header("location:mainPage.html");
		}
		else{
			?>
			<script>
				alert("Invalid username or password");
			</script>
			<?php
		}
	}
}
}

?>
