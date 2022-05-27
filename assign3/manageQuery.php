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
            <li class="mode"><a href="manageQueryLight.php">Light Mode</a></li>
            <li class="mode"><a href="authenticate.php">User</a></li>
            <li class="mode selected"><a href="manageQuery.php">⚙</a></li>
        </ul>
    </header>
    <main id="queries-background">
        <h1>Settings</h1>

        <?php
        session_start();

        if (isset($_SESSION['loggedin'])) {
            echo "  <div class='row'>
            <div class='column'>
                <form id='regform' method='post' action='manage.php' novalidate='novalidate' class='queries'>
                    <h2>Queries</h2>
                    <p><label for='query'>Enter a query</label></p>
                    <select name='query' id='query'>
                        <option value='none'>Please select</option>
                        <option value='all'>List all attempts</option>
                        <option value='allforstudent'>List all attempts for a particular student</option>
                        <option value='allstudent100'>List all students who got 100% on their first attempt</option>
                        <option value='allstudent50'>List all students who got less than 50% on their second attempt
                        </option>
                        <option value='deleteattempt'>Delete all attempts for a particular student</option>
                        <option value='changescore'>Change the score for a quiz attempt</option>
                    </select> <br>
                    <p><label for='first_name'>Enter student's first name</label></p>
                    <input type='text' name='first_name' id='first_name' size='20'> <br>
                    <p><label for='last_name'>Enter student's last name</label></p>
                    <input type='text' name='last_name' id='last_name' size='20'>
                    <p><label for='student_num'>Enter student ID</label></p>
                    <input type='text' name='student_num' id='student_num' size='20'>
                    <p><label for='attempt_num'>Select attempt num</label></p>
                    <select name='attempt_num' id='attempt_num'>
                        <option value='none'>Please Select</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                    </select>
                    <p><label for='attempt_score'>Select new attempt score</label></p>
                    <select name='attempt_score' id='attempt_score'>
                        <option value='none'>Please Select</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                    </select> <br>
                    <br>
                    <div class='button-container'>
                        <input type='submit' name='submit' value='SUBMIT' id='submit-btn'>
                        <input type='reset' name='reset' value='RESET' id='reset-btn'>
                    </div>
                </form>
            </div>

            <div class='column'>
                <section class='query-information queries'>
                    <h2>Query Information</h2>
                    <ul>
                        <h3>List all attempts</h3>
                        <li> No input required</li>
                        <h3>List all attempts for a particular student</h3>
                        <li> Requires first name & last name or student ID</li>
                        <h3>List all students who scored 100%</h3>
                        <li> No input required</li>
                        <h3>List all students who scored less than 50%</h3>
                        <li> No input required</li>
                        <h3>Delete all attempts for a particular student</h3>
                        <li> Requires first name & last name or student ID</li>
                        <h3>Change the score for a quiz attempt</h3>
                        <li> Requires first name & last name or student ID, attempt number and new score</li>
                    </ul>
                </section>
            </div>
        </div>";
        } else {
            echo ("<section class='panel'>
            You must be logged in to continue
        </section>");
        }
        ?>

    </main>

    <?php
    include "footer.inc"
    ?>

</body>

</html>