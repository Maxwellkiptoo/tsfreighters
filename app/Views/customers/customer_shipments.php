<?php include 'layout/client_sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Shipments</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  background: #f9fafb;
  color: #333;
  overflow-x: hidden;
}
.main-content {
  margin-left: 250px;
  padding: 30px;
}

.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.page-header h1 {
  font-size: 22px;
  font-weight: 600;
  color: #111827;
}
.page-header .search-box {
  display: flex;
  align-items: center;
  gap: 8px;
}
.page-header input {
  padding: 8px 12px;
  border: 1px solid #d1d5db;
  border-radius: 8px;
  font-size: 14px;
  width: 220px;
}
.page-header button {
  background: #10b981;
  border: none;
  color: white;
  padding: 8px 12px;
  border-radius: 8px;
  cursor: pointer;
  transition: background 0.3s;
}
.page-header button:hover { background: #059669; }

/* Table */
.table-container {
  background: white;
  border-radius: 16px;
  margin-top: 30px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
  overflow-x: auto;
}
table {
  width: 100%;
  border-collapse: collapse;
  font-size: 15px;
  min-width: 800px;
}
th, td {
  text-align: left;
  padding: 12px 16px;
}
th {
  background: #10b981;
  color: white;
  font-weight: 600;
}
tr:nth-child(even) { background: #f9fafb; }

.status {
  padding: 6px 10px;
  border-radius: 8px;
  font-weight: 500;
  font-size: 13px;
}
.status.delivered { background: #d1fae5; color: #047857; }
.status.transit { background: #fef3c7; color: #b45309; }
.status.pending { background: #e0f2fe; color: #0369a1; }

.action-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #10b981;
  color: white;
  border: none;
  padding: 6px 12px;
  border-radius: 8px;
  font-size: 13px;
  cursor: pointer;
  transition: background 0.3s;
}
.action-btn:hover { background: #059669; }

footer {
  margin-top: 40px;
  text-align: center;
  font-size: 14px;
  color: #6b7280;
}
</style>
</head>
<body>

<div class="main-content">
  <div class="page-header">
    <h1><i class="fa fa-box"></i> My Shipments</h1>
    <div class="search-box">
      <input type="text" id="searchInput" placeholder="Search by Tracking ID...">
      <button onclick="searchTable()"><i class="fa fa-search"></i> Search</button>
    </div>
  </div>

  <div class="table-container">
    <table id="shipmentTable">
      <thead>
        <tr>
          <th>Tracking ID</th>
          <th>Origin</th>
          <th>Destination</th>
          <th>Status</th>
          <th>Expected Delivery</th>
          <th>Cost</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>#TRK9472</td>
          <td>Nairobi</td>
          <td>Mombasa</td>
          <td><span class="status transit">In Transit</span></td>
          <td>29 Oct 2025</td>
          <td>Ksh 2,500</td>
          <td><button class="action-btn"><i class="fa fa-eye"></i> View</button></td>
        </tr>
        <tr>
          <td>#TRK3289</td>
          <td>Kisumu</td>
          <td>Nakuru</td>
          <td><span class="status delivered">Delivered</span></td>
          <td>21 Oct 2025</td>
          <td>Ksh 1,800</td>
          <td><button class="action-btn"><i class="fa fa-eye"></i> View</button></td>
        </tr>
        <tr>
          <td>#TRK1123</td>
          <td>Thika</td>
          <td>Eldoret</td>
          <td><span class="status pending">Pending Pickup</span></td>
          <td>Pending</td>
          <td>Ksh 3,200</td>
          <td><button class="action-btn"><i class="fa fa-eye"></i> View</button></td>
        </tr>
      </tbody>
    </table>
  </div>

  <footer>© 2025 Nexbridge Logistics | Customer Shipments</footer>
</div>

<script>
// Simple table search by tracking ID
function searchTable() {
  const input = document.getElementById('searchInput').value.toUpperCase();
  const table = document.getElementById('shipmentTable');
  const tr = table.getElementsByTagName('tr');
  for (let i = 1; i < tr.length; i++) {
    const td = tr[i].getElementsByTagName('td')[0];
    if (td) {
      const txtValue = td.textContent || td.innerText;
      tr[i].style.display = txtValue.toUpperCase().indexOf(input) > -1 ? '' : 'none';
    }
  }
}
</script>

</body>
</html>
