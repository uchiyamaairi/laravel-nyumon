-- .env, .env.example, .env.testing など、DB_DATABASEの値に合わせること
CREATE DATABASE IF NOT EXISTS laravel_nyumon;
CREATE DATABASE IF NOT EXISTS laravel_nyumon_test;
GRANT ALL ON laravel_nyumon.* TO 'dev'@'%';
GRANT ALL ON laravel_nyumon_test.* TO 'dev'@'%';
