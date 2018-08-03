<?php

   $config = parse_ini_file('config.ini');
   session_start();

   if(isset($_SESSION['user']))
   {
      if($_POST['process'] == "enroll")
      {
        $queryUrl = $config['API_URL'] . "/enroll";
        $request = curl_init($queryUrl);

        curl_setopt($request, CURLOPT_POST, true);
        curl_setopt($request,CURLOPT_POSTFIELDS, $_POST["imgObj"]);
        curl_setopt($request, CURLOPT_HTTPHEADER, array(
                "Content-type: application/json",
                "app_id:" . $config['APP_ID'],
                "app_key:" . $config['APP_KEY']
            )
        );

        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($request);
        echo $response;

        // close the session
        curl_close($request);
      }

       $_POST = json_decode(file_get_contents('php://input'), true);
       if ($_POST['process'] == "recognize") {
        	$queryUrl = $config['API_URL'] . "/recognize";
        	$request = curl_init($queryUrl);
        	// set curl options
        	curl_setopt($request, CURLOPT_POST, true);
        	curl_setopt($request,CURLOPT_POSTFIELDS, $_POST["imgObj"]);
        	curl_setopt($request, CURLOPT_HTTPHEADER, array(
        	        "Content-type: application/json",
        	        "app_id:" . $config['APP_ID'],
        	        "app_key:" . $config['APP_KEY']
        	    )
        	);
        	curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        	$response = curl_exec($request);
        	echo $response;

        	// close the session
        	curl_close($request);

        }

    }
