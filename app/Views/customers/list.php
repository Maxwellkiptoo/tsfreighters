<!DOCTYPE html>
<html>
<head>
<title>Customers</title>
<style>
body { font-family: Arial, sans-serif; margin: 20px; }
h1 { color: #333; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
table, th, td { border: 1px solid #ccc; }
th, td { padding: 10px; text-align: left; }
a.button { padding: 6px 12px; background: #28a745; color: #fff; text-decoration: none; border-radius: 4px; }
a.delete { background: #dc3545; }
a.button:hover { opacity: 0.9; }
</style>
</head>
<body>
<h1>Customer List</h1>
<a class="button" href="index.php?controller=customer&action=create">+ Add New Customer</a>
<table>
<tr>
    <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Company</th><th>Actions</th>
</tr>
<?php foreach ($customers as $cust): ?>
<tr>
    <td><?= $cust['id'] ?></td>
    <td><?= htmlspecialchars($cust['name']) ?></td>
    <td><?= htmlspecialchars($cust['email']) ?></td>
    <td><?= htmlspecialchars($cust['phone']) ?></td>
    <td><?= htmlspecialchars($cust['company_name']) ?></td>
    <td>
        <a class="button" href="index.php?controller=customer&action=edit&id=<?= $cust['id'] ?>">Edit</a>
        <a class="button delete" href="index.php?controller=customer&action=delete&id=<?= $cust['id'] ?>" onclick="return confirm('Delete this customer?')">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
