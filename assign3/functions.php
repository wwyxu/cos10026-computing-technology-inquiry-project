<?php
// Sanitise data
function sanitise_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

// Get data functions
function getData($externalVar, $redirect) {
	if (isset($_POST[$externalVar])) {
		$localVar = $_POST[$externalVar];
		$localVar = sanitise_input($localVar);
	} else {
		// Redirect to form, if process not triggered by a form submit
		header("location: $redirect");
	}
	return $localVar;
}

function getArrayData($externalVar, $redirect) {
	if (isset($_POST[$externalVar])) {
		$localArray = array();
		$localVar = $_POST[$externalVar];
		foreach ($localVar as $choice) {
			$choice = sanitise_input($choice);
			array_push($localArray, $choice);
		}
	} else {
		// Redirect to form, if process not triggered by a form submit
		header("location: $redirect");
	}
	return $localArray;
}

// Type checking function
function pregMatchArray($pattern, $answer) {
	$i = 0;
	foreach ($answer as $option) {
		$i += preg_match($pattern, $option);
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

// Mark question functions
function markQuestion($selection, $answer) {
	if ($selection == $answer) {
		return 1;
	}
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

// Incorrect answers functions
function incorrectAnswer($mark, $givenAnswer, $correctAnswer, $i) {
	if ($mark != 1) {
		echo "<h3>Question $i</h3>\n";
		echo "<p>Your Answer: $givenAnswer</p>\n";
		echo "<p>Correct Answer: $correctAnswer</p>\n";
	}
}

function incorrectAnswerArray($mark, $givenAnswer, $correctAnswer, $i) {
	if ($mark != 1) {
		echo "<h3>Question $i</h3>\n";
		echo "<p>Your Answer: </p>\n";
		echo "<ul>\n";
		foreach ($givenAnswer as $choice) {
			echo "<li>$choice</li>\n";
		}
		echo "</ul>\n";
		echo "<p>Correct Answer: </p>\n";
		echo "<ul>\n";
		foreach ($correctAnswer as $choice) {
			echo "<li>$choice</li>\n";
		}
		echo "</ul>\n";
	}
}

// Incorrect type functions
function incorrectType($match, $answer, $i, $message, $nothingMessage) {
	if ($match != 1) {
		echo "<h3>$i</h3>\n";
		if ($answer == "") {
			echo "<p>$nothingMessage</p>\n";
		} else {
			echo "<p>$message</p>\n";
		}
	}
}

function incorrectTypeArray($match, $answer, $i, $message, $nothingMessage) {
	if ($match != 1) {
		echo "<h3>$i</h3>\n";
		if ($answer[0] == "") {
			echo "<p>$nothingMessage</p>\n";
		} else {
			echo "<p>$message</p>\n";
		}
	}
}

?>