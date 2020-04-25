<?php
$servername='localhost';
$user='root';
$pass='';
$db='bookshare';

$link = mysqli_connect($servername,$user,$pass,$db);

if(!$link){
  echo "Database not selected".mysqli_connect_error($link);
}
if(isset($_POST['post']))
{    

 $filename = $_FILES['pdf']['name'];
 $file = $_FILES['pdf']['tmp_name'];
 $name=ucwords($_POST['name']);
 $branch=$_POST['branch'];
 $sem=$_POST['sem'];
 $year=$_POST['year'];
 $exam=$_POST['exam'];

 //  create a pdf folder to upload the data 
 $folder="papers/".$filename;
 $uploadOk = 1; 

 
 $filename = strtolower($filename);
 $exam = strtolower($exam);
 if(move_uploaded_file($file,$folder))
 {
  $sql="INSERT INTO papers (name,branch,sem,year,exam,pdf) VALUES('$name','$branch','$sem','$year','$exam','$filename')";
  mysqli_query($link,$sql);
  $msg="Congratulations! Materials added succefully.";
 //echo "file is successfully uploaded in paper folder. ";
  //sheader("Location: paper.php");
 }
 else{
    echo "file is not uploaded  ";
 }

}
 ?>