<!DOCTYPE html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Задание 2</title>
</head>
<body>
<main class="container-sm">
    <div class="my-3" id="comments"></div>
    <div class="row mt-12">
        <div class="col-md-12 ">
            <form method="POST" class="input-group mb-3">
                <input class="form-control" type="text" name="name" placeholder="Name" aria-label="Name">
                <textarea class="form-control" name="comment" placeholder="Comment" aria-label="Comment"></textarea>
                <button class="btn btn-outline-secondary" type="submit">Отправить</button>
            </form>
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
    let commentsResponse = <?php echo json_encode($commentsResponse, JSON_UNESCAPED_UNICODE); ?>;

    /**
     * Собираем из массива вывод комментариев
     * @param commentsResponse
     */
    function generateComments (commentsResponse)
    {
        let comments = document.querySelector("#comments");
        for (let comment in commentsResponse){
            console.log(commentsResponse);
            const row = document.createElement("div");
            row.classList.add("row", "mt-12");

            const nameParagraph = document.createElement("p");
            nameParagraph.textContent = commentsResponse[comment]['name'];
            nameParagraph.classList.add("col-md-3", "my-3", "border-secondary");
            row.appendChild(nameParagraph);
            row.appendChild(document.createElement("br"));


            const colDiv = document.createElement("div");
            colDiv.classList.add("col-md-12");
            const commentParagraph = document.createElement("p");
            commentParagraph.textContent = commentsResponse[comment]['comment'];
            colDiv.appendChild(commentParagraph);
            row.appendChild(colDiv);

            const hrOutside = document.createElement("hr");
            hrOutside.classList.add("my-3", "border-secondary");

            comments.appendChild(row);
            comments.appendChild(hrOutside);
        }

    }
    generateComments(commentsResponse);
</script>