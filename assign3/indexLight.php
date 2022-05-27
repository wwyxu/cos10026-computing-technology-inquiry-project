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
        <a class="logo" href="indexLight.php"><img src="images/nodejslogo2.png" width="30" alt="logo"></a>
        <input type="checkbox" class="menu-checkbox" id="menu-checkbox">
        <label class="hamburger-icon" for="menu-checkbox"><span class="nav-icon"></span></label>

        <!-- Menu -->
        <ul class="menu">
            <li><a class="selected" href="indexLight.php">Home</a></li>
            <li><a href="topicLight.php">Topic</a></li>
            <li><a href="quizLight.php">Quiz</a></li>
            <li><a href="enhancementsLight.php">Enhancements</a></li>
            <li><a href="enhancements2Light.php">PHP Enhancements</a></li>
            <li class="mode"><a href="index.php">Dark Mode</a></li>
            <li class="mode"><a href="authenticateLight.php">User</a></li>
            <li class="mode"><a href="manageQueryLight.php">⚙</a></li>
        </ul>
    </header>

    <main class="index">
        <!-- Main page content -->
        <div id="index-introduction" class="index-links">
            <!-- Introduction section -->
            <h1 class="index-heading">Hi, we are Team Node.js</h1>
            <!-- Headings -->
            <h2 class="index-description">
                This is our website about the runtime
                environment Node.js, <br />
                We are group 2, our team consists of members Archer, Ben, Callum, Jack and William.
            </h2>
            <p class="index-btn-container"><a href="https://www.youtube.com/watch?v=tDtD4dZ-KFQ&ab_channel=WoundedGoat" target="_blank" class="index-button">Video</a></p>
        </div>
        <section id="index-topic" class="index-links">
            <!-- Topic link section -->
            <h2 class="index-heading">Topic</h2> <!-- Headings -->
            <h3 class="index-description">Learn about Node.js, a method for writing website backends using JavaScript
            </h3>
            <!-- Descriptions -->
            <p class="index-btn-container"><a href="topicLight.php" class="index-button">Find out more</a></p>
            <!-- Buttons with containers -->
        </section>
        <section id="index-quiz" class="index-links">
            <!-- Quiz link section -->
            <h2 class="index-heading">Quiz</h2>
            <h3 class="index-description">Test your understanding of Node.js, and see if you can get a perfect score
            </h3>
            <p class="index-btn-container"><a href="quizLight.php" class="index-button">Let's go</a></p>
        </section>
        <section id="index-enhancements" class="index-links">
            <!-- Enhancements link section -->
            <h2 class="index-heading">Enhancements</h2>
            <h3 class="index-description">See the history of this website, and learn how it has grown and matured</h3>
            <p class="index-btn-container"><a href="enhancementsLight.php" class="index-button">Find out more</a></p>
        </section>
    </main>

    <?php
    include "footer.inc"
    ?>

</body>

</html>