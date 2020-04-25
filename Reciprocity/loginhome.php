<!DOCTYPE html>

<?php
  session_start();
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
		if(array_key_exists("emailid", $_POST)){
      
  
      
			if($_POST['emailid']==""){
				$error="Please enter all the fields!";
			}else{
				//user has entered everthing
				$query="SELECT * FROM sub_email WHERE emailid='".mysqli_real_escape_string($link,$_POST['emailid'])."'";
				$result=mysqli_query($link,$query);//query to select users with the entered email

				if(mysqli_num_rows($result)>0){
					$error="Unfortunately Email is already taken!";//cant keep 2 or more same email ids
				}else{
					//EVERTHNG IS VALID, ADD THE USER INTO THE DATABASE
					$query="INSERT INTO sub_email(emailid) VALUES ('".$_POST['emailid']."')";//*********SQL PROTECTION REQUIRED*******

					if(mysqli_query($link,$query)){
						// echo "<p>YOU HAVE BEEN SIGNED UP</p>";

						header("Location: login.php");
						
					}else{
						$error="There was a problem signing you up!";
          }
        }
      }
			}
    }
    
?>
<html lang="en">

<head>
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
  <style>

.btn-outline-success{
	margin: 0px 10px;
	color: white;
	border: 1px solid white;
}
body {
	font-family: Arial, Helvetica, sans-serif;
  }  

  .navbar {
	overflow: hidden;
	background-color: #333;
  }
  
  .navbar a {
	float: left;
	font-size: 16px;
	color: white;
	text-align: center;
	padding: 10px 12px;
	text-decoration: none;
  }
  
  .dropdown {
	float: left;
	overflow: hidden;
  }
  
  .dropdown .dropbtn {
	font-size: 12px;  
	border: none;
	outline: none;
	color: white;
	padding: 10px 12px;
	background-color: inherit;
	font-family: inherit;
	margin: 0;
  }
  
  .navbar a:hover, .dropdown:hover .dropbtn {
	background-color: red;
  }
  
  .dropdown-content {
	display: none;
	position: absolute;
	background-color: #f9f9f9;
	min-width: 100px;
	box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	z-index: 1;
  }
  
  .dropdown-content a {
	float: none;
	color: black;
	padding: 10px 12px;
	text-decoration: none;
	display: block;
	text-align: left;
  }
  
  .dropdown-content a:hover {
	background-color: #ddd;
  }
  
  .dropdown:hover .dropdown-content {
	display: block;
  }
  
.secondnav{

	margin-top: 56px;
}

.secondNavItems{
	font-weight: bold;
	margin-right: 40px; 
}

.movingImg{
	max-height: 250px;
}

.card{
	margin: 10px;
}

#ourproducts{
	text-align: center;
	margin: 5px;
	margin-top: 10px;
	text-decoration: underline;
}

.navbar-text{
	font-weight: bold;
	margin-right: 15px;
}

.btn-danger{
	background: #343a40;
}

#viewProducts{
	font-weight: bold;
}
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
          <li><a href="#venue">Motive</a></li>
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
      Motive
    ============================-->
    <section id="venue" class="wow fadeInUp">

    <h3 id="ourproducts">PRODUCTS THAT ARE SOLD ON OUR WEBSITE</h3>

<!-- SOME PRODUCTS AT LANDING PAGE -->

<div class="container">
  <div class="row">

    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card">
          <a href="productpage.php">
            <img class="card-img-top" src="img/ip.jpeg" alt="Card image cap">
          </a>
          <div class="card-body">
            <h5 class="card-title">Internet Programming</h5>
            <p class="card-text">IT SEMESTER V </p>
          </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card">
          <a href="productpage.php">
            <img class="card-img-top" src="img/dsa.jpeg" alt="Card image cap">
          </a>
          <div class="card-body">
            <h5 class="card-title">Data Structures</h5>
            <p class="card-text">IT SEMESTER III</p>
          </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card">
          <a href="productpage.php">
            <img class="card-img-top" src="img/mechanics.jpeg" alt="Card image cap">
          </a>
          <div class="card-body">
            <h5 class="card-title">Engineering Mechanics</h5>
            <p class="card-text">FE SEMESTER I</p>
          </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card">
          <a href="productpage.php">
            <img class="card-img-top" src="img/bee.jpeg" alt="Card image cap">
          </a>
          <div class="card-body">
            <h5 class="card-title">Basic Electrical Engineering</h5>
            <p class="card-text">FE SEMESTER I</p>
          </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card">
          <a href="productpage.php">
            <img class="card-img-top" src="img/cloudcomp.jpeg" alt="Card image cap">
          </a>
          <div class="card-body">
            <h5 class="card-title">Cloud Computing</h5>
            <p class="card-text">COMPS SEMESTER VI</p>
          </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card">
          <a href="productpage.php">
            <img class="card-img-top" src="img/automata.png" alt="Card image cap">
          </a>
          <div class="card-body">
            <h5 class="card-title">Automata Theory</h5>
            <p class="card-text">IT SEMESTER IV</p>
          </div>
        </div>
    </div>

    
  </div>
</div>
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
            <a class="nav-link" href="paper.php" >E-Papper</a>
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
    change password
  ============================-->

  <!--==========================
    logout
  ============================-->
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
              <li><i class="fa fa-angle-right"></i> <a href="#venue">Motive</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#schedule">Catalog</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#myprofile">Myprofile</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#speakers">About Us</a></li>
            </ul>
          </div>
          
<!-- 
<ul class="nav-menu">
          <li class="menu-active"><a href="#intro">Home</a></li>
          <li><a href="#venue">Motive</a></li>
          <li><a href="#schedule">Catalog</a></li>
          <li><a href="#myprofile">My Profile</a></li>
          <li><a href="#">Change Password</a></li> -->
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
