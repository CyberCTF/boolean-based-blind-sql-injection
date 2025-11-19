USE app_repo41;

-- Create patients table
CREATE TABLE IF NOT EXISTS patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id VARCHAR(50) NOT NULL UNIQUE,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    date_of_birth DATE NOT NULL,
    ssn VARCHAR(11),
    address TEXT,
    phone VARCHAR(20),
    email VARCHAR(255),
    insurance_provider VARCHAR(100),
    insurance_id VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_patient_id (patient_id),
    INDEX idx_last_name (last_name(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create medical_records table
CREATE TABLE IF NOT EXISTS medical_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id VARCHAR(50) NOT NULL,
    record_date DATE NOT NULL,
    diagnosis TEXT,
    treatment TEXT,
    medications TEXT,
    notes TEXT,
    doctor_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id) ON DELETE CASCADE,
    INDEX idx_patient_id (patient_id(191)),
    INDEX idx_record_date (record_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create appointments table
CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id VARCHAR(50) NOT NULL,
    appointment_date DATETIME NOT NULL,
    appointment_type VARCHAR(100),
    status VARCHAR(50) DEFAULT 'scheduled',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id) ON DELETE CASCADE,
    INDEX idx_patient_id (patient_id(191)),
    INDEX idx_appointment_date (appointment_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create admin_users table (contains the flag)
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(200),
    role VARCHAR(50) DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_username (username(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample patient data
INSERT IGNORE INTO patients (patient_id, first_name, last_name, date_of_birth, ssn, address, phone, email, insurance_provider, insurance_id) VALUES
('PAT-001', 'John', 'Smith', '1985-03-15', '123-45-6789', '123 Main St, Anytown, ST 12345', '555-0101', 'john.smith@email.com', 'HealthCare Plus', 'HC-123456'),
('PAT-002', 'Jane', 'Doe', '1990-07-22', '987-65-4321', '456 Oak Ave, Somewhere, ST 67890', '555-0102', 'jane.doe@email.com', 'MediCover Insurance', 'MC-789012'),
('PAT-003', 'Robert', 'Johnson', '1978-11-08', '456-78-9012', '789 Elm St, Nowhere, ST 34567', '555-0103', 'robert.j@email.com', 'HealthCare Plus', 'HC-345678'),
('PAT-004', 'Sarah', 'Williams', '1992-05-30', '234-56-7890', '321 Pine Rd, Elsewhere, ST 89012', '555-0104', 'sarah.w@email.com', 'MediCover Insurance', 'MC-901234'),
('PAT-005', 'Michael', 'Brown', '1988-09-14', '567-89-0123', '654 Maple Dr, Anywhere, ST 45678', '555-0105', 'michael.b@email.com', 'HealthCare Plus', 'HC-567890');

-- Insert sample medical records
INSERT IGNORE INTO medical_records (patient_id, record_date, diagnosis, treatment, medications, notes, doctor_name) VALUES
('PAT-001', '2024-01-15', 'Hypertension', 'Blood pressure monitoring, lifestyle modifications', 'Lisinopril 10mg daily', 'Patient responding well to treatment', 'Dr. Anderson'),
('PAT-001', '2024-03-20', 'Routine Checkup', 'General physical examination', 'Continue current medications', 'Patient in good health', 'Dr. Anderson'),
('PAT-002', '2024-02-10', 'Diabetes Type 2', 'Blood glucose monitoring, diet counseling', 'Metformin 500mg twice daily', 'Initial diagnosis, follow-up scheduled', 'Dr. Martinez'),
('PAT-003', '2024-01-05', 'Upper Respiratory Infection', 'Antibiotic treatment', 'Amoxicillin 500mg three times daily for 7 days', 'Symptoms improving', 'Dr. Lee'),
('PAT-004', '2024-04-12', 'Annual Physical', 'Complete physical examination, lab work', 'None', 'All results within normal limits', 'Dr. Anderson'),
('PAT-005', '2024-03-01', 'Migraine', 'Pain management', 'Sumatriptan 50mg as needed', 'Patient reports reduced frequency', 'Dr. Martinez');

-- Insert sample appointments
INSERT IGNORE INTO appointments (patient_id, appointment_date, appointment_type, status, notes) VALUES
('PAT-001', '2024-12-15 10:00:00', 'Follow-up', 'scheduled', 'Blood pressure check'),
('PAT-002', '2024-12-20 14:30:00', 'Consultation', 'scheduled', 'Diabetes management review'),
('PAT-003', '2024-12-18 09:00:00', 'Routine', 'scheduled', 'Annual checkup'),
('PAT-004', '2024-12-22 11:00:00', 'Follow-up', 'scheduled', 'Lab results review'),
('PAT-005', '2024-12-16 15:00:00', 'Consultation', 'scheduled', 'Migraine follow-up');

-- Insert admin user (this is the flag - credentials stored here)
INSERT IGNORE INTO admin_users (username, password, full_name, role) VALUES
('backup8320', 'kxj#t=%YkFv8S+q&', 'Database Backup Administrator', 'admin');
