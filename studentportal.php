<?php
require 'php/dbh.inc.php';
session_start();
if (!isset($_SESSION['studentID'])) {
    header("location: login.php");
}else{
    $marketplaceSQL = "SELECT * FROM marketplace WHERE studentID=".$_SESSION['studentID'].";";
    if (isset($conn)) {
        $resultrsql = mysqli_query($conn, $marketplaceSQL);
    }
    $resultrsqlcheck = mysqli_num_rows($resultrsql);
    if ($resultrsqlcheck > 0) {
        while ($row = mysqli_fetch_assoc($resultrsql)){
            $listingpics .= '
                <div class="mySlides fade">
                    <div class="changecontentcontainer">
                        <div class="changecontent">
                            <img class="slideIMG" src="studentdata/'.$_SESSION['pathName'].'/marketplace/'.$row['fileName'].'" alt="'.$row['listingName'].' Listing Image">
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
        header("location: studentportal.php?error=sqlerror");
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

    if ($paid = false) {
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
        <title>Students Portal</title>
        <link href="css/normalize.css" rel="stylesheet" />
        <link href="css/stylesheet.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
        <script src="js/fadein.js"></script>
        <script src="js/portalslideshow.js"></script>
        <script src="js/portalmodal.js"></script>
        <script src="js/studentportal.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
          google.charts.load("current", {packages:["corechart"]});
          google.charts.load('current', {'packages':['table']});
          google.charts.setOnLoadCallback(drawChart);
          google.charts.setOnLoadCallback(drawTable);
          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Listing', 'Percent'],
              <?php
                $marketplaceSQL = "SELECT * FROM stats WHERE studentID=".$_SESSION['studentID'].";";
                $resultrsql = mysqli_query($conn, $marketplaceSQL);
                $resultrsqlcheck = mysqli_num_rows($resultrsql);
                if ($resultrsqlcheck > 0) {
                    while ($row = mysqli_fetch_assoc($resultrsql)){
                        echo "['".$row['listingName']."',".$row['percent']."],";
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
                require 'php/dbh.inc.php';
                $marketplaceSQL = "SELECT * FROM stats WHERE studentID=".$_SESSION['studentID'].";";
                $resultrsql = mysqli_query($conn, $marketplaceSQL);
                $resultrsqlcheck = mysqli_num_rows($resultrsql);
                if ($resultrsqlcheck > 0) {
                    while ($row = mysqli_fetch_assoc($resultrsql)){
                        echo "['".$row['listingName']."',{v: ".$row['percent'].", f: \"".$row['percent']."%\"}, ".$row['listingViews'].",".$row['listingWatching'].",".$row['listingSales']."],";
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
            <?php include 'header.php'?>
            <!-- Header end -->
            <!-- Left start -->
            <div class="leftgrid">
                <img id="placeholder-logo-left" src="images/placeholder-logo-left.png" alt="placeholder Logo Left" />
            </div>
            <!-- Left end -->
            <!-- right start -->
            <div class="rightgrid">
                <img id="placeholder-logo-right" src="images/placeholder-logo-right.png" alt="placeholder Logo Right" />
            </div>
            <!-- right end -->
            <!-- Body start -->
            <div class="bodygrid">
                <?php
                    if (isset($_SESSION['studentID'])) {
                        echo '
                        <div class="portalcontent">
                            <div class="portalheader">
                                <form class="fltrt" action="php/logout.inc.php" method="post">
                                    <input type="submit" value="LOGOUT" name="logout">
                                </form>
                                <h1>' .$_SESSION['studentName'].'</h1>
                            </div>
                            <div class="portalprofiletitle">
                                <h2>Profile</h2>
                            </div>
                            <div class="portalprofile">
                                <div class="changecontentcontainer">
                                    <img src="studentdata/'.$_SESSION['pathName'].'/profile.jpg" class="changecontent" />
                                    <div class="changecontentmiddle">
                                        <div class="changecontenttext" id="changeprofile">Change Image</div>
                                    </div>
                                </div>
                            </div>
                            <div class="portalbio">
                                <div class="changecontentcontainer">
                                    <p class="changecontent">'.$_SESSION['studentBio']. '</p>
                                    <div class="changecontentmiddle">
                                        <div class="changecontenttext" id="changebio">Change Bio</div>
                                    </div>
                                </div>
                            </div>
                            <div class="portalpayout">
                                <form class="fltrt portalbutton" action="php/payout.php" method="post">
                                    <input id="earnings" type="hidden" name="earnings" value="' .$earnings.'">
                                    <input type="hidden" name="earningsdisplay" value="'.$earningsdisplay.'">
                                    <input type="submit" value="PAYOUT" name="payout-submit" id="payout-submit">
                                </form>
                                <h3>Account funds: &nbsp;'.$earningsdisplay.'</h3>
                            </div>
                            <div class="portalmarketplacetitle" id="portalmarketplacetitle">
                                <h2>marketplace</h2>
                            </div>
                            <div class="portalnewlisting">
                                <form class="fltrt portalbutton" action="" method="post">
                                    <input type="submit" value="New Listing" name="newlisting-submit" id="newlisting-submit">
                                </form>
                                <h3>Upload new Listing</h3>
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
            <?php include 'footer.php'?>
            <!-- Footer end -->
            <div class="bg-modal">
                    <div class="modal-content">
                        <div class="modal-close">+</div>
                        <?php echo '
                        <form id="modalform" name="form" method="post" class="listingupload" action="php/contentsubmit.php?listingIndex='.$listingIndex.'" enctype="multipart/form-data">
                            <fieldset>
                                <h3>New Listing Upload</h3>
                                <p>Please enter your listing bio with a count of <b>50-200 words</b> and listing image as a <b>.jpg</b> file with a minimum of <b>500x500 pixels</b> width and height.<br></p>
                                <label class="fltlt">Listing Image</label>
                                <input type="file" name="listingimgupload">
                                <br />
                                <label class="fltlt">Listing Title</label>
                                <br />
                                <input type="text" name="listingtitleupload" placeholder="Type your listing title here...">
                                <br />
                                <label class="fltlt">Listing Category</label>
                                <br />
                                <input type="text" name="listingcategoryupload" placeholder="Type your listing category here...">
                                <br />
                                <label class="fltlt">Listing Price</label>
                                <br />
                                <input type="number" min="0.00" step="0.01" name="listingpriceupload" placeholder="Type your listing price here...">
                                <br />
                                <label class="fltlt">Listing Description</label>
                                <br />
                                <textarea type="text" name="listingbioupload" placeholder="Type your listing bio here...."></textarea>
                                <input name="newlistingsubmit" type="submit" value="Submit">
                            </fieldset>
                        </form>
                        <form id="modalform" name="form" method="post" class="profileupdate" action="php/contentsubmit.php?listingIndex='.$listingIndex.'" enctype="multipart/form-data">
                            <fieldset>
                                <h3>Profile Image Update</h3>
                                <p>Please enter your profile image as a <b>.jpg</b> file with a minimum of <b>500x500 pixels</b> width and height.<br><em>after submission the file will be reviewed and updated on acceptance.</em></p>
                                <input type="file" name="profileupdate">
                                <input name="profilesubmit" type="submit" value="Submit">
                            </fieldset>
                        </form>
                        <form id="modalform" name="form" method="post" class="bioupdate" action="php/contentsubmit.php?listingIndex='.$listingIndex.'">
                            <fieldset>
                                <h3>Profile Bio Update</h3>
                                <p>Please enter your profile bio with a count of <b>50-200 words</b>.<br><em>after submission the bio will be reviewed and updated on acceptance.</em></p>
                                <textarea type="text" name="bioupdate" placeholder="Type your profile bio Here...."></textarea>
                                <input name="biosubmit" type="submit" value="Submit">
                            </fieldset>
                        </form>
                        <form id="modalform" name="form" method="post" class="listingupdate" action="php/contentsubmit.php?listingIndex='.$listingIndex.'" enctype="multipart/form-data">
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