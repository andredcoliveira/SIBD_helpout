-- Create Users Table
CREATE TABLE accounts (
  id SERIAL PRIMARY KEY,
  username VARCHAR(32) UNIQUE NOT NULL,
  passwd VARCHAR(256) NOT NULL,
  name VARCHAR(128),
  address VARCHAR(256),
  birthdate DATE
);
