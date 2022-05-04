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
    <a class="logo" href="index.html"><img src="images/nodejslogo.png" width="30" alt="logo"></a>
    <input type="checkbox" class="menu-checkbox" id="menu-checkbox">
    <label class="hamburger-icon" for="menu-checkbox"><span class="nav-icon"></span></label>

    <!-- Menu -->
    <ul class="menu six-item-menu">
        <li><a href="index.html">Home</a></li>
        <li><a href="topic.html">Topic</a></li>
        <li><a href="quiz.html">Quiz</a></li>
        <li><a href="enhancements.html">Enhancements</a></li>
        <li><a class="selected" href="markquiz.php">Results</a></li>
        <li class="mode"><a href="markquizLight.php">Light Mode</a></li>
    </ul>
</header>

<main id="results-background">
	<h1>Quiz Results</h1>
	<?php
		// Login to the database
		require_once("login.php");
		$database = @mysqli_connect($host, $user, $pwd, $dbname);

		if (!$database) {
			echo "<section class='results'>";
			echo "<p>Connection error: " . mysqli_connect_error() . "</p>";
			echo "</section>";
		}

		require("functions.php");

		// GET DATA FROM FORM
		$firstName = getData('firstName');
		$lastName = getData('lastName');
		$studentId = getData('studentId');
		$question1 = getData('question1');
		$question2 = getData('question2');
		$question3 = getArrayData('question3');
		$question4 = getData('question4');
		$question5 = getData('question5');

		// Get no. attempts
		$attemptsQry =
		"SELECT attempt_num FROM attempts
		WHERE student_num = '$studentId'";
		$attempts = mysqli_query($database, $attemptsQry);
		$noAttempts = mysqli_fetch_all($attempts);
		$noAttempts = sizeof($noAttempts) + 1;

		// TYPE CHECK RESPONSES
		$firstNameMatch = preg_match("/^[a-zA-Z -]{1,30}$/", $firstName);
		$lastNameMatch = preg_match("/^[a-zA-Z -]{1,30}$/", $lastName);
		$studentIdMatch = preg_match("/^(\d{7}|\d{10})$/", $studentId);
		$q1Match = preg_match("/^[A-Za-z -]{1,15}$/", $question1);
		$q2Match = preg_match("/^[\dA-Za-z]{1,2}$/", $question2);
		$q3Match = pregMatchArray("/^[A-Za-z -]{1,26}$/", $question3);
		$q4Match = preg_match("/^[A-Za-z ]{1,15}$/", $question4);
		$q5Match = preg_match("/^\d{4}$/", $question5);

		// Final score
		$typeCheckScore = $firstNameMatch + $lastNameMatch + $studentIdMatch + $q1Match + $q2Match + $q3Match + $q4Match + $q5Match;

		// MARK QUESTIONS
		$q1Answer = array("javascript", "js");
		$question1Lower = strtolower($question1);
		$q1Mark = markQuestionOr($question1Lower, $q1Answer);
		$q2Mark = markQuestion($question2, "V8");
		$q3Answer = array("Quick set up", "High rate of growth", "Uses the JavaScript Engine");
		$q3Mark = markQuestionAnd($question3, $q3Answer);
		$q4Mark = markQuestion($question4, "Ryan Dahl");
		$q5Mark = markQuestion($question5, 2009);

		// Final score
		$attemptScore = $q1Mark + $q2Mark + $q3Mark + $q4Mark + $q5Mark;

		// DISPLAY RESULTS
		if ($typeCheckScore != 8) {
			// Incorrect Types
			echo "<section class='results'>";
			echo "<h2>Error</h2>";
			incorrectType($firstNameMatch, $firstName, "First Name", "Only up to 30 letters, spaces or hyphens allowed in your first name.", "You must enter your first name.");
			incorrectType($lastNameMatch, $lastName, "Last Name", "Only up to 30 letters, spaces or hyphens allowed in your last name.", "You must enter your last name.");
			incorrectType($studentIdMatch, $studentId, "Student ID", "Your student ID must be a 7 or 10 digit number.", "You must enter your Student ID.");
			incorrectType($q1Match, $question1, "Question 1", "Only up to 15 letters, spaces or hyphens allowed in Question 1.", "You must enter an answer for Question 1.");
			incorrectType($q2Match, $question2, "Question 2", "Only up to 2 letters or numbers allowed in Question 2.", "You must select an answer for Question 2.");
			incorrectTypeArray($q3Match, $question3, "Question 3", "Question 3 answers can only have up to 25 letters, spaces or hyphens.", "You must select at least one answer for Question 3.");
			incorrectType($q4Match, $question4, "Question 4", "Only up to 15 letters or spaces allowed in Question 4.", "You must select an answer for Question 4.");
			incorrectType($q5Match, $question5, "Question 5", "Only a 4 digit year allowed in Question 5.", "You must enter an answer for Question 5.");
			echo "<p class='results-btn-container'><a href='quiz.html' class='results-button'>Retry the quiz</a></p>";
			echo "</section>";
		} else {
			if ($noAttempts > 2) {
				// Exceeded Attempt Limit
				echo "<section class='results exceeded'>";
				echo "<h2>Exceeded Attempt Limit</h2>";
				echo "<p>Sorry, you have had the maximum amount of attempts for this quiz.</p>";
				echo "<p class='results-btn-container'><a href='index.html' class='results-button'>Go to the home page</a></p>";
				echo "</section>";

			} else {
				// Details
				echo "<section class='results'>";
				echo "<h2>Details</h2>";
				echo "<p>Name: $firstName $lastName</p>";
				echo "<p>Student ID: $studentId</p>";
				echo "<p>Score: $attemptScore</p>";
				echo "<p>Number of attempts: " . $noAttempts . "</p>";

				// Incorrect Answers
				if ($attemptScore == 5) {
					echo "<h2>Congraluations! You got everything correct!</h2>";
				} else {
					echo "<h2>Incorrect Answers</h2>";

					// Display incorrect answers
					incorrectAnswer($q1Mark, $question1, "JavaScript", 1);
					incorrectAnswer($q2Mark, $question2, "V8", 2);
					$question3Answer = array("Quick set up", "High rate of growth", "Uses the JavaScript Engine");
					incorrectAnswerArray($q3Mark, $question3, $question3Answer, 3);
					incorrectAnswer($q4Mark, $question4, "Ryan Dahl", 4);
					incorrectAnswer($q5Mark, $question5, 2009, 5);
				}
				echo "<p class='results-btn-container'><a href='quiz.html' class='results-button'>Take the quiz again</a></p>";
				echo "</section>";

				// Insert record into database
				$date = date("Y-m-d");
				$insertQry =
				"INSERT INTO attempts (dt, first_name, last_name, student_num, attempt_num, attempt_score)
				VALUES ('$date', '$firstName', '$lastName', $studentId, " . $noAttempts . ", $attemptScore)";
				mysqli_query($database, $insertQry);
			}
		}

		// Close database and clean up
		mysqli_close($database);
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
