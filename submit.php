
<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "tagImages";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
   //$sql = "INSERT INTO tags (tag, image) VALUES ('"+$_POST["tag"]+"', 'image1')";
    $tagContent = $_POST["tag"];
    $sql = "INSERT INTO tags (tag, image) VALUES ('$tagContent', 'image1')";

    if (mysqli_query($conn, $sql)) {
        //console.log("New record created successfully");
    } else {
        //console.log("Error: " . $sql . "<br>" . mysqli_error($conn));
    }
    $conn->close();
    header( "Location:index.php");
?>