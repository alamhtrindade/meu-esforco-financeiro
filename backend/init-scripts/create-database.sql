CREATE DATABASE tarefeiro_database_local;

\c tarefeiro_database_local

CREATE TABLE public.failed_jobs (
    id bigserial NOT NULL,
    "uuid" varchar(255) NOT NULL,
    "connection" text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    "exception" text NOT NULL,
    failed_at timestamp(0) DEFAULT CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT failed_jobs_pkey PRIMARY KEY (id),
    CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid)
);

CREATE TABLE public.migrations (
    id serial4 NOT NULL,
    migration varchar(255) NOT NULL,
    batch int4 NOT NULL,
    CONSTRAINT migrations_pkey PRIMARY KEY (id)
);

CREATE TABLE public.users (
    id bigserial NOT NULL,
    "name" varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    email_verified_at timestamp(0) NULL,
    "password" varchar(255) NOT NULL,
    remember_token varchar(100) NULL,
    created_at timestamp(0) NULL,
    updated_at timestamp(0) NULL,
    CONSTRAINT users_email_unique UNIQUE (email),
    CONSTRAINT users_pkey PRIMARY KEY (id)
);