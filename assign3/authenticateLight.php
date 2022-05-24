<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Node.js" />
    <meta name="keywords" content="Node.js, Technology Inquiry Project" />
    <meta name="author" content="Group 2 - Node.js - Archer, Ben, Callum, Jack and William" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/styleLight.css">
    <link rel="icon" type="image/x-icon" href="images/nodejsicon.ico">
    <title>Node.js - Technology Inquiry Project</title>
</head>

<body>
    <header>
        <!-- Node.js logo -->
        <a class="logo" href="index.html"><img src="images/nodejslogo.png" width="30" alt="logo"></a>
        <input type="checkbox" class="menu-checkbox" id="menu-checkbox">
        <label class="hamburger-icon" for="menu-checkbox"><span class="nav-icon"></span></label>

        <!-- Menu -->
        <ul class="menu">
            <li><a href="indexLight.html">Home</a></li>
            <li><a href="topicLight.html">Topic</a></li>
            <li><a href="quizLight.php">Quiz</a></li>
            <li><a href="enhancementsLight.html">Enhancements</a></li>
            <li><a href="enhancements2Light.html">PHP Enhancements</a></li>
            <li class="mode"><a href="authenticate.php">Dark Mode</a></li>
            <li class="mode selected"><a href="authenticateLight.php">User</a></li>
            <li class="mode"><a href="manageQueryLight.php">⚙</a></li>
        </ul>
    </header>

    <main id="quiz-background">
        <h1>Log In</h1>

        <?php
        session_start();

        if (!isset($_SESSION['loggedin'])) {
            echo (' <section class="quiz">
                <div>Password and Username is "admin"</div>

                <form action="authenticateQueryLight.php" method="post">
                    <label for="username">
                        <input type="text" name="username" placeholder="Username" id="username" required>
                    </label>
                    <label for="password">
                        <input type="password" name="password" placeholder="Password" id="password" required>
                    </label>
                    <input type="submit" value="Login" />
                </form>
                 </section>');
        } else {
            echo (' <section class="panel">
                        <div>You are logged in</div>
                        <a href="logout.php">Logout</a>
                    </section>');
        }
        ?>
    </main>

    <footer class="footer">
        <div class="footer-heading">
            <h1>Group</h1>
            <a href="mailto:103322558@student.swin.edu.au">Archer</a>
            <a href="mailto:103619739@student.swin.edu.au">Ben</a>
            <a href="mailto:103972490@student.swin.edu.au">William</a>
            <a href="mailto:103994591@student.swin.edu.au">Callum</a>
            <a href="#mailto:103597767@student.swin.edu.au">Jack</a>
        </div>
        <div class="footer-heading">
            <h1>Contact</h1>
            <a href="mailto:103322558@student.swin.edu.au">103322558@student.swin.edu.au</a>
            <a href="mailto:103619739@student.swin.edu.au">103619739@student.swin.edu.au</a>
            <a href="mailto:103972490@student.swin.edu.au">103972490@student.swin.edu.au</a>
            <a href="mailto:103994591@student.swin.edu.au">103994591@student.swin.edu.au</a>
            <a href="mailto:103597767@student.swin.edu.au">103597767@student.swin.edu.au</a>
        </div>
        <div class="footer-heading">
            <h1>About</h1>
            <a href="http://www.swinburne.edu.au/">School</a>
            <a href="https://www.investopedia.com/articles/investing/012715/5-richest-people-world.asp">Investors</a>
            <a href="https://www.entrepreneur.com/article/240492">Blog</a>
            <a href="https://www.facebook.com">Facebook Page</a>
        </div>
        <div class="footer-email-form">
            <h1>Join our newsletter</h1>
            <input type="email" placeholder="Enter your email address" id="footer-email">
            <br />
            <input type="submit" value="Sign Up" id="footer-email-btn">
        </div>
    </footer>

</body>

</html>