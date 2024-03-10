<?php
    session_start();
    if(!isset($_SESSION["user"])){
    }
    $username = $_SESSION["user_name"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carlo Henry De Leon</title>
    <link rel="stylesheet" type="text/css" href="design.css">
</head>
<body>
    <button class="plain-text-button" onclick="scrollToSection('section1')">About Me</button>
    <button class="plain-text-button" onclick="scrollToSection('section2')">Skills</button>
    <button class="plain-text-button" onclick="scrollToSection('section3')">FAQ</button>
    

    <hr>
    <p class="username"><strong>Welcome, <?php echo $username; ?></strong></p>
    <p><a href="logout.php"><strong>Logout</strong></a></p>


    <div class="content-container">
        <img src="PROFILE.jpg" alt="Description of the image" class="left-aligned-image">
        <div class="text-container">
            <h1>Welcome!!!, I am Carlo Henry De Leon</h1>
        </div>
    </div>

    <section id="section1">
        <h1>About Me</h1>
        <img src="DeLeonformalpicture.jpg" alt="Description of the image" class="left-aligned-image2">
        <div class="text-container2">
            <p> I am currently a <b>Second Year Student</b>, section <b>IT-221</b></p>
            <p>i am working on projects such as this website for the subject Web Programming and also Machine Project for the subject Operating Systems</p>
            <p>My Hobbies include playing Video Games, and also i am a Musician, performing inside the campus and also gigs outside of my university</p>
            <p>Interest include <b>instruments</b> and <b>Music Theory</b> or <b>Theoriticals about Music</b> to help broaden my knowledge in creating music</p>
        </div>
        <h2>Resume</h2>
        <div class="text-container2">
            <p>Herewith attached is my <b>Resume</b>, feel free to view!</p>
            <p><a href="C:\Users\Carlo\Desktop\De Leon_IT221_WEBPROG_Project\Carlo Henry L. De Leon.pdf" target="_blank"><b>My Resume, Carlo Henry L. De Leon </b></a></p>
            </div>
    </section>

    <section id="section2">
        <h1>Skills</h1>
        <div class="text-container2">
            <p>Often people say i work <b>fast</b>, indeed i do work <b>fast</b> when i know what to do </p>
            <p>Expertise includes <b>Planning</b> and <b>Time Managing</b></p>
        </div>
    </section>

    <section id="section3">
        <h1>FAQ</h1>
        <div class="text-container2">
        <p><b>Contact Information:</b> <a href="https://www.facebook.com/librenyokongbagongbassamplifier/">Carlohenry De Leon</a></p>
        <p><b>Questions that i can answer, about myself and what i do:</p></b>
        <p><b>Is Information Technology hard?:</b> There is no easy thing in life, i chose this path because i have interest in computers, 
            and also people keep saying that this path has a lot of opportunities and i can actually make sense on what they are saying,
            but to answer the question, yes it is hard, but Computer Science is harder *laughs*</p>
        <p><b>Do i fix refrigerators?</b>  : No i'm afraid i don't do such tasks</p>
        <p><b>Most Interesting Job in Information Technology:</b>  as long it's coding and not buisness oriented, i am on it, since i actually like coding</p>
    </div>
    </section>


<div class="container_comment">
        <div class="col-md-8">
            <h1 id="comments" class="text-center">Leave a Comment</h1>
            <form method="post">
                <div class="mb-3">
                    <label for="comment" id="ycomment" class="form-label">Your Comment:</label>
                    <textarea class="form-control" id="comment" name="comment" rows="5" required></textarea>
                </div>
                <button type="submit" name="submit" class="btn_submit">Submit</button>
            </form>
        </div>
    </div>

    <?php

        if(isset($_POST["comment"])){
            $message = $_POST["comment"];
            $date = date("Y-m-d");

            // Get the user's ID from the session
            if(isset($_SESSION["user_id"])) {
                $user_id = $_SESSION["user_id"];
            } else {
                // Handle the case where user ID is not set in session
                die("User ID not found in session");
            }

            require_once("database.php");

            $sql = "INSERT INTO comment (ID, date, message) VALUES (?, ?, ?)";

            $stmt = mysqli_stmt_init($conn);

            $preparestmt = mysqli_stmt_prepare($stmt, $sql);

            if ($preparestmt) {
                mysqli_stmt_bind_param($stmt, "sss", $user_id, $date, $message);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success center'>Comment posted successfully!</div>";
            } else {
                die("Something went wrong");
            }
        }
        ?>


    <script>
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth' });
            }
        }
    </script>
</body>
</html>
