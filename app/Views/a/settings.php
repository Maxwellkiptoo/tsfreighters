<?php include 'layout/sidebar.php'; ?>

<div class="main-content">
  <h2 class="page-title"><i class="fa fa-cog"></i> Admin Settings</h2>

  <div class="settings-container">

    <!-- 👤 Admin Profile -->
    <div class="card">
      <h3><i class="fa fa-user-circle"></i> Profile Settings</h3>
      <form id="profileForm" method="POST" action="update_profile.php" class="settings-form">
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" name="admin_name" value="John Doe" required>
        </div>
        <div class="form-group">
          <label>Email Address</label>
          <input type="email" name="admin_email" value="admin@tsfreighters.com" required>
        </div>
        <div class="form-group">
          <label>Phone Number</label>
          <input type="text" name="admin_phone" value="+254712345678" required>
        </div>
        <div class="form-group">
          <label>Change Password</label>
          <input type="password" name="new_password" placeholder="Leave blank to keep current">
        </div>
        <div class="form-actions">
          <button type="submit"><i class="fa fa-save"></i> Update Profile</button>
        </div>
      </form>
    </div>

    <!-- 🏢 Company Info -->
    <div class="card">
      <h3><i class="fa fa-building"></i> Company Information</h3>
      <form id="companyForm" method="POST" action="update_company.php" enctype="multipart/form-data" class="settings-form">
        <div class="form-group">
          <label>Company Name</label>
          <input type="text" name="company_name" value="TS Freighters Ltd" required>
        </div>
        <div class="form-group">
          <label>Address</label>
          <input type="text" name="address" value="Nairobi, Kenya">
        </div>
        <div class="form-group">
          <label>Support Email</label>
          <input type="email" name="support_email" value="support@tsfreighters.com">
        </div>
        <div class="form-group">
          <label>Upload Logo</label>
          <input type="file" name="company_logo" accept="image/*">
        </div>
        <div class="form-actions">
          <button type="submit"><i class="fa fa-upload"></i> Save Company Info</button>
        </div>
      </form>
    </div>

    <!-- ⚙️ Preferences -->
    <div class="card">
      <h3><i class="fa fa-sliders-h"></i> Preferences</h3>
      <form id="preferencesForm" method="POST" action="update_preferences.php" class="settings-form">
        <div class="form-group">
          <label>Theme Mode</label>
          <select name="theme">
            <option value="light">Light</option>
            <option value="dark">Dark</option>
          </select>
        </div>
        <div class="form-group">
          <label>Notifications</label>
          <div class="checkbox-group">
            <label><input type="checkbox" checked> Email Alerts</label>
            <label><input type="checkbox"> SMS Alerts</label>
            <label><input type="checkbox" checked> System Updates</label>
          </div>
        </div>
        <div class="form-actions">
          <button type="submit"><i class="fa fa-save"></i> Save Preferences</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- 💅 Inline Styles -->
<style>
.page-title {
  font-size: 1.6rem;
  font-weight: 600;
  color: #111827;                                   
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 25px;
}

.settings-container {
  display: grid;
  gap: 25px;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
}

.card {
  background: #fff;
  border-radius: 12px;
  padding: 25px;
  box-shadow: 0 3px 10px rgba(0,0,0,0.08);
}

.card h3 {
  font-size: 1.2rem;
  color: #111827;
  margin-bottom: 15px;
  display: flex;
  align-items: center;
  gap: 8px;
}

.settings-form .form-group {
  margin-bottom: 15px;
}

.settings-form label {
  font-weight: 600;
  color: #374151;
  margin-bottom: 5px;
  display: block;
}

.settings-form input,
.settings-form select {
  width: 100%;
  padding: 10px 12px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 0.95rem;
}

.checkbox-group {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.form-actions {
  text-align: right;
  margin-top: 15px;
}

.form-actions button {
  background: #2563eb;
  color: #fff;
  border: none;
  padding: 10px 18px;
  border-radius: 8px;
  cursor: pointer;
  transition: 0.3s;
}

.form-actions button:hover {
  background: #1e40af;
}
</style>

<!-- ⚙️ JS -->
<script>
document.querySelectorAll('.settings-form').forEach(form => {
  form.addEventListener('submit', e => {
    e.preventDefault();
    alert('✅ Settings saved successfully (demo mode)');
  });
});
</script>
