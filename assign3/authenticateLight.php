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
            <li><a href="indexLight.php">Home</a></li>
            <li><a href="topicLight.php">Topic</a></li>
            <li><a href="quizLight.php">Quiz</a></li>
            <li><a href="enhancementsLight.php">Enhancements</a></li>
            <li><a href="enhancements2Light.php">PHP Enhancements</a></li>
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
                        <h2>You are logged in</h2>
                        <p class="results-btn-container"><a class="results-button" href="logoutLight.php">Logout</a></p>
                    </section>');
        }
        ?>
    </main>

    <?php
    include "footer.inc"
    ?>

</body>

</html>