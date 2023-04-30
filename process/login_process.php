<?php

include_once('../custom/globals-without-login.php');


	if ($_POST['mode'] == 'login')
	{
		$_SESSION['login_error'] = "";

		$temp_array = array();
		try 
  		{
			$query = 	"SELECT 
							users.*
					 	FROM 
							users
					 	WHERE 
						 	(
						 		MD5(users_email) = :users_email 
						 		OR
						 		MD5(users_username) = :users_username
						 	)
						 	AND
						 	MD5(users_password) = :users_password";
			$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$temp_array = array();

			if($sth->execute(
				array(
					':users_email' => md5($_POST['email']),
					':users_username' => md5($_POST['email']),
					':users_password' => md5(base64_encode($_POST['password']))
				)
			))
			{
				if($row = $sth->fetch(PDO::FETCH_ASSOC))
				{
					$row['users_note'] = str_replace(array('\r', '\n'), array(chr(13), chr(10)), $row['users_note']);
					foreach ($row as $key => $value) 
					{
						$row[$key] =  stripslashes($value);
					}
					foreach ($row as $key => $value) 
					{
						$row[$key] = strip_tags($value, '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>');
					}
					$temp_array = $row;


					$_SESSION['user'] = $temp_array;
					$_SESSION['login_error'] = "";

					$newURL = HTTP_SERVER."index.php";
					header('Location: '.$newURL);
				}
				else
				{
					$_SESSION['login_error'] = "User with provided details were not found";
					$newURL = HTTP_SERVER."index.php";
					header('Location: '.$newURL);
				}

			}
		}
		catch(PDOException $e)
		{
			echo "Error: " . __LINE__. $e->getMessage();
		}
	}

?>