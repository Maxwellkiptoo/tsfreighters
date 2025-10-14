<?php include 'layout/sidebar.php'; ?>

<div class="main-content">
  <h2 class="page-title"><i class="fa fa-file-invoice"></i> Invoice Management</h2>

  <!-- 🧾 Create Invoice Form -->
  <div class="card invoice-card">
    <h3><i class="fa fa-plus-circle"></i> Create New Invoice</h3>
    <form id="invoiceForm" method="POST" action="process_invoice.php" class="invoice-form">
      <div class="form-group">
        <label>Client Name</label>
        <input type="text" name="client_name" id="clientName" required placeholder="Enter client name">
      </div>

      <div class="form-group">
        <label>Service Description</label>
        <textarea name="description" id="description" required placeholder="e.g. Freight transport from Mombasa to Nairobi"></textarea>
      </div>

      <div class="form-group">
        <label>Amount (KES)</label>
        <input type="number" name="amount" id="amount" required placeholder="e.g. 12000">
      </div>

      <div class="form-group">
        <label>Send Invoice Via</label>
        <select name="send_method" id="sendMethod" required>
          <option value="">-- Select Option --</option>
          <option value="email">Email</option>
          <option value="sms">SMS</option>
        </select>
      </div>

      <div class="form-group" id="emailField" style="display:none;">
        <label>Recipient Email</label>
        <input type="email" name="email" id="email" placeholder="client@example.com">
      </div>

      <div class="form-group" id="phoneField" style="display:none;">
        <label>Recipient Phone (e.g. +254712345678)</label>
        <input type="text" name="phone" id="phone" placeholder="+2547...">
      </div>

      <div class="form-actions">
        <button type="submit" name="create_invoice"><i class="fa fa-paper-plane"></i> Generate & Send</button>
      </div>
    </form>
  </div>

  <!-- 👀 Live Preview Panel -->
  <div class="preview-card">
    <h3><i class="fa fa-eye"></i> Live Invoice Preview</h3>
    <div class="invoice-preview" id="invoicePreview">
      <div class="invoice-header">
        <div>
          <h4>TS Freighters Ltd</h4>
          <p>P.O Box 1123, Nairobi, Kenya</p>
          <p><strong>Date:</strong> <span id="prevDate"><?php echo date('Y-m-d'); ?></span></p>
        </div>
        <div class="invoice-number">
          <strong>Invoice No:</strong> <span id="prevNumber">INV-<?php echo strtoupper(substr(md5(time()), 0, 6)); ?></span>
        </div>
      </div>
      <hr>
      <p><strong>Client:</strong> <span id="prevClient">—</span></p>
      <p><strong>Service Description:</strong> <span id="prevDesc">—</span></p>
      <p><strong>Amount:</strong> <span id="prevAmount">—</span></p>
      <p><strong>Send Method:</strong> <span id="prevMethod">—</span></p>
      <p><strong>Recipient:</strong> <span id="prevRecipient">—</span></p>
      <div class="preview-actions">
        <button type="button" class="btn download"><i class="fa fa-download"></i> Download PDF</button>
        <button type="button" class="btn resend"><i class="fa fa-envelope"></i> Send Again</button>
      </div>
    </div>
  </div>

  <!-- 📜 Sent Invoices -->
  <div class="card sent-invoices">
    <h3><i class="fa fa-history"></i> Sent Invoices</h3>
    <div class="filter">
      <input type="text" id="searchInvoice" placeholder="🔍 Search by client or invoice number...">
    </div>
    <table class="invoice-table" id="invoiceTable">
      <thead>
        <tr>
          <th>Invoice No</th>
          <th>Client</th>
          <th>Amount (KES)</th>
          <th>Method</th>
          <th>Date</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>INV-87AF12</td>
          <td>John Doe</td>
          <td>12,500</td>
          <td>Email</td>
          <td>2025-10-10</td>
          <td><span class="status success">Sent</span></td>
          <td>
            <button class="btn-table"><i class="fa fa-eye"></i></button>
            <button class="btn-table"><i class="fa fa-download"></i></button>
          </td>
        </tr>
        <tr>
          <td>INV-92BB45</td>
          <td>Jane Wambui</td>
          <td>8,000</td>
          <td>SMS</td>
          <td>2025-10-09</td>
          <td><span class="status success">Sent</span></td>
          <td>
            <button class="btn-table"><i class="fa fa-eye"></i></button>
            <button class="btn-table"><i class="fa fa-download"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- 💅 CSS -->
