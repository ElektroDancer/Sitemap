create schema sitemap;

create table sitemap.page
(
    id          int auto_increment,
    url         varchar(255) not null,
    last_modify varchar(10)  not null,
    constraint page_pk
        primary key (id)
);

create
unique index page_url_uindex
    on sitemap.page (url);

