<?php
namespace Core;

use mysql_xdevapi\Exception;
use PDO;

require_once __DIR__ . "/Model.php";
class Controller
{
    /**
     * @param string $view
     * @param array $data
     * @return bool
     */
    private function view(string $view, array $data = [])
    {
        try {
            extract($data);
            require_once __DIR__ . '/../views/' . $view . '.php';
        } catch (Exception $exception){
            echo $exception->getMessage();
            return false;
        }
        return true;
    }

    /**
     * Навигатор по заданиям
     * @return bool
     */
    public function index()
    {
        //подключаем представление
        return $this->view('home');
    }

    /**
     * Имеется массив с баллами школьников по разным предметам.
     * $data = [
     * ['Иванов', 'Математика', 5],
     * ['Иванов', 'Математика', 4],
     * ['Иванов', 'Математика', 5],
     * [Петров, 'Математика', 5],
     * ['Сидоров', 'Физика', 4],
     * ['Иванов', 'Физика', 4],
     * ['Петров', 'ОБЖ', 4],
     * ];
     *
     * Необходимо вывести его в виде таблицы table-tr-td (баллы суммируются, школьники и предметы отсортированы)
     * @return bool
     */
    public function task1()
    {
        $input = [
            ['Иванов', 'Математика', 5],
            ['Иванов', 'Математика', 4],
            ['Иванов', 'Математика', 5],
            ['Петров', 'Математика', 5],
            ['Сидоров', 'Физика', 4],
            ['Иванов', 'Физика', 4],
            ['Петров', 'ОБЖ', 4],
        ];

        //проверяем студентов на уникальность предмета по студенту. суммируем баллы, сохраняем в ассоциативный массив
        $results = [];
        foreach ($input as $item) {
            if (isset($results[$item[0]][$item[1]])){
                $results[$item[0]][$item[1]] += $item[2];
            } else {
                $results[$item[0]][$item[1]] = $item[2];
            }
        }
        //сортируем по студентам
        ksort($results);

        return $this->view('task1', ['results' => $results]);
    }

    /**
     * Есть база данных состоящая из таблиц:
     * группы каталога
     * товары
     * наличие товаров на складах
     * склады
     * По некоторой причине нарушена их связность:
     * есть пустые группы (без товаров)
     * есть товары без наличия
     * есть склады без товаров
     *
     * Необходимо написать код для устранения (удаления) этих нарушений.
     * @return bool
     */
    public function task2()
    {
        //Модель для работы с бд
        $model = new Model();
        //3 запроса для устранения проблем
        $command = "DELETE FROM products WHERE id NOT IN (SELECT DISTINCT product_id FROM availabilities);
        DELETE FROM categories WHERE id NOT IN (SELECT DISTINCT category_id FROM products);
        DELETE FROM stocks WHERE id NOT IN (SELECT DISTINCT stock_id FROM availabilities);";

        return $this->view('task2', ['response' => $model->getDb()->exec($command)]);
    }

