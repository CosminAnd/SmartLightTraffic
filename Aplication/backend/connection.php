<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Autorization, X-Requested-With');

    // Connect to the database using TCP protocol
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "database";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    //Delete the previous data
    $query = "DELETE FROM `data`";
    mysqli_query($conn, $query);

    // Read the JSON file 
    $json = file_get_contents('data.json');
    
    // Decode the JSON file
    $json_data = json_decode($json,true);


    foreach ($json_data as $data){
        $nume = mysqli_real_escape_string($conn, $data['nume']);
        $data_1 = mysqli_real_escape_string($conn, $data['data']);  
        $query = "INSERT INTO `data` (`nume`, `data`) VALUES ( '".$nume."', '".$data_1."')";
        mysqli_query($conn, $query);
    }


    // Retrieve data from the database
    $sql = "SELECT * FROM data ORDER BY data ASC";
    $result = $conn->query($sql);

    $results = $result->fetch_all();
    $count_1 = 0;
    $count_2 = 0;

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        echo json_encode($results);
    }


    // Close the database connection
    $conn->close();
