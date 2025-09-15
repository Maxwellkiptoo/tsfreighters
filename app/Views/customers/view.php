<?php include __DIR__ . '/header.php'; ?>
<div class="card" style="max-width:760px; margin:auto; display:grid; grid-template-columns: 1fr 2fr; gap:16px; align-items:start">
  <div style="background:linear-gradient(180deg,var(--glass),#fff); padding:16px; border-radius:10px">
    <div style="font-weight:700; font-size:20px"><?= htmlspecialchars($customer['name']) ?></div>
    <div style="color:var(--muted); margin-top:6px"><?= htmlspecialchars($customer['company_name']) ?></div>
    <div style="margin-top:12px">
      <div style="font-size:13px; color:var(--muted)">Email</div>
      <div><?= htmlspecialchars($customer['email']) ?></div>
    </div>
    <div style="margin-top:8px">
      <div style="font-size:13px; color:var(--muted)">Phone</div>
      <div><?= htmlspecialchars($customer['phone']) ?></div>
    </div>
  </div>

  <div class="card" style="padding:16px">
    <div style="font-weight:700">Address</div>
    <div style="margin-top:8px; color:#334155"><?= nl2br(htmlspecialchars($customer['address'])) ?></div>

    <div style="margin-top:16px; display:flex; gap:8px; justify-content:flex-end">
      <a class="btn" href="index.php?controller=customer&action=edit&id=<?= $customer['id'] ?>" style="background:var(--warning); color:white">Edit</a>
      <a class="btn" href="index.php?controller=customer&action=index" style="background:#e6e9ee; color:#333">Back</a>
    </div>
  </div>
</div>
<?php include __DIR__ . '/footer.php'; ?>
