<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello Ini file pertama saya didalam view laravel</h1>
    @php
    $nama = 'Budi';
    $nilai = 70.00;
    @endphp
    {{-- struktu kendali IF --}}
    @if ($nilai >= 60)
    @php $ket = "lulus"; @endphp
    @else 
    @php $ket = "tidak lulus"; @endphp
    @endif

    {{-- memanggil variable hasil didalam laravel menggunakan kurung kurawal--}}
    {{$nama}} <p> Dengan nilai </p> {{$nilai}} <p>Dinyatakan </p> {{$ket}}


    
</body>
</html>