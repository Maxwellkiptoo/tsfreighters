<?php include __DIR__ . '/header.php'; ?>
<div class="card" style="max-width:720px; margin:auto">
  <form method="POST" style="display:grid; gap:12px">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
    <div style="display:flex; gap:12px">
      <div style="flex:1">
        <label style="display:block; font-weight:600; margin-bottom:6px">Name</label>
        <input class="input" name="name" required value="<?= htmlspecialchars($customer['name']) ?>">
      </div>
      <div style="flex:1">
        <label style="display:block; font-weight:600; margin-bottom:6px">Email</label>
        <input class="input" name="email" type="email" required value="<?= htmlspecialchars($customer['email']) ?>">
      </div>
    </div>

    <div style="display:flex; gap:12px">
      <div style="flex:1">
        <label style="display:block; font-weight:600; margin-bottom:6px">Phone</label>
        <input class="input" name="phone" required value="<?= htmlspecialchars($customer['phone']) ?>">
      </div>
      <div style="flex:1">
        <label style="display:block; font-weight:600; margin-bottom:6px">Company</label>
        <input class="input" name="company_name" value="<?= htmlspecialchars($customer['company_name']) ?>">
      </div>
    </div>

    <div>
      <label style="display:block; font-weight:600; margin-bottom:6px">Address</label>
      <textarea class="input" name="address" rows="3"><?= htmlspecialchars($customer['address']) ?></textarea>
    </div>

    <div style="display:flex; gap:12px; justify-content:flex-end">
      <a class="btn" href="index.php?controller=customer&action=index" style="background:#e6e9ee; color:#333; text-decoration:none">Cancel</a>
      <button class="btn btn-teal" type="submit">Update Customer</button>
    </div>
  </form>
</div>
<?php include __DIR__ . '/footer.php'; ?>
