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
            <li class="mode"><a href="authenticateQueryLight.php">Light Mode</a></li>
            <li class="mode selected"><a href="authenticate.php">User</a></li>
            <li class="mode"><a href="manageQuery.php">⚙</a></li>
        </ul>
    </header>

    <main id="quiz-background">
        <h1>Log In Page</h1>

        <?php
        session_start();
        require_once("login.php");
        $database = mysqli_connect($host, $user, $pwd, $dbname);
        echo $database->connect_error;

        if (!$database) {
            echo "<section class='results'>\n";
            echo "<h2>Error</h2>\n";
            echo "<p>Connection error: " . mysqli_connect_error() . "</p>\n";
            echo "</section>\n";
        } else {
            new mysqli($host, $user, $pwd, $dbname);

            $sql = "CREATE TABLE IF NOT EXISTS `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `username` varchar(50) NOT NULL,
            `password` varchar(255) NOT NULL,
            `email` varchar(100) NOT NULL
            )";

            if ($database->query($sql) != TRUE) {
                echo "<section class='results'>";
                echo "<h2>Error</h2>\n";
                echo "<p>Error creating table: " . $database->error . "</p>\n";
                echo "</section>";
            } else {
                require("functions.php");

                $selectQuery = "SELECT * FROM `users";
                $result = mysqli_query($database, $selectQuery);
                $rowCount = mysqli_num_rows($result);

                if ($rowCount == 0) {
                    $insertAccount = "INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES (1, 'admin', 'admin', 'test@test.com')";

                    mysqli_query($database, $insertAccount);

                    echo "<section class='panel'>";
                    echo "<p>Inserted default account, please refresh browser to continue</p>";
                    echo "</section>";
                } else {
                    echo "<section class='panel'>";

                    $username = getData('username', 'authenticate.php');
                    $password = getData('password', 'authenticate.php');

                    // var_dump($username);
                    // var_dump($password);

                    if (!isset($_POST['username'], $_POST['password'])) {
                        exit('Please fill both the username and password fields!');
                    }

                    $userQuery = "SELECT * FROM `users`";
                    $userQueryResult = mysqli_query($database, $userQuery);
                    $user = mysqli_fetch_assoc($userQueryResult);
                    // $userRowCount = mysqli_num_rows($user);

                    if ($user) {
                        if ($password == $user["password"]) {
                            $_SESSION['loggedin'] = TRUE;
                            $_SESSION['name'] = $_POST['username'];
                            $_SESSION['id'] = $user['id'];
                            echo '<h2>Welcome ' . $_SESSION['name'] . '!</h2>';
                            echo '<p class="results-btn-container"><a class="results-button" href="logout.php">Logout</a></p>';
                        } else {
                            echo "Password is incorrect, please try again";
                        }
                    } else {
                        echo 'This account does not exist';
                    }
                    echo "</section>";
                }
            }

            mysqli_close($database);
        }
        ?>
    </main>
    <?php
    include "footer.inc"
    ?>

</body>

</html>