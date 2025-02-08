<!DOCTYPE html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Задание 2</title>
</head>
<body>
<main class="container-sm">
    <div class="row mt-3">
        <div class="col-md-12">
            <p class="text-center"><?= ($response !== false) ? "Модифицировано " . $response . " строк" : "Что-то пошло не так"?></p>
        </div>
    </div>
    <div class="row mt-12">
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <a class="btn btn-secondary btn-lg active d-block mx-auto w-50" href="/">Назад</a>
        </div>
    </div>
</main>
</body>