<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Quiz</title>

</head>
<body>
    <div class = "quiz-container">
        <h1> MATH QUIZ </h1>
        <form method="POST" action="process.php">
            <div class ="form-group">
                <label> Level:</label>
                <select name="level" required>
                    <option value="1"> Level 1 (1-10) </option>
                    <option value="2"> Level 2 (11-100) </option>
                    <option value="custom"> Custom  </option>
                </select>
            </div>

            <div class="form-group">
                <label> Custom Range (if applicable): </label>
                <div class="custom-range">
                    <input type="number" name="custom_min" placeholder="Min" min="1">
                    <input type="number" name="custom_max" placeholder="Max" min="1">
                </div>
            </div>

            <div class="form-group">
                <label>Operation:</label>
                <select name="operation" required>
                    <option value="addition"> Addition </option>
                    <option value="subtraction"> Subtraction </option>
                    <option value="multiplication"> Multiplication</option>
                </select>
            </div>

            <div class="from-group">
                <label> Number of Questons:</label>
                <input type="number" name="num_questions" value="5" min="1" required>
            </div>

            <button type="submit" name="start_quiz"> Start Quiz </button>
        </from>
    </div>
</body>
</html>