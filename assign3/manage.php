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

<body id="queries_page_background">
    <header>
        <!-- Node.js logo -->
        <a class="logo" href="index.html"><img src="images/nodejslogo.png" width="30" alt="logo"></a>
        <input type="checkbox" class="menu-checkbox" id="menu-checkbox">
        <label class="hamburger-icon" for="menu-checkbox"><span class="nav-icon"></span></label>

        <!-- Menu -->
        <ul class="menu five-item-menu">
            <li><a href="index.html">Home</a></li>
            <li><a href="topic.html">Topic</a></li>
            <li><a href="quiz.php">Quiz</a></li>
            <li><a href="enhancements.html">Enhancements</a></li>
            <li><a href="enhancements2.html">PHP Enhancements</a></li>
            <li class="mode selected"><a href="manage.php">⚙</a></li>
        </ul>
    </header>
    <main>
        <h1>Query Results <input type="button" onclick="history.back();" value="Back"></h1>
        <div class="management-page">
            <?php
            require("login.php");
            require("functions.php");

            if (isset($_POST["query"])) {
                $query = $_POST["query"];
            } else {
                header("location: manageQuery.php");
            }

            if (isset($_POST["first_name"])) {
                $first_name = $_POST["first_name"];
                sanitise_input($first_name);
            }

            if (isset($_POST["last_name"])) {
                $last_name = $_POST["last_name"];
                sanitise_input($last_name);
            }

            if (isset($_POST["student_num"])) {
                $student_num = $_POST["student_num"];
                sanitise_input($student_num);
            }

            if (isset($_POST["attempt_num"])) {
                $attempt_num = $_POST["attempt_num"];
                sanitise_input($attempt_num);
            }

            if (isset($_POST["attempt_score"])) {
                $attempt_score = $_POST["attempt_score"];
                sanitise_input($attempt_score);
            }

            switch ($query) {
                case "none":
                    header("location: manageQuery.php");
                case "all":
                    $sql = "SELECT first_name, last_name, student_num, attempt_num, attempt_score FROM `attempts`;";
                    break;
                case "allforstudent":
                    if (!(($first_name && $last_name) or $student_num)) {
                        echo "<p>Error! Name or ID input error. Please go back.</p>";
                    } else {
                        if ($first_name && $last_name) {
                            $sql = "SELECT first_name, last_name, student_num, attempt_num, attempt_score FROM `attempts` WHERE first_name = '$first_name' AND last_name = '$last_name';";
                        } else {
                            $sql = "SELECT first_name, last_name, student_num, attempt_num, attempt_score FROM `attempts` WHERE student_num = '$student_num';";
                        }
                    }
                    break;
                case "allstudent100":
                    $sql = "SELECT first_name, last_name, student_num, attempt_num, attempt_score FROM `attempts` WHERE attempt_score = '5' AND attempt_num = '1';";
                    break;
                case "allstudent50":
                    $sql = "SELECT first_name, last_name, student_num, attempt_num, attempt_score FROM `attempts` WHERE attempt_score <= '2' AND attempt_num = '2';";
                    break;
                case "deleteattempt":
                    if (!(($first_name && $last_name) or $student_num)) {
                        echo "<p>Error! Name or ID input error. Please go back.</p>";
                    } else {
                        if ($first_name && $last_name) {
                            $sql = "DELETE FROM `attempts` WHERE first_name = '$first_name' AND last_name = '$last_name';";
                        } else {
                            $sql = "DELETE FROM `attempts` WHERE student_num = '$student_num';";
                        }
                        echo "<p>Attempts deleted</p>";
                    }
                    break;
                case "changescore":
                    if (!((($first_name && $last_name) || $student_num) && ($attempt_num != 'none' && $attempt_score != 'none'))) {
                        echo "<p>Error! Name or input error. Please go back.</p>";
                    } else {
                        if ($first_name && $last_name) {
                            $sql = "UPDATE `attempts` SET `attempt_score` = '$attempt_score' WHERE `attempt_num` = '$attempt_num' AND `first_name` = '$first_name' AND `last_name` = '$last_name';";
                        } else {
                            $sql = "UPDATE `attempts` SET `attempt_score` = '$attempt_score' WHERE `attempt_num` = '$attempt_num' AND `student_num` = '$student_num';";
                        }
                    }
                    break;
            }
            if (!$sql) {
                "<p>Query error</p>";
            } else {
                $database = @mysqli_connect($host, $user, $pwd, $dbname);
                if ($query === "deleteattempt") {
                    mysqli_close($database);
                } elseif ($query === "changescore") {
                    mysqli_query($database, $sql);
                    echo "<p>Update successful</p>";
                    if ($first_name && $last_name) {
                        $sql = "SELECT first_name, last_name, student_num, attempt_num, attempt_score FROM `attempts` WHERE first_name = '$first_name' AND last_name = '$last_name';";
                    } else {
                        $sql = "SELECT first_name, last_name, student_num, attempt_num, attempt_score FROM `attempts` WHERE student_num = '$student_num';";
                    }
                    print_table($database, $sql);
                } else {
                    print_table($database, $sql);
                }
            }
            ?>
        </div>
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