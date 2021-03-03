<?php
session_start();
if (!isset($_SESSION['studentID'])) {
    header("location: ../login.html");
}else{
    require 'dbh.inc.php';
    $marketplaceSQL = "SELECT * FROM marketplace WHERE studentID=".$_SESSION['studentID'].";";
    $resultrsql = mysqli_query($conn, $marketplaceSQL);
    $resultrsqlcheck = mysqli_num_rows($resultrsql);
    if ($resultrsqlcheck > 0) {
        while ($row = mysqli_fetch_assoc($resultrsql)){
            $listingpics .= '
                <div class="mySlides fade">
                    <div class="changecontentcontainer">
                        <div class="changecontent">
                            <img class="slideIMG" src="../studentdata/'.$_SESSION['pathName'].'/marketplace/'.$row['fileName'].'.jpg" alt="'.$row['listingName'].' Artwork">
                        </div>
                        <div class="changecontentmiddle">
                            <div class="changecontenttext" id="changelisting" data-change="change'.$row['listingID'].'">Change Content</div>
                        </div>
                    </div>
                </div>
            ';
            $listingcount = count($row['listingName']);
            for ($i=0; $i < $listingcount; $i++) {
                $temp .= '<span class="dot"></span>';
            }
            $listingdots = '<div class="centeralign">'.$temp.'</div>';
            echo '<div data-listingID="'.$row['listingID'].'"></div>';
            $listingIndex = htmlspecialchars($_GET["listingIndex"]) !== "" ? htmlspecialchars($_GET["listingIndex"]) : $_SESSION['listingID'];
        }
    }
    $sql = "SELECT * FROM payoutRequests t INNER JOIN (SELECT studentID, max(date) AS MaxDate FROM payoutRequests GROUP BY studentID) tm ON t.studentID = tm.studentID AND t.date = tm.MaxDate WHERE t.studentID = ".$_SESSION['studentID'].";";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../studentportal.php?error=sqlerror");
        exit();
    }else{
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $payoutsqlcheck = mysqli_num_rows($result);
        if($payoutsqlcheck == 0){
            $prevpaydate = 0;
            $paid = true;
        }else{
            if ($row = mysqli_fetch_assoc($result)){
                $prevpaydate = $row['date'];
                if ($row['paid'] == 1) {
                    $paid = true;
                }else{
                    $paid = false;
                }
            }
        }
    }
    $salesSQL = "SELECT * FROM sales WHERE studentID=".$_SESSION['studentID']." AND date >'".$prevpaydate."';";
    $resultssql = mysqli_query($conn, $salesSQL);
    $resultssqlcheck = mysqli_num_rows($resultssql);
    if ($resultssqlcheck > 0) {
        while ($row = mysqli_fetch_assoc($resultssql)){
            if ($row['royalty']>$row['deal']) {
                if ($row['remix'] == 1) {
                    $earnings = $earnings + (($row['royalty']-$row['deal'])*0.7);
                }else{
                    $earnings = $earnings + ($row['royalty']-$row['deal']);
                }
            }else{
                $earnings = $earnings + 0;
            }
        }
    }else{
        $earnings = 0;
    }
    $earnings = round((round($earnings,2)*0.6),2);

    if ($paid == false) {
        $earningsdisplay = "Payout in Proccess...";
    }else{
        $earningsdisplay = "£ ".$earnings;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>placeholder students Portal</title>
        <link href="../css/normalize.css" rel="stylesheet" />
        <link href="../css/stylesheet.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
        <script src="../js/fadein.js"></script>
        <script src="../js/portalslideshow.js"></script>
        <script src="../js/portalmodal.js"></script>
        <script src="../js/studentportal.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
          google.charts.load("current", {packages:["corechart"]});
          google.charts.load('current', {'packages':['table']});
          google.charts.setOnLoadCallback(drawChart);
          google.charts.setOnLoadCallback(drawTable);
          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Platform', 'Percent'],
              <?php
                require 'dbh.inc.php';
                $marketplaceSQL = "SELECT * FROM stats WHERE studentID=".$_SESSION['studentID']." AND listingID=".$listingIndex.";";
                $resultrsql = mysqli_query($conn, $marketplaceSQL);
                $resultrsqlcheck = mysqli_num_rows($resultrsql);
                if ($resultrsqlcheck > 0) {
                    while ($row = mysqli_fetch_assoc($resultrsql)){
                        echo "['".$row['platform']."',".$row['percent']."],";
                    }
                }
              ?>
            ]);
            var options = {
              title: 'Platform Streams',
              is3D: true,
              backgroundColor: '#F9F9F9',
              chartArea:{left:0,top:0,width:'100%',height:'100%'}
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
          }
          function drawTable() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Listing');
            data.addColumn('number', 'Percent');
            data.addColumn('number', 'Listing Views');
            data.addColumn('number', 'Listing Watching');
            data.addColumn('number', 'Listing Sales');
            data.addRows([
                <?php
                require 'dbh.inc.php';
                $marketplaceSQL = "SELECT * FROM stats WHERE studentID=".$_SESSION['studentID']." AND listingID=".$listingIndex.";";
                $resultrsql = mysqli_query($conn, $marketplaceSQL);
                $resultrsqlcheck = mysqli_num_rows($resultrsql);
                if ($resultrsqlcheck > 0) {
                    while ($row = mysqli_fetch_assoc($resultrsql)){
                        echo "['".$row['platform']."',{v: ".$row['percent'].", f: \"".$row['percent']."%\"}, ".$row['audioStreams'].",".$row['trackDownloads'].",".$row['albumDownloads']."],";
                    }
                }
              ?>
            ]);
            var table = new google.visualization.Table(document.getElementById('table_div'));
            table.draw(data, {showRowNumber: false, width: '100%', height: '100%'});
          }
        </script>
    </head>
    <body>
        <div class="portalcontainer">
            <!-- Header start -->
            <div class="headergrid">
                <header>
                    <nav>
                        <a href="index.html" class="nav">PLACEHOLDER</a>
                        <div class="fltrt">
                            <a href="../students.html" class="headernav">STUDENTS</a>
                            <p class="navbreak">.</p>
                            <a href="../marketplace.html" class="headernav">MARKETPLACE</a>
                            <p class="navbreak">.</p>
                            <a href="php/studentportal.php" class="headernav">LOGIN</a>
                            <div class="socialblock">
                                <a href="">
                                    <img class="navsocial" src="../images/icons/youtube-icon.png" alt="Youtube Icon" />
                                </a>
                                <a href="">
                                    <img class="navsocial" src="../images/icons/facebook-icon.png"  alt="Facebook Icon" />
                                </a>
                                <a href="">
                                    <img class="navsocial" src="../images/icons/soundcloud-icon.png"  alt="Soundcloud Icon" />
                                </a>
                                <div class="dropdown">
                                    <img class="navmenu" src="images/icons/menu-icon.png" alt="Menu Icon" />
                                    <div class="dropdown-content">
                                            <a href="../students.html">STUDENTS</a>
                                            <br />
                                            <a href="../marketplace.html">MARKETPLACE</a>
                                            <br />
                                            <a href="php/studentportal.php">LOGIN</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <div class="sentconfirmation"></div>
                </header>
            </div>
            <!-- Header end -->
            <!-- Left start -->
            <div class="leftgrid">
                <img id="placeholder-logo-left" src="../images/placeholder-logo-left.png" alt="placeholder Logo Left" />
            </div>
            <!-- Left end -->
            <!-- right start -->
            <div class="rightgrid">
                <img id="placeholder-logo-right" src="../images/placeholder-logo-right.png" alt="placeholder Logo Right" />
            </div>
            <!-- right end -->
            <!-- Body start -->
            <div class="bodygrid">
                <?php
                    if (isset($_SESSION['studentID'])) {
                        echo '
                        <div class="portalcontent">
                            <div class="portalheader">
                                <form class="fltrt" action="logout.inc.php" method="post">
                                    <input type="submit" value="LOGOUT" name="logout">
                                </form>
                                <h1>'.$_SESSION['studentName'].'</h1>
                            </div>
                            <div class="portalprofiletitle">
                                <h2>Profile</h2>
                            </div>
                            <div class="portalprofile">
                                <div class="changecontentcontainer">
                                    <img src="../studentdata/'.$_SESSION['pathName'].'/profile.jpg" class="changecontent" />
                                    <div class="changecontentmiddle">
                                        <div class="changecontenttext" id="changeprofile">Change Image</div>
                                    </div>
                                </div>
                            </div>
                            <div class="portalbio">
                                <div class="changecontentcontainer">
                                    <p class="changecontent">'.$_SESSION['studentBio'].'</p>
                                    <div class="changecontentmiddle">
                                        <div class="changecontenttext" id="changebio">Change Bio</div>
                                    </div>
                                </div>
                            </div>
                            <div class="portalpayout">
                                <form class="fltrt" action="payout.php" method="post">
                                    <input id="earnings" type="hidden" name="earnings" value="'.$earnings.'">
                                    <input type="hidden" name="earningsdisplay" value="'.$earningsdisplay.'">
                                    <input type="submit" value="PAYOUT" name="payout-submit" id="payout-submit">
                                </form>
                                <h3>Account funds: &nbsp;'.$earningsdisplay.'</h3>
                            </div>
                            <div class="portalmarketplacetitle" id="portalmarketplacetitle">
                                <h2>marketplace</h2>
                            </div>
                            <div class="portalmarketplace">
                                <div class="slideshow-container">
                                  <!-- Full-width images with number and caption text -->
                                  '.$listingpics.'
                                    <!-- Next and previous buttons -->
                                    <a class="prev">&#10094;</a>
                                    <a class="next">&#10095;</a>
                                </div>
                                <br>
                                '.$listingdots.'
                            </div>
                            <div class="portallistingchart">
                                <div id="piechart_3d"></div>
                            </div>
                            <div class="portallistingtable">
                                <div id="table_div"></div>
                            </div>
                        </div>
                        ';
                    }else{
                        echo '<h1>No User logged in</h1>';
                    }
                ?>
            </div>
            <!-- Body end -->
            <!-- Footer start -->
            <div class="footergrid">
                <footer>
                    <a href="../index.html">Home</a>
                    <p class="navbreak">.</p>
                    <a href="../students.html">Students</a>
                    <p class="navbreak">.</p>
                    <a href="../marketplace.html">Marketplace</a>
                    <p class="navbreak">.</p>
                    <a href="studentportal.php">Login</a>
                    <p class="navbreak">.</p>
                    <a href="../privacy.html">Privacy Policy</a>
                    <p class="navbreak">.</p>
                    <a href="../termsconditions.html">Terms & Conditions</a>
                    <p class="navbreak">.</p>
                    <a href="../contact.html">Contact Us</a>
                    <p class="navbreak">.</p>
                    <a href="../about.html">About Us</a>
                    <p>© 2021 placeholder</p>
                </footer>
            </div>
            <!-- Footer end -->
            <div class="bg-modal">
                    <div class="modal-content">
                        <div class="modal-close">+</div>
                        <?php echo '
                        <form id="modalform" name="form" method="post" class="profileupdate" action="contentsubmit.php?listingIndex='.$listingIndex.'" enctype="multipart/form-data">
                            <fieldset>
                                <h3>Profile Image Update</h3>
                                <p>Please enter your profile image as a <b>.jpg</b> file with a minimum of <b>500x500 pixels</b> width and height.<br><em>after submission the file will be reviewed and updated on acceptance.</em></p>
                                <input type="file" name="profileupdate">
                                <input name="profilesubmit" type="submit" value="Submit">
                            </fieldset>
                        </form>
                        <form id="modalform" name="form" method="post" class="bioupdate" action="contentsubmit.php?listingIndex='.$listingIndex.'">
                            <fieldset>
                                <h3>Profile Bio Update</h3>
                                <p>Please enter your profile bio with a count of <b>50-200 words</b>.<br><em>after submission the bio will be reviewed and updated on acceptance.</em></p>
                                <textarea type="text" name="bioupdate" placeholder="Type your profile bio Here...."></textarea>
                                <input name="biosubmit" type="submit" value="Submit">
                            </fieldset>
                        </form>
                        <form id="modalform" name="form" method="post" class="listingupdate" action="contentsubmit.php?listingIndex='.$listingIndex.'" enctype="multipart/form-data">
                            <fieldset>
                                <h3>listing Content Update</h3>
                                <p>Please enter your listing bio with a count of <b>50-200 words</b> and/or listing image as a <b>.jpg</b> file with a minimum of <b>500x500 pixels</b> width and height.<br><em>after submission the bio and/or image will be reviewed and updated on acceptance.</em></p>
                                <input type="file" name="listingimgupdate">
                                <textarea type="text" name="listingbioupdate" placeholder="Type your listing bio Here...."></textarea>
                                <input name="marketplaceubmit" type="submit" value="Submit">
                            </fieldset>
                        </form>';
                        ?>
                </div>
            </div>
        </div>
    </body>
</html>