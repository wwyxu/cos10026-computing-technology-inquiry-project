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