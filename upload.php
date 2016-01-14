
<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "tagImages";
    $iniNumber=1;
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if(isset($_POST["submit"])){
        $imageUpload = $_POST["imageUpload"];
        $imageCount = count($_POST["imageUpload"]);
        for ($i=0;$i<$imageCount;$i++){
            $fileName = $_POST["imageUpload"][$i];
            $sql = "INSERT INTO images (name) VALUES ('$fileName')";
            if (mysqli_query($conn, $sql)) {
            } else {
                //console.log("Error: " . $sql . "<br>" . mysqli_error($conn));
            }
        }     
    }
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Upload</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/style.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</head>
<body>
    <script>
        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#selectedFile')
                    .attr('src', e.target.result);
            };
            console.log(input.files[0]);
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div class="container">
    <div class="row">
      <div class="one-half column" style="margin-top: 10%">
        <h4>Upload an image</h4>
          
        <form class="form-inline" action="" method="post">
              <div class="form-group">
                <input type="file" class="form-control" name="imageUpload[]" required onchange="readURL(this);" multiple>
              </div>
              <input type="button" value="cancel"/>&nbsp;<input type="submit" class="btn btn-default" name="submit"/>
        </form>
      </div>
      <div class="one-half column row" style="margin-top: 10%">
        <img id="selectedFile" src="#" alt="your selected image" />
      </div>
    </div>
  </div>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
