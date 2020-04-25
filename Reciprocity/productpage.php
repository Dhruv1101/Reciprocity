<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Reciprocity</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <link href="img/hader1.jpg" rel="icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/venobox/venobox.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  
  <style type="text/css">
    .card{
	margin: 10px;
	margin-top: 15px;
}

.btn-outline-success{
	color: white;
	margin-right: 15px;
	font-weight: bold;
}

.btn-danger{
	color: white;
	background: #343a40;
}

.secondNavItems{
	font-weight: bold;
	margin-right: 40px; 
}

#ourproducts{
	text-align: center;
	margin: 5px;
	margin-top: 10px;
	text-decoration: underline;
}
  </style>
  
</head>

<body>
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="#intro" class="scrollto"><img src="img/logo.jpg" alt="" title=""></a>
        
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
           <li class="menu-active"><a href="#intro">Home</a></li>
          <li><a href="#pro">Products</a></li>
          <li><a href="#schedule">Catalog</a></li>
          <li><a href="#myprofile">My Profile</a></li>
          <li class="buy-tickets"><a href="logoutClicked.php">Log Out</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section id="intro">
    <img src=img/banner.jpg>
    <div class="intro-container wow fadeIn">
      <h1 class="mb-4 pb-0">The<br><span>Reciprocity</span></h1>
    </div>
  </section>
  <section id=pro>
  <h3 id="ourproducts">PRODUCTS</h3>

<div class="container">
  <div class="row">

    <?php

      $user='root';
      $pass='';
      $db='bookshare';

      $link=mysqli_connect('localhost',$user,$pass,$db);

      if(mysqli_connect_error()){
        echo "There was an error connecting to DB!";
      }else{
      //connected to db successfully

        if(isset($_GET['branch'])){
          // echo $_GET['branch'];
          $query="SELECT * FROM books WHERE branch='".$_GET['branch']."' ORDER BY bookid DESC";
        }else{
          $query="SELECT * FROM books ORDER BY bookid DESC";
        }

        $result=mysqli_query($link,$query);

        while ($row=mysqli_fetch_array($result)) {

          $bookid=$row['bookid'];
         
          echo "
          <div class=\"col-lg-3 col-md-4 col-sm-6\">
            <div class=\"card\">
              <img class=\"card-img-top\" src='images/".$row['image']."' alt=\"Card image cap\">
              <div class=\"card-body\">
                <h5 class=\"card-title\">".$row['title']."</h5>
                <p class=\"card-text\">".$row['description']."</p>
                <a href=\"showitem.php?bookid=$bookid\" class=\"btn btn-primary btn-lg btn-block\">Show Materials</a>
              </div>
            </div>
          </div>";

        }
    }

    ?>
    
<!--     <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card">
          <img class="card-img-top" src="assets/LoginRegisterBook.jpeg" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">SEM-4</h5>
            <h6 class="card-title">Rs.500</h6>
            <p class="card-text">PHYSICS CHEM MATH</p>
            <a href="showitem.php?bookid=1&title=automata&price=900" class="btn btn-primary btn-lg btn-block">BUY</a>
          </div>
        </div>
    </div> -->


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
              <li><i class="fa fa-angle-right"></i> <a href="#pro">PRODUCTS</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#schedule">Cata Log</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#myprofile">My Profile</a></li>
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
