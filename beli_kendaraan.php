<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamMy Vehicle</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .menu-title {
            background: rgba(255, 255, 255, 0.95);
            padding: 18px 25px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
            width: 100%;
            max-width: 600px;
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .menu-title::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #4776E6, #8E54E9);
        }

        .menu-title div:first-child {
            font-size: 22px;
            cursor: pointer;
            color: #444;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
            background: rgba(0, 0, 0, 0.04);
        }

        .menu-title div:first-child:hover {
            background: rgba(0, 0, 0, 0.08);
            transform: translateX(-2px);
        }

        .menu-title div:last-child {
            font-size: 20px;
            font-weight: 600;
            background: linear-gradient(90deg, #4776E6, #8E54E9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .main-container {
            width: 100%;
            max-width: 600px;
        }

        .input-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.15);
            backdrop-filter: blur(10px);
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #4a5568;
            font-size: 15px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        input[type="number"] {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        input[type="number"]:focus {
            outline: none;
            border-color: #4776E6;
            box-shadow: 0 0 0 3px rgba(71, 118, 230, 0.1);
            transform: translateY(-1px);
        }

        input[type="number"]::placeholder {
            color: #a0aec0;
        }

        .form-group:hover label {
            color: #4776E6;
        }

        .calculate-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(45deg, #4776E6, #8E54E9);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            position: relative;
            overflow: hidden;
        }

        .calculate-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                120deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent
            );
            transition: 0.5s;
        }

        .calculate-btn:hover::before {
            left: 100%;
        }

        .calculate-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 25px rgba(71, 118, 230, 0.3);
        }

        .calculate-btn:active {
            transform: translateY(0);
        }

        /* Input number spinner removal */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            body {
                padding: 15px;
            }

            .menu-title {
                padding: 15px 20px;
                border-radius: 14px;
            }

            .input-container {
                padding: 25px;
                border-radius: 16px;
            }

            label {
                font-size: 14px;
            }

            input[type="number"] {
                padding: 12px 15px;
                font-size: 15px;
            }

            .calculate-btn {
                padding: 14px;
                font-size: 16px;
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #4776E6, #8E54E9);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #3665d5, #7d43d8);
        }
    </style>
</head>
<body>
<div class="menu-title">
    <a href="index.php" style="text-decoration: none;">
        <div>&lt;</div>
    </a>
    <div>Dream Vehicle Simulation</div>
</div>

    <form method="post" class="main-container" action="calculate.php">
        <div class="input-container">
            <div class="form-group">
                <label for="years">How long you want to buy your dream vehicle</label>
                <input type="number" id="years" name="years" placeholder="Enter number of years" required>
            </div>

            <div class="form-group">
                <label for="current_vehicle_price">Current Vehicle Price</label>
                <input type="number" id="current_vehicle_price" name="current_vehicle_price" step="0.01" placeholder="Enter current price" required>
            </div>

            <div class="form-group">
                <label for="down_payment_percentage">Down Payment (%)</label>
                <input type="number" id="down_payment_percentage" name="down_payment_percentage" step="0.01" placeholder="Enter down payment percentage" required>
            </div>

            <div class="form-group">
                <label for="current_savings">Current Savings</label>
                <input type="number" id="current_savings" name="current_savings" step="0.01" placeholder="Enter your current savings" required>
            </div>

            <div class="form-group">
                <label for="monthly_savings">Monthly Savings</label>
                <input type="number" id="monthly_savings" name="monthly_savings" step="0.01" placeholder="Enter monthly savings amount" required>
            </div>

            <div class="form-group">
                <label for="investment_return">Investment Return (%)</label>
                <input type="number" id="investment_return" name="investment_return" step="0.01" placeholder="Enter expected return rate" required>
            </div>

            <div class="form-group">
                <label for="inflation_rate">Inflation Rate (%)</label>
                <input type="number" id="inflation_rate" name="inflation_rate" step="0.01" placeholder="Enter inflation rate" required>
            </div>

            <button type="submit" class="calculate-btn">Calculate</button>
        </div>
    </form>
</body>
</html>