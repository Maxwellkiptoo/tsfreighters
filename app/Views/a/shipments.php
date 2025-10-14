<?php include 'layout/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shipments | Admin Panel</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  background: #f5f6fa;
  color: #333;
  overflow-x: hidden;
}
.main-content {
  margin-left: 250px;
  padding: 30px;
}
header {
  background: linear-gradient(90deg, #10b981, #047857);
  padding: 18px 30px;
  border-radius: 12px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: white;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  position: sticky;
  top: 0;
  z-index: 50;
}
header h1 {
  font-size: 22px;
  font-weight: 600;
  margin: 0;
}
header .search-box {
  position: relative;
  width: 300px;
}
header .search-box input {
  width: 100%;
  padding: 8px 35px 8px 15px;
  border: none;
  border-radius: 25px;
  outline: none;
}
header .search-box i {
  position: absolute;
  right: 12px;
  top: 10px;
  color: #6b7280;
}

/* Table */
.table-section {
  background: white;
  margin-top: 30px;
  border-radius: 16px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
  padding: 25px;
}
.table-section h2 {
  margin-bottom: 15px;
  color: #111827;
}
table {
  width: 100%;
  border-collapse: collapse;
  font-size: 15px;
}
table th, table td {
  text-align: left;
  padding: 12px 15px;
}
table th {
  background: #10b981;
  color: white;
  font-weight: 600;
}
table tr:nth-child(even) {
  background: #f9fafb;
}
.status {
  padding: 5px 10px;
  border-radius: 8px;
  font-weight: 500;
  font-size: 13px;
  display: inline-block;
}
.status.delivered { background: #d1fae5; color: #047857; }
.status.transit { background: #fef3c7; color: #b45309; }
.status.delayed { background: #fee2e2; color: #b91c1c; }

.actions button {
  border: none;
  background: none;
  cursor: pointer;
  font-size: 16px;
  margin: 0 6px;
}
.actions .view { color: #10b981; }
.actions .edit { color: #2563eb; }
.actions .delete { color: #dc2626; }
.actions button:hover { opacity: 0.8; }

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
  <header>
    <h1>Shipments</h1>
    <div class="search-box">
      <input type="text" placeholder="Search by Tracking ID or Client...">
      <i class="fa fa-search"></i>
    </div>
  </header>

  <div class="table-section">
    <h2>All Shipments</h2>
    <table>
      <thead>
        <tr>
          <th>Tracking ID</th>
          <th>Client</th>
          <th>Origin</th>
          <th>Destination</th>
          <th>Status</th>
          <th>Expected Delivery</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>#TRK9472</td>
          <td>John Doe</td>
          <td>Nairobi</td>
          <td>Mombasa</td>
          <td><span class="status transit">In Transit</span></td>
          <td>12 Oct 2025</td>
          <td class="actions">
            <button class="view"><i class="fa fa-eye"></i></button>
            <button class="edit"><i class="fa fa-pen"></i></button>
            <button class="delete"><i class="fa fa-trash"></i></button>
          </td>
        </tr>
        <tr>
          <td>#TRK3289</td>
          <td>Mary Atieno</td>
          <td>Kisumu</td>
          <td>Nakuru</td>
          <td><span class="status delivered">Delivered</span></td>
          <td>9 Oct 2025</td>
          <td class="actions">
            <button class="view"><i class="fa fa-eye"></i></button>
            <button class="edit"><i class="fa fa-pen"></i></button>
            <button class="delete"><i class="fa fa-trash"></i></button>
          </td>
        </tr>
        <tr>
          <td>#TRK6645</td>
          <td>Peter Kariuki</td>
          <td>Nairobi</td>
          <td>Eldoret</td>
          <td><span class="status delayed">Delayed</span></td>
          <td>Pending</td>
          <td class="actions">
            <button class="view"><i class="fa fa-eye"></i></button>
            <button class="edit"><i class="fa fa-pen"></i></button>
            <button class="delete"><i class="fa fa-trash"></i></button>
          </td>
        </tr>
        <tr>
          <td>#TRK5567</td>
          <td>Jane Mwangi</td>
          <td>Malindi</td>
          <td>Kisii</td>
          <td><span class="status delivered">Delivered</span></td>
          <td>8 Oct 2025</td>
          <td class="actions">
            <button class="view"><i class="fa fa-eye"></i></button>
            <button class="edit"><i class="fa fa-pen"></i></button>
            <button class="delete"><i class="fa fa-trash"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <footer>© 2025 Nexbridge Logistics Admin Panel</footer>
</div>
</body>
</html>
