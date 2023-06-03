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

CREATE TABLE Roles (
  role_id INT PRIMARY KEY,
  role_name VARCHAR(255)
);

//pour stocker les autorisations

CREATE TABLE Permissions (
  permission_id INT PRIMARY KEY,
  permission_name VARCHAR(255)
);



ALTER TABLE users ADD reset_token VARCHAR(255);
ALTER TABLE users ALTER COLUMN password SET VALUES '$2y$10$2YKjHrOKhhG8gPeXxn0X2O3ecxmuT1nDbClzkLIFN5qedDYrE6fwa' WHERE email = 'audesandrine6@gmail.com' ;
ALTER TABLE users ALTER COLUMN role  SET DEFAULT 'customer';
ALTER TABLE users ADD active_account BOOLEAN DEFAULT FALSE;
ALTER TABLE users ADD active_account_token VARCHAR(255);
/* ALTER TABLE users ADD role_id INT
 */
ALTER TABLE users ADD tokenID VARCHAR(255) DEFAULT NULL;
 change le type de la colonne role en int
ALTER TABLE users ALTER COLUMN role TYPE INT USING role::integer;
ALTER TABLE users ALTER COLUMN role SET DEFAULT 3;
/* les 3 ceux sont les customers 1 pour admin et 2 pour éditeurs */


ALTER TABLE users
ADD CONSTRAINT fk_users_role
FOREIGN KEY (role_id)
REFERENCES Roles(role_id);

CREATE TABLE RolePermissions (
  role_id INT,
  permission_id INT,
  PRIMARY KEY (role_id, permission_id),
  FOREIGN KEY (role_id) REFERENCES Roles(role_id),
  FOREIGN KEY (permission_id) REFERENCES Permissions(permission_id)
);





/* inject un users */
INSERT INTO users (firstname, lastname, email, password, role, created_at, updated_at)
VALUES ('toto', 'toto', 'audesandrine6@gmail.com', 'toto', 'admin', NOW(), NOW());
INSERT INTO users (firstname, lastname, email, password, role, created_at, updated_at)
VALUES ('yann', 'toto', 'habieyann@live.fr', 'toto', 'admin', NOW(), NOW());

 CREATE TABLE articles (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL,
    user_id INTEGER NOT NULL,
    slug VARCHAR(255) NOT NULL,
    status VARCHAR(255) NOT NULL,
); 

/* CREATE TABLE comments (
    id SERIAL PRIMARY KEY,
    content TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL,
    author VARCHAR(255) NOT NULL,
    article_id INTEGER NOT NULL
); */


CREATE TABLE posts(
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    status VARCHAR(255) NOT NULL,
);

/* rajoute une colonne slug */

ALTER TABLE posts ADD COLUMN slug VARCHAR(255)  NULL;
ALTER TABLE posts ADD COLUMN image VARCHAR(255)  NULL;


ALTER TABLE posts DROP COLUMN name;

ALTER TABLE posts ADD COLUMN date_created TIMESTAMP  NULL DEFAULT CURRENT_TIMESTAMP;


ALTER TABLE articles ALTER COLUMN context TYPE VARCHAR(255) USING context::varchar(255);