    /**
     * Создайте страницу со списком комментариев и формой добавления нового.
     * После отправки формы (с перезагрузкой страницы) новый комментарий должен сохраняться в БД и при отображении страницы выводиться последним в списке.
     * @return bool
     */
    public function task3()
    {
        //Модель для работы с бд
        $model = new Model();
        //если данные в POST приходят, то подготавливаем и запрос и исполняем
        if (isset($_POST['name']) && isset($_POST['comment'])) {
            $stmt = $model->getDb()->prepare("INSERT INTO comments (name, comment) VALUES (:name, :comment)");
            $stmt->execute([
                ':name' => $_POST['name'],
                ':comment' => $_POST['comment']
            ]);
        }
        //запрашиваем из бд все записи
        $stmt = $model->getDb()->prepare("SELECT * FROM comments");
        $stmt->execute();
        return $this->view('task3', ['commentsResponse' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
    }

    /**
     * Необходимо обрезать его до 29 слов с добавлением многоточия.
     * Форматирование необходимо сохранить.
     * @return bool
     */
    public function task4()
    {
        $stringLength = 29;
        $text = <<<TXT
            <p class="big">
                Год основания:<b>1589 г.</b> Волгоград отмечает день города в <b>2-е воскресенье сентября</b>. <br>В <b>2023 году</b> эта дата - <b>10 сентября</b>.
            </p>
            <p class="float">
                <img src="https://www.calend.ru/img/content_events/i0/961.jpg" alt="Волгоград" width="300" height="200" itemprop="image">
                <span class="caption gray">Скульптура «Родина-мать зовет!» . входит в число семи чудес России (Фото: Art Konovalov, по лицензии shutterstock.com)</span>
            </p>
            <p>
                <i><b>Великая Отечественная война в истории города</b></i></p><p><i>Важнейшей операцией Советской Армии в Великой Отечественной войне стала <a href="https://www.calend.ru/holidays/0/0/1869/">Сталинградская битва</a> (17.07.1942 - 02.02.1943). Целью боевых действий советских войск являлись оборона  Сталинграда и разгром действовавшей на сталинградском направлении группировки противника. Победа советских войск в Сталинградской битве имела решающее значение для победы Советского Союза в Великой Отечественной войне.</i>
            </p>
        TXT;
        //формируем DOM документ из текста и выделаем массив участков текста.
        $doc = new \DOMDocument();
        $doc->loadHTML(mb_convert_encoding($text, 'HTML-ENTITIES', 'UTF-8'));
        $xpath = new \DOMXPath($doc);
        $nodes = $xpath->query('//text()');

        $wordCounter = 0;
        foreach ($nodes as $index => $node) {
            // Выделяем только текст без знаков препинания и преобразуем в массив слов.
            $clearString = preg_replace('/[^a-zA-Zа-яА-ЯёЁ0-9 ]/u','', trim($nodes->item($index)->nodeValue));
            $words = preg_split('/[.\s,]+/', $clearString);

            // Убираем пустые элементы
            $words = array_filter($words, function($value) {
                return trim($value) !== "";
            });

            //Подсчитываем слова, как только количество слов превышает допустимое значение, отрезаем часть массива слов. Остальные превращаем в пустые строки
            $wordCounterPrev = $wordCounter;
            $wordCounter += count($words);
            if ($wordCounter > $stringLength) {
                $words = array_slice(preg_split('/[.\s,]+/', trim($nodes->item($index)->nodeValue)), 0, $stringLength - $wordCounterPrev);
                if ($wordCounterPrev < $stringLength){
                    $nodes->item($index)->nodeValue = implode(' ', $words) . '...';
                }else{
                    $nodes->item($index)->nodeValue = '';
                }
            }
        }
        return $this->view('task4', ['response' => $doc->saveHTML()]);
    }

    /**
     * У Алисы есть n сестер и m братьев.
     * Напишите функцию на php, принимающую эти параметры и возвращающую количество сестер произвольного брата Алисы.
     * @return bool
     */
    public function task5()
    {
        //преобразуем введённые данные, чтобы избежать ошибок и возвращаем ответ
        $sisters = isset($_POST['sisters']) && ctype_digit ($_POST['sisters'])? $_POST['sisters'] : 0;
        $brothers = isset($_POST['brothers']) && ctype_digit ($_POST['brothers'])? $_POST['brothers'] : 0;
        if ($brothers > 0) {
            return $this->view('task5', ['response' => "У брата Алисы ".($sisters+1)." сестра", 'sisters' => $sisters, 'brothers' => $brothers]);
        } else {
            if ($sisters <= 0) return $this->view('task5', ['response' => "Алиса скучает одна"]);
            return $this->view('task5', ['response' => "У Алисы нет братьев", 'sisters' => $sisters]);
        }
    }

}