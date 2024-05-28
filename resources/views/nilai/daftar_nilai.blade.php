<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ini adalah file kedua</h1>
    @php 
    $no = 1;
    $s1 = ['nama'=> 'Fawazz', 'nilai'=>70];
    $s2 = ['nama'=> 'Ali', 'nilai'=>80];
    $s3 = ['nama'=> 'Andi', 'nilai'=>80];
    $s4 = ['nama'=> 'Aji', 'nilai'=>60];
    $s5 = ['nama'=> 'Adi', 'nilai'=>90];
    $judul = ['No', 'Nama', 'Nilai', 'Keterangan'];

    $siswa = [$s1,$s2,$s3,$s4,$s5];
    @endphp
    <table align="center" border="1" cellpadding="10">
        <thead>
            <tr>
                {{-- foreach adalah sebuah perulangan yang dimiliki oleh php didalam laravel --}}
                @foreach($judul as $jdl)
                <th>{{$jdl}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($siswa as $s)
            @php 
            $ket = ($s['nilai'] >= 60) ? 'Lulus' : 'Gagal';
            $warna = ($no % 2 == 1) ? 'Green' : 'Yellow';
            @endphp
            <tr bgcolor="{{$warna}}">
                <td>{{$no++}}</td>
                <td>{{$s['nama']}}</td>
                <td>{{$s['nilai']}}</td>
                <td>{{$ket}}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</body>
</html>