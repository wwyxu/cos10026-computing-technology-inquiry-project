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

<body>
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
            <li><a href="enhancements2.php">PHP Enhancements</a></li>
            <li class="mode"><a href="authenticateLight.php">Light Mode</a></li>
            <li class="mode selected"><a href="authenticate.php">User</a></li>
            <li class="mode"><a href="manageQuery.php">⚙</a></li>
        </ul>
    </header>

    <main id="quiz-background">
        <h1>Log In</h1>

        <?php
        session_start();

        if (!isset($_SESSION['loggedin'])) {
            echo (' <section class="quiz">
                <div>Password and Username is "admin"</div>

                <form action="authenticateQuery.php" method="post">
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
                        <p class="results-btn-container"><a class="results-button" href="logout.php">Logout</a></p>
                    </section>');
        }
        ?>
    </main>

    <?php
    include "footer.inc"
    ?>

</body>

</html>