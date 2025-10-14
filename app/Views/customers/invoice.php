<?php include 'layout/sidebar.php'; ?>

<div class="main-content">
  <h2 class="page-title"><i class="fa fa-file-invoice"></i> Invoice Management</h2>

  <!-- 🔍 Filter & Search -->
  <div class="filter-bar">
    <form method="GET" action="" class="filter-form">
      <input type="text" name="search" placeholder="Search by customer or invoice #" class="filter-input" value="<?= $_GET['search'] ?? '' ?>">
      <select name="status" class="filter-select">
        <option value="">All Status</option>
        <option value="paid" <?= (($_GET['status'] ?? '') == 'paid') ? 'selected' : '' ?>>Paid</option>
        <option value="unpaid" <?= (($_GET['status'] ?? '') == 'unpaid') ? 'selected' : '' ?>>Unpaid</option>
        <option value="pending" <?= (($_GET['status'] ?? '') == 'pending') ? 'selected' : '' ?>>Pending</option>
      </select>
      <input type="month" name="month" class="filter-input" value="<?= $_GET['month'] ?? '' ?>">
      <button type="submit" class="filter-btn"><i class="fa fa-filter"></i> Filter</button>
    </form>
  </div>

  <!-- 📄 Invoice Table -->
  <div class="card">
    <table class="invoice-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Invoice No</th>
          <th>Customer</th>
          <th>Date</th>
          <th>Amount (KES)</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // ✅ Example static data (replace with DB query later)
        $invoices = [
          ['INV-001', 'John Doe', '2025-09-12', 12500, 'Paid', 'john@example.com'],
          ['INV-002', 'Mary Wambui', '2025-09-18', 8900, 'Unpaid', 'mary@example.com'],
          ['INV-003', 'Ali Said', '2025-09-20', 15800, 'Pending', 'ali@example.com'],
          ['INV-004', 'Peter Kamau', '2025-09-25', 20000, 'Paid', 'peter@example.com'],
        ];

        $filtered = array_filter($invoices, function($inv) {
          $search = strtolower($_GET['search'] ?? '');
          $status = strtolower($_GET['status'] ?? '');
          $month = $_GET['month'] ?? '';

          if ($search && !str_contains(strtolower($inv[1] . ' ' . $inv[0]), $search)) return false;
          if ($status && strtolower($inv[4]) !== $status) return false;
          if ($month && strpos($inv[2], $month) !== 0) return false;
          return true;
        });

        $count = 1;
        foreach ($filtered as $inv): ?>
          <tr>
            <td><?= $count++ ?></td>
            <td><?= $inv[0] ?></td>
            <td><?= $inv[1] ?></td>
            <td><?= date('M d, Y', strtotime($inv[2])) ?></td>
            <td><?= number_format($inv[3]) ?></td>
            <td><span class="status <?= strtolower($inv[4]) ?>"><?= $inv[4] ?></span></td>
            <td class="actions">
              <a href="#" class="btn-view" data-invoice='<?= json_encode($inv) ?>' title="View"><i class="fa fa-eye"></i></a>
              <a href="#" class="btn-download" data-link="generate_invoice.php?invoice=<?= $inv[0] ?>" data-id="<?= $inv[0] ?>" title="Download"><i class="fa fa-download"></i></a>
              <a href="#" class="btn-email" data-email="<?= $inv[5] ?>" data-id="<?= $inv[0] ?>" title="Email"><i class="fa fa-envelope"></i></a>
              <a href="#" class="btn-delete" data-id="<?= $inv[0] ?>" title="Delete"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
        <?php endforeach; ?>

        <?php if (empty($filtered)): ?>
          <tr><td colspan="7" style="text-align:center; color:#888;">No invoices found</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- 🪟 Invoice Modal -->
<div class="modal" id="invoiceModal">
  <div class="modal-content">
    <span class="close-btn">&times;</span>
    <h3><i class="fa fa-file-invoice"></i> Invoice Details</h3>
    <div id="invoiceDetails"></div>
  </div>
</div>

<!-- 🪟 Download Confirmation Modal -->
<div class="modal" id="downloadModal">
  <div class="modal-content">
    <h3><i class="fa fa-download"></i> Confirm Download</h3>
    <p>Are you sure you want to download this invoice?</p>
    <div style="text-align:right; margin-top:20px;">
      <button id="cancelDownload" style="background:#ccc; padding:6px 12px; border:none; border-radius:6px; cursor:pointer;">Cancel</button>
      <button id="confirmDownload" style="background:#10b981; color:white; padding:6px 12px; border:none; border-radius:6px; cursor:pointer;">Download</button>
    </div>
  </div>
