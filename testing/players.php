    $redirect = '/dashboard.php';
    if ($role === 'admin') $redirect = '/admin/dashboard.php';
    if ($role === 'warehouse') $redirect = '/warehouse/dashboard.php';
    if ($role === 'ops') $redirect = '/ops/dashboard.php';
    if ($role === 'supplier') $redirect = '/supplier/dashboard.php';
    if ($role === 'customer') $redirect = '/customer/orders.php';