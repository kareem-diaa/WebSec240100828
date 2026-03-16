@extends('layouts.master')
@section('title', 'Calculator')
@section('content')

<div class="d-flex justify-content-center mt-5">
<div class="card shadow" style="width: 340px;">
    <div class="card-header bg-dark text-white text-center">
        <h4 class="mb-0">🧮 Calculator</h4>
    </div>
    <div class="card-body">

        <div class="mb-3">
            <label class="form-label fw-bold">Number 1</label>
            <input type="number" id="num1" class="form-control" placeholder="Enter first number">
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Number 2</label>
            <input type="number" id="num2" class="form-control" placeholder="Enter second number">
        </div>

        <div class="d-grid gap-2">
            <div class="row g-2">
                <div class="col-6">
                    <button class="btn btn-primary w-100" onclick="calculate('+')">➕ Add</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-danger w-100"  onclick="calculate('-')">➖ Subtract</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-success w-100" onclick="calculate('*')">✖️ Multiply</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-warning w-100" onclick="calculate('/')">➗ Divide</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-secondary w-100" onclick="calculate('%')">🔢 Modulus</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-info w-100" onclick="calculate('**')">🔺 Power</button>
                </div>
            </div>
        </div>

        <div id="result-box" class="alert alert-success mt-4 text-center fs-5 fw-bold d-none"></div>
        <div id="error-box"  class="alert alert-danger  mt-4 text-center d-none"></div>

    </div>
</div>
</div>

<script>
    function calculate(op) {
        const n1 = parseFloat(document.getElementById('num1').value);
        const n2 = parseFloat(document.getElementById('num2').value);
        const res  = document.getElementById('result-box');
        const err  = document.getElementById('error-box');

        res.classList.add('d-none');
        err.classList.add('d-none');

        if (isNaN(n1) || isNaN(n2)) {
            err.textContent = '⚠️ Please enter both numbers!';
            err.classList.remove('d-none');
            return;
        }
        if (op === '/' && n2 === 0) {
            err.textContent = '⚠️ Cannot divide by zero!';
            err.classList.remove('d-none');
            return;
        }

        let result;
        const opSymbols = {'+':'+', '-':'−', '*':'×', '/':'÷', '%':'mod', '**':'^'};

        switch(op) {
            case '+':  result = n1 + n2; break;
            case '-':  result = n1 - n2; break;
            case '*':  result = n1 * n2; break;
            case '/':  result = n1 / n2; break;
            case '%':  result = n1 % n2; break;
            case '**': result = Math.pow(n1, n2); break;
        }

        res.textContent = `${n1} ${opSymbols[op]} ${n2} = ${result}`;
        res.classList.remove('d-none');
    }
</script>

@endsection