</div>

<!-- 💅 Styles -->
<style>
.page-title { font-size: 1.6rem; font-weight: 600; color: #111827; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; } 
.filter-bar { margin-bottom: 20px; background: #fff; padding: 15px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.08); } .filter-form { display: flex; flex-wrap: wrap; gap: 10px; } 
.filter-input, .filter-select { padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px; flex: 1; } .filter-btn { background: #10b981; color: #fff; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; transition: 0.2s; } 
.filter-btn:hover { background: #0e9a75; } .card { background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.1); } .invoice-table { width: 100%; border-collapse: collapse; } .invoice-table th, .invoice-table td { padding: 12px 15px; border-bottom: 1px solid #e5e7eb; text-align: left; } 
.invoice-table th { background: #111827; color: #fff; font-weight: 600; } .status { padding: 4px 10px; border-radius: 20px; font-size: 0.85rem; font-weight: 500; } 
.status.paid { background: #16a34a; color: #fff; } .status.unpaid { background: #dc2626; color: #fff; } .status.pending { background: #f59e0b; color: #fff; } 
.actions a { margin-right: 8px; color: #555; font-size: 1rem; transition: 0.2s; } .actions a:hover { color: #10b981; transform: scale(1.1); }
.modal {
  display: none; position: fixed; z-index: 2000;
  left: 0; top: 0; width: 100%; height: 100%;
  background: rgba(0,0,0,0.6); justify-content: center; align-items: center;
}
.modal-content {
  background: white; padding: 25px; border-radius: 10px;
  width: 400px; max-width: 90%;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  text-align: center;
}
.close-btn { float: right; cursor: pointer; font-size: 20px; color: #666; }
.close-btn:hover { color: red; }
</style>

<!-- ⚙️ JS -->
<script>
let downloadLink = "";

// 🧾 View Invoice
document.querySelectorAll('.btn-view').forEach(btn => {
  btn.addEventListener('click', e => {
    e.preventDefault();
    const data = JSON.parse(btn.dataset.invoice);
    const modal = document.getElementById('invoiceModal');
    const details = document.getElementById('invoiceDetails');

    details.innerHTML = `
      <p><strong>Invoice No:</strong> ${data[0]}</p>
      <p><strong>Customer:</strong> ${data[1]}</p>
      <p><strong>Date:</strong> ${data[2]}</p>
      <p><strong>Amount:</strong> KES ${data[3].toLocaleString()}</p>
      <p><strong>Status:</strong> ${data[4]}</p>
      <p><strong>Email:</strong> ${data[5]}</p>
    `;
    modal.style.display = 'flex';
  });
});

// 💾 Download Confirmation
document.querySelectorAll('.btn-download').forEach(btn => {
  btn.addEventListener('click', e => {
    e.preventDefault();
    downloadLink = btn.dataset.link;
    document.getElementById('downloadModal').style.display = 'flex';
  });
});

document.getElementById('confirmDownload').addEventListener('click', () => {
  window.open(downloadLink, '_blank'); // open new tab for download
  document.getElementById('downloadModal').style.display = 'none';
});

document.getElementById('cancelDownload').addEventListener('click', () => {
  document.getElementById('downloadModal').style.display = 'none';
});

// 📨 Email Invoice
document.querySelectorAll('.btn-email').forEach(btn => {
  btn.addEventListener('click', e => {
    e.preventDefault();
    alert(`✅ Invoice ${btn.dataset.id} sent to ${btn.dataset.email}`);
  });
});

// 🗑️ Delete Invoice
document.querySelectorAll('.btn-delete').forEach(btn => {
  btn.addEventListener('click', e => {
    e.preventDefault();
    const id = btn.dataset.id;
    if (confirm(`Are you sure you want to delete invoice ${id}?`)) {
      btn.closest('tr').remove();
      alert(`🗑️ Invoice ${id} deleted.`);
    }
  });
});

// Close modals
document.querySelectorAll('.close-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    btn.closest('.modal').style.display = 'none';
  });
});

window.onclick = e => {
  document.querySelectorAll('.modal').forEach(modal => {
    if (e.target === modal) modal.style.display = 'none';
  });
};
</script>
