-- Grant database-specific privileges to application user
GRANT SELECT, INSERT, UPDATE, DELETE ON app_repo41.* TO 'app_user'@'%';

-- Grant full privileges to database administrator user (flag)
GRANT ALL PRIVILEGES ON app_repo41.* TO 'backup8320'@'%';

FLUSH PRIVILEGES;
