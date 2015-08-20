<?php 
	include 'db.php';
	require 'vendor/autoload.php'; 


	$app = new \Slim\Slim();

	$app->get('/hello/:name', function ($name) {
	    echo "Hello, $name";
	});

	$app->post("/insertUser", function() use ($app) {
        $request = Slim\Slim::getInstance()->request();
        $data = $request->params();
		insertUser($data);
		$response['status'] = "success";
		$response['message'] = "Record Inserted Successfully";
		echo json_encode($response);
    });


	function insertUser($data) {
		$name = $data['name'];
		$mobile = $data['mobile'];
		$email = $data['email'];
		$message = $data['message'];
		$sql = "INSERT INTO user (name, mobile, email, message) VALUES ('$name','$mobile','$email','$message')";
		try {
			$db = getDB();
			$stmt = $db->prepare($sql);  
			$stmt->bindParam("name", $name);
			$stmt->bindParam("mobile", $mobile);
			$stmt->bindParam("email", $email);
			$stmt->bindParam("message", $message);
			$stmt->execute();
			$db = null;
		} catch(PDOException $e) {
			//error_log($e->getMessage(), 3, '/var/tmp/php.log');
			echo '{"error":{"text":'. $e->getMessage() .'}}'; 
		}
	}


	$app->run();


	

?>