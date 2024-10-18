USE janklipord;

-- Create branches table
CREATE TABLE IF NOT EXISTS branches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Create stocks table
CREATE TABLE IF NOT EXISTS stocks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    branch_id INT NOT NULL,
    item_name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (branch_id) REFERENCES branches(id) ON DELETE CASCADE
);

-- Insert sample data into branches
INSERT INTO branches (name) VALUES 
('Branch A'),
('Branch B'),
('Branch C');

-- Insert sample data into stocks
INSERT INTO stocks (branch_id, item_name, quantity) VALUES 
(1, 'Tablet', 100),
(1, 'Computer', 50),
(2, 'TV', 200),
(2, 'Laptop', 0),
(3, 'Phone', 75);
