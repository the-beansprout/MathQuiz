<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Quiz</title>
    <style>
        body{
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            dispaly: flex;
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
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        select, input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #2980b9;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .custom-range {
            display: flex;
            gap: 10px;
            width: 100%;
        }
    </style>

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