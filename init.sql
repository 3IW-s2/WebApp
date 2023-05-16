CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(255)  NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL
);


/* inject un users */
INSERT INTO users (firstname, lastname, email, password, role, created_at, updated_at)
VALUES ('toto', 'toto', 'audesandrine6@gmail.com', 'toto', 'admin', NOW(), NOW());
ALTER TABLE users ADD reset_token VARCHAR(255);
ALTER TABLE users ALTER COLUMN password SET VALUES '$2y$10$2YKjHrOKhhG8gPeXxn0X2O3ecxmuT1nDbClzkLIFN5qedDYrE6fwa' WHERE email = 'audesandrine6@gmail.com' ;
ALTER TABLE users ALTER COLUMN role  SET DEFAULT 'customer';




INSERT INTO users (firstname, lastname, email, password, role, created_at, updated_at)
VALUES ('yann', 'toto', 'habieyann@live.fr', 'toto', 'admin', NOW(), NOW());

CREATE TABLE articles (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL,
    user_id INTEGER NOT NULL
);

CREATE TABLE comments (
    id SERIAL PRIMARY KEY,
    content TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL,
    user_id INTEGER NOT NULL,
    article_id INTEGER NOT NULL
);

