drop database if exists "secure_login";
create database if not exists "secure_login";

create table users
(
    id int auto_increment,
    uid int null,
    authentication_string int null,
    constraint users_pk
        primary key (id)
);

create table connexions
(
    id int auto_increment,
    user_id int null,
    conn_time datetime null,
    logged bool null,
    constraint connexions_pk
        primary key (id),
    constraint connexions_users_id_fk
        foreign key (user_id) references users (id)
);