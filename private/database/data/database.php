CREATE TABLE shipments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tracking_number VARCHAR(50) UNIQUE NOT NULL,
    client_id INT,
    sender_name VARCHAR(100),
    sender_phone VARCHAR(20),
    receiver_name VARCHAR(100),
    receiver_phone VARCHAR(20),
    origin VARCHAR(100),
    destination VARCHAR(100),
    shipment_type ENUM('parcel','document','freight','other') DEFAULT 'parcel',
    weight DECIMAL(10,2),
    cost DECIMAL(10,2),
    status ENUM('pending','in_transit','delivered','cancelled') DEFAULT 'pending',
    driver_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE SET NULL,
    FOREIGN KEY (driver_id) REFERENCES drivers(id) ON DELETE SET NULL
);

CREATE TABLE shipment_updates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    shipment_id INT NOT NULL,
    status VARCHAR(100),
    location VARCHAR(100),
    remarks TEXT,
    updated_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (shipment_id) REFERENCES shipments(id) ON DELETE CASCADE,
    FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);


CREATE TABLE invoices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_id INT NOT NULL,
  tracking_number VARCHAR(50),
  invoice_number VARCHAR(50),
  amount DECIMAL(10,2),
  status VARCHAR(20) DEFAULT 'Unpaid',
  invoice_file VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE invoices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  invoice_number VARCHAR(50) UNIQUE,
  shipment_id INT NOT NULL,
  total_amount DECIMAL(10,2),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (shipment_id) REFERENCES shipments(id)
);

CREATE TABLE support_tickets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_id INT NOT NULL,
  subject VARCHAR(255),
  message TEXT,
  attachment VARCHAR(255),
  status ENUM('Open','Closed') DEFAULT 'Open',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (customer_id) REFERENCES customers(id)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','staff','driver','customer') DEFAULT 'customer',
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE drivers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    license_number VARCHAR(50),
    vehicle_number VARCHAR(50),
    vehicle_type VARCHAR(50),
    status ENUM('available','on_trip','inactive') DEFAULT 'available',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(100) NOT NULL,
    contact_person VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    address TEXT,
    client_type ENUM('individual','corporate') DEFAULT 'individual',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    shipment_id INT NOT NULL,
    payment_method ENUM('cash','mpesa','card','bank_transfer') DEFAULT 'cash',
    amount DECIMAL(10,2) NOT NULL,
    transaction_id VARCHAR(100),
    payment_status ENUM('pending','paid','failed') DEFAULT 'pending',
    paid_at TIMESTAMP NULL,
    FOREIGN KEY (shipment_id) REFERENCES shipments(id) ON DELETE CASCADE
);

CREATE TABLE expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    amount DECIMAL(10,2) NOT NULL,
    category ENUM('fuel','maintenance','salary','other') DEFAULT 'other',
    recorded_by INT,
    expense_date DATE DEFAULT (CURRENT_DATE),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (recorded_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    report_title VARCHAR(100),
    report_type ENUM('daily','weekly','monthly','custom') DEFAULT 'daily',
    generated_by INT,
    file_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (generated_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    message TEXT,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

