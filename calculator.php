<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dreammy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Input validation and defaults
    $goal_amount = isset($_POST['goal_amount']) ? max((float) str_replace('.', '', $_POST['goal_amount']), 0) : 0;
    $time_period = isset($_POST['time_period']) ? max((int) $_POST['time_period'], 0) : 0;
    $current_amount = isset($_POST['current_amount']) ? max((float) str_replace('.', '', $_POST['current_amount']), 0) : 0;
    $saving_frequency = isset($_POST['saving_frequency']) ? $_POST['saving_frequency'] : "monthly";
    $saving_timing = isset($_POST['saving_timing']) ? $_POST['saving_timing'] : "end";
    $target_investment = isset($_POST['target_investment']) ? max((float) str_replace('.', '', $_POST['target_investment']), 0) : 0;
    $return_rate = isset($_POST['return_rate']) ? max((float) $_POST['return_rate'], 0) : 0;

    // Calculation variables
    $total_periods = $saving_frequency === "yearly" ? $time_period : $time_period * 12;
    $periodic_rate = $saving_frequency === "yearly" ? $return_rate / 100 : $return_rate / 100 / 12;

    // Future value calculation for initial investment
    $future_value = $current_amount * pow(1 + $periodic_rate, $total_periods);

    // Calculate future value based on saving timing
    if ($saving_timing === "start") {
        // For start-of-period investments, each payment earns returns for one additional period
        for ($i = 0; $i < $total_periods; $i++) {
            $future_value += $target_investment * pow(1 + $periodic_rate, $total_periods - $i);
        }
    } else {
        // For end-of-period investments
        for ($i = 1; $i <= $total_periods; $i++) {
            $future_value += $target_investment * pow(1 + $periodic_rate, $total_periods - $i);
        }
    }

    // Required additional investment calculation
    $required_investment = max($goal_amount - $future_value, 0);
    
    // Calculate periodic investment amounts for timeline display
    $timeline_values = array();
    $current_value = $current_amount;
    
    for ($year = 1; $year <= $time_period; $year++) {
        $periods_in_year = $saving_frequency === "yearly" ? 1 : 12;
        $year_start_value = $current_value;
        
        for ($period = 1; $period <= $periods_in_year; $period++) {
            if ($saving_timing === "start") {
                $current_value = ($current_value + $target_investment) * (1 + $periodic_rate);
            } else {
                $current_value = $current_value * (1 + $periodic_rate) + $target_investment;
            }
        }
        
        $timeline_values[$year] = array(
            'start' => $year_start_value,
            'end' => $current_value,
            'growth' => $current_value - $year_start_value
        );
    }
    $stmt = $conn->prepare("INSERT INTO calculation_history (goal_amount, time_period, current_amount, saving_frequency, saving_timing, target_investment, return_rate, calculation_result) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "didsdsdd", 
        $goal_amount, 
        $time_period, 
        $current_amount, 
        $saving_frequency, 
        $saving_timing, 
        $target_investment, 
        $return_rate, 
        $future_value // Use $future_value as calculation result
    );

    if ($stmt->execute()) {
        echo "";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Investment Calculator</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .gradient-background {
            background: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);
        }
        
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .input-group input,
        .input-group select {
            width: 100%;
            padding: 0.75rem;
            padding-left: 2.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .input-group i {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #718096;
        }
        
        .input-group input:focus,
        .input-group select:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
        }

        .timeline-item {
            position: relative;
            padding-left: 2rem;
            margin-bottom: 2rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e2e8f0;
        }

        .timeline-dot {
            position: absolute;
            left: -0.5rem;
            top: 0;
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
            background: #4299e1;
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin-top: 2rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="gradient-background py-6 px-4 shadow-lg">
            <div class="max-w-4xl mx-auto">
                <a href="home.php" class="inline-flex items-center text-white hover:text-gray-200 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Home
                </a>
                <h1 class="text-3xl font-bold text-white text-center mt-4">Smart Investment Calculator</h1>
                <p class="text-center text-white mt-2">Plan your financial future with confidence</p>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-4xl mx-auto px-4 py-8">
            <div class="bg-white rounded-lg shadow-xl p-6 mb-8">
                <form method="post" class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="input-group">
                            <i class="fas fa-money-bill-wave"></i>
                            <input type="text" id="goal_amount" name="goal_amount" 
                                   placeholder="Goal Amount (Rp)" 
                                   oninput="formatNumberInput(this)" required>
                        </div>

                        <div class="input-group">
                            <i class="fas fa-clock"></i>
                            <input type="number" id="time_period" name="time_period" 
                                   placeholder="Time Period (years)" required>
                        </div>

                        <div class="input-group">
                            <i class="fas fa-piggy-bank"></i>
                            <input type="text" id="current_amount" name="current_amount" 
                                   placeholder="Current Amount (Rp)" 
                                   oninput="formatNumberInput(this)" required>
                        </div>

                        <div class="input-group">
                            <i class="fas fa-calendar"></i>
                            <select id="saving_frequency" name="saving_frequency">
                                <option value="monthly">Monthly Investment</option>
                                <option value="yearly">Yearly Investment</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <i class="fas fa-hourglass-start"></i>
                            <select id="saving_timing" name="saving_timing">
                                <option value="start">Start of Period</option>
                                <option value="end">End of Period</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <i class="fas fa-chart-line"></i>
                            <input type="text" id="target_investment" name="target_investment" 
                                   placeholder="Target Investment per Period (Rp)" 
                                   oninput="formatNumberInput(this)" required>
                        </div>

                        <div class="input-group">
                            <i class="fas fa-percentage"></i>
                            <input type="number" id="return_rate" name="return_rate" 
                                   placeholder="Return Rate (% per year)" 
                                   step="0.01" required>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg
                                   transition-colors duration-200 flex items-center justify-center">
                        <i class="fas fa-calculator mr-2"></i>
                        Calculate Investment
                    </button>
                </form>
            </div>

            <?php if (isset($required_investment)): ?>
            <!-- Results Section -->
            <div class="bg-white rounded-lg shadow-xl p-6">
                <div class="flex justify-center space-x-4 mb-6">
                    <button onclick="showSection('strategy')" 
                            class="px-6 py-2 rounded-lg font-semibold transition-colors duration-200
                                   hover:bg-blue-500 hover:text-white focus:outline-none
                                   strategy-tab">
                        <i class="fas fa-chess mr-2"></i>Strategy
                    </button>
                    <button onclick="showSection('timeline')" 
                            class="px-6 py-2 rounded-lg font-semibold transition-colors duration-200
                                   hover:bg-blue-500 hover:text-white focus:outline-none
                                   timeline-tab">
                        <i class="fas fa-clock mr-2"></i>Timeline
                    </button>
                </div>

                <div id="strategy" class="section active fade-in">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-blue-800 mb-4">Investment Summary</h3>
                            <div class="space-y-3">
                                <p><i class="fas fa-bullseye text-blue-500 mr-2"></i>
                                   <strong>Goal:</strong> Rp <?= number_format($goal_amount, 2, ',', '.') ?></p>
                                <p><i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                   <strong>Timeline:</strong> <?= $time_period ?> years</p>
                                <p><i class="fas fa-wallet text-blue-500 mr-2"></i>
                                   <strong>Current:</strong> Rp <?= number_format($current_amount, 2, ',', '.') ?></p>
                            </div>
                        </div>

                        <div class="bg-green-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-green-800 mb-4">Expected Results</h3>
                            <div class="space-y-3">
                                <p><i class="fas fa-chart-line text-green-500 mr-2"></i>
                                   <strong>Monthly Investment:</strong> Rp <?= number_format($target_investment, 2, ',', '.') ?></p>
                                <p><i class="fas fa-percentage text-green-500 mr-2"></i>
                                   <strong>Return Rate:</strong> <?= $return_rate ?>% per year</p>
                                <p><i class="fas fa-money-bill-wave text-green-500 mr-2"></i>
                                   <strong>Final Value:</strong> Rp <?= number_format($future_value, 2, ',', '.') ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="timeline" class="section hidden fade-in">
                    <div class="bg-gray-800 text-white p-6 rounded-lg">
                        <?php foreach ($timeline_values as $year => $values): ?>
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <h3 class="text-xl font-bold mb-2">Year <?= $year ?></h3>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-gray-300">Starting Amount:</p>
                                        <p class="text-2xl font-semibold">
                                            Rp <?= number_format($values['start'], 2, ',', '.') ?>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-gray-300">Ending Amount:</p>
                                        <p class="text-2xl font-semibold">
                                            Rp <?= number_format($values['end'], 2, ',', '.') ?>
                                        </p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <p class="text-gray-300">Growth:</p>
                                        <p class="text-2xl font-semibold text-green-400">
                                            + Rp <?= number_format($values['growth'], 2, ',', '.') ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </main>
    </div>

    <script>
        function formatNumberInput(input) {
            let value = input.value.replace(/\D/g, '');
            let formatted = new Intl.NumberFormat('id-ID').format(value);
            input.value = formatted;
        }

        function showSection(section) {
            // Hide all sections
            document.querySelectorAll('.section').forEach(sec => {
                sec.classList.add('hidden');
                sec.classList.remove('active');
            });
            
            // Show selected section
            const selectedSection = document.getElementById(section);
            selectedSection.classList.remove('hidden');
            selectedSection.classList.add('active');
            
            // Update tab styling
            document.querySelectorAll('button').forEach(btn => {
                btn.classList.remove('bg-blue-500', 'text-white');
            });
            document.querySelector(`.${section}-tab`).classList.add('bg-blue-500', 'text-white');
            
            // Trigger fade-in animation
            selectedSection.classList.remove('fade-in');
            void selectedSection.offsetWidth; // Force reflow
            selectedSection.classList.add('fade-in');
        }

        // Initialize first tab
        document.addEventListener('DOMContentLoaded', () => {
            const strategyTab = document.querySelector('.strategy-tab');
            if (strategyTab) {
                strategyTab.classList.add('bg-blue-500', 'text-white');
            }
        });
    </script>
</body>
</html>