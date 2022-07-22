<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
    <input type="text" value="create" name="action" hidden>
    <input type="submit" value="Create">
</form>


<table id="myTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Auteur</th>
            <th>Publication parente</th>
            <th>Statut</th>
            <th>Date de publication</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <?php
        foreach ($config as $comment) :
        ?>
            <input type="text" value="<?= $comment->getId() ?>" name="update" hidden>
            <tr>
                <td><a href="comments/<?= $comment->getId() ?>"><?= $comment->getId() ?></a></td>
                    <td><?= $comment->showAuthor() ?></td>
                    <td><?= $comment->getPost() ?>
                    <td>
                        <?= $comment->showStatus() ?>
                    </td>
                    <td>
                         <?= $comment->getFormatedDate() ?>
                    </td>
                    <td><form action="/comments/<?= $comment->getId() ?>/delete" method="post" onsubmit="return confirm('Are you sure you want to delete this post, this action is unreversible?');">
                        <input type="hidden" name="id" value="<?= $comment->getId() ?>">
                        <input type="hidden" name="type" value="delete">
                        <input type="hidden" name="input" value="comment">
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