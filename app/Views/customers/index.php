<?php include __DIR__ . '/header.php'; ?>
<div class="card">
  <div class="controls">
    <form style="display:flex; gap:8px; align-items:center; margin:0" method="GET" action="index.php">
      <input type="hidden" name="controller" value="customer">
      <input type="hidden" name="action" value="index">
      <input class="input" type="text" name="q" placeholder="Search customers by name or email" value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
      <button class="btn btn-muted" type="submit">Search</button>
    </form>

    <div style="margin-left:auto; display:flex; gap:8px">
      <a class="btn btn-teal" href="index.php?controller=customer&action=create">+ Add Customer</a>
    </div>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Company</th>
        <th>Phone</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($customers)): ?>
        <tr><td colspan="6" style="padding:20px; text-align:center; color:#718096">No customers found.</td></tr>
      <?php else: ?>
        <?php foreach ($customers as $c): ?>
        <tr>
          <td><?= htmlspecialchars($c['id']) ?></td>
          <td><?= htmlspecialchars($c['name']) ?></td>
          <td><?= htmlspecialchars($c['email']) ?></td>
          <td><?= htmlspecialchars($c['company_name']) ?></td>
          <td><?= htmlspecialchars($c['phone']) ?></td>
          <td>
            <a class="action view" href="index.php?controller=customer&action=view&id=<?= $c['id'] ?>">View</a>
            <a class="action edit" href="index.php?controller=customer&action=edit&id=<?= $c['id'] ?>">Edit</a>
            <a class="action del" href="index.php?controller=customer&action=delete&id=<?= $c['id'] ?>" onclick="return confirm('Delete this customer?')">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>
<?php include __DIR__ . '/footer.php'; ?>
