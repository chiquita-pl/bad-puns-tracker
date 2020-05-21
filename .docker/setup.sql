CREATE DATABASE IF NOT EXISTS bad_puns_counter;
CREATE USER 'bpcuser'@'%' IDENTIFIED WITH mysql_native_password  BY 'temppass123';
GRANT ALL PRIVILEGES ON bad_puns_counter.* to bpcuser WITH GRANT OPTION;
