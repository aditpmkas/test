<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Fund Calculator</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        /* Root variables */
:root {
    --primary: #2563eb;
    --primary-dark: #1e40af;
    --secondary: #64748b;
    --success: #22c55e;
    --danger: #ef4444;
    --warning: #f59e0b;
    --background: #f8fafc;
    --card: #ffffff;
    --text: #0f172a;
}

/* Base reset */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

/* Body styles */
body {
    font-family: 'Inter', system-ui, sans-serif;
    background: var(--background);
    color: var(--text);
    line-height: 1.6;
    font-size: 16px;
}

/* Back button */
.back-button {
    position: fixed;
    top: 1px;
    left: 1px;
    color: blue;
    padding: clamp(1rem, 4vw, 1.5rem) clamp(2rem, 6vw, 3rem);
    border-radius: 2rem;
    text-decoration: none;
    font-weight: 500;
    box-shadow: 0 4px 8px rgba(214, 196, 196, 0.5);
    transition: all 0.3s ease;
    z-index: 1000;
    font-size: clamp(1.2rem, 3.5vw, 1.5rem);
}


.back-button:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0,0,0,0.2);
}

/* Container */
.container {
    width: 95%;
    max-width: 1000px;
    margin: 1rem auto;
    padding: 1rem;
}

/* Header */
.header {
    text-align: center;
    margin-bottom: 2rem;
    padding: 0 1rem;
}

.header h1 {
    font-size: clamp(1.5rem, 5vw, 2.5rem);
    color: var(--primary);
    margin-bottom: 0.5rem;
}

.header p {
    color: var(--secondary);
    font-size: clamp(0.9rem, 3vw, 1.1rem);
}

/* Card */
.card {
    background: var(--card);
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
    padding: clamp(1rem, 3vw, 2rem);
    margin-bottom: 1.5rem;
    animation: fadeIn 0.5s ease-out;
}

/* Step indicator */
.step-indicator {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(70px, 1fr));
    gap: 0.5rem;
    margin-bottom: 2rem;
    position: relative;
}

.step {
    flex: 1;
    text-align: center;
    position: relative;
    padding: 0.5rem;
}

.step-number {
    width: clamp(2rem, 8vw, 2.5rem);
    height: clamp(2rem, 8vw, 2.5rem);
    border-radius: 50%;
    background: var(--secondary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.5rem;
    font-weight: bold;
    transition: all 0.3s ease;
    font-size: clamp(0.9rem, 3vw, 1rem);
}

.step-label {
    font-size: clamp(0.8rem, 2.5vw, 1rem);
}

.step.active .step-number {
    background: var(--primary);
    transform: scale(1.1);
}

.step.completed .step-number {
    background: var(--success);
}

/* Form groups */
.form-group {
    margin-bottom: 1.5rem;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.3s ease;
    display: none;
}

.form-group.visible {
    opacity: 1;
    transform: translateY(0);
    display: block;
    animation: slideUp 0.5s ease-out;
}

/* Labels and inputs */
label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: var(--text);
    font-size: clamp(0.9rem, 2.5vw, 1rem);
}

.input-wrapper {
    position: relative;
}

.currency-symbol {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--secondary);
    font-size: clamp(0.9rem, 2.5vw, 1rem);
}

input {
    width: 100%;
    padding: clamp(0.5rem, 2vw, 0.75rem);
    border: 2px solid #e2e8f0;
    border-radius: 0.5rem;
    font-size: clamp(0.9rem, 2.5vw, 1rem);
    transition: all 0.3s ease;
}

input[type="text"] {
    padding-left: 3rem;
}

input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
}

/* Help and error text */
.help-text, .error-text {
    font-size: clamp(0.8rem, 2vw, 0.875rem);
    margin-top: 0.5rem;
}

.help-text {
    color: var(--secondary);
}

.error-text {
    color: var(--danger);
    display: none;
}

/* Button styles */
button {
    width: 100%;
    padding: clamp(0.75rem, 2.5vw, 1rem);
    background: var(--primary);
    color: white;
    border: none;
    border-radius: 0.5rem;
    font-size: clamp(0.9rem, 2.5vw, 1rem);
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 1rem;
}

button:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
}

/* Results section */
.result {
    display: none;
    animation: fadeIn 0.5s ease-out;
}

.result-card {
    background: white;
    border-radius: 0.5rem;
    padding: clamp(1rem, 3vw, 1.5rem);
    margin-bottom: 1rem;
    border-left: 4px solid var(--primary);
}

.result-title {
    font-size: clamp(1.1rem, 3.5vw, 1.25rem);
    color: var(--primary);
    margin-bottom: 1rem;
}

/* Progress bar */
.progress-bar {
    height: 1rem;
    background: #e2e8f0;
    border-radius: 0.5rem;
    overflow: hidden;
    margin: 1rem 0;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--primary), var(--success));
    transition: width 1s ease-out;
}

/* Recommendations */
.recommendations {
    display: grid;
    gap: 1rem;
}

.recommendation {
    padding: clamp(0.75rem, 2vw, 1rem);
    background: #f8fafc;
    border-radius: 0.5rem;
}

.recommendation-icon {
    color: var(--primary);
    margin-right: 0.5rem;
}

/* Tips section */
.tips-section {
    margin-top: 1.5rem;
    padding: clamp(0.75rem, 2vw, 1rem);
    background: #f8fafc;
    border-radius: 0.5rem;
}

.tips-title {
    font-size: clamp(1.1rem, 3.5vw, 1.25rem);
    color: var(--primary);
    margin-bottom: 1rem;
}

.tips-list {
    list-style: none;
}

.tips-list li {
    font-size: clamp(0.9rem, 2.5vw, 1rem);
    margin-bottom: 0.75rem;
    padding-left: 1.5rem;
    position: relative;
}

.tips-list li:before {
    content: "•";
    color: var(--primary);
    position: absolute;
    left: 0;
}

/* Tooltips */
.tooltip {
    position: relative;
    display: inline-block;
    cursor: help;
}

.tooltip .tooltip-text {
    visibility: hidden;
    width: min(200px, 80vw);
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    transform: translateX(-50%);
    opacity: 0;
    transition: opacity 0.3s;
    font-size: clamp(0.8rem, 2vw, 0.875rem);
}

.tooltip:hover .tooltip-text {
    visibility: visible;
    opacity: 1;
}

/* Animations */
@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Mobile optimizations */
@media (max-width: 480px) {
    .container {
        width: 100%;
        padding: 0.5rem;
    }

    .card {
        border-radius: 0.5rem;
        padding: 1rem;
    }

    .step-indicator {
        gap: 0.25rem;
    }

    .back-button {
        padding: 0.5rem 1rem;
    }

    .result-card {
        padding: 1rem;
    }

    .recommendation {
        padding: 0.75rem;
    }
}

/* Tablet optimizations */
@media (min-width: 481px) and (max-width: 768px) {
    .container {
        width: 90%;
    }

    .recommendations {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
}
    </style>
</head>
<body>
<a href="home.php" class="back-button"><</a>
    <div class="container">
        <div class="header">
            <h1>Emergency Fund Calculator</h1>
            <p>Plan your emergency fund more effectively</p>
        </div>

        <div class="card">
            <div class="step-indicator">
                <div class="step active" id="step1-indicator">
                    <div class="step-number">1</div>
                    <div class="step-label">Expenses</div>
                </div>
                <div class="step" id="step2-indicator">
                    <div class="step-number">2</div>
                    <div class="step-label">Dependents</div>
                </div>
                <div class="step" id="step3-indicator">
                    <div class="step-number">3</div>
                    <div class="step-label">Target</div>
                </div>
                <div class="step" id="step4-indicator">
                    <div class="step-number">4</div>
                    <div class="step-label">Current Funds</div>
                </div>
            </div>

            <form id="emergency-fund-form">
    <div id="step-1" class="form-group visible">
        <label for="monthly-expenses">
            Monthly Expenses
            <span class="tooltip">ⓘ
                <span class="tooltip-text">Enter your total monthly recurring expenses including installments, bills, and daily needs</span>
            </span>
        </label>
        <div class="input-wrapper">
            <span class="currency-symbol">Rp</span>
            <input type="text" id="monthly-expenses" name="monthly_expenses" required>
        </div>
        <div class="help-text">Example: 5.000.000</div>
        <div class="error-text">Please enter a valid amount</div>
    </div>

    <div id="step-2" class="form-group">
        <label for="dependents">
            Number of Dependents
            <span class="tooltip">ⓘ
                <span class="tooltip-text">The number of family members who depend on you</span>
            </span>
        </label>
        <input type="number" id="dependents" name="dependents" min="0" max="10" required>
        <div class="help-text">Enter the number of people who depend on you</div>
        <div class="error-text">Please enter a number between 0-10</div>
    </div>

    <div id="step-3" class="form-group">
        <label for="saving-period">
            Target Period (Months)
            <span class="tooltip">ⓘ
                <span class="tooltip-text">How long will it take you to accumulate your emergency fund?</span>
            </span>
        </label>
        <input type="number" id="saving-period" name="saving_period" min="1" max="60" required>
        <div class="help-text">Recommendation: 12-24 months</div>
        <div class="error-text">Please enter a period between 1-60 months</div>
    </div>

    <div id="step-4" class="form-group">
        <label for="current-savings">
            Current Emergency Fund
            <span class="tooltip">ⓘ
                <span class="tooltip-text">The total emergency fund you currently have</span>
            </span>
        </label>
        <div class="input-wrapper">
            <span class="currency-symbol">Rp</span>
            <input type="text" id="current-savings" name="current_savings" required>
        </div>
        <div class="help-text">Example: 10.000.000</div>
        <div class="error-text">Please enter a valid amount</div>
        <button type="button" onclick="calculateEmergencyFund()">Calculate Emergency Fund</button>
    </div>
</form>

<div id="result" class="result">
    <!-- Results will be inserted here by JavaScript -->
</div>

<div class="tips-section">
    <h3 class="tips-title">Emergency Fund Management Tips</h3>
    <ul class="tips-list">
        <li>Save emergency funds in easily accessible instruments</li>
        <li>Review your emergency fund needs regularly</li>
        <li>Prioritize emergency funds before high-risk investments</li>
        <li>Keep your emergency fund separate from your operational account</li>
        <li>Continue saving even after reaching your target</li>
    </ul>
</div>


    <script>
        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID').format(amount);
        }

        function unformatCurrency(value) {
            return parseFloat(value.replace(/[^\d]/g, ''));
        }

        function validateStep(stepNumber) {
            const step = document.getElementById(`step-${stepNumber}`);
            const inputs = step.querySelectorAll('input');
            let isValid = true;

            inputs.forEach(input => {
                const value = input.type === 'number' ? input.value : unformatCurrency(input.value);
                const errorText = input.parentElement.parentElement.querySelector('.error-text');

                if (!value || value <= 0) {
                    errorText.style.display = 'block';
                    input.classList.add('error');
                    isValid = false;
                } else {
                    errorText.style.display = 'none';
                    input.classList.remove('error');
                }
            });

            return isValid;
        }

        function showStep(stepNumber) {
            document.querySelectorAll('.form-group').forEach(group => {
                group.classList.remove('visible');
            });

            document.querySelectorAll('.step').forEach(step => {
                step.classList.remove('active');
            });

            const currentStep = document.getElementById(`step-${stepNumber}`);
            const currentIndicator = document.getElementById(`step${stepNumber}-indicator`);
            currentStep.classList.add('visible');
            currentIndicator.classList.add('active');

            for (let i = 1; i < stepNumber; i++) {
                document.getElementById(`step${i}-indicator`).classList.add('completed');
            }
        }

        function nextStep(currentStepNumber) {
            if (validateStep(currentStepNumber)) {
                showStep(currentStepNumber + 1);
            }
        }

        // Add input event listeners
        document.querySelectorAll('input[type="text"]').forEach(input => {
            input.addEventListener('input', (e) => {
                let value = e.target.value.replace(/[^\d]/g, '');
                e.target.value = value ? formatCurrency(value) : '';
            });
        });

        function calculateEmergencyFund() {
            if (!validateStep(4)) return;

            const monthlyExpenses = unformatCurrency(document.getElementById('monthly-expenses').value);
            const dependents = parseInt(document.getElementById('dependents').value);
            const savingPeriod = parseInt(document.getElementById('saving-period').value);
            const currentSavings = unformatCurrency(document.getElementById('current-savings').value);

            const emergencyFund = (monthlyExpenses * 6) + (dependents * 1000000);
            const remainingFund = Math.max(emergencyFund - currentSavings, 0);
            const monthlySaving = remainingFund / savingPeriod;
            const progressPercentage = Math.min((currentSavings / emergencyFund) * 100, 100);

            const resultHTML = `
               <div class="card animate__animated animate__fadeIn">
                <h2 class="result-title">Emergency Fund Analysis Results</h2>

                <div class="result-card">
                    <h3>Emergency Fund Target</h3>
                    <p class="amount">Rp ${formatCurrency(emergencyFund)}</p>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: ${progressPercentage}%"></div>
                    </div>
                    <p class="progress-text">Progress: ${progressPercentage.toFixed(1)}%</p>
                </div>

                <div class="result-card">
                    <h3>Fund Details</h3>
                    <ul>
                        <li>Current fund: Rp ${formatCurrency(currentSavings)}</li>
                        <li>Remaining fund: Rp ${formatCurrency(remainingFund)}</li>
                        <li>Monthly saving target: Rp ${formatCurrency(monthlySaving)}</li>
                    </ul>
                </div>
            </div>


                    <div class="result-card">
                        <h3>Recommendation</h3>
                        ${generateRecommendations(progressPercentage, monthlySaving, monthlyExpenses)}
                    </div>
                </div>
            `;

            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = resultHTML;
            resultDiv.style.display = 'block';
            resultDiv.scrollIntoView({ behavior: 'smooth' });
        }

        function generateRecommendations(progress, monthlySaving, monthlyExpenses) {
            let recommendations = '<div class="recommendations">';
            
            if (progress < 25) {
                recommendations += `
                <div class="recommendation">
                    <span class="recommendation-icon">📊</span>
                    <p>Prioritize building emergency funds before high-risk investments</p>
                </div>
                <div class="recommendation">
                    <span class="recommendation-icon">💰</span>
                    <p>Store funds in easily accessible instruments like savings accounts or deposits</p>
                </div>

                `;
            } else if (progress < 50) {
                recommendations += `
                   <div class="recommendation">
                    <span class="recommendation-icon">📈</span>
                    <p>You're on the right track! Keep up the consistency in saving</p>
                </div>
                <div class="recommendation">
                    <span class="recommendation-icon">🎯</span>
                    <p>Start considering low-risk investment instruments</p>
                </div>

                `;
            } else if (progress < 75) {
                recommendations += `
                <div class="recommendation">
                    <span class="recommendation-icon">🌟</span>
                    <p>Great progress! Start diversifying your portfolio</p>
                </div>
                <div class="recommendation">
                    <span class="recommendation-icon">📝</span>
                    <p>Evaluate and adjust your emergency fund target periodically</p>
                </div>

                `;
            } else {
                recommendations += `
                    <div class="recommendation">
                        <span class="recommendation-icon">🎉</span>
                        <p>Congratulations! Your emergency fund is in great shape</p>
                    </div>
                    <div class="recommendation">
                        <span class="recommendation-icon">🔄</span>
                        <p>Focus on maintenance and periodic review</p>
                    </div>
                `;
            }

            if (monthlySaving > monthlyExpenses * 0.5) {
                recommendations += `
            <div class="recommendation">
                <span class="recommendation-icon">⚠️</span>
                <p>Your monthly saving target is quite high. Consider the following:</p>
                <ul>
                    <li>Extending the saving period</li>
                    <li>Finding additional sources of income</li>
                    <li>Optimizing monthly expenses</li>
                </ul>
            </div>

                `;
            }

            recommendations += '</div>';
            return recommendations;
        }

        // Initialize first step
        showStep(1);

        // Add keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                const currentStep = document.querySelector('.form-group.visible');
                const stepNumber = parseInt(currentStep.id.split('-')[1]);
                if (stepNumber < 4) {
                    nextStep(stepNumber);
                } else {
                    calculateEmergencyFund();
                }
            }
        });
    </script>
</body>
</html>