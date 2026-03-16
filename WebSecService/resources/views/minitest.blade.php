@extends('layouts.master')
@section('title', 'MiniTest - Supermarket Bill')
@section('content')

<div class="card m-4">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0">🛒 SuperMarket Bill</h4>
    </div>
    <div class="card-body">

        <table class="table table-bordered table-striped table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Unit Price (EGP)</th>
                    <th>Total (EGP)</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp

                @foreach($items as $index => $item)
                    @php $lineTotal = $item->qty * $item->unit_price; @endphp
                    @php $grandTotal += $lineTotal; @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="text-start">{{ $item->name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ number_format($item->unit_price, 2) }}</td>
                        <td>{{ number_format($lineTotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="table-success fw-bold">
                    <td colspan="4" class="text-end">Grand Total:</td>
                    <td>{{ number_format($grandTotal, 2) }} EGP</td>
                </tr>
            </tfoot>
        </table>

    </div>
    <div class="card-footer text-muted text-end">
        Thank you for shopping with us! 🧾
    </div>
</div>

@endsection