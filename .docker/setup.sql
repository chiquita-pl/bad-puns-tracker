CREATE DATABASE IF NOT EXISTS bad_puns_counter;
CREATE USER 'bpcuser'@'%' IDENTIFIED BY 'temppass123';
GRANT ALL PRIVILEGES ON bad_puns_counter.* to bpcuser WITH GRANT OPTION;
