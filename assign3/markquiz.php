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
			<li><a href="quiz.php">Quiz</a></li>
			<li><a href="enhancements.html">Enhancements</a></li>
			<li><a href="enhancements2.html">PHP Enhancements</a></li>
			<li><a class="selected" href="markQuiz.php">Results</a></li>
			<!-- <li class="mode"><a href="markQuizLight.php">Light Mode</a></li> -->
			<li class="mode"><a href="authenticate.php">User</a></li>
			<li class="mode"><a href="manageQuery.php">⚙</a></li>
		</ul>
	</header>

	<main id="results-background">
		<h1>Quiz Results</h1>
		<?php
		// Login to the database
		require_once("login.php");
		$database = @mysqli_connect($host, $user, $pwd, $dbname);

		// Check if database connection was successful
		if (!$database) {
			echo "<section class='results'>\n";
			echo "<h2>Error</h2>\n";
			echo "<p>Connection error: " . mysqli_connect_error() . "</p>\n";
			echo "</section>\n";
		} else {
			// CREATE ATTEMPTS TABLE IF NOT EXISTS
			new mysqli($host, $user, $pwd, $dbname);

			// sql to create table
			$sql = "CREATE TABLE IF NOT EXISTS `attempts` (
				`attempt_id` INT AUTO_INCREMENT PRIMARY KEY,
				`dt` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				`first_name` VARCHAR(30) NOT NULL,
				`last_name` VARCHAR(30) NOT NULL,
				`student_num` INT,
				`attempt_num` INT,
				`attempt_score` INT
			)";
			// Check if table exists
			#$existsQry = "SELECT * FROM `attempts`";
			#$result = mysqli_query($database, $existsQry);
			// Display error with creating table if table doesn't exist
			if ($database->query($sql) != TRUE) {
				echo "<section class='results'>";
				echo "<h2>Error</h2>\n";
				echo "<p>Error creating table: " . $database->error . "</p>\n";
				echo "</section>";
			} else {
				// $query = "SELECT * FROM `questions` ORDER BY RAND () LIMIT 5";
				// $result = mysqli_query($database, $query);
				// $rowCount = mysqli_num_rows($result);

				require("functions.php");

				// GET DATA FROM FORM
				$firstName = getData('firstName', 'quiz.php');
				$lastName = getData('lastName', 'quiz.php');
				$studentId = getData('studentId', 'quiz.php');
				$questionString = getData('questionString', 'quiz.php');
				$question1 = getData('question1', 'quiz.php');
				$question2 = getData('question2', 'quiz.php');
				$question3 = getArrayData('question3', 'quiz.php');
				$question4 = getData('question4', 'quiz.php');
				$question5 = getData('question5', 'quiz.php');
				$question6 = getData('question6', 'quiz.php');
				$question7 = getData('question7', 'quiz.php');

				$questionArrayString = explode(',', $questionString);
				$questionArray = array_map('intval', $questionArrayString);

				// Get no. attempts
				$attemptsQry =
					"SELECT attempt_num FROM attempts
				WHERE student_num = '$studentId'";
				$attempts = mysqli_query($database, $attemptsQry);

				// Check if attempts query worked
				if (!$attempts) {
					echo "<section class='results'>\n";
					echo "<h2>Error</h2>\n";
					echo "<p>Something is wrong with the attempts query: " . $attemptsQry . "</p>\n";
					echo "</section>\n";
				} else {
					$noAttempts = mysqli_fetch_all($attempts);
					$noAttempts = sizeof($noAttempts) + 1;

					// TYPE CHECK RESPONSES
					$firstNameMatch = preg_match("/^[a-zA-Z -]{1,30}$/", $firstName);
					$lastNameMatch = preg_match("/^[a-zA-Z -]{1,30}$/", $lastName);
					$studentIdMatch = preg_match("/^(\d{7,10})$/", $studentId);
					$q1Match = preg_match("/^[A-Za-z -]{1,15}$/", $question1);
					$q2Match = preg_match("/^[\dA-Za-z]{1,2}$/", $question2);
					$q3Match = pregMatchArray("/^[A-Za-z -]{1,26}$/", $question3);
					$q4Match = preg_match("/^[A-Za-z ]{1,15}$/", $question4);
					$q5Match = preg_match("/^\d{4}$/", $question5);
					$q6Match = preg_match("/^[A-Za-z -]{1,15}$/", $question6);
					$q7Match = preg_match("/^[A-Za-z -]{1,15}$/", $question7);

					// Final score
					$typeCheckScore = $firstNameMatch + $lastNameMatch + $studentIdMatch + $q1Match + $q2Match + $q3Match + $q4Match + $q5Match + $q6Match + $q7Match;

					// MARK QUESTIONS
					$q1Answer = array("javascript", "js");
					$question1Lower = strtolower($question1);
					$q1Mark = markQuestionOr($question1Lower, $q1Answer);
					$q2Mark = markQuestion($question2, "V8");
					$q3Answer = array("Quick set up", "High rate of growth", "Uses the JavaScript Engine");
					$q3Mark = markQuestionAnd($question3, $q3Answer);
					$q4Mark = markQuestion($question4, "Ryan Dahl");
					$q5Mark = markQuestion($question5, 2009);
					$q6Mark = markQuestion($question6, "Full-stack");
					$q7Mark = markQuestion($question7, "Django");

					// Final score
					$attemptScore = $q1Mark + $q2Mark + $q3Mark + $q4Mark + $q5Mark + $q6Mark + $q7Mark;

					// DISPLAY RESULTS
					if ($typeCheckScore != 8) {
						// Incorrect Types
						echo "<section class='results'>\n";
						echo "<h2>Error</h2>\n";
						incorrectType($firstNameMatch, $firstName, "First Name", "Only up to 30 letters, spaces or hyphens allowed in your first name.", "You must enter your first name.");
						incorrectType($lastNameMatch, $lastName, "Last Name", "Only up to 30 letters, spaces or hyphens allowed in your last name.", "You must enter your last name.");
						incorrectType($studentIdMatch, $studentId, "Student ID", "Your student ID must be a 7 or 10 digit number.", "You must enter your Student ID.");

						foreach ($questionArray as $value) {
							if ($value == 1) {
								incorrectType($q1Match, $question1, "Error at Question 'What language does Node.js support natively?'. ", "Only up to 15 letters, spaces or hyphens allowed in Question 1.", "You must enter an answer for this question.");
							}

							if ($value == 2) {
								incorrectType($q2Match, $question2, "Error at Question 'Which engine, developed by Google, was Node.js built on?'.", "Only up to 2 letters or numbers allowed in Question 2.", "You must select an answer for this question.");
							}

							if ($value == 3) {
								incorrectTypeArray($q3Match, $question3, "Error at Question 'Tick all of the following which apply to Node.js'. ", "Question 3 answers can only have up to 25 letters, spaces or hyphens.", "You must select at least one answer for this question.");
							}

							if ($value == 4) {
								incorrectType($q4Match, $question4, "Error at Question 'Who created Node.js?'.", "Only up to 15 letters or spaces allowed in Question 4.", "You must select an answer for this question.");
							}

							if ($value == 5) {
								incorrectType($q5Match, $question5, "Error at Question 'What year was the initial release year of Node.js?'. ", "Only a 4 digit year allowed in Question 5.", "You must enter an answer for this question.");
							}

							if ($value == 6) {
								incorrectType($q6Match, $question6, "Error at Question 'Node.js is used for which type of developement?'.", "Only up to 25 letters or numbers allowed in Question 6.", "You must select an answer for this question.");
							}

							if ($value == 7) {
								incorrectType($q7Match, $question7, "Error at Question 'Which of the following is a direct competitor to Node.js'.", "Only up to 25 letters or numbers allowed in Question 7.", "You must select an answer for this question.");
							}
						}

						echo "<p class='results-btn-container'><a href='quiz.php' class='results-button'>Retry the quiz</a></p>\n";
						echo "</section>\n";
					} elseif ($noAttempts > 2) {
						// Exceeded Attempt Limit
						echo "<section class='results exceeded'>\n";
						echo "<h2>Exceeded Attempt Limit</h2>\n";
						echo "<p>Sorry, you have had the maximum amount of attempts for this quiz.</p>\n";
						echo "<p class='results-btn-container'><a href='index.html' class='results-button'>Go to the home page</a></p>\n";
						echo "</section>\n";
					} else {
						// Details
						echo "<section class='results'>\n";
						echo "<h2>Details</h2>\n";
						echo "<p>Name: $firstName $lastName</p>\n";
						echo "<p>Student ID: $studentId</p>\n";
						echo "<p>Score: $attemptScore</p>\n";
						echo "<p>Number of attempts: " . $noAttempts . "</p>\n";

						// Incorrect Answers
						if ($attemptScore == 5) {
							echo "<h2>Congraluations! You got everything correct!</h2>\n";
						} else {
							echo "<h2>Incorrect Answers</h2>\n";

							// Display incorrect answers
							incorrectAnswer($q1Mark, $question1, "JavaScript", 1);
							incorrectAnswer($q2Mark, $question2, "V8", 2);
							$question3Answer = array("Quick set up", "High rate of growth", "Uses the JavaScript Engine");
							incorrectAnswerArray($q3Mark, $question3, $question3Answer, 3);
							incorrectAnswer($q4Mark, $question4, "Ryan Dahl", 4);
							incorrectAnswer($q5Mark, $question5, 2009, 5);
							incorrectAnswer($q6Mark, $question6, "Full-stack", 6);
							incorrectAnswer($q7Mark, $question7, "Django", 7);
						}

						if ($noAttempts == 1) {
							echo "<p class='results-btn-container'><a href='quiz.php' class='results-button'>Take the quiz again</a></p>\n";
							echo "</section>\n";
						}

						// Insert record into database
						$date = date("Y-m-d H:i:s +1000"); // Date and time formatting
						$insertQry =
							"INSERT INTO attempts (dt, first_name, last_name, student_num, attempt_num, attempt_score)
						VALUES ('$date', '$firstName', '$lastName', $studentId, " . $noAttempts . ", $attemptScore)";
						$result = mysqli_query($database, $insertQry);

						// Checks if insert query worked
						if (!$result) {
							echo "<section class='results'>\n";
							echo "<h2>Error</h2>\n";
							echo "<p>Something is wrong with the insert query: " . $insertQry . "</p>\n";
							echo "</section>\n";
						}
					}
				}
			}
			// Close database and clean up
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