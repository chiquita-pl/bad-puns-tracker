CREATE DATABASE IF NOT EXISTS bad_puns_counter;
CREATE USER 'bpcuser'@'127.0.0.1' IDENTIFIED BY 'temppass123';
GRANT ALL on bad_puns_counter.* to bpcuser;
