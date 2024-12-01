<?php
session_start();

function GenerateQuestions($numQuestions, $min, $max, $operation){
    $questions =[];
    for ($i =0; $i <$numQuestions; $i++){
        $num1 = rand($min, $max);
        $num2 = rand($min, $max);

        switch ($operation){
            case 'addtion':
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

        $choices = GenerateQuestions($answer);
        $questions[] =[
            'question' =>"$num1 $symbol $num2",
            'answer' => $answer,
            'choices' => $choices
        ];
    }
    return $questions;
}

function GenerateChoices($correctAnswer){
    $choices = [$correctanswer]
        while(count($choices)< 4){
            $randomChoice = $correctAnswer =rand (-10, 10);
            if ($randomChoice !== $correctAnswer && !($randomChoice, $choices)){
                $choices[]=$randomChoice;
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

        $_SESSION['questions'] = GenerateQuestions($numQuestions, $min, $max, $operation);
        $_SESSION['current_question'] = 0;
        $_SESSION['score'] = ['correct' => 0, 'wrong' => 0];
    }
    

?>