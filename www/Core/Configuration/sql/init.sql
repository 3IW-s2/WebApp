CREATE TABLE {DB_PREFIX}users (
    id SERIAL PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(255)  NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL
);

CREATE TABLE {DB_PREFIX}admin_preferences (
    id SERIAL PRIMARY KEY,
    number_article INT NOT NULL DEFAULT 3
);

CREATE TABLE {DB_PREFIX}article_types (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

INSERT INTO {DB_PREFIX}article_types (name) VALUES ('sports');
INSERT INTO {DB_PREFIX}article_types (name) VALUES ('acteur');
INSERT INTO {DB_PREFIX}article_types (name) VALUES ('politique');

INSERT INTO {DB_PREFIX}admin_preferences (number_article)
VALUES (3);

CREATE TABLE {DB_PREFIX}posts(
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    status VARCHAR(255) NOT NULL,
    category_id INTEGER  NULL
);


ALTER TABLE {DB_PREFIX}users ALTER COLUMN role TYPE INT USING role::integer;
ALTER TABLE {DB_PREFIX}posts ADD COLUMN image_path VARCHAR(255)  NULL;
/* rajoute une colonne slug */

ALTER TABLE {DB_PREFIX}posts ADD COLUMN slug VARCHAR(255)  NULL;
ALTER TABLE {DB_PREFIX}posts ADD COLUMN image VARCHAR(255)  NULL;


/* ALTER TABLE posts DROP COLUMN name;
 */
ALTER TABLE {DB_PREFIX}posts ADD COLUMN date_created TIMESTAMP  NULL DEFAULT CURRENT_TIMESTAMP;


ALTER TABLE {DB_PREFIX}users ADD COLUMN status VARCHAR(255)  NULL;

/* SELECT * FROM users WHERE email = 'audesandrine6@gmail' AND  status IS NULL;
 */
ALTER TABLE {DB_PREFIX}users ADD reset_token VARCHAR(255);

/* ALTER TABLE users ALTER COLUMN password SET VALUES '$2y$10$2YKjHrOKhhG8gPeXxn0X2O3ecxmuT1nDbClzkLIFN5qedDYrE6fwa' WHERE email = 'audesandrine6@gmail.com' ;
 */
/* ALTER TABLE users ADD active_account VARCHAR(255);
 */
 ALTER TABLE {DB_PREFIX}users ADD active_account_token VARCHAR(255);
/*  ALTER TABLE users DROP COLUMN active_account;
 *//* ALTER TABLE users ADD role_id INT
 */
ALTER TABLE {DB_PREFIX}users ADD tokenID VARCHAR(255) DEFAULT NULL;
/* ALTER TABLE users ALTER COLUMN role TYPE INT ;
 *//* les 3 ceux sont les customers 1 pour admin et 2 pour éditeurs */

ALTER TABLE {DB_PREFIX}posts ALTER COLUMN title DROP NOT NULL;

ALTER TABLE {DB_PREFIX}users ADD COLUMN expirate_token TIMESTAMP  NULL;

 CREATE TABLE {DB_PREFIX}articles (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255)  NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL,
    user_id INTEGER  NULL,
    slug VARCHAR(255) NOT NULL,
    status VARCHAR(255) NOT NULL,
    category_id INTEGER  NULL,
    active_comment VARCHAR(255)  NULL

); 
/* ALTER TABLE {DB_PREFIX}articles ADD COLUMN category_id INTEGER  NULL;
 */
 /* ALTER TABLE articles ADD COLUMN author VARCHAR(255) NOT  NULL;
 *//* ALTER TABLE articles DROP COLUMN user_id;
 */
 CREATE TABLE {DB_PREFIX}comments (
    id SERIAL PRIMARY KEY,
    content TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL,
    user_id INTEGER NOT NULL,
    author VARCHAR(255) NOT NULL,
    article_id INTEGER NOT NULL,
    status VARCHAR(255) NOT NULL
); 
ALTER TABLE {DB_PREFIX}comments ALTER COLUMN author DROP NOT NULL;


CREATE TABLE {DB_PREFIX}menu (
  menu_id SERIAL PRIMARY KEY,
  parent_id INT,
  titre VARCHAR(255),
  url VARCHAR(255),
  status VARCHAR(255) NOT NULL
);

ALTER TABLE {DB_PREFIX}menu ADD COLUMN position INT NULL;



/* ALTER TABLE menu ALTER COLUMN parent_id DROP NOT NULL;
ALTER TABLE menu ADD COLUMN status VARCHAR(255) NULL ; */

CREATE TABLE {DB_PREFIX}history (
    id SERIAL PRIMARY KEY,
    table_name VARCHAR(255) NOT NULL,
    entity_type VARCHAR(255) NOT NULL,
    entity_id INTEGER NOT NULL,
    action VARCHAR(255) NULL,
    created_at TIMESTAMP NOT NULL,
    content TEXT NOT NULL
);


CREATE TABLE {DB_PREFIX}front (
    id SERIAL PRIMARY KEY,
    font VARCHAR(100) NOT NULL,
    font_weight VARCHAR(100) NOT NULL,
    primary_color VARCHAR(100) NOT NULL,
    nav_color VARCHAR(100) NOT NULL,
    logo VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL,
    template VARCHAR(255)  NULL
);


INSERT INTO {DB_PREFIX}front (font, font_weight, primary_color, nav_color, logo, created_at, updated_at) VALUES ('Arial', 'light', '#000000', '#a8d9ff' , 'logo.png', NOW(), NOW());

CREATE TABLE {DB_PREFIX}ip(
    id SERIAL PRIMARY KEY,
    ip VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL
);
