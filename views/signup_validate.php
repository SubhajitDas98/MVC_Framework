<?php
    //session_start();
    require_once '../core/DB.php';
    $nameErr = $emailErr = $genderErr = $pwdErr = "";
    $name = $email = $gender = $userpassword = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {	
        $_SESSION["name"] = $name = test_input($_POST["name"]);
        $_SESSION["email"] = $email = test_input($_POST["email"]);
        $_SESSION["password"] = $userpassword = test_input($_POST["password"]);
        $_SESSION["dob"] = $dob = test_input($_POST["dob"]);
        $_SESSION["gender"] = $gender = test_input($_POST["gender"]);
    
        if (empty($name)) {
            $nameErr = "Name is required";
        }
        elseif(strlen($name)<3)
        {
            $nameErr = "Username must have atleast 3 letters!";
        }
        else
        {
            $nameErr = "";
        }

        if (empty($email)) {
         $emailErr = "Email is required";
        }
        else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format"; 
            }
        }
            
        if (strlen($userpassword) <= 8) {
            $pwdErr = "Your Password Must Contain At Least 8 Characters, 1 capital Letter and 1 number !";
        }
        elseif(!preg_match("#[0-9]+#",$userpassword)) {
            $pwdErr = "Your Password Must Contain At Least 8 Characters, 1 capital Letter and 1 number !";
        }
        elseif(!preg_match("#[A-Z]+#",$userpassword)) {
            $pwdErr = "Your Password Must Contain At Least 8 Characters, 1 capital Letter and 1 number !";
        }
        elseif(!preg_match("#[a-z]+#",$userpassword)) {
            $pwdErr = "Your Password Must Contain At Least 8 Characters, 1 capital Letter and 1 number !!";
        } else {
            $pwdErr = "";
        }

        if (empty($gender)) {
            $genderErr = "Gender is required";
        }

	    if (!$nameERR && !$genderErr && !$emailErr && !$pwdErr) {
            // $conn = new mysqli($host, $username, $dbpassword, $dbname);
            // if ($conn->connect_error){
            //     die("Connection failed: " . $conn->connect_error);
            // }
            // $check_email_query="SELECT * from users WHERE email=?";
            // $stmt = $conn->prepare($check_email_query); 
            // $stmt->bind_param("s", $email);
            // $stmt->execute();
            // $result = $stmt->get_result();
            // $row = $result->fetch_assoc(); 
            
            $newdb = new DB('localhost','subhajit','nahipata1234#','mvc');
            $selectResult = [];
            $selectResult = $newdb->select(['*'],'users')->where([['email','LIKE',$email]],[])->get();
            // var_dump($selectResult);
            // exit;
            if($selectResult){
                $emailErr="Email already exists. You cannot register with duplicate email.";
            }
            else{
                // $stmt = $conn->prepare("INSERT INTO users (name, email, password, dob, gender) VALUES (?, ?, ?, ?, ?)");
                // $password=password_hash($userpassword,PASSWORD_DEFAULT);
                // $stmt->bind_param("sssss", $name, $email, $password, $dob, $gender);
                $password=password_hash($userpassword,PASSWORD_DEFAULT);
                $insert =$newdb->insert('users',['name','email','password','dob','gender'],[$name, $email, $password, $dob, $gender]);
                // var_dump($insert);
                // exit;
                if($insert){
                    echo "<script> alert('You have successfully Registered'); </script>";
                    //header('Location:signup.php');
                }  
            }
	    }
	}
    //session_destroy();

    function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
?>