<?php
session_start();
include('include.php');
if(!isset($_SESSION['email'])){
    header("location:partielogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>userAccount</title>
    <style>
          :root {
              --background-color: #121212;
            
              --accent-color: #ff5722;
              --text-color: #e0e0e0;
            
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        h1 {
            text-align: center;
            color: var(--accent-color);
            font-size: 2.5em;
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
            animation: fadeIn 1s ease-in-out;
        }

       

        table {
            width: 100%;
            border-collapse: collapse;
            animation: fadeIn 1s ease;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: var(--accent-color);
            color: #fff;
            box-shadow: inset 0 -3px 0 rgba(0, 0, 0, 0.2);
        }

button[type="submit"] {
    background-color: var(--accent-color);
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 1em;
    border-radius: 5px;
    cursor: pointer;
    transition: transform 0.2s, background-color 0.3s;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
}

button[type="submit"]:hover {
    transform: scale(1.05);
    background-color: #e64a19;
}


select {
    background-color: #1e1e1e;
    color: var(--text-color);
    padding: 8px;
    font-size: 1em;
    border: 1px solid var(--accent-color);
    border-radius: 5px;
    cursor: pointer;
    transition: transform 0.2s, background-color 0.3s;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
}

select:hover,
select:focus {
    transform: translateY(-2px);
    background-color: rgba(255, 87, 34, 0.15);
}

option {
    background-color: #1e1e1e;
    color: var(--text-color);
}

       
    </style>
</head>
<body>
<?php



if (isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $new_etat = $_POST['etat'];
    $new_droit = $_POST['droit'];

    $stmt = $conn->prepare("UPDATE users SET etat = ?, droit = ? WHERE id = ?");
    $stmt->bind_param("ssi", $new_etat, $new_droit, $user_id);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('User updated successfully');</script>";
}


$result = $conn->query("SELECT id, nom, email, etat, droit FROM users");
?>

    <h1>User Management</h1>
    <table border="1" class="user-table">
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Status</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <?php while ($user = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($user['nom']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['etat']); ?></td>
                <td><?php echo htmlspecialchars($user['droit']); ?></td>
                <td>
                    <form action="adminusersacount.php" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        
                        
                        <select name="etat">
                            <option value="active" <?php if ($user['etat'] == 'active') echo 'selected'; ?>>Active</option>
                            <option value="desactive" <?php if ($user['etat'] == 'desactive') echo 'selected'; ?>>Desactive</option>
                        </select>

                        
                        <select name="droit">
                            <option value="user" <?php if ($user['droit'] == 'user') echo 'selected'; ?>>User</option>
                            <option value="admin" <?php if ($user['droit'] == 'admin') echo 'selected'; ?>>Admin</option>
                        </select>

                        <button type="submit" name="update_user">Update</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>