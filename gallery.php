
<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "tagImages";
    $imageCategories=[];   
    $imageArray=array();
    $imagesIds=[];
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    
    $retrieveCategories = "SELECT * from categories";
    $categoriesResult = $conn->query($retrieveCategories);
   
    if ($categoriesResult->num_rows > 0) {
        
        $numberOfRows = $categoriesResult->num_rows;
        for($i=0; $i<$numberOfRows; $i++){
            $crow = $categoriesResult->fetch_assoc();
            $imageCategories[$i] = $crow["name"];
        }
    }else {
        echo "0 results";
    }

    
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
            <li><a href="index.php">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="active"><a href="gallery.php">Gallery</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="jumbotron" style="background:transparent"><div class="container"></div></div>
    <div class="container">
      <!-- Image Categories -->
        <div>
            <?php 
                for ($category = 0; $category < count($imageCategories); $category++) {
                    $retrieveImages = "SELECT * from images WHERE category='$imageCategories[$category]'";
                     $result = $conn->query($retrieveImages);
                    
                    if ($result->num_rows > 0) {
                        $num_rows = $result->num_rows;
                        $imagesIds=[];
                        $imageArray = array();
                        for($i=0;$i<$num_rows;$i++){
                            $row = $result->fetch_assoc();
                            $imagesIds[$i] = $row["id"];
                            $imageArray[$row["id"]] = $row["name"];
                        }
                        
                    } else {
                        echo "0 results";
                    }
                    $numberOfImages = count($imagesIds);
                    $numberOfRows = round($numberOfImages/3);
                    
            ?>
            <div class="panel panel-info">
                <div class="panel-heading" data-toggle="collapse" data-target="#panel<?php echo $category?>"><?php echo $imageCategories[$category]?></div>
                <div class="panel-body collapse" id="panel<?php echo $category?>">
                    <!--List images-->
                <?php 
                    
                    
                    for ($row = 0; $row < $numberOfRows; $row++){
                 ?> 
                    <div class="row">
                        <!--First column-->
                        <?php
                            if ($row*3<$numberOfImages){
                        ?>
                        <div class="col-md-2">
                            <img src="resources/<?php echo $imageCategories[$category]?>/<?php echo $imageArray[$imagesIds[$row*3]]?>" class="img-responsive" alt="Responsive image">
                        </div>
                        <div class="col-md-2">
                        <?php
                            $imageName = $imageArray[$imagesIds[$x]];
                            $sql = "SELECT tag FROM tags WHERE image = '$imageName'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "#".$row["tag"]." ";
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                        </div>
                        <?php }?>
                        <!--Second column-->
                        <?php
                            if ($row*3+1<$numberOfImages){
                        ?>
                        <div class="col-md-2">
                            <img src="resources/<?php echo $imageCategories[$category]?>/<?php echo $imageArray[$imagesIds[$row*3+1]]?>" class="img-responsive" alt="Responsive image">
                        </div>
                        <div class="col-md-2">
                        <?php
                            $imageName = $imageArray[$imagesIds[$row*3+1]];
                            $sql = "SELECT tag FROM tags WHERE image = '$imageName'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "#".$row["tag"]." ";
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                        </div>
                        <?php }?>
                        <!--Third column-->
                        <?php
                            if ($row*3+2<$numberOfImages){
                        ?>
                        <div class="col-md-2">
                            <img src="resources/<?php echo $imageCategories[$category]?>/<?php echo $imageArray[$imagesIds[$row*3+2]]?>" class="img-responsive" alt="Responsive image">
                        </div>
                        <div class="col-md-2">
                        <?php
                            $imageName = $imageArray[$imagesIds[$row*3+2]];
                            $sql = "SELECT tag FROM tags WHERE image = '$imageName'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "#".$row["tag"]." ";
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                        </div>
                        <?php }?>
                    </div>
                        <hr/>
                <?php }?>
                   
            </div>
            <!--End of panel body-->
        </div>
            <?php 
               }
            ?>
        <!--End of categories-->
        
        
      </div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
<?php
    $conn->close();
?>
