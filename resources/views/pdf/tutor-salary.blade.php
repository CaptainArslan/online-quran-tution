
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Tutor Salary</title>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #0087C3;
            text-decoration: none;
        }

        body {
            position: relative;
            width: 90%;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-family: SourceSansPro;
        }

        header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
        }

        #logo {
            float: left;
            margin-top: 5px;
        }

        #logo img {
            width: 120px;
        }

        #company {
            text-align: right;
            margin-top: 10px;
        }


        #details {
            margin-bottom: 50px;
        }

        #client {
            padding-left: 6px;
            font-size: 16px;
            float: left;
        }
        #driver {
            padding-left: 6px;
            font-size: 16px;
            text-align: right;
        }

        #client .to {
            color: #777777;
        }

        h2.name {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
        }

        #invoice {
            text-align: right;
        }

        #invoice h1 {
            color: #0087C3;
            font-size: 2.4em;
            line-height: 1em;
            font-weight: normal;
            margin: 0  0 10px 0;
        }

        #invoice .date {
            font-size: 1.1em;
            color: #777777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 20px;
            background: #EEEEEE;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
        }

        table th {
            white-space: nowrap;
            font-weight: normal;
            font-weight: bold;
        }

        table td {
            text-align: right;
        }

        table td h3{
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 0.2em 0;
        }

        table .no {
            font-size: 1.6em;
            text-align: left;
        }

        table .desc {
            text-align: left;
            font-size: 17px;
        }


        table .qty {
        }


        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table tbody tr:last-child td {
            border: none;
        }

        table tfoot td {
            padding: 5px 0px;
            background: #FFFFFF;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #AAAAAA;
        }

        table tfoot tr:first-child td {
            border-top: none;
        }

        table tfoot tr:last-child td {
            color: #57B223;
            font-size: 1.4em;
            font-weight: bold;

        }

        table tfoot tr td:first-child {
            border: none;
        }

        .address, .email
        {
            margin-top: 10px;
            margin-bottom: 10px;
        }

    </style>
</head>
<body>
<header class="clearfix">
    <div id="logo">
        <img src="http://www.onlinequrantuition.co.uk/images/logo.png">
        <br>
        {{ $setting['email'] ?? '' }}
    </div>
    <div id="company">

        <div>{{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('D, F d') }}</div>
    </div>
    </div>
</header>
<main>



    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="no">Hourly Rate</th>
            <th class="desc">Total Hours</th>
            <th class="desc">Bonus</th>
            <th class="desc">Amount</th>
            <th class="desc">Total Paid</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td class="no">PKR {{ $request->amount_to_pay ?? '' }}</td>
            <td class="desc">{{ $request->hours }}</td>
            <td class="desc">PKR {{$request->bonus}}</td>
            <td class="desc">PKR {{$request->amount_to_pay * $request->hours}}</td>
            <td class="desc">PKR {{($request->amount_to_pay * $request->hours)+$request->bonus}}</td>
        </tr>
        </tbody>
        <tfoot>


        </tfoot>
    </table>
    <div style="text-align:center;color:#5BBD78;">
        <h1 style="text-transform: uppercase;">Thank you for using Online Quran Tution</h1>
    </div>
</main>
</body>
</html>

