<?php
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  }
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } 
  if ($_FILES["fileToUpload"]["size"] > 200000) {
    echo "Sorry, your file is too large.";
    
  }
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post"   enctype="multipart/form-data" >
        <input type= "file" name = "fileToUpload"  id = "fileToUpload"  >
        <input type="submit" value = "Upload file" name = "submit" >

    </form>
    <?php
if (!empty($target_file) && file_exists($target_file)) {
  echo "<h2>Uploaded Image:</h2>";
  echo "<img src='$target_file' alt='Uploaded Image'>";
}
    ?>
</body>
</html>