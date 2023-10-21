CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    avatar VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

-- INSERT INTO users (id, firstName, lastName, email, password, avatar) VALUES ('1', 'test', 'test test', 'test@test.com', 'jeff123', '');