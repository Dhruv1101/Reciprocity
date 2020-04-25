<?php

  session_start();

  if(!isset($_SESSION['name'])){
    header("Location: login.php");
  }

  $user='root';
  $pass='';
  $db='bookshare';

  $link=mysqli_connect('localhost',$user,$pass,$db);
  $error=null;
  $msg=null;


  if(mysqli_connect_error()){
    $error="There was an error connecting to DB!";
  }else{
    //SUCCESSFULLLY CONNECTED TO DB
    // echo "connected";
    if(array_key_exists("title", $_POST) AND array_key_exists("description", $_POST) AND array_key_exists("course", $_POST) AND array_key_exists("branch", $_POST) AND array_key_exists("sem", $_POST) AND array_key_exists("phone", $_POST)){

      $target="images/".basename($_FILES['image']['name']);//Basename gets the file name any changes made here do it in query too********

      $image=$_FILES['image']['name'];//File name

      $userid=$_SESSION['id'];
      $title=ucwords($_POST['title']);
      $description=ucfirst($_POST['description']);
      $course=$_POST['course'];
      $branch=$_POST['branch'];
      $sem=$_POST['sem'];
      $phone=$_POST['phone'];

      $query="INSERT INTO requestbooks (userid,title,description,course,branch,sem,image,phone) VALUES('$userid','$title','$description','$course','$branch','$sem','$image','$phone')";

      //ADD PICTUREEE!!!!! userid
      // $query="INSERT INTO books (userid,title,description,course,branch,sem,price,image,address,phone) VALUES('".$_SESSION['id']."','".$_POST['title']."','".$_POST['description']."','".$_POST['course']."','".$_POST['course']."','".$_POST['sem']."','".$_POST['price']."','".$image."','".$_POST['address']."','".$_POST['phone']."')";   
        
        
        if(mysqli_query($link,$query) AND move_uploaded_file($_FILES['image']['tmp_name'], $target)){
            $msg="Congratulations! Materials request added succefully.";
            //header("Location: login.php");
          }else{
            $error="Problem adding book. Try again!";
          }
    }

  }



?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Reciprocity</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
	<!-- <link rel="stylesheet" type="text/css" href="additempage.css"> -->
  <!-- Favicons -->
  <link href="img/hader1.jpg" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/venobox/venobox.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
  <style type="text/css">
    #additemform{
	max-width: 700px;
	padding: 40px 20px;
	margin: 10px auto;
	border: 10px solid #343a40;
	border-radius: 30px;
	width: 80%;
}

.btn-danger{
	background: #343a40;
}

.secondNavItems{
	font-weight: bold;
	margin-right: 40px; 
}

.btn-outline-success{
	margin: 0px 10px;
	color: white;
	border: 1px solid white;
}

.custom-select{
	margin-bottom: 20px;
}

.custom-file{
	margin-bottom: 15px;
}

.postBtn{
	display: flex;
  align-items: center;
  justify-content: center;
}
  </style>

</head>
<body>


  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <!-- Uncomment below if you prefer to use a text logo -->
        <!-- <h1><a href="#main">C<span>o</span>nf</a></h1>-->
        <a href="#intro" class="scrollto"><img src="img/logo.jpg" alt="" title=""></a>
        <?php
                if(isset($_SESSION['name']))
                  //MEANS USER IS LOGGED IN
                  $str="Hey, ".ucwords($_SESSION['name'])."";
                  echo "<span style=color:#ffffff;> &nbsp;$str</span>";        
                ?>
      </div>
      <nav id="nav-menu-container">
        <ul class="nav-menu">
           <li class="menu-active"><a href="#intro">Home</a></li>
          <li><a href="#req">Request Form</a></li>
          <li><a href="#schedule">Catalog</a></li>
          <li><a href="#myprofile">My Profile</a></li>
          <li><a href="#">Change Password</a></li>
          <li class="buy-tickets"><a href="logoutClicked.php">Log Out</a></li>
          </a>  
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">
    <img src=img/banner.jpg>
    <div class="intro-container wow fadeIn">
      <h1 class="mb-4 pb-0">The<br><span>Reciprocity</span></h1>
    </div>
  </section>

  <!--==========================
    catalog
  ============================-->

  <section id="req" class="wow fadeInUp">
  <form id="additemform" method="POST" enctype="multipart/form-data" action="requestbook.php">
  <?php 
    if ($msg) {
      echo "<div class=\"alert alert-success\" role=\"alert\">".$msg."</div>";
    }else if($error){
      echo "<div class=\"alert alert-danger\" role=\"alert\">".$error."</div>";
    }
  ?>
  <h3>Request For Get Materials </h3>
	 <div class="form-group">
    	<label for="formGroupExampleInput"><b>Title</b></label>
    	<input type="text" class="form-control" id="formGroupExampleInput" placeholder="Title" name="title" autocomplete="off">
  	</div>

  	<div class="form-group">
    	<label for="exampleFormControlTextarea1"><b>Description</b></label>
    	<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" autocomplete="off"></textarea>
  	</div>
  	<div>
  		<select class="custom-select" name="course">
          <option value="Engineering">Engineering</option>
          <option value="phy">physiyo</option>
          <option value="Management">magagement</option>
          <option value="other">other</option>
		</select>
  	</div>

  	<div>
  		<select class="custom-select" name="branch">
			  <option selected>Branch</option>
			  <option value="IT">IT</option>
			  <option value="Computers">COMPUTERS</option>
			  <option value="Electronics">ELECTRONICS</option>
			  <option value="Extc">EXTC</option>
        <option value="Mechanical">MECHANICAL</option>
        <option value="Civil">CIVIL</option>
        <option value="Instrumentation">INSTRUMENTATION</option>
        <option value="Chemical">CHEMICAL</option>
		</select>
  	</div>

  	<div>
  		<select class="custom-select" name="sem">
		  <option selected>Semester</option>
		  <option value="I">I</option>
		  <option value="II">II</option>
		  <option value="III">III</option>
      <option value="IV">IV</option>
      <option value="V">V</option>
      <option value="VI">VI</option>
      <option value="VII">VII</option>
      <option value="VII">VIII</option>
		</select>
  	</div>

  	<div class="custom-file">
  		<input type="file" class="custom-file-input" id="customFile" name="image">
  		<label class="custom-file-label" for="customFile">Choose an Image</label>
	</div>

  	<div class="form-group">
    	<label for="formGroupExampleInput"><b>Phone (+91)</b></label>
    	<input type="text" class="form-control" id="formGroupExampleInput" placeholder="9029192669" name="phone" autocomplete="off">
  	</div>

  	<div class="postBtn">
   		<button type="submit" class="btn btn-primary btn-lg"><b>POST</b></button> 		
  	</div>

