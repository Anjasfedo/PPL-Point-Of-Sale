<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota pembelian - No: {{ tambah_nol_didepan($pembelian->id_pembelian, 10) }}</title>

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
    $style .= 
        ! empty($_COOKIE['innerHeight'])
            ? $_COOKIE['innerHeight'] .'mm; }'
            : '}';
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
    {{-- <div class="text-center">
        <h3 style="margin-bottom: 5px;">{{ strtoupper($setting->nama_perusahaan) }}</h3>
        <p>{{ strtoupper($setting->alamat) }}</p>
    </div> --}}
    <br>
    <div>
        <p style="float: left;">{{ date('d-m-Y') }}</p>
        <p style="float: right">{{ strtoupper(auth()->user()->name) }}</p>
    </div>
    <div class="clear-both" style="clear: both;"></div>
    <p>No: {{ tambah_nol_didepan($pembelian->id_pembelian, 10) }}</p>
    <hr>
    
    <br>
    <table width="100%" style="border: 0;">
        @php
            $lastSupplier = null;
        @endphp
        @foreach ($detail as $item)
            @if ($item->supplier->nama_supplier !== $lastSupplier)
                <tr>
                    <td colspan="4"><strong>Supplier: {{ $item->supplier->nama_supplier }}</strong></td>
                </tr>
                @php
                    $lastSupplier = $item->supplier->nama_supplier;
                @endphp
            @endif
            <tr>
                <td colspan="3">{{ $item->produk->nama_produk }}</td>
            </tr>
            <tr>
                <td>{{ $item->jumlah }} x {{ format_uang($item->produk->harga_jual) }}</td>
                <td></td>
                <td class="text-right">{{ format_uang($item->total_harga) }}</td>
            </tr>
        @endforeach
    </table>
    
    <hr>

    <table width="100%" style="border: 0;">
        <tr>
            <td>Total Item:</td>
            <td class="text-right">{{ $pembelian->total_item }}</td>
        </tr>
        {{-- <tr>
            <td>Diskon:</td>
            <td class="text-right">{{ format_uang($pembelian->diskon) }}</td>
        </tr>
        <tr>
            <td>Total Bayar:</td>
            <td class="text-right">{{ format_uang($pembelian->bayar) }}</td>
        </tr> --}}
        <tr>
            <td>Diterima:</td>
            <td class="text-right">{{ format_uang($pembelian->diterima) }}</td>
        </tr>
        <tr>
            <td>Total Harga:</td>
            <td class="text-right">{{ format_uang($pembelian->total_pembelian) }}</td>
        </tr>
        <tr>
            <td>Kembali:</td>
            <td class="text-right">{{ format_uang($pembelian->kembalian) }}</td>
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
        document.cookie = "innerHeight="+ ((height + 50) * 0.264583);

        // Set PDF file name based on the HTML title
        let filename = document.title.replace(/ /g, "_") + ".pdf";
        document.title = filename;
        let contentDispositionHeader = `attachment; filename="${filename}"`;

        // Add the Content-Disposition header to the HTML head
        let contentDispositionMeta = document.createElement('meta');
        contentDispositionMeta.httpEquiv = 'Content-Disposition';
        contentDispositionMeta.content = contentDispositionHeader;
        document.head.appendChild(contentDispositionMeta);
    </script>
</body>
</html>