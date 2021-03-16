<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>placeholder Contact Form</title>
        <link href="css/normalize.css" rel="stylesheet" />
        <link href="css/stylesheet.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
        <script src="js/contact.js"></script>
    </head>
    <body>
        <div class="container">
            <!-- Header start -->
            <?php include 'header.php' ?>
            <!-- Header end -->
            <!-- Left start -->
            <div class="leftgrid">
            </div>
            <!-- Left end -->
            <!-- right start -->
            <div class="rightgrid">
            </div>
            <!-- right end -->
            <!-- Body start -->
            <div class="bodygrid">
                <div class="formcontainer">  
                  <form id="form" name="form" method="post" action="placeholder/php/contact.php">
                    <h3>- CONTACT US -</h3>
                    <h4>Contact us today, and we will reply as soon as possible!</h4>
                    <fieldset>
                      <legend>Name</legend>
                      <input placeholder="Your name" type="text" tabindex="1" name="fullname" id="fullname" autofocus>
                      <span class="name_error"></span>
                    </fieldset>
                    <fieldset>
                      <legend>Email</legend>
                      <input placeholder="Your Email Address" type="text" name="email" id="email" tabindex="2">
                      <span class="email_error"></span>
                    </fieldset>
                    <fieldset>
                      <legend>Reason for contacting</legend>
                      <select name="reason">
                      <option value = "1">General Enquires</option>
                      <option value = "2">Student Relations</option>
                      <option value = "3">Payout Enquires</option>
                      <option value = "4">Technical Support</option>
                      </select>
                    </fieldset>
                    <fieldset>
                      <legend>Subject</legend>
                      <input placeholder="Type your subject here...." type="text" tabindex="3" name="subject" id="subject">
                      <span class="subject_error"></span>
                    </fieldset>
                    <fieldset>
                      <legend>Message</legend>
                      <textarea placeholder="Type your Message Here...." type="text" name="query" id="query" tabindex="4"></textarea>
                      <span class="message_error"></span>
                    </fieldset>
                    <fieldset>
                      <input name="btnSubmit" type="submit" id="contact-submit" value="Submit" />
                    </fieldset>
                  </form>
                </div>
            </div>
            <!-- Body end -->
            <!-- Footer start -->
            <?php include 'footer.php' ?>
            <!-- Footer end -->
        </div>
    </body>
</html>