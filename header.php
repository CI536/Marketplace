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
                            <a href="index.php">MARKETPLACE</a>
                            <br />
                            <?php
                                if (isset($_SESSION['studentID'])) {
                                    echo '<a href="studentportal.php">PROFILE</a>';
                                }else{
                                    echo '<a href="studentportal.php">LOGIN</a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            
        </nav>
        <div class="sentconfirmation"></div>
    </header>
</div>