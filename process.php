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
?>