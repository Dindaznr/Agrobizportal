<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        table {
            border-collapse: collapse;
        }

        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }

        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }

        td, th {
            display: table-cell;
            vertical-align: inherit;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table-sm td, .table-sm th {
            padding: .3rem;
        }
        .table td, .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        th {
            text-align: inherit;
        }

        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }
        
        .h3, h3 {
            font-size: 1.575rem;
        }

        h2, h3, h4, h5, h6 {
            margin-bottom: .5rem;
            font-family: inherit;
            font-weight: 500;
            line-height: 1.2;
            color: inherit;
        }

        .h2, h2 {
            font-size: 1.8rem;
        }
        
        h1, h2, h3, h4, h5, h6 {
            margin-top: 0;
            margin-bottom: .5rem;
        }
        
        .margin-bottom {
            margin-bottom: 100px;
        }

        /* header */

        header { margin: 0 0 3em; }
        header:after { clear: both; content: ""; display: table; }

        header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
        header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
        header address p { margin: 0 0 0.25em; }
        header span, header img { display: block; float: right; }
        header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
        header img { max-height: 100%; max-width: 100%; }
        header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

        /* article */

        article, article address, table.meta, table.inventory { margin: 0 0 3em; }
        article:after { clear: both; content: ""; display: table; }
        article h1 { clip: rect(0 0 0 0); position: absolute; }

        article address { float: left; font-size: 125%; font-weight: bold; }

        /* table meta & balance */

        table.meta { float: right; width: 36%; }
        table.meta:after { clear: both; content: ""; display: table; }

        /* table meta */

        table.meta th { width: 40%; }
        table.meta td { width: 60%; }
    </style>
</head>
<body>
	<center>
        <h2 class="h3 margin-bottom">Rekap Total Penjualan Product</h2>
	</center>
    <header>
        <h4>Agrobizportal</h4>
        <address>
            <p>Jl. Ciledug Raya, Petukangan Utara, <br>
            Jakarta Selatan, 12260. DKI Jakarta</p>
            <p> +62 858-1447-8853</p>
        </address>
    </header>
    <article>
        <table class="meta">
            <tr>
                <th><span>Tanggal</span></th>
                <td><span>January 1, 2012</span></td>
            </tr>
        </table>
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Total Penjualan (Unit)</th>
                        <th>Total Penjualan (Rupiah)</th>
                        <th>Transaksi (Unit)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalSales = 0;
                        $totalTransaction = 0;
                    @endphp
                    @foreach($products as $no => $product)
                    <tr>
                        <td>{{ $no += 1 }}</td>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['sale_counts'] }}</td>
                        <td>{{ number_format($product['price'] * $product['sale_counts']) }}</td>
                        <td>{{ count($product->orderItem) }}</td>
                        <?php
                        $totalSales += $product['price'] * $product['sale_counts']; 
                        $totalTransaction += count($product->orderItem);
                        ?>
                    </tr>
                    @endforeach
                    <tr>
                        <th scope="row">Total: </th>
                        <td colspan="1"></td>
                        <td>{{ $products->sum('sale_counts') }}</td>
                        <td >Rp. {{ number_format( $totalSales ) }}</td>
                        <td>{{ $totalTransaction }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </article>
</body>
</html>