<?php
 $servername='localhost';
 $user='root';
 $pass='';
 $db='bookshare';

 $link = mysqli_connect($servername,$user,$pass,$db);
 $error=null;
 $msg=null;
 if(!$link)
 {
   echo "Database not selected".mysqli_connect_error($link);
 }
 else{
  if(array_key_exists("title", $_POST) AND array_key_exists("branch", $_POST) AND array_key_exists("sem", $_POST) AND array_key_exists("year", $_POST) AND array_key_exists("exam", $_POST) AND array_key_exists("pdf", $_POST))
 {
   $target="hacka/".basename($_FILES['pdf']['name']);//Basename gets the file name any changes made here do it in query too********

   $pdf=$_FILES['pdf']['name'];//File name

   $id=$_SESSION['id'];
   $title=$_POST['title'];
   $description =$_POST['description'];
   $branch=$_POST['branch'];
   $sem=$_POST['sem'];
   $pdf=$_POST['pdf'];

   $query="INSERT INTO ebook (id,title,description,branch,sem,pdf) VALUES('$id','$title','$description','$branch','$sem','$pdf')";
  
     if(mysqli_query($link,$query) AND move_uploaded_file($_FILES['pdf']['tmp_name'], $target)){
         $msg="Congratulations! Book added succefully.";
         //header("Location: login.php");
       }else{
         $error="Problem adding book. Try again!";
       }
 }
}

 ?>

<html>
<head>
	<title>Upload E-Book</title>
   <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
   <link rel="stylesheet" type="text/css" href="addpdf.css">
  <style type="text/css">
    <?php 
      include 'addpdf.css';
    ?>
  </style>
  
</head>
<body>

<form id="upload" method="POST" enctype="multipart/form-data" action="eupload.php">	

	<div class="form-group"><input type="text" class="form-control" id="formGroupExampleInput" placeholder="Title " name="title" autocomplete="off" required ></div>
  <div class="form-group"><input type="text" class="form-control" id="formGroupExampleInput" placeholder="description " name="description" autocomplete="off" required ></div>
   
    <div>
    <select class="custom-select" name="branch" require>  
      <option selected>Branch</option>  
      <option value="Computer">Computer </option>  
      <option value="Civil">Civil</option>  
      <option value="Mechanical">Mechanical</option>  
      <option value="Chemical">Chemical</option> 
      <option value="IT">IT</option>   
      <option value="Bsc.IT">Bsc.IT</option>  
   </select>
     </div>
     
     <div>
  		<select class="custom-select" name="sem" require>
		  <option selected>Semester</option>
		  <option value="I">I</option>
		  <option value="II">II</option>
		  <option value="III">III</option>
      <option value="IV">IV</option>
      <option value="V">V</option>
      <option value="VI">VI</option>
      <option value="VII">VII</option>
      <option value="VIII">VIII</option>
		</select>
  	</div>

  	<div class="custom-file">
  		<input type="file" class="custom-file-input" id="pdf" name="pdf" require>
  		<label class="custom-file-label" for="customFile">Choose an PDF</label>
	</div>

  	<div class="postBtn">
   		<br><button type="submit" class="btn btn-primary btn-lg" name="post1"><b>POST</b></button> 		
  	</div>

</form>
	
<script type="text/javascript" src="bootstrap/jquery-3.3.1.slim.min.js"></script>
<script type="text/javascript" src="bootstrap/popper.min.js"></script>
<script type="text/javascript" src="bootstrap/bootstrap.js"></script>
</body>
</html>
