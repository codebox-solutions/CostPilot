CREATE DATABASE IF NOT EXISTS CostPilot  DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE CostPilot ;
-- ============================
-- TABELA: users
-- ============================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash TEXT NOT NULL,
    profile_picture TEXT,
    last_login TIMESTAMP NULL DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================
-- TABELA: simulations
-- ============================
CREATE TABLE simulations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_name VARCHAR(100) NOT NULL,
    fixed_cost DECIMAL(12,2) NOT NULL,
    variable_cost DECIMAL(12,2) NOT NULL,
    desired_margin_percent DECIMAL(5,2) NOT NULL,
    tax_percent DECIMAL(5,2),
    apply_compound_interest BOOLEAN DEFAULT FALSE,
    use_cashflow_prediction BOOLEAN DEFAULT FALSE,
    interpolation_type ENUM('Linear', 'Polinomial', '-') DEFAULT '-',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ============================
-- TABELA: simulation_results
-- ============================
CREATE TABLE simulation_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    simulation_id INT NOT NULL,
    estimated_profit DECIMAL(14,2) NOT NULL,
    is_profitable BOOLEAN,
    generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (simulation_id) REFERENCES simulations(id) ON DELETE CASCADE
);

-- ============================
-- TABELA: reports
-- ============================
CREATE TABLE reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    simulation_id INT NOT NULL,
    product_name VARCHAR(100) NOT NULL,
    simulation_date TIMESTAMP NOT NULL,
    fixed_cost DECIMAL(12,2) NOT NULL,
    variable_cost DECIMAL(12,2) NOT NULL,
    desired_margin_percent DECIMAL(5,2) NOT NULL,
    tax_percent DECIMAL(5,2),
    estimated_profit DECIMAL(14,2),
    applied_compound_interest BOOLEAN DEFAULT FALSE,
    has_cashflow_prediction BOOLEAN DEFAULT FALSE,
    interpolation_type ENUM('Linear', 'Polinomial', '-') DEFAULT '-',
    generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (simulation_id) REFERENCES simulations(id) ON DELETE CASCADE
);

-- ============================
-- TABELA: predictions
-- ============================
CREATE TABLE predictions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    model_type ENUM('Regressão Polinomial', 'Série Temporal', 'Interpolação') NOT NULL,
    input_data JSON NOT NULL,
    prediction_period INT NOT NULL,
    result_data JSON NOT NULL,
    std_deviation DECIMAL(10,4),
    confidence_interval TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE INDEX idx_simulations_user_id ON simulations(user_id);
CREATE INDEX idx_reports_user_id ON reports(user_id);
CREATE INDEX idx_predictions_user_id ON predictions(user_id);