<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Reservasi {{ $reservasi->code }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
    <center>
    <div class="container">
        <h1>Data Reservasi Kode {{ $reservasi->code }}</h1>
        <h6>Tanggal  {{ date('d m Y') }}</h6>
        <h6>Pelanggan {{ $reservasi->user->name }}</h6>
        
        <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Menu</th>
                    <th>Jumlah Porsi</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $grandtotal = 0;
                @endphp
            @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }} </td>
                        <td>{{ $item->menu->nama_menu }}</td>
                        <td>{{ $item->jumlah }} Porsi</td>
                        <td>{{ format_rupiah($item->menu->harga) }}</td>
                        <td>{{ format_rupiah($item->subtotal) }}</td>
                    </tr>
                    @php
                        $grandtotal += $item->subtotal;
                    @endphp
                    @endforeach
                    <tr>
                        <b>
                        <th colspan="4">Total</th>
                        <th>{{ format_rupiah($grandtotal) }}</th>
                        </b>
                    </tr>
            </tbody>
        </table>    
    </div>
</center>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
