CREATE SCHEMA "user";

CREATE TABLE "user"."user" (
    id_user INT PRIMARY KEY,
    email VARCHAR(100),
    password VARCHAR(50),
    person_id INT
);

CREATE SCHEMA person;

CREATE TABLE person.person (
    id_person SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);