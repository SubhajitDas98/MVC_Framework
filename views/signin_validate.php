<?php
	require_once '../core/DB.php';
	session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST")  
	{ 
        $wrong = ""; 
	    $user_email=$_POST['username'];
	    $user_pass=$_POST['password'];  
	  
        // var_dump($_POST['password']);
        // exit;
	    // $check_user="SELECT password from users WHERE email=?";  
	  	// $stmt = $conn->prepare($check_user); 
		// $stmt->bind_param("s", $user_email);
		// $stmt->execute();
		// $result = $stmt->get_result();  
	  	// $row = $result->fetch_assoc();

        $newdb = new DB('localhost','subhajit','nahipata1234#','mvc');
        $selectResult = [];
        $selectResult = $newdb->select(['password'],'users')->where([['email','LIKE',$user_email]],[])->get();
        // var_dump($selectResult);
        // exit;
	    if(password_verify($user_pass,$selectResult["password"]))  
	    {  
            //echo "<script>alert('Welcome')</script>";
            $userDetails = $newdb->select(['*'],'users')->where([['email','LIKE',$user_email]],[])->get();
            // var_dump($userDetails);
            // exit;
	    	$_SESSION['name']=$userDetails['name'];
            $_SESSION['email']=$userDetails['email'];
			$_SESSION['dob']=$userDetails['dob'];
            $_SESSION['gender']=$userDetails['gender'];
            // var_dump($selectResult['name']);
            // exit;
	        header('Location: \home');
	        exit();
	    }  
	    else  
	    {  
	    	$wrong = "Email or Password Incorrect.";  
	    }  
	}  
?>