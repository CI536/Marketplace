<div class="footergrid">
    <footer>
        <a href="index.php">Marketplace</a>
        <p class="navbreak">.</p>
        <?php
        if (isset($_SESSION['studentID'])) {
            echo '<a href="studentportal.php">Profile</a>';
        }else{
            echo '<a href="studentportal.php">Login</a>';
        }
        ?>
        <p class="navbreak">.</p>
        <a href="privacy.php">Privacy Policy</a>
        <p class="navbreak">.</p>
        <a href="termsconditions.php">Terms & Conditions</a>
        <p class="navbreak">.</p>
        <a href="contact.php">Contact Us</a>
        <p class="navbreak">.</p>
        <a href="about.php">About Us</a>
        <p>© <?php echo date ('Y'); ?> placeholder</p>
    </footer>
</div>