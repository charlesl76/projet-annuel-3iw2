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
            if($entry['post_type'] == "category"){
                $entry['post_type'] = "tag";
            }
        ?>
            <input type="text" value="<?= $entry["id"] ?>" name="update" hidden>
            <tr>
                <td><a href="<?= $entry['post_type'] . 's/' . $entry['id'] . '">' . $entry["title"] ?></a></td>
                    <td><?= $entry["author"] ?></td>
                    <?= $entry['post_type'] == "article" ? "<td>" . $entry["post_parent"] . "</td>" : "" ?>
                    <?= $entry['post_type'] == "article" ? "<td>" . $entry["comment_count"] . "</td>" : "" ?>
                    <td>
                        <span><?php
                                    if($entry["status"] == 1){
                                        echo "<span style=\"color: green;\">Published</span><br>";
                                    } elseif($entry["status"] == 0){
                                        echo "<span style=\"color: grey;\">Hidden</span><br>";
                                    } elseif($entry["status"] == 2){
                                        echo "<span style=\"color: blue;\">Draft</span><br>";
                                    } else {
                                        echo "<span style=\"color: red;\">Recycle bin</span><br>";
                                    }
                        ?></span>
                        <span><?php $entry["date"] = new DateTime($entry["date"]); echo date_format($entry["date"],"m/d/Y - H:i") ?></span>
                    </td>
                    <td><form action=" <?= $entry['post_type'] ?>s/<?= $entry['id'] ?>/delete" method="post" onsubmit="return confirm('Are you sure you want to delete this post, this action is unreversible?');">
                        <input type="hidden" name="id" value="<?= $entry['id'] ?>">
                        <input type="hidden" name="type" value="delete">
                        <input type="hidden" name="input" value="<?= $entry['post_type'] ?>">
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