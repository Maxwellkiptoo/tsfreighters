CREATE TABLE shipments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_id INT NOT NULL,
  tracking_number VARCHAR(50) UNIQUE,
  origin VARCHAR(255),
  destination VARCHAR(255),
  package_details TEXT,
  weight DECIMAL(10,2),
  delivery_type VARCHAR(50),
  insurance VARCHAR(10),
  estimated_cost DECIMAL(10,2),
  status VARCHAR(50),
  expected_delivery DATE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
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
