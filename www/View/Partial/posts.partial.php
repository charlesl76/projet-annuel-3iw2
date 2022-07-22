<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
    <input type="text" value="create" name="action" hidden>
    <input type="submit" value="Create">
</form>

<?php
// search in server uri for string after first slash
$uri = $_SERVER['REQUEST_URI'];
$uri = explode("/", $uri);
$type = $uri[1];
?>

<table id="myTable" class="display">
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <?= $type == "articles" ? "<th>Tag</th>" : "" ?>
            <?= $type == "articles" ? "<th>Comments</th>" : "" ?>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <?php
        foreach ($config as $entry) :
            if($entry->getPost_type() == "category"){
                $entry->setPost_type("tag");
            }
        ?>
            <input type="text" value="<?= $entry->getId() ?>" name="update" hidden>
            <tr>
                <td><a href="<?= $entry->getPost_type() . 's/' . $entry->getId() . '">' . $entry->getTitle() ?></a></td>
                    <td><?= $entry->showAuthor() ?></td>
                    <?= $entry->getPost_type() == "article" ? "<td>" . $entry->showTag() . "</td>" : "" ?>
                    <?= $entry->getPost_type() == "article" ? "<td>" . $entry->getComment_count() . "</td>" : "" ?>
                    <td>
                        <span><?php
                                    if($entry->getStatus() == 1){
                                        echo "<span style=\"color: green;\">Published</span><br>";
                                    } elseif($entry->getStatus() == 0){
                                        echo "<span style=\"color: grey;\">Hidden</span><br>";
                                    } elseif($entry->getStatus() == 2){
                                        echo "<span style=\"color: blue;\">Draft</span><br>";
                                    } else {
                                        echo "<span style=\"color: red;\">Recycle bin</span><br>";
                                    }
                        ?></span>
                        <span><?php echo $entry->getFormatedDate() ?></span>
                    </td>
                    <td><form action=" <?= $entry->getPost_type() ?>s/<?= $entry->getId() ?>/delete" method="post" onsubmit="return confirm('Are you sure you want to delete this post, this action is unreversible?');">
                        <input type="hidden" name="id" value="<?= $entry->getId() ?>">
                        <input type="hidden" name="type" value="delete">
                        <input type="hidden" name="input" value="<?= $entry->getPost_type() ?>">
                        <input type="submit" value="Delete">
                        </form>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
    </tbody>
</table>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "paging": true,
            "columns": [{
                    "width": "5%"
                },
                null,
                null,
                null,
                null
            ],
        });
    });
</script>