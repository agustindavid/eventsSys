<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    </style>
</head>

<body>
    <div class="invoice-box" style="max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, .15); font-size: 16px; line-height: 24px; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; color: #555;">
                    <table style="width: 100%;  text-align: left;">
                        <tr>
                            <td class="title">
                                <img class="logo" src="{{url('/')}}/img/logo.jpg" style="width:200px;">
                            </td>

                            <td>
                                Pago #: {{setting('payment_prefix')}}{{$expense->id}}<br>
                                Fecha: {!! \Carbon\Carbon::parse($expense->expenseDate)->format('d-m-Y') !!}<br>
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%; text-align: left;">
                        <tr>
                            <td>
                                Eventos Especiales El Francés<br>
                                Av Muñoz No 360, Fracc, Los Laureles<br>
                                Tel:8135055
                            </td>
                        </tr>
                    </table>

            <table style="width: 100%;  text-align: left;">
            <tr class="heading">
                <td>
                    Concepto
                </td>

                <td>
                    Monto
                </td>
            </tr>

            <tr class="details">
                <td>
                    {{$expense->concept}}
                </td>

                <td>
                    <b>${{$expense->amount}}</b>
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Detalles
                </td>

                <td>

                </td>
            </tr>
        </table>
    </div>
</body>
</html>
