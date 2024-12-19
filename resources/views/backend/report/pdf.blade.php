<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 10px;
        }

        p {
            text-align: center;
            font-size: 12px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-size: 12px;
        }

        td {
            font-size: 11px;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 10px;
        }

        @page {
            margin: 20mm;
        }

        @media print {
            body {
                margin: 0;
            }

            .container {
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Ambatucar Report</h1>
        <p>This report contains detailed information about car rentals, including rental status and penalties.</p>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Payment Code</th>
                    <th>Rental Code</th>
                    <th>Car Model</th>
                    <th>Rented By</th>
                    <th>Rent Start</th>
                    <th>Rent End</th>
                    <th>Return Date</th>
                    <th>Penalty</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 0;
                @endphp
                @foreach ($rentals as $rental)
                    <tr>
                        <td>{{ ++$count }}</td>
                        <td>{{ $rental->payment->payment_code }}</td>
                        <td>{{ $rental->rental_code }}</td>
                        <td>{{ $rental->car->model }}</td>
                        <td>{{ $rental->user->name }} <br> ID: {{ $rental->user->id }}</td>
                        <td>{{ $rental->rent_start }}</td>
                        <td>{{ $rental->rent_end }}</td>
                        <td>{{ $rental->return_date ?? '-' }}</td>
                        <td>Rp. {{ number_format($rental->penalty_amount, 0, ',', '.') ?? 0 }}</td>
                        <td><span class="text-capitalize">{{ $rental->status }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="footer">
            <p>Generated on {{ now()->format('d-m-Y H:i:s') }}</p>
        </div>
    </div>
</body>

</html>
