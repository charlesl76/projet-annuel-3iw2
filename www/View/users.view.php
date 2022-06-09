<h1>Liste des utilisateurs</h1>

<table>

    <td>Username</td>
    <td>Firstname</td>
    <td>Lastname</td>
    <td>Role</td>

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

</table>