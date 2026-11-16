<?php

    // Database connection
    include(__DIR__ . "/settings/database.php");

    // Get user ID
    $user_id = $_GET['userID'] ?? null;

    if ($user_id === null) {
    die("User ID not provided");
    }

    // Prepare query
    $sql_edit_user = "SELECT * FROM users WHERE id = $1";
    $res = pg_query_params($local_conn, $sql_edit_user, [$user_id]);

    if (!$res) {
        die("Error getting user information");
    }

    $user = pg_fetch_assoc($res);

    //echo "<pre>";
    //print_r($user);
    //echo "</pre>";
?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>

    <h2>Edit User Information</h2>

    <form action="update_user.php" method="POST">

        <input type="hidden" name="userID" value="<?= $user['id'] ?>">

        <label>First name:</label>
        <input type="text" name="firstname"
            value="<?= htmlspecialchars($user['firstname']) ?>">
        <br><br>

        <label>Last name:</label>
        <input type="text" name="lastname"
            value="<?= htmlspecialchars($user['lastname']) ?>">
        <br><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">
        <br><br>

        <label>Mobile Phone:</label>
        <input type="text" name="mobile_phone" value="<?= htmlspecialchars($user['mobile_phone']) ?>">
        <br><br>

        <label>Status:</label>

        <select name="status">
            <option value="t" <?= $user['status'] == 't' ? 'selected' : '' ?>>
                Active
            </option>

            <option value="f" <?= $user['status'] == 'f' ? 'selected' : '' ?>>
                Inactive
            </option>
        </select>
        <br><br>

        <button type="submit">Save Changes</button>

    </form>

</body>
</html>

