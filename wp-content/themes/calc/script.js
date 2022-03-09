const calculator = {
    displayValue: '0',
    firstOperand: null,
    waitingForSecondOperand: false,
    operator: null,
    expressionData: [],
    historyData: [],
};

function inputDigit(digit) {
    const {
        displayValue,
        waitingForSecondOperand
    } = calculator;

    if (waitingForSecondOperand === true) {
        calculator.displayValue = digit;
        calculator.waitingForSecondOperand = false;
    } else {
        calculator.displayValue = displayValue === '0' ? digit : displayValue + digit;
    }
    calculator.expressionData.push(digit);
}

function inputDecimal(dot) {
    // If the `displayValue` does not contain a decimal point
    if (!calculator.displayValue.includes(dot)) {
        // Append the decimal point
        calculator.displayValue += dot;
        calculator.expressionData.push(dot);
    }
}

function handleOperator(nextOperator) {
    calculator.expressionData.push(nextOperator);
    const {
        firstOperand,
        displayValue,
        operator
    } = calculator
    const inputValue = parseFloat(displayValue);

    if (operator && calculator.waitingForSecondOperand) {
        calculator.operator = nextOperator;
        return;
    }

    if (firstOperand == null) {
        calculator.firstOperand = inputValue;
    } else if (operator) {
        const currentValue = firstOperand || 0;
        const result = performCalculation[operator](currentValue, inputValue);

        calculator.displayValue = String(result);
        calculator.firstOperand = result;
        calculator.expressionData.push(result);
        calculator.historyData.push({expression: calculator.expressionData.join('')});
        calculator.expressionData = [];
        resultation();
    }

    calculator.waitingForSecondOperand = true;
    calculator.operator = nextOperator;
}
function resultation () {
    let resulstHistory = document.getElementById('results');
    let string = '';
    for (let key in calculator.historyData) {
        string += '' + calculator.historyData[key]['expression'] + "<br>";
        console.log(calculator.historyData[key]['expression'])
    };
    resulstHistory.innerHTML = string

}
const performCalculation = {
    '/': (firstOperand, secondOperand) => firstOperand / secondOperand,

    '*': (firstOperand, secondOperand) => firstOperand * secondOperand,

    '+': (firstOperand, secondOperand) => firstOperand + secondOperand,

    '-': (firstOperand, secondOperand) => firstOperand - secondOperand,

    '=': (firstOperand, secondOperand) => secondOperand
};

function resetCalculator() {
    calculator.displayValue = '0';
    calculator.firstOperand = null;
    calculator.waitingForSecondOperand = false;
    calculator.operator = null;
}

function updateDisplay() {
    const display = document.querySelector('.calculator-screen');
    display.value = calculator.displayValue;
}

updateDisplay();


const keys = document.querySelector('.calculator-keys');
keys.addEventListener('click', (event) => {
    const {
        target
    } = event;
    if (!target.matches('button')) {
        return;
    }
    if (target.classList.contains('operator')) {
        if (calculator.expressionData.length == 0) {
            return;
        }
        // if (calculator.expressionData[calculator.expressionData.length - 1] == isNaN(calculator.expressionData)) {
        //     return;
        // }
        if (isNaN(calculator.expressionData[calculator.expressionData.length - 1])) {
            return;
        }
        handleOperator(target.value);
        updateDisplay();
        return;
    }

    // let ravno = document.querySelector('.ravno');

    if (target.classList.contains('decimal')) {
        inputDecimal(target.value);
        updateDisplay();
        return;
    }

    if (target.classList.contains('all-clear')) {
        resetCalculator();
        updateDisplay();
        return;
    }

    inputDigit(target.value);
    updateDisplay();
});