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
        <a class="logo" href="index.html"><img src="images/nodejslogo.png" width="30" alt="logo"></a>
        <input type="checkbox" class="menu-checkbox" id="menu-checkbox">
        <label class="hamburger-icon" for="menu-checkbox"><span class="nav-icon"></span></label>

        <ul class="menu five-item-menu">
            <li><a href="index.html">Home</a></li>
            <li><a href="topic.html">Topic</a></li>
            <li><a href="quiz.php">Quiz</a></li>
            <li><a href="enhancements.html">Enhancements</a></li>
            <li><a href="enhancements2.html">PHP Enhancements</a></li>
            <li class="mode"><a href="authenticate.php">User</a></li>
            <li class="mode selected"><a href="quizLight.php">⚙</a></li>
        </ul>
    </header>

    <main id="quiz-background">
        <h1>Quiz</h1>

        <?php
        require_once("login.php");
        $database = @mysqli_connect($host, $user, $pwd, $dbname);

        if (!$database) {
            echo "<section class='results'>\n";
            echo "<h2>Error</h2>\n";
            echo "<p>Connection error: " . mysqli_connect_error() . "</p>\n";
            echo "</section>\n";
        } else {
            new mysqli($host, $user, $pwd, $dbname);

            $sql = "CREATE TABLE IF NOT EXISTS `questions` (
				`id` INT AUTO_INCREMENT PRIMARY KEY,
				`question` VARCHAR(100) NOT NULL,
                `answers` VARCHAR(150),
				`correct_answer` VARCHAR(120) NOT NULL,
                `question_type` VARCHAR(15) NOT NULL,
                `pattern` VARCHAR(40)
			)";

            if ($database->query($sql) != TRUE) {
                echo "<section class='results'>";
                echo "<h2>Error</h2>\n";
                echo "<p>Error creating table: " . $database->error . "</p>\n";
                echo "</section>";
            } else {
                require("functions.php");
                $query = "SELECT * FROM `questions` ORDER BY RAND () LIMIT 5";
                $result = mysqli_query($database, $query);
                $rowCount = mysqli_num_rows($result);

                // printf("Total rows in this table : %d\n", $rowCount);

                if ($rowCount == 0) {
                    $query_one = "INSERT INTO questions (id, question, answers, correct_answer, question_type)
                    VALUES(1, 'What language does Node.js support natively?', NULL, 'JavaScript', 'text')";

                    $query_two = "INSERT INTO questions (id, question, answers, correct_answer, question_type)
                    VALUES(2, 'Which engine, developed by Google, was Node.js built on?', 'V2,V4,V6,V8', 'V8', 'radio')";

                    $query_three = "INSERT INTO questions (id, question, answers, correct_answer, question_type)
                    VALUES(3, 'Tick all of the following which apply to Node.js', 'Quick set up,High rate of growth,Multi-threaded paradigm,Uses JavaScript Engine', 'Quick set up,High rate of growth,Uses the JavaScript Engine', 'checkbox')";

                    $query_four = "INSERT INTO questions (id, question, answers, correct_answer, question_type)
                    VALUES(4, 'Who created Node.js?', 'Bill Gates, Mark Zuckerberg, Ryan Dahl, Steve Jobs', 'Ryan Dahl', 'option')";

                    $query_five = "INSERT INTO questions (id, question, correct_answer, question_type)
                    VALUES(5, 'What year was the initial release year of Node.js?', 2009, 'number')";

                    $query_six = "INSERT INTO questions (id, question, answers, correct_answer, question_type)
                    VALUES(6, 'Node.js is used for which type of developement?', 'Front-end,Back-end,Full-stack,Desktop', 'Full-stack', 'radio')";

                    $query_seven = "INSERT INTO questions (id, question, answers, correct_answer, question_type)
                    VALUES(7, 'Which of the following is a direct competitor to Node.js', 'Twitter,FaceBook,React,Django', 'Django', 'radio')";

                    $result_one = mysqli_query($database, $query_one);
                    $result_two = mysqli_query($database, $query_two);
                    $result_three = mysqli_query($database, $query_three);
                    $result_four = mysqli_query($database, $query_four);
                    $result_five = mysqli_query($database, $query_five);
                    $result_six = mysqli_query($database, $query_six);
                    $result_seven = mysqli_query($database, $query_seven);

                    echo "<section class='quiz'>";
                    echo "<p>Inserted default questions, please refresh browser to view</p>";
                    echo "</section>";
                } else {
                    echo "<section class='quiz'>";
                    echo "<form method='post' action='markQuiz.php' novalidate>";
                    echo "<h2>Details</h2>";
                    echo "<fieldset>
                    <label for='firstName'>First
                        Name</label>
                    <br />
                    <input type='text' id='firstName' name='firstName' maxlength='30' size='10' required
                        pattern='^[a-zA-Z -]+$' placeholder='First Name' />
                    <br />
                    <label for='lastName'>Last Name</label>
                    <br />
                    <input type='text' id='lastName' name='lastName' maxlength='30' size='10' required
                        pattern='^[a-zA-Z -]+$' placeholder='Last Name' />
                    <br />
                    <label for='studentId'>Student ID:</label>
                    <br />
                    <input type='text' name='studentId' id='studentId' size='10' pattern='\d{7}|\d{10}'
                        placeholder='Student ID' required />
                    </fieldset>
                    <h2>Questions</h2>";

                    $questionArray = [];

                    while ($record = mysqli_fetch_assoc($result)) {
                        echo "<fieldset>";

                        array_push($questionArray, $record["id"]);

                        if ($record["question_type"] == 'number') {
                            echo '<legend>', $record["question"], '</legend>';
                            echo '<input type="', $record["question_type"], '" id="question', $record["id"], '" name ="question', $record["id"], '" required />';
                        }

                        if ($record["question_type"] == 'radio') {
                            $answers = explode(',', $record["answers"]);
                            $inputCount = count($answers) - 1;

                            echo '<legend>', $record["question"], '</legend>';
                            while (0 <= $inputCount) {
                                echo '<label><input type="radio" name="question', $record["id"], '" value="', $answers[$inputCount], '" id="', $answers[$inputCount], '" ';

                                if ($inputCount == 4) {
                                    echo 'required';
                                }

                                echo '/>', $answers[$inputCount], '</label>';

                                $inputCount--;
                            }
                        }

                        if ($record["question_type"] == 'checkbox') {
                            $answers = explode(',', $record["answers"]);
                            $inputCount = count($answers) - 1;

                            echo '<legend>', $record["question"], '</legend>';
                            while (0 <= $inputCount) {
                                echo '<label><input type="checkbox" name="question', $record["id"], '[]" value="', $answers[$inputCount], '"/>', $answers[$inputCount], '</label><br>';

                                $inputCount--;
                            }
                        }

                        if ($record["question_type"] == 'text') {
                            echo '<legend>', $record["question"], '</legend>';
                            echo '<input type="', $record["question_type"], '" id="question', $record["id"], '" name ="question', $record["id"], '"maxLength="15" size="10"  pattern="[A-Za-z -]{1,15}" required>';
                        }

                        if ($record["question_type"] == 'option') {
                            $answers = explode(',', $record["answers"]);
                            $inputCount = count($answers) - 1;

                            echo '<legend>', $record["question"], '</legend>';
                            echo '<select id="question', $record["id"], '" name="question', $record["id"], '" >';
                            echo '<option value="">Please Select</option>';

                            while (0 <= $inputCount) {
                                echo '<option value="', $answers[$inputCount], '">', $answers[$inputCount], '</option>';
                                $inputCount--;
                            }

                            echo '</select>';
                        }

                        echo "</fieldset>";
                    }
                    $questionString = implode(",", $questionArray);

                    echo '<fieldset><input type="hidden" name="questionString" id="questionArray" value="', $questionString, '"> </input></fieldset>';

                    echo "<div class='button-container'>
                    <input type='submit' name='submit' value='SUBMIT' id='submit-btn'>
                    <input type='reset' name='reset' value='RESET' id='reset-btn'>
                    </div>";

                    echo "</form>";
                    echo "</section>";
                }
            }

            mysqli_close($database);
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