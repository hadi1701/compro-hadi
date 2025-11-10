<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Form</title>
    
</head>
<body>
    <h3>Matematika Sederhana</h3>
    <form action="{{route("bagi-action")}}" method="post">
        @csrf
        <label for="">Angka 1</label>
        <input type="text" placeholder="Masukkan angka" name="pertama" required>
        <br><br>
        <label for="">Angka 2</label>
        <input type="text" placeholder="Masukkan angka" name="kedua" required>
        <br><br>
        <button>Jumlahkan</button>
    </form>

    <h2>Jumlahnya adalah : {{$jumlah ?? 0}}</h2>
</body>
</html>