</form>

      </section>

  <!--==========================
    catalog
  ============================-->


  <section id="schedule" class="section-with-bg">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h2>Catalog For Borrow and Request Materials</h2>
          <p>Choose Matarials what ever you like</p>
        </div>

        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link" href="productpage.php" >Borrow Physical Matarial</a>
          </li>
          <br><br><br>
          <li class="nav-item">
            <a class="nav-link" href="productpagepdf.php" >E-Book</a>
          </li>
          <br><br><br>
          <li class="nav-item">
            <a class="nav-link" href="#" >E-Papper</a>
          </li>
          <br><br><br>
          <li class="nav-item">
            <a class="nav-link" href="requestbook.php" >Request for Material</a>
          </li>
        </ul>

        <div class="tab-content row justify-content-center">
        </div>

</div>

</section>

            <!--==========================
    Request for book
  ============================-->
      <section id="schedule" class="section-with-bg">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h2>Donate for materials</h2>
          <p>Choose  </p>
        </div>

        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link" href="additem.php" >Donate Physical Material</a>
          </li>
          <br><br><br>
          <li class="nav-item">
            <a class="nav-link" href="#" >Share E-Book</a>
          </li>
          <br><br><br>
          <li class="nav-item">
            <a class="nav-link" href="#" >Share E-Papper</a>
          </li>
        
        </ul>

        <div class="tab-content row justify-content-center">
        </div>

</div>

</section>
 <!--==========================
    MyProfile
  ============================-->
  <section id="myprofile" class="section-with-bg">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h2>My Profile</h2>
        </div>

        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link" href="#" >Chat</a>
          </li>
          <br><br><br>
          <li class="nav-item">
            <a class="nav-link" href="#" >Edit Profile</a>
          </li>
          <br><br><br>
          <li class="nav-item">
            <a class="nav-link" href="reqestm.php" >Request For My Materials</a>
          </li>
          <br><br><br>
          <li class="nav-item">
            <a class="nav-link" href="#" >Remove my Added Materials</a>
          </li>
        
        </ul>

        <div class="tab-content row justify-content-center">
        </div>

</div>

</section>

   <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <img src="img/logo.jpg" alt="TheEvenet">
           <!-- <p>In alias aperiam. Placeat tempore facere. Officiis voluptate ipsam vel eveniet est dolor et totam porro. Perspiciatis ad omnis fugit molestiae recusandae possimus. Aut consectetur id quis. In inventore consequatur ad voluptate cupiditate debitis accusamus repellat cumque.</p>
          --></div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="#intro">Home</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#gallery">Gallery</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">New User</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#venue">Our University</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#speakers">About Us</a></li>
            </ul>
          </div>
<!--
          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="#">Home</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">About us</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>-->

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              P P Savani University, NH 8, GETCO, Near Biltech Company<br> Kosamba, Dhamdod<br> Gujarat 394125<br>
              <strong>Phone:</strong> <a href="tel:+917567511101">+91 7567511101</a><br>
              <strong>Email:</strong> <a herf="mailto=brain.teasers@outlook.com">brain.teasers@outlook.com</a><br>
            </p>

            <div class="social-links">
              <a href="https://twitter.com/PPSavaniUni" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="https://www.facebook.com/ppsuni/" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="https://www.instagram.com/ppsavaniuniversity/" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="https://www.linkedin.com/school/p-p-savani-university/" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <!--<div class="copyright">
        &copy; Copyright <strong>TheEvent</strong>. All Rights Reserved
      </div>
      <div class="credits">
        
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=TheEvent
        
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>-->
      <div class="copyright">
        &copy; Copyright <strong><span>BrainTeasers</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="#">BrainTeasers Team </a> ~ <a href="https://www.instagram.com/_._._dhruv_._._">Dhruv Gandhi </a> , <a href="https://www.instagram.com/dhruv_surani_16/">Dhruv Surani</a> , <a href="https://www.instagram.com/mj_6078/">Mohil Jariwala</a> , <a href="https://www.instagram.com/jay__roy/">Jay Roy</a> , <a href="#">Krunal Kakadiya</a> , <a href="https://www.instagram.com/golu_1912/">Isha Golakiya</a> , <a href="https://www.instagram.com/disha_vitthani_07/">Disha Vitthani</a> , <a href="https://www.instagram.com/h_patel_2616/">Hardi Sakhia</a>
      </div>
    </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/venobox/venobox.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>

  <script type="text/javascript" src="bootstrap/jquery-3.3.1.slim.min.js"></script>
<script type="text/javascript" src="bootstrap/popper.min.js"></script>
<script type="text/javascript" src="bootstrap/bootstrap.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>
</body>

</html>
