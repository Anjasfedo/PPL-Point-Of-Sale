<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Penjualan - No: {{ tambah_nol_didepan($penjualan->id_penjualan, 10) }}</title>
    <?php
    $style = '
        <style>
            * {
                font-family: "consolas", sans-serif;
            }
            p {
                display: block;
                margin: 3px;
                font-size: 10pt;
            }
            table td {
                font-size: 9pt;
            }
            .text-center {
                text-align: center;
            }
            .text-right {
                text-align: right;
            }
    
            @media print {
                @page {
                    margin: 0;
                    size: 75mm 
        ';
    ?>
    <?php
    $style .= !empty($_COOKIE['innerHeight']) ? $_COOKIE['innerHeight'] . 'mm; }' : '}';
    ?>
    <?php
    $style .= '
                html, body {
                    width: 70mm;
                }
                .btn-print {
                    display: none;
                }
            }
        </style>
        ';
    ?>

    {!! $style !!}
</head>

<body onload="window.print()">
    <button class="btn-print" style="position: absolute; right: 1rem; top: rem;" onclick="window.print()">Print</button>
    <br>
    <div>
        <p style="float: left;">{{ date('d-m-Y') }}</p>
        <p style="float: right">{{ strtoupper(auth()->user()->name) }}</p>
    </div>
    <div class="clear-both" style="clear: both;"></div>
    <p>No: {{ tambah_nol_didepan($penjualan->id_penjualan, 10) }}</p>
    <hr>
    <br>
    <table width="100%" style="border: 0;">
        @foreach ($detail as $item)
            <tr>
                <td colspan="3">{{ $item->barang->nama_barang }}</td>
            </tr>
            <tr>
                <td>{{ $item->jumlah }} x {{ format_uang($item->barang->harga_jual) }}</td>
                <td></td>
                <td class="text-right">{{ format_uang($item->total_harga) }}</td>
            </tr>
        @endforeach
    </table>
    <hr>
    <table width="100%" style="border: 0;">
        <tr>
            <td>Total Item:</td>
            <td class="text-right">{{ $penjualan->total_item }}</td>
        </tr>
        <tr>
            <td>Diterima:</td>
            <td class="text-right">{{ format_uang($penjualan->diterima) }}</td>
        </tr>
        <tr>
            <td>Total Harga:</td>
            <td class="text-right">{{ format_uang($penjualan->total_penjualan) }}</td>
        </tr>
        <tr>
            <td>Kembali:</td>
            <td class="text-right">{{ format_uang($penjualan->kembalian) }}</td>
        </tr>
    </table>
    <hr>
    <p class="text-center">-- TERIMA KASIH --</p>
    <script>
        let body = document.body;
        let html = document.documentElement;
        let height = Math.max(
            body.scrollHeight, body.offsetHeight,
            html.clientHeight, html.scrollHeight, html.offsetHeight
        );
        document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "innerHeight=" + ((height + 50) * 0.264583);
        let filename = document.title.replace(/ /g, "_") + ".pdf";
        document.title = filename;
        let contentDispositionHeader = `attachment; filename="${filename}"`;
        let contentDispositionMeta = document.createElement('meta');
        contentDispositionMeta.httpEquiv = 'Content-Disposition';
        contentDispositionMeta.content = contentDispositionHeader;
        document.head.appendChild(contentDispositionMeta);
    </script>
</body>

</html>