<style>
.main-content { padding: 20px; }
.page-title {
  font-size: 1.7rem; font-weight: 600; color: #111827;
  margin-bottom: 25px; display: flex; align-items: center; gap: 10px;
}
.card {
  background: #fff; border-radius: 12px; padding: 25px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08); margin-bottom: 25px;
}
.invoice-form .form-group { margin-bottom: 15px; }
.invoice-form label { font-weight: 600; color: #374151; display: block; margin-bottom: 6px; }
.invoice-form input, .invoice-form textarea, .invoice-form select {
  width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem;
}
textarea { resize: vertical; min-height: 70px; }
.form-actions { text-align: right; margin-top: 15px; }
.form-actions button {
  background: #10b981; color: white; border: none; padding: 10px 18px; border-radius: 8px;
  cursor: pointer; transition: 0.3s;
}
.form-actions button:hover { background: #0e9a75; }

/* Preview Card */
.preview-card { background: #f9fafb; border: 1px dashed #d1d5db; border-radius: 10px; padding: 20px; }
.preview-card h3 { margin-bottom: 15px; color: #374151; display: flex; align-items: center; gap: 8px; }
.invoice-preview { font-size: 0.95rem; color: #111827; }
.invoice-header { display: flex; justify-content: space-between; }
.preview-actions { margin-top: 15px; display: flex; gap: 10px; }
.preview-actions .btn {
  padding: 8px 14px; border: none; border-radius: 6px; cursor: pointer;
  transition: 0.3s; font-size: 0.9rem; display: flex; align-items: center; gap: 6px;
}
.btn.download { background: #2563eb; color: #fff; }
.btn.resend { background: #f59e0b; color: #fff; }
.btn:hover { opacity: 0.9; }

/* Table */
.invoice-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
.invoice-table th, .invoice-table td { padding: 12px; border-bottom: 1px solid #e5e7eb; text-align: left; font-size: 0.95rem; }
.invoice-table th { background: #f3f4f6; color: #374151; }
.status.success { color: #10b981; font-weight: 600; }
.filter { margin-bottom: 12px; }
.filter input {
  width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;
}
.btn-table {
  background: #f3f4f6; border: none; padding: 6px 8px; border-radius: 6px;
  cursor: pointer; transition: 0.2s; color: #374151;
}
.btn-table:hover { background: #e5e7eb; }
@media(max-width: 768px){
  .invoice-header{ flex-direction: column; gap: 10px; }
  .preview-actions { flex-direction: column; }
}
</style>

<!-- ⚙️ JS -->
<script>
document.getElementById('sendMethod').addEventListener('change', function() {
  const emailField = document.getElementById('emailField');
  const phoneField = document.getElementById('phoneField');
  emailField.style.display = phoneField.style.display = 'none';
  if (this.value === 'email') emailField.style.display = 'block';
  if (this.value === 'sms') phoneField.style.display = 'block';
});

// 🔄 Live Preview
const updatePreview = () => {
  document.getElementById('prevClient').innerText = document.getElementById('clientName').value || '—';
  document.getElementById('prevDesc').innerText = document.getElementById('description').value || '—';
  document.getElementById('prevAmount').innerText = document.getElementById('amount').value ? `KSh ${document.getElementById('amount').value}` : '—';
  document.getElementById('prevMethod').innerText = document.getElementById('sendMethod').value || '—';
  document.getElementById('prevRecipient').innerText = document.getElementById('email').value || document.getElementById('phone').value || '—';
};
document.querySelectorAll('#invoiceForm input, #invoiceForm textarea, #invoiceForm select').forEach(el => el.addEventListener('input', updatePreview));

// 🔍 Search filter
document.getElementById('searchInvoice').addEventListener('input', function() {
  const search = this.value.toLowerCase();
  document.querySelectorAll('#invoiceTable tbody tr').forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(search) ? '' : 'none';
  });
});
</script>
