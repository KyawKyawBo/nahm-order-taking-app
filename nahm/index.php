<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Correct Code to use Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .keypad {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            max-width: 200px;
            margin-bottom: 10px;
        }

        .keypad button {
            width: 100%;
            padding: 10px;
            font-size: 18px;
        }

        input[type="text"] {
            touch-action: none;
            /* Disable touch events on the input field */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Enter Correct Code to use Admin Dashboard</h1>
        <form method="post" action="verify.php">
            <div class="keypad mb-3">
                <button type="button" class="btn btn-primary" onclick="appendToCode('1')">1</button>
                <button type="button" class="btn btn-primary" onclick="appendToCode('2')">2</button>
                <button type="button" class="btn btn-primary" onclick="appendToCode('3')">3</button>
                <button type="button" class="btn btn-primary" onclick="appendToCode('4')">4</button>
                <button type="button" class="btn btn-primary" onclick="appendToCode('5')">5</button>
                <button type="button" class="btn btn-primary" onclick="appendToCode('6')">6</button>
                <button type="button" class="btn btn-primary" onclick="appendToCode('7')">7</button>
                <button type="button" class="btn btn-primary" onclick="appendToCode('8')">8</button>
                <button type="button" class="btn btn-primary" onclick="appendToCode('9')">9</button>
                <button type="button" class="btn btn-primary" onclick="appendToCode('0')">0</button>
                <button type="button" class="btn btn-secondary" onclick="clearCode()">Clear</button>
            </div>
            <input type="text" name="code" id="codeInput" readonly class="form-control mb-3"
                placeholder="Enter the code">
            <button type="submit" class="btn btn-primary">Submit</button>

            <script>
                function appendToCode(digit) {
                    var codeInput = document.getElementById('codeInput');
                    codeInput.value += digit;
                }

                function clearCode() {
                    var codeInput = document.getElementById('codeInput');
                    codeInput.value = '';
                }
            </script>
        </form>
    </div>
</body>

</html>