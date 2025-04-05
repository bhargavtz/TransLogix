CREATE TABLE IF NOT EXISTS shipments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    tracking_number VARCHAR(50) UNIQUE NOT NULL,
    sender_address_id INT NOT NULL,
    receiver_address_id INT NOT NULL,
    package_type VARCHAR(50) NOT NULL,
    weight DECIMAL(10,2) NOT NULL,
    dimensions VARCHAR(50),
    shipping_method VARCHAR(50) NOT NULL,
    shipping_cost DECIMAL(10,2) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (sender_address_id) REFERENCES user_addresses(id),
    FOREIGN KEY (receiver_address_id) REFERENCES user_addresses(id)
);

CREATE TABLE IF NOT EXISTS shipping_methods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    base_cost DECIMAL(10,2) NOT NULL,
    cost_per_kg DECIMAL(10,2) NOT NULL,
    estimated_days VARCHAR(20) NOT NULL
);

INSERT INTO shipping_methods (name, description, base_cost, cost_per_kg, estimated_days) VALUES
('Standard Ground', 'Economic ground shipping', 10.00, 2.50, '5-7 days'),
('Express Air', 'Fast air freight delivery', 25.00, 5.00, '2-3 days'),
('Same Day', 'Ultra-fast local delivery', 50.00, 7.50, '24 hours');