<?php
session_start();

function GenerateQuestions($numQuestions, $min, $max, $operation){
    $questions =[];
    for ($i =0; $i < $numQuestions; $i++){
        $num1 = rand($min, $max);
        $num2 = rand($min, $max);

        switch ($operation){
            case 'addition':
                $symbol = '+';
                $answer = $num1 + $num2;
                break;
            case 'subtraction':
                $symbol = '-';
                $answer = $num1 - $num2;
                break;
            case 'multiplication':
                $symbol = 'x';
                $answer = $num1 * $num2;
                break;
            default:
                $symbol ='+';
                $answer = $num1 + $num2;
        }

        $choices = GenerateChoices($answer);
        $questions[] = [
            'question' =>"$num1 $symbol $num2",
            'answer' => $answer,
            'choices' => $choices
        ];
    }
    return $questions;
}
// Generate choice options
function GenerateChoices($correctAnswer){
    $choices = [$correctAnswer];
    while(count($choices) < 4){
        $randomChoice = $correctAnswer + rand (-10, 10);
        if ($randomChoice !== $correctAnswer && !in_array($randomChoice, $choices)) {
            $choices[] = $randomChoice;
        }
    }
    shuffle($choices);
    return $choices;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['start_quiz'])) {
    $level = $_POST['level'];
    $operation = $_POST['operation'];
    $numQuestions = $_POST['num_questions'];
    $customMin = $_POST['custom_min'] ?? 1;
    $customMax = $_POST['custom_max'] ?? 10;

        // Set range based on level
        switch ($level) {
            case '1':
                $min = 1;
                $max = 10;
                break;
            case '2':
                $min = 11;
                $max = 100;
                break;
            case 'custom':
                $min = $customMin;
                $max = $customMax;
                break;
            default:
                $min = 1;
                $max = 10;
        }
// Generate questions
        $_SESSION['questions'] = GenerateQuestions($numQuestions, $min, $max, $operation);
        $_SESSION['current_question'] = 0;
        $_SESSION['score'] = ['correct' => 0, 'wrong' => 0];
}
    
    if (isset($_SESSION['questions'])) 
        $currentIndex = $_SESSION['current_question'];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
        $userAnswer = intval($_POST['answer']);
        $correctAnswer = $_SESSION['questions'][$currentIndex]['answer'];
    
            if ($userAnswer === $correctAnswer) {
                $_SESSION['score']['correct']++;
            } else {
                $_SESSION['score']['wrong']++;
            }
    
            $_SESSION['current_question']++;
    }

// If quiz is finished
        if ($_SESSION['current_question'] >= count($_SESSION['questions'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .results-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h2 {
            color: #2c3e50;
        }
        .score {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .correct {
            color: #27ae60;
        }
        .wrong {
            color: #e74c3c;
        }
        .restart-btn {
            display: inline-block;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .restart-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
<div class="results-container">
                <h2>Quiz Results</h2>
                <div class="score">
                    <p class="correct">Correct: <?php echo $_SESSION['score']['correct']; ?></p>
                    <p class="wrong">Wrong: <?php echo $_SESSION['score']['wrong']; ?></p>
                </div>
                <a href="index.php" class="restart-btn">Restart Quiz</a>
            </div>
        </body>
</body>
</html>
<?php
        session_destroy();
        exit;
    }
    // Display the next question
    $currentQuestion = $_SESSION['questions'][$_SESSION['current_question']];

    ?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Math Quiz</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f0f4f8;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .quiz-container {
                background-color: white;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                padding: 30px;
                text-align: center;
                max-width: 400px;
                width: 100%;
            }
            h2 {
                color: #2c3e50;
                margin-bottom: 20px;
            }
            .question {
                font-size: 24px;
                margin-bottom: 20px;
                color: #34495e;
            }
            form {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
            .choice {
                background-color: #f1f5f9;
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 10px;
                display: flex;
                align-items: center;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }
            .choice:hover {
                background-color: #e2e8f0;
            }
            .choice input {
                margin-right: 10px;
            }
            button {
                background-color: #3498db;
                color: white;
                border: none;
                padding: 12px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
                margin-top: 15px;
            }
            button:hover {
                background-color: #2980b9;
            }
        </style>
    </head>
    <body>
        <div class="quiz-container">
            <h2>Question <?php echo $_SESSION['current_question'] + 1; ?></h2>
            <p class="question"><?php echo $currentQuestion['question']; ?></p>
            <form method="post">
                <?php foreach ($currentQuestion['choices'] as $choice): ?>
                    <label class="choice">
                        <input type="radio" name="answer" value="<?php echo $choice; ?>" required>
                        <?php echo $choice; ?>
                    </label>
                <?php endforeach; ?>
                <button type="submit">Submit Answer</button>
            </form>
        </div>
    </body>
    </html>