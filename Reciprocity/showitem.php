<?php
  session_start();

  if(!isset($_SESSION['name'])){
    //user is no logged in. So redirect to login
    header("Location: login.php");
  }
  

?>

<?php
  $user='root';
  $pass='';
  $db='bookshare';

  $link=mysqli_connect('localhost',$user,$pass,$db);
  $error=null;
  $msg=null;

  if(!isset($_GET['bookid'])){
  	header("Location: productpage.php");
  }

  $bookid=$_GET['bookid'];

  if(mysqli_connect_error()){
    $error="There was an error connecting to DB!";
    
  }else{
    $userid=$_SESSION['id'];
  	$query="SELECT * FROM books WHERE bookid=$bookid";
  }
  $result=mysqli_query($link,$query);
  $row=mysqli_fetch_array($result);

  if(!isset($_GET['addrequest']))
  {
    $uid=$_SESSION['id'];
    $sendid=$row['userid'];
    $bookid=$_GET['bookid'];
    $query="INSERT INTO `friend_requests`( `sent_to_id`, `sent_from_id`, `bookid`) VALUES ($sendid,$uid,$bookid)";
    $result=mysqli_query($link,$query);
  }
  


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
	<!-- <link rel="stylesheet" type="text/css" href="showitem.css"> -->
		<style type="text/css">
				.container2{
	border: 10px solid #343a40;
	margin: 10px auto;
	padding: 20px;
	border-radius: 30px;
}

#titleksm{
	margin-top: 10px;
}

.imgksm{
	border:5px solid #343a40;
	border-radius: 10px;
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

.btn-success{
	background: #09912d;
}

			
		</style>
		<meta charset="utf-8">
  <title>Reciprocity</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

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

  <!-- =======================================================
    Theme Name: TheEvent
    Theme URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->

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
          <li><a href="#detail">Material Details</a></li>
          <li><a href="#schedule">Catalog</a></li>
          <li><a href="#myprofile">My Profile</a></li>
          <li><a href="#">Change Password</a></li>
          <li class="buy-tickets"><a href="logoutClicked.php">Log Out</a></li>
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
	
<section id="detail">
<div class="container2">
	
		<div class="row row-grid">
				<div class="col-lg-6">
						<div class="imgksm">
							
							<?php
									echo "<img class=\"card-img-top img-fluid\" src='images/".$row['image']."' alt=\"Card image cap\" >";
							?>

						</div>
				</div>
				<div class="col-lg-6">

						<div class="pl-lg-5">

								<!-- Product title -->
								<h4 class="h4" id="titleksm">Title : <?php echo ($row['title']) ?> </h4>
								</div>

								<!-- Description -->
								<div class="py-4 my-4 border-top border-bottom">
										<h6 class="text-sm">Description:</h6>
										<p class="text-sm mb-0">
											<?php echo ($row['description']) ?>
										</p>
								</div>

								<dl class="row">
										<dt class="col-sm-3"><span class="h6 text-sm mb-0">Course</span></dt>
										<dd class="col-sm-9"><span class="text-sm"><?php echo ($row['course']) ?></span></dd>

										<dt class="col-sm-3"><span class="h6 text-sm mb-0">Branch</span></dt>
										<dd class="col-sm-9"><span class="text-sm"><?php echo ($row['branch']) ?></span></dd>

										<dt class="col-sm-3"><span class="h6 text-sm mb-0">Semester</span></dt>
										<dd class="col-sm-9"><span class="text-sm"><?php echo ($row['sem']) ?></span></dd>
								</dl>

								<dl class="row">
										<dt class="col-sm-3"><span class="h6 text-sm mb-0">Sold By</span></dt>
                    <dd class="col-sm-9"><span class="text-sm"><?php echo ($row['userid']) ?></span></dd>
										<!-- <dd class="col-sm-9">
											<span class="text-sm">
												<?php 
													$userid=($row['userid']);
													$query1="SELECT * FROM books WHERE id=$userid";
													$result1=mysqli_query($link,$query1);
													$row1=mysqli_fetch_array($result1);
													echo ucwords($row1['name']);
												?>
													
												</span> -->
										</dd>
                    </dl>
                <!-- Add to cart-->
                <a href="showitem.php"> 
                  
                      <button type="button" class="btn btn-dang"  id="addrequest" >Request To Borrow Material</button>
                    </a>


                
                    <a href="showitem.php">
                      <button type="button" class="btn btn-dang">Go Back</button>
                    </a>
												</div>
										</div>
								</div>
						</div>
				</div>
		</div>
</div>
<script type="text/javascript" src="bootstrap/jquery-3.3.1.slim.min.js"></script>
<script type="text/javascript" src="bootstrap/popper.min.js"></script>
<script type="text/javascript" src="bootstrap/bootstrap.js"></script>
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
            <a class="nav-link" href="#" >E-Book</a>
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
    Query
  ============================-->



  <!--==========================
    Request for book
  ============================-->
  <!--==========================
    myprofile
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

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>
</body>

</html>
