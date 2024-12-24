<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dreammy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = [];
if (isset($_SERVER["REQUEST_METHOD"])&&$_SERVER["REQUEST_METHOD"] == "POST") {

    $years = $_POST['years'];
    $current_vehicle_price = $_POST['current_vehicle_price'];
    $down_payment_percentage = $_POST['down_payment_percentage'] / 100;
    $current_savings = $_POST['current_savings'];
    $monthly_savings = $_POST['monthly_savings'];
    $investment_return = $_POST['investment_return'] / 100;
    $inflation_rate = $_POST['inflation_rate'] / 100;

    $adjusted_price = $current_vehicle_price * pow((1 + $inflation_rate), $years);

    $down_payment = $adjusted_price * $down_payment_percentage;

    $r = $investment_return / 12;
    $n = $years * 12;
    $future_value = $monthly_savings * ((pow((1 + $r), $n) - 1) / $r);
    $total_funds = $current_savings + $future_value;

    $remaining_amount = $total_funds - $down_payment;

    $kkb_amount = $adjusted_price - $down_payment;

    $stmt = $conn->prepare("INSERT INTO dream_vehicle (years, current_vehicle_price, down_payment_percentage, current_savings, monthly_savings, investment_return, inflation_rate) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("idddddd",$years, $current_vehicle_price, $down_payment_percentage, $current_savings, $monthly_savings, $investment_return, $inflation_rate);
    $stmt->execute();
    $stmt->close();

    $result = [
        "adjusted_price" => number_format($adjusted_price, 2),
        "down_payment" => number_format($down_payment, 2),
        "total_funds" => number_format($total_funds, 2),
        "remaining_amount" => number_format($remaining_amount, 2),
        "kkb_amount" => number_format($kkb_amount, 2 )
    ];

    echo"<link rel='stylesheet' href='style.css'>";
    echo "<div class='result-container'>";
    echo "<h2>Results</h2>";
    echo "<p>Adjusted Vehicle Price: <strong>IDR " . number_format($adjusted_price, 2) . "</strong></p>";
    echo "<p>Down Payment: <strong>IDR " . number_format($down_payment, 2) . "</strong></p>";
    echo "<p>Total Funds Available: <strong>IDR " . number_format($total_funds, 2) . "</strong></p>";
    echo "<p>Remaining Amount After DP: <strong>IDR " . number_format($remaining_amount, 2) . "</strong></p>";
    echo "<p>KKB Amount: <strong>IDR " . number_format($kkb_amount, 2) . "</strong></p>";
    echo "</div>";
}
?>