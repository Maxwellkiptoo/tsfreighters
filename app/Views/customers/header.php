<?php
use App\Core\Auth; // (not required as we use simple include). ensure Auth::init() was called in controller
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>TS Freighters — Customers</title>
<style>
:root{
  --dark-blue: #1C3144;
  --offwhite: #F5F7FA;
  --teal: #2ECC71;
  --warning: #F39C12;
  --alert: #E74C3C;
  --success: #27AE60;
  --muted: #6b7280;
  --glass: rgba(255,255,255,0.8);
}
*{box-sizing:border-box}
body{margin:0;font-family: "Segoe UI", Roboto, Arial, sans-serif;background:var(--offwhite);color:var(--dark-blue)}
.header {
  background: linear-gradient(90deg, var(--dark-blue), #11304a);
  color: white;
  padding: 18px 24px;
  display:flex;
  align-items:center;
  justify-content:space-between;
}
.brand { font-weight:700; font-size:18px; letter-spacing:0.2px }
.container { max-width:1100px; margin:24px auto; padding:0 16px; }

/* card */
.card {
  background: #fff;
  border-radius:10px;
  padding:16px;
  box-shadow: 0 6px 18px rgba(17,24,39,0.06);
}

/* table */
.controls { display:flex; gap:12px; align-items:center; margin-bottom:12px; flex-wrap:wrap}
.input { padding:10px 12px; border-radius:8px; border:1px solid #e6e9ee; width:260px; background:white }
.btn { display:inline-block; padding:10px 14px; border-radius:8px; text-decoration:none; color:white; cursor:pointer; border:none; }
.btn-teal{ background:var(--teal); }
.btn-muted{ background:var(--muted); color:#fff }
.btn-danger{ background:var(--alert); }
.table { width:100%; border-collapse:collapse; margin-top:12px; }
.table th, .table td { padding:12px 10px; text-align:left; border-bottom:1px solid #f1f5f9; font-size:14px }
.badge { padding:6px 8px; border-radius:8px; font-size:13px; color:white }

/* action buttons */
.action { display:inline-block; padding:8px 10px; border-radius:8px; font-size:13px; margin-right:6px; text-decoration:none; color:white }
.action.view{ background:var(--success) }
.action.edit{ background:var(--warning); color:#fff }
.action.del{ background:var(--alert) }

/* responsive */
@media (max-width:700px){
  .table th:nth-child(4), .table td:nth-child(4) { display:none } /* hide company on small screens */
  .controls { flex-direction:column; align-items:stretch }
}
</style>
</head>
<body>
<div class="header">
  <div class="brand">TS Freighters</div>
  <div style="font-size:14px; color:rgba(255,255,255,0.9)">Customer Management</div>
</div>
<div class="container">
