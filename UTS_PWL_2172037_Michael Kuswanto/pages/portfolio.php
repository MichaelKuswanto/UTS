<?php
$PortfolioDao = new \dao\PortfolioDao();

$deleteCommand = filter_input(INPUT_GET, 'cmd');
if (isset($deleteCommand) && $deleteCommand == 'del') {
    $bookIsbn = filter_input(INPUT_GET, 'bis');
    $result = $PortfolioDao->deleteBookToDb($bookIsbn);
    if ($result) {
        echo '<div>Data successfully removed</div>';
    } else {
        echo '<div>Failed to remove data</div>';
    }
}

$submitPressed = filter_input(INPUT_POST,"btnSave");
if (isset($submitPressed)) {
    $isbn = filter_input(INPUT_POST, "txtisbn");
    $title = filter_input(INPUT_POST, "txttitle");
    $author = filter_input(INPUT_POST, "txtauthor");
    $publisher = filter_input(INPUT_POST, "txtpublisher");
    $year = filter_input(INPUT_POST, "txtyear");
    $des = filter_input(INPUT_POST, "txtdes");
    $genreId = filter_input(INPUT_POST, "txtgenre");
    $genre = new \entity\Genre();
    $genre->setId($genreId);

    $book = new \entity\Book();
    $book->setIsbn($isbn);
    $book->setTitle($title);
    $book->setAuthor($author);
    $book->setPublisher($publisher);
    $book->setYear($year);
    $book->setDescription($des);
    $book->setGenre($genre);
    $result = $bookDao->addNewBook($book);
    if ($result) {
        echo '<div>Data successfully added</div>';
    } else {
        echo '<div>Failed to add data</div>';
    }
}
?>


<div class="row d-flex justify-content-center">
    <div class="w-100 p-3 bg-light">
        <form method="post">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-3">
                    <label for="txttitle">Portfolio Title</label>
                </div>
                <div class="col-sm-7">
                    <input type="text" maxlength="45" placeholder="Title" required autofocus name="txttitle" id="txttitle">
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-3">
                    <label for="txttype">Participation Type</label>
                </div>
                <div class="col-sm-7">
                    <input type="text" maxlength="45" placeholder="Contribution" required autofocus name="txttype" id="txttype" value="Peserta">
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-3">
                    <label for="txtdes">Description</label>
                </div>
                <div class="col-sm-7">
                    <textarea maxlength="45" required autofocus name="txtdes" id="txtdes"></textarea>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-3">
                    <label for="txtplace">Place</label>
                </div>
                <div class="col-sm-7">
                    <input type="text" maxlength="45" placeholder="Activity Place" required autofocus name="txtplace" id="txtplace">
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-3">
                    <label for="txtfile">Certificate</label>
                </div>
                <div class="col-sm-7">
                    <input type="file" name="txtfile" id="txtfile" accept="image/*"></input>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-3">
                    <input type="submit" value="Save Data" name="btnSave">
                </div>
                <div class="col-sm-7">

                </div>
            </div>
        </form>
    </div>
</div>



<div class="row d-flex justify-content-center">
    <div class="w-100 p-3 bg-light">
        <table class="table table-striped justify-content-center">
            <thead>
            <tr>
                <th scope="col">Created At</th>
                <th scope="col">Portfolio Detail</th>
                <th scope="col">Certificate</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result = $PortfolioDao->fetchPortfolioFromDb();
            /** @var  $portfolio \entity\Portfolio */
            foreach ($result as $portfolio) {
                if ($book->getCover() == NULL) {
                    $book->setCover('uploads/default.png');
                }
                echo '<tr>';
                echo '<td>' . $portfolio->getCreatedAt(). '</td>' ;
                echo '<td>' . $book->getTitle(). '</td>' ;
                echo '<td>' . '<img width="105" height="150"  src="' . $book->getCover() . '">'. '</td>' ;
                echo '<td>' . $book->getAuthor(). '</td>' ;
                echo '<td>' . $book->getPublisher(). '</td>' ;
                echo '<td>' . $book->getYear(). '</td>' ;
                echo '<td>' . $book->getDescription(). '</td>' ;
                echo '<td>' . $book->getGenre()->getName(). '</td>' ;
                echo '<td>
                <button onclick="editBook(\'' . $book->getIsbn() . '\')" class="btn btn-warning">Edit Data</button>
                <button onclick="deleteBook(\'' . $book->getIsbn() . '\')" class="btn btn-danger">Delete Data</button>
                </td>' ;
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script src="js/book_index.js"></script>