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
            <form method="POST" class="input-group mb-3">
                <p> Сколько родни у Алисы? </p>
            </form>
        </div>
    </div><div class="row mt-12">
        <div class="col-md-12">
            <form method="POST" class="input-group mb-3">
                <input class="form-control" type="text" name="sisters" placeholder="Сколько сестёр?" aria-label="Sisters" value="<?= $sisters ?>">
                <input class="form-control" type="text" name="brothers" placeholder="Сколько братьев?" aria-label="Brothers" value="<?= $brothers ?>">
                <button class="btn btn-outline-secondary" type="submit">Отправить</button>
            </form>
        </div>
    </div>
    <div class="row mt-12">
        <div class="col-md-12">
            <p><?= $response ?></p>
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