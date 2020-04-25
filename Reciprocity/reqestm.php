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
    $userid=$_SESSION['id'];
  	$query="SELECT * FROM friend_requests WHERE sent_to_id=$userid";
  }
  $result=mysqli_query($link,$query);
  $row=mysqli_fetch_array($result);

?>
<!DOCTYPE html>
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

  <!-- =======================================================
    Theme Name: TheEvent
    Theme URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->

  <style>
 
#body
{
 margin-top:100px;
}
#body table
{
 margin:0 auto;
 position:relative;
 bottom:50px;
}
table td,th
{
 padding:20px;
 border: solid #9fa8b0 1px;
 border-collapse:collapse;
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
          <li><a href="#">Request Table</a></li>
          <li><a href="#schedule">Catalog</a></li>
          <li><a href="#myprofile">My Profile</a></li>
          <li><a href="#">Change Password</a></li>
          <li class="buy-tickets"><a href="logoutClicked.php">Log Out</a></li>
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
    Request tabel
  ============================-->
  <section>

  <div id="body">
  <form method="post" action="">
 <table width="80%">
    <tr>
    <th colspan="6"><h2>Request For Your Materials </h2></th>
    </tr>
    <tr>
    <td>ID</td>
    <td>Material ID</td>
    <td>Borrower ID</td>
    <td>Actions</td>
    <!-- <td>View/Download</td>
    <td>delete</td>
     -->
    </tr>
    <?php
//  $sql="DELETE * FROM tbl_uploads";
//  $sql="DELETE FROM tbl_uploads";

    $userid=$_SESSION['id'];
                  $query="SELECT id,bookid,sent_to_id,sent_from_id FROM friend_requests WHERE sent_to_id=$userid";
                  $result=mysqli_query($link,$query);
                     while($row1=mysqli_fetch_array($result))
                  {
                    
                    $query1="SELECT title FROM books WHERE bookid=".$row1['bookid']."";
                  $result1=mysqli_query($link,$query1);
                  while($row2=mysqli_fetch_array($result1))
                  {

                    $query2="SELECT name FROM users WHERE uid=".$row1['sent_from_id']."";
                    $result2=mysqli_query($link,$query2);
                    while($row3=mysqli_fetch_array($result2))
                    {
                  ?>
                          <tr>
                          <td><?php echo ($row1['id']) ?></td>
                          <td><?php echo ($row2['title']) ?></td>
                          <td><?php echo ($row3['name']) ?></td>
                          <td>
                          <button type="submit"   id="a1" name="allow">Allow</button>
                        <button type="submit"  id="a2" name="deny">Deny</button>
                        <?php
                          {
                            if(isset($_POST['allow']))
                            {
                             // Console.log("Allow");
                            
                              $uid=$_SESSION['id'];
                              $fid=$row1['sent_from_id'];
                              $quert="INSERT INTO friends (`user_id`, `friend_id`) VALUES ('$uid','$fid')";
                              //mysqli_fetch_array($result);
                              mysqli_query($link,$quert);
                            $quer="DELETE FROM `friend_requests` WHERE (sent_from_id='$fid')";
                            mysqli_query($link,$quer);
                            }
                            else
                            {

                             // echo "error";
                            }
                          }
                          {
                            if(isset($_POST['deny']))
                            {
                              //console.log("deny");
                              $uid=$_SESSION['id'];
                              $fid=$row1['sent_from_id'];
                            $quer="DELETE FROM `friend_requests` WHERE (sent_from_id='$fid' and sent_to_id='$uid')";
                            mysqli_query($link,$quer);
                            
                          }
                          else
                          {
                            //echo "error";
                          }
                        }
                        }
                    }
                }
            ?> 
            </td>
                      </tr>
    </table>
    </form>
</div>
  </section>
  <!--==========================
    catalog
  ============================-->

        <br>
        <br>
        <br>
        <br>

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
