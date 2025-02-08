<!DOCTYPE html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Задание 1</title>
</head>
<body>
<main class="container-sm">
    <div class="row mt-12">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr id="tableHead"></tr>
                </thead>
                <tbody id="resultsTable"></tbody>
            </table>
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
<script>
    let results = <?php echo json_encode($results, JSON_UNESCAPED_UNICODE); ?>;

    /**
     * отображение таблицы
     * @param results
     */
    function generateTable(results)
    {
        let tableHead = document.querySelector("#tableHead");
        let tbody = document.querySelector("#resultsTable");

        tableHead.innerHTML = "<th></th>";

        // Собираем все уникальные предметы
        let subjects = new Set();
        for (let student in results) {
            for (let subject in results[student]) {
                subjects.add(subject);
            }
        }
        subjects = Array.from(subjects).sort(); // Сортируем предметы

        // Добавляем заголовки предметов
        subjects.forEach(subject => {
            let th = document.createElement("th");
            th.textContent = subject;
            tableHead.appendChild(th);
        });

        // Заполняем таблицу данными
        for (let student in results) {
            let row = document.createElement("tr");

            let nameCell = document.createElement("td");
            nameCell.textContent = student;
            row.appendChild(nameCell);

            subjects.forEach(subject => {
                let scoreCell = document.createElement("td");
                scoreCell.textContent = results[student][subject] || "";
                row.appendChild(scoreCell);
            });

            tbody.appendChild(row);
        }
    }
    generateTable(results);
</script>