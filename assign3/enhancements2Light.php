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

<body id="enhancement_body_background">
    <header>
        <!-- Node.js logo -->
        <a class="logo" href="indexLight.php"><img src="images/nodejslogo2.png" width="30" alt="logo"></a>
        <input type="checkbox" class="menu-checkbox" id="menu-checkbox">
        <label class="hamburger-icon" for="menu-checkbox"><span class="nav-icon"></span></label>

        <!-- Menu -->
        <ul class="menu">
            <li><a href="indexLight.php">Home</a></li>
            <li><a href="topicLight.php">Topic</a></li>
            <li><a href="quizLight.php">Quiz</a></li>
            <li><a href="enhancementsLight.php">Enhancements</a></li>
            <li><a class="selected" href="enhancements2Light.php">PHP Enhancements</a></li>
            <li class="mode"><a href="enhancements2.php">Dark Mode</a></li>
            <li class="mode"><a href="authenticateLight.php">User</a></li>
            <li class="mode"><a href="manageQueryLight.php">⚙</a></li>
        </ul>
    </header>

    <main>
        <h1>PHP Enhancements</h1>

        <div class="enhancements">
            <section class="enhancement-card">
                <h2>Randomize Quiz</h2>
                <p>

                </p>
            </section>

            <section class="enhancement-card">
                <h2>Authentication</h2>
                <p>
                </p>
            </section>
        </div>
    </main>

    <?php
    include "footer.inc"
    ?>
</body>

</html>