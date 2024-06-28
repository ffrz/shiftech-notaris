<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite([])
</head>
<body>
    <h1>Selamat datang di {{ App\Models\Setting::value('company.notary_name', 'Notaris / PPAT') }} </h1>
    <p>Untuk pelacakan status pesanan anda, silahkan mengakses halaman berikut.<p>
    <p><a href="admin">Enter Administration area</a></p>
</body>
</html>
