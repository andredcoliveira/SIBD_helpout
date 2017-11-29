CREATE TABLE users (
	id SERIAL PRIMARY KEY,
	name VARCHAR(128) NOT NULL,
	username VARCHAR(32) NOT NULL UNIQUE,
	pw VARCHAR(64) NOT NULL,
	birthdate DATE,
	description VARCHAR(1024),
	active BOOLEAN DEFAULT TRUE
);

CREATE TABLE pedido (
	id SERIAL PRIMARY KEY,
	name VARCHAR(128) NOT NULL,
	reward VARCHAR(128),
	added_date TIMESTAMP,
	description VARCHAR(512),
	location VARCHAR(128),
	date_limit DATE,
	active BOOLEAN DEFAULT TRUE
);

CREATE TABLE users_pedido (
	users_id INTEGER REFERENCES users
		ON DELETE CASCADE ON UPDATE CASCADE,
	pedido_id INTEGER REFERENCES pedido
		ON DELETE CASCADE ON UPDATE CASCADE,
	owner BOOLEAN,
	PRIMARY KEY(users_id, pedido_id)
);

CREATE TABLE comment (
	id SERIAL PRIMARY KEY,
	commenter_id INTEGER REFERENCES users NOT NULL,
	commented_id INTEGER REFERENCES users NOT NULL,
	classification NUMERIC(1,0)
		CHECK(classification >= 1 AND classification <= 5) NOT NULL,
	comment VARCHAR(512) NOT NULL,
	time_posted TIMESTAMP,
	pedido_id INTEGER REFERENCES pedido NOT NULL,
	UNIQUE(commented_id, pedido_id) 
);

CREATE TABLE skill (
	id SERIAL PRIMARY KEY,
	nome VARCHAR(32) UNIQUE NOT NULL
);

CREATE TABLE users_skill (
	users_id INTEGER REFERENCES users,
	skill_id INTEGER REFERENCES skill,
	PRIMARY KEY(users_id, skill_id)
);

CREATE TABLE pedido_skill (
	pedido_id INTEGER REFERENCES pedido,
	skill_id INTEGER REFERENCES skill,
	PRIMARY KEY(pedido_id, skill_id)
);

CREATE TABLE conversa (
	id SERIAL PRIMARY KEY,
	pedido_id INTEGER REFERENCES pedido
);

CREATE TABLE users_conversa (
	users_id INTEGER REFERENCES users,
	conversa_id INTEGER REFERENCES conversa,
	PRIMARY KEY(users_id, conversa_id)
);

CREATE TABLE mensagem (
	id SERIAL PRIMARY KEY,
	conversa_id INTEGER REFERENCES conversa,
	sender_id INTEGER REFERENCES users,
	message VARCHAR(512) NOT NULL
);

CREATE TABLE filters (
	users_id INTEGER REFERENCES users
		ON DELETE CASCADE ON UPDATE CASCADE,
	skill_id INTEGER REFERENCES skill
		ON DELETE CASCADE ON UPDATE CASCADE,
	PRIMARY KEY(users_id, skill_id)
);
