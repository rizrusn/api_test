<?php
//include "connect.php";

	$verb = $_SERVER['REQUEST_METHOD'];

	if ($verb == 'GET'){
		getAll();
	}elseif ($verb == 'POST') {
		create();
	}elseif ($verb == 'DELETE'){

	}elseif ($verb == 'PUT'){

	}

	function create(){
		$conn = mysqli_connect("localhost","root","","api_test") or die("koneksi gagal");

		$vname = $_POST['name'];
		$vgender = $_POST['gender'];

		$status = mysqli_query($conn,"INSERT INTO clients (name,gender) VALUES ('$vname', '$vgender')")
			or die("Error: ".mysqli_error($conn));

		$id = mysqli_insert_id($conn);
		$array = array('id'=>$id);
	    
	    $json = json_encode($array);
	    return $json;

	    mysqli_close($conn);
	}

	function getAll(){
		$conn = mysqli_connect("localhost","root","","api_test") or die("koneksi gagal");
		$data = mysqli_query($conn,"select * from clients")
			or die("Error: ".mysqli_error($conn));

		$clients = array();
		while ($client = mysqli_fetch_array($data)) {
			$clients[] = $client;
		}
		$clients = json_encode($clients);
		echo $clients;

		mysqli_close($conn);
	}
	

?>