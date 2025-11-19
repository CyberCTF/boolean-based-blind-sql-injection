-- Create application user
CREATE USER IF NOT EXISTS 'app_user'@'%' IDENTIFIED BY 'app_password_secure_2024';

-- Create database administrator user (this is the flag)
CREATE USER IF NOT EXISTS 'backup8320'@'%' IDENTIFIED BY 'kxj#t=%YkFv8S+q&';

FLUSH PRIVILEGES;
