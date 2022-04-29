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
    <a class="logo" href="index.html"><img src="images/nodejslogo2.png" width="30" alt="logo"></a>
    <input type="checkbox" class="menu-checkbox" id="menu-checkbox">
    <label class="hamburger-icon" for="menu-checkbox"><span class="nav-icon"></span></label>

    <!-- Menu -->
    <ul class="menu six-item-menu">
        <li><a href="indexLight.html">Home</a></li>
        <li><a href="topicLight.html">Topic</a></li>
        <li><a href="quizLight.html">Quiz</a></li>
        <li><a href="enhancementsLight.html">Enhancements</a></li>
        <li><a class="selected" href="markquizLight.php">Results</a></li>
        <li class="mode"><a href="markquiz.php">Dark Mode</a></li>
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

		// Sanitise data
		function sanitise_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		// GET DATA FROM FORM

		// Get data functions
		function getData($externalVar) {
			if (isset($_POST[$externalVar])) {
				$localVar = $_POST[$externalVar];
				$localVar = sanitise_input($localVar);
			} else {
				// Redirect to form, if process not triggered by a form submit
				header("location: quizLight.html");
			}
			return $localVar;
		}

		function getArrayData($externalVar) {
			if (isset($_POST[$externalVar])) {
				$localArray = array();
				$localVar = $_POST[$externalVar];
				foreach ($localVar as $choice) {
					$choice = sanitise_input($choice);
					array_push($localArray, $choice);
				}
			} else {
				// Redirect to form, if process not triggered by a form submit
				header("location: quizLight.html");
			}
			return $localArray;
		}

		// Get form data
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

		// MARK QUESTIONS

		// Mark question functions
		function markQuestion($selection, $answer) {
			if ($selection == $answer) {
				$i = 1;
			}
			return $i;
		}

		function markQuestionAnd($selection, $answer) {
			$i = 0;
			foreach ($selection as $j) {
				foreach ($answer as $k) {
					if ($j == $k) {
						$i += 1;
					}
				}
			}

			$answerSize = sizeof($answer);
			if ($i != 0) {
				if ($answerSize / $i == 1) {
					return 1;
				} else {
					return 0;
				}
			} else {
				return 0;
			}
		}

		function markQuestionOr($selection, $answer) {
			foreach ($answer as $option) {
				if ($selection == $option) {
					return 1;
				}
			}
		}

		// Mark questions
		$q1Answer = array("javascript", "js");
		$question1Lower = strtolower($question1);
		$q1 = markQuestionOr($question1Lower, $q1Answer);
		$q2 = markQuestion($question2, "V8");
		$q3Answer = array("Quick set up", "High rate of growth", "Uses the JavaScript Engine");
		$q3 = markQuestionAnd($question3, $q3Answer);
		$q4 = markQuestion($question4, "Ryan Dahl");
		$q5 = markQuestion($question5, 2009);

		// Final score
		$attemptScore = $q1 + $q2 + $q3 + $q4 + $q5;

		// DISPLAY RESULTS

		if ($noAttempts > 2) {

			// Exceeded Attempt Limit
			echo "<section class='results exceeded'>";
			echo "<h2>Exceeded Attempt Limit</h2>";
			echo "<p>Sorry, you have had the maximum amount of attempts for this quiz.</p>";
			echo "<p class='results-btn-container'><a href='indexLight.html' class='results-button'>Go to the home page</a></p>";
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

				// Incorrect answers functions
				function incorrectAnswer($mark, $givenAnswer, $correctAnswer, $i) {
					if ($mark != 1) {
						echo "<h3>Question $i</h3>";
						echo "<p>Your Answer: $givenAnswer</p>";
						echo "<p>Correct Answer: $correctAnswer</p>";
					}
				}

				function incorrectAnswerArray($mark, $givenAnswer, $correctAnswer, $i) {
					if ($mark != 1) {
						echo "<h3>Question $i</h3>";
						echo "<p>Your Answer: ";
						echo "<ul>";
						foreach ($givenAnswer as $choice) {
							echo "<li>$choice</li>";
						}
						echo "</ul>";
						echo "<p>Correct Answer: </p>";
						echo "<ul>";
						foreach ($correctAnswer as $choice) {
							echo "<li>$choice</li>";
						}
						echo "</ul>";
					}
				}

				// Display incorrect answers
				incorrectAnswer($q1, $question1, "JavaScript", 1);
				incorrectAnswer($q2, $question2, "V8", 2);
				$question3Answer = array("Quick set up", "High rate of growth", "Uses the JavaScript Engine");
				incorrectAnswerArray($q3, $question3, $question3Answer, 3);
				incorrectAnswer($q4, $question4, "Ryan Dahl", 4);
				incorrectAnswer($q5, $question5, 2009, 5);
			}

			echo "<p class='results-btn-container'><a href='quizLight.html' class='results-button'>Take the quiz again</a></p>";
			echo "</section>";

			// Insert record into database
			$date = date("Y-m-d");
			$insertQry =
			"INSERT INTO attempts (dt, first_name, last_name, student_num, attempt_num, attempt_score)
			VALUES ('$date', '$firstName', '$lastName', $studentId, " . $noAttempts . ", $attemptScore)";
			mysqli_query($database, $insertQry);

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
