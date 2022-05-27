<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Node.js" />
    <meta name="keywords" content="Node.js, Technology Inquiry Project" />
    <meta name="author" content="Group 2 - Node.js - Archer, Ben, Callum, Jack and William" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="icon" type="image/x-icon" href="images/nodejsicon.ico">
    <title>Node.js - Technology Inquiry Project</title>
</head>

<body id="enhancement_body_background">
    <header>
        <!-- Node.js logo -->
        <a class="logo" href="index.php"><img src="images/nodejslogo.png" width="30" alt="logo"></a>
        <input type="checkbox" class="menu-checkbox" id="menu-checkbox">
        <label class="hamburger-icon" for="menu-checkbox"><span class="nav-icon"></span></label>

        <!-- Menu -->
        <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="topic.php">Topic</a></li>
            <li><a href="quiz.php">Quiz</a></li>
            <li><a href="enhancements.php">Enhancements</a></li>
            <li><a class="selected" href="enhancements2.php">PHP Enhancements</a></li>
            <li class="mode"><a href="enhancements2Light.php">Light Mode</a></li>
            <li class="mode"><a href="authenticate.php">User</a></li>
            <li class="mode"><a href="manageQuery.php">⚙</a></li>
        </ul>
    </header>

    <main>
        <h1>Enhancements</h1>

        <div class="enhancements">
            <section class="enhancement-card">
                <h2>Randomize Quiz</h2>
                <p>
                    The first enhancement was making the quiz dynamically render the questions. The questions, their types, answers (if any for multiple select options), and solution are inserted into the ‘questions’ table. From there, 5 rows are randomly pulled to be displayed to the user.
                </p>
            </section>

            <section class="enhancement-card">
                <h2>Authentication</h2>
                <p>
                    The second enhancement was the implementation of admin login functionality. This page is accessible through the user link in the top right corner of the navigation bar and uses PHP session based storage to achieve authorization. This technique was sourced through the blog post https://codeshack.io/secure-login-system-php-mysql/.

                    Authentication is achieved if the fields the user inputs are equal to any of the rows in the users table, a prefilled table. This comparison check can be done using a where clause to pull rows where the username is equal, if there are none then the user does not exist. If the user exists and the passwords are a match, then the user will be authenticated and the session logged in variable will be set to true.
                    When authorized the user is granted access the manage query table.

                    Users are be able to log out using the same page. When authorized and on the user page, a button will appear which when clicked will initiate termination of the session and return the user back to the index page.
                </p>
            </section>
        </div>
    </main>

    <?php
    include "footer.inc"
    ?>
</body>

</html>