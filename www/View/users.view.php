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
                <td><a href="/user/delete?id=<?= $user['id']?>">Delete</a><td>
                <form action="/user/update" method="post">
                    <input type="hidden" name="id" value="<?= $user['id']?>">
                    <input type="submit" value="Update">
                </form>
            </tr>
        <?php endforeach; ?>

</table>