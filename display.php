<?php
$target_dir= $_POST["dirname"];
$target_file = $target_dir .basename($_FILES['fileToUpload']['name']);
$uploadOk = 1; 
if($_SERVER["REQUEST_METHOD"] == "POST") 
{                           
    if(!empty($_POST['dirname'] )){                           // To check whether directory exist or not 
        if(!is_dir($_POST["dirname"])){
            mkdir($_POST["dirname"]);	 
			$uploadOk = 1;
        }
    }
    else { 
        echo "Specify the directory name..."; 
        $uploadOk = 0; 
        exit;	 
    } 
     if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0)   // Check if file was uploaded without errors 
     {     
        $allowed_ext = array("jpg" => "image/jpg", 
        "jpeg" => "image/jpeg", 
        "gif" => "image/gif", 
        "png" => "image/png");
        $file_name = $_FILES["fileToUpload"]["name"]; 
		$file_type = $_FILES["fileToUpload"]["type"]; 
		$file_size = $_FILES["fileToUpload"]["size"]; 

        $ext = pathinfo($file_name, PATHINFO_EXTENSION);   		// Verify file extension 


		if (!array_key_exists($ext, $allowed_ext)) { 
			die("Error: Please select a valid file format.");
        }  
        $maxsize = 2 * 1024 * 1024;        // Verify file size - 2MB max 
		
		if ($file_size > $maxsize) { 
			die("Error: File size is larger than the allowed limit."); 
		}
                                                       
		if (in_array($file_type, $allowed_ext))       // Verify MYME type of the file 
			
			if (file_exists("upload/" . $_FILES["fileToUpload"]["name"]))  // Check whether file exists before uploading it 
            { 
				echo $_FILES["fileToUpload"]["name"]." is already exists."; 
			}		 
			else { 
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], 
				$target_file)) { 
					echo "The file ". $_FILES["fileToUpload"]["name"]. 
					" has been uploaded."; 
				} 
				else { 
					echo "Sorry, there was an error uploading your file."; 
				} 
			} 
		} 	
                                              
}
?>