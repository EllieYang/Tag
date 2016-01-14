
<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "tagImages";
    $iniNumber=1;
    $imageArray=array();
    $imagesIds=[];
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $retrieveImages = "SELECT * from images";
    $result = $conn->query($retrieveImages);

    if ($result->num_rows > 0) {
        $num_rows = $result->num_rows;
        for($i=0;$i<$num_rows;$i++){
            $row = $result->fetch_assoc();
            $imagesIds[$i] = $row["id"];
            $imageArray[$row["id"]] = $row["name"];
        }
        shuffle($imagesIds);
//        for($i=0;$i<count($imagesIds);$i++){
//            $id = $imagesIds[$i];
//            //echo $imageArray[$id];
//        }
    } else {
        echo "0 results";
    }
    
    
    $tagContent = $_POST["tag"];
    $image = $_POST["image"];
    $sql = "INSERT INTO tags (tag, image) VALUES ('$tagContent', '$image')";
    
    if($tagContent){
        if (mysqli_query($conn, $sql)) {
            //console.log("New record created successfully");
        } else {
            //console.log("Error: " . $sql . "<br>" . mysqli_error($conn));
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tag It!</title>
    <meta name="description" content="">
    <meta name="author" content="">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

</head>
<body>
    <!--Database Connection-->
   
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">TagIt!</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="gallery.php">Gallery</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="jumbotron" style="background:transparent"><div class="container"></div></div>
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
    <form class="form-inline" action="" method="post">
        <div class="col-md-6 formCustomize">
          <h2>Tag it!</h2>
          <p>Enter the first word or phrase that comes to mind when seeing the image on this page. </p>
          
              <div class="form-group">
                <label class="sr-only" for="tagInput">Tag here</label> 
                <input type="text" class="form-control" id="tagInput" placeholder="Tag" name="tag" required>
              </div>
              <input type="submit" class="btn btn-default"/>
            
        </div>
        <div class="col-md-6">
          <img src="resources/all/<?php $id = $imagesIds[0]; echo $imageArray[$id]; ?>" class="img-responsive" alt="Responsive image">
            <input type="text" name="image" value="<?php echo $imageArray[$imagesIds[0]] ?>" style="display:none"/>
       </div>
    </form>
      </div>
        </div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
