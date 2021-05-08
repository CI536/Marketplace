<div class="headergrid">
    <header>
        <nav>
            <a href="index.php" class="headernav">MARKETPLACE</a>
            <div class="fltrt">
                <?php
                    if (isset($_SESSION['studentID'])) {
                        echo '<a href="studentportal.php" class="headernav">PROFILE</a>';
                    }else{
                        echo '<a href="studentportal.php" class="headernav">LOGIN</a>';
                    }
                ?>
            </div>
            <div class = "fltlt">
                <div class="socialblock">
                    <div class="dropdown">
                        <img class="navmenu" src="images/icons/menu-icon.png" alt="Menu Icon" />
                        <div class="dropdown-content">
                            <!--  show side bar if page is home -->
                            <?php include 'sidebar.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
            
        </nav>
        <div class="sentconfirmation"></div>
    </header>
</div>