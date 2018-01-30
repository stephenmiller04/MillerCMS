CREATE TABLE articles (
	id INT PRIMARY KEY AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    author varchar(255) NOT NULL,
    published DATETIME NOT NULL,
		summary varchar(255) NOT NULL,
    category INT NOT NULL,
    content text NOT NULL,
    thumbnail varchar(255) NOT NULL,
    tags varchar(255) NOT NULL
);
