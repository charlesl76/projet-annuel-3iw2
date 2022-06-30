<h1>Liste des utilisateurs</h1>

<table id="myTable" class="display">
    <thead>
        <tr>
            <td>Username</td>
            <td>Firstname</td>
            <td>Lastname</td>
            <td>Role</td>
            <td colspan=2 >Actions</td>
        </tr>
    </thead>

    <tbody>
        <?php foreach($users as $user) : ?> 
            <tr>
                <td><?php echo $user['username']; ?> </td>
                <td><?php echo $user['first_name']; ?> </td>
                <td><?php echo $user['last_name']; ?> </td>
                <td><?php echo $user['role']; ?> </td>
                <td>
                    <a href="/users/<?= $user['id'] ?>">Update</a>
                </td>
                <td>
                    <form action="/users/<?= $user['id']?>/delete" method="post">
                        <input type="hidden" name="id" value="<?= $user['id']?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>

            </tr>
        <?php endforeach; ?>
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