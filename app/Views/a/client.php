<?php include 'layout/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registered Clients - LogiTrack</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
/* Page Wrapper */
.client-page {
  margin-left: 260px;
  margin-top: 110px;
  padding: 30px;
  transition: margin-left 0.3s;
  font-family: 'Poppins', sans-serif;
}
.sidebar.collapsed ~ .client-page { margin-left: 80px; }

/* Page Header */
.client-page .page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 25px;
  flex-wrap: wrap;
}
.client-page .page-header h2 {
  font-size: 1.9rem;
  font-weight: 600;
  color: #111827;
}
.client-page .breadcrumb {
  font-size: 14px;
  color: #6b7280;
}
.client-page .breadcrumb a {
  color: #10b981;
  text-decoration: none;
}
.client-page .breadcrumb a:hover { text-decoration: underline; }

/* Search Box */
.search-clients {
  margin-bottom: 20px;
  display: flex;
  justify-content: flex-end;
}
.search-clients input {
  width: 250px;
  padding: 8px 12px;
  border-radius: 12px;
  border: 1px solid #d1d5db;
  outline: none;
  transition: all 0.3s;
}
.search-clients input:focus {
  border-color: #10b981;
  box-shadow: 0 0 5px rgba(16,185,129,0.3);
}

/* Table Card */
.client-table-card {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.08);
  padding: 20px;
  overflow-x: auto;
}

/* Table Styles */
.client-table {
  width: 100%;
  border-collapse: collapse;
  min-width: 700px;
}
.client-table th, .client-table td {
  padding: 14px 15px;
  text-align: left;
  border-bottom: 1px solid #e5e7eb;
  font-size: 14px;
  color: #374151;
}
.client-table th {
  background: #f9fafb;
  font-weight: 600;
  color: #111827;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.client-table tr:hover { background: #f3f4f6; }

/* Action Buttons */
.client-table .action-btn {
  padding: 6px 12px;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  font-size: 13px;
  transition: all 0.3s;
}
.client-table .edit-btn { background: #10b981; color: #fff; }
.client-table .edit-btn:hover { background: #059669; }
.client-table .delete-btn { background: #ef4444; color: #fff; }
.client-table .delete-btn:hover { background: #dc2626; }

/* Responsive */
@media (max-width: 992px) {
  .client-page { margin-left: 80px; padding: 20px; }
}
@media (max-width: 768px) {
  .client-page { margin-left: 0; padding: 15px; }
  .search-clients { justify-content: center; margin-bottom: 15px; }
}
</style>
</head>
<body>

<div class="client-page">
  <div class="page-header">
    <div>
      <h2>Registered Clients</h2>
      <div class="breadcrumb">
        <a href="index.php?controller=dashboard&action=index">Dashboard</a> / Clients
      </div>
    </div>
    <div class="search-clients">
      <input type="text" placeholder="Search clients..." id="clientSearch">
    </div>
  </div>

  <div class="client-table-card">
    <table class="client-table" id="clientsTable">
      <thead>
        <tr>
          <th>#</th>
          <th>Full Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Company</th>
          <th>Registered On</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- Example Rows -->
        <tr>
          <td>1</td>
          <td>Jane Smith</td>
          <td>jane@example.com</td>
          <td>+254712345678</td>
          <td>Acme Ltd</td>
          <td>2025-10-10</td>
          <td>
            <button class="action-btn edit-btn" title="Edit Client"><i class="fa fa-edit"></i></button>
            <button class="action-btn delete-btn" title="Delete Client"><i class="fa fa-trash"></i></button>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>John Doe</td>
          <td>john@example.com</td>
          <td>+254798765432</td>
          <td>LogiTrack</td>
          <td>2025-10-09</td>
          <td>
            <button class="action-btn edit-btn" title="Edit Client"><i class="fa fa-edit"></i></button>
            <button class="action-btn delete-btn" title="Delete Client"><i class="fa fa-trash"></i></button>
          </td>
        </tr>
        <!-- Dynamic rows from DB go here -->
      </tbody>
    </table>
  </div>
</div>

<script>
// Simple client-side search filter
const clientSearch = document.getElementById('clientSearch');
const clientsTable = document.getElementById('clientsTable').getElementsByTagName('tbody')[0];

clientSearch.addEventListener('keyup', function() {
  const filter = clientSearch.value.toLowerCase();
  const rows = clientsTable.getElementsByTagName('tr');
  Array.from(rows).forEach(row => {
    const cells = row.getElementsByTagName('td');
    let match = false;
    Array.from(cells).forEach(cell => {
      if (cell.textContent.toLowerCase().includes(filter)) match = true;
    });
    row.style.display = match ? '' : 'none';
  });
});
</script>

</body>
</html>
