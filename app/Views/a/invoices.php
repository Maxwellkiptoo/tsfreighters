<?php
include 'layout/sidebar.php';
?>

<div class="main-content">
  <h2 class="page-title"><i class="fa fa-file-invoice"></i> Create & Send Invoice</h2>

  <!-- 🧾 Create Invoice Form -->
  <div class="card">
    <form id="invoiceForm" method="POST" action="process_invoice.php" class="invoice-form">
      <div class="form-group">
        <label>Client Name</label>
        <input type="text" name="client_name" required>
      </div>

      <div class="form-group">
        <label>Service Description</label>
        <textarea name="description" required></textarea>
      </div>

      <div class="form-group">
        <label>Amount (KES)</label>
        <input type="number" name="amount" required>
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
        <input type="email" name="email">
      </div>

      <div class="form-group" id="phoneField" style="display:none;">
        <label>Recipient Phone (e.g. +254712345678)</label>
        <input type="text" name="phone">
      </div>

      <div class="form-actions">
        <button type="submit" name="create_invoice"><i class="fa fa-paper-plane"></i> Generate & Send</button>
      </div>
    </form>
  </div>
</div>

<!-- 💅 Styles -->
<style>
.page-title {
  font-size: 1.6rem;
  font-weight: 600;
  color: #111827;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.card {
  background: #fff;
  border-radius: 10px;
  padding: 25px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  max-width: 600px;
}
.invoice-form .form-group {
  margin-bottom: 15px;
}
.invoice-form label {
  font-weight: 600;
  color: #374151;
  display: block;
  margin-bottom: 6px;
}
.invoice-form input, 
.invoice-form textarea,
.invoice-form select {
  width: 100%;
  padding: 10px 12px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 1rem;
}
.invoice-form textarea { height: 80px; resize: vertical; }
.form-actions {
  margin-top: 20px;
  text-align: right;
}
.form-actions button {
  background: #10b981;
  color: white;
  border: none;
  padding: 10px 18px;
  border-radius: 8px;
  cursor: pointer;
  transition: 0.2s;
}
.form-actions button:hover {
  background: #0e9a75;
}
</style>

<!-- ⚙️ JS -->
<script>
document.getElementById('sendMethod').addEventListener('change', function() {
  const emailField = document.getElementById('emailField');
  const phoneField = document.getElementById('phoneField');

  emailField.style.display = 'none';
  phoneField.style.display = 'none';

  if (this.value === 'email') emailField.style.display = 'block';
  if (this.value === 'sms') phoneField.style.display = 'block';
});
</script>
