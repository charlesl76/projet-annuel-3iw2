<form action="pages" method="POST">
        <input type="text" value="1" name="action" hidden>
        <input type="submit" value="Create">
    </form>

    <?php var_dump($_POST); ?>

    <table id="myTable" class="display">
        <thead>
            <tr>
                <th></th>
                <th>Title</th>
                <th>Author</th>
                <th>Comments</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($config as $entry) :
                // var_dump($entry);
            ?>
                <tr>
                    <td><span class="material-symbols-outlined">
                            check_box_outline_blank
                        </span></td>
                    <td><?= $entry["title"] ?></td>
                    <td><?= $entry["author"] ?></td>
                    <td><?= $entry["comment_count"] ?></td>
                    <td>
                        <span><?= $entry["status"] ?></span>
                        <span><?= $entry["date"] ?></span>
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
            "paging": false,
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