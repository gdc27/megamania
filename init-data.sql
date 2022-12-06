create table migrations
(
    id serial primary key,
    migration varchar(255) not null,
    batch     integer      not null
);

alter table migrations
    owner to postgres;

create table users
(
    id  bigserial primary key,
    name              varchar(255) not null,
    email             varchar(255) not null constraint users_email_unique unique,
    email_verified_at timestamp(0),
    password          varchar(255) not null,
    remember_token    varchar(100),
    created_at        timestamp(0),
    updated_at        timestamp(0)
);

alter table users
    owner to postgres;

create table password_resets
(
    email      varchar(255) not null,
    token      varchar(255) not null,
    created_at timestamp(0)
);

alter table password_resets
    owner to postgres;

create index password_resets_email_index
    on password_resets (email);

create table failed_jobs
(
    id bigserial primary key,
    uuid varchar(255) not null constraint failed_jobs_uuid_unique unique,
    connection text                                   not null,
    queue      text                                   not null,
    payload    text                                   not null,
    exception  text                                   not null,
    failed_at  timestamp(0) default CURRENT_TIMESTAMP not null
);

alter table failed_jobs
    owner to postgres;

create table personal_access_tokens
(
    id bigserial primary key,
    tokenable_type varchar(255) not null,
    tokenable_id   bigint       not null,
    name           varchar(255) not null,
    token          varchar(64)  not null constraint personal_access_tokens_token_unique unique,
    abilities      text,
    last_used_at   timestamp(0),
    expires_at     timestamp(0),
    created_at     timestamp(0),
    updated_at     timestamp(0)
);

alter table personal_access_tokens
    owner to postgres;

create index personal_access_tokens_tokenable_type_tokenable_id_index
    on personal_access_tokens (tokenable_type, tokenable_id);

create table categories
(
    id   bigserial
        primary key,
    name varchar(30) not null
);

alter table categories
    owner to postgres;

create table subscriptions
(
    id                  bigserial
        primary key,
    name                varchar(255)     not null,
    monthly_cost        double precision not null,
    discount_percentage integer          not null
);

alter table subscriptions
    owner to postgres;

create table customers
(
    id              bigserial
        primary key,
    email           varchar(255)
        constraint customers_email_unique
            unique,
    first_name      varchar(30) not null,
    last_name       varchar(40) not null,
    subscription_id bigint constraint customers_subscription_id_foreign
            references subscriptions
            on delete cascade
);

alter table customers
    owner to postgres;

create table products
(
    id          bigserial
        primary key,
    name        varchar(100)     not null,
    description text,
    price       double precision not null,
    stock       integer          not null,
    category_id bigint           not null
        constraint products_category_id_foreign
            references categories
            on delete cascade
);

alter table products
    owner to postgres;

create table employees
(
    id          bigserial
        primary key,
    first_name  varchar(30)      not null,
    last_name   varchar(40)      not null,
    salary      double precision not null,
    hiring_date date             not null
);

alter table employees
    owner to postgres;

create table sales
(
    id          bigserial
        primary key,
    date        date   not null,
    customer_id bigint not null
        constraint sales_customer_id_foreign
            references customers
            on delete cascade,
    employee_id bigint not null
        constraint sales_employee_id_foreign
            references employees
            on delete cascade
);

alter table sales
    owner to postgres;

create table product_sale
(
    product_id bigint  not null
        constraint product_sale_product_id_foreign
            references products
            on delete cascade,
    sale_id    bigint  not null
        constraint product_sale_sale_id_foreign
            references sales
            on delete cascade,
    quantity   integer not null
);

alter table product_sale
    owner to postgres;

CREATE OR REPLACE FUNCTION update_stock()
RETURNS TRIGGER
AS $$
DECLARE var_product_id INT;
        var_quantity INT;
        var_stock INT;
BEGIN
SELECT product_id, quantity INTO var_product_id, var_quantity FROM product_sale WHERE sale_id = NEW.sale_id;
SELECT stock INTO var_stock FROM products WHERE id = var_product_id;
UPDATE products SET stock = var_stock - var_quantity WHERE id = var_product_id;
RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER update_stock_trigger
    AFTER INSERT ON product_sale
    FOR EACH ROW
    EXECUTE PROCEDURE update_stock();

INSERT INTO subscriptions (id, name, monthly_cost, discount_percentage) VALUES (1, 'Abonnement gratuit', 0, 0);
INSERT INTO subscriptions (id, name, monthly_cost, discount_percentage) VALUES (2, 'Abonnement bronze', 3.5, 5);
INSERT INTO subscriptions (id, name, monthly_cost, discount_percentage) VALUES (3, 'Abonnement gold', 10, 15);

INSERT INTO categories (id, name) VALUES (2, 'Jeux playstation 5');
INSERT INTO categories (id, name) VALUES (3, 'Jeux playstation 4');
INSERT INTO categories (id, name) VALUES (4, 'Jeux playstation 3');

INSERT INTO employees (id, first_name, last_name, salary, hiring_date) VALUES (1, 'Gertrude', 'Maximin', 1330, '2018-12-27');
INSERT INTO employees (id, first_name, last_name, salary, hiring_date) VALUES (2, 'Georges', 'Michael', 1500, '2020-09-12');

INSERT INTO products (id, name, description, price, stock, category_id) VALUES (1, 'God of War PS5', 'Do it boy !', 50, 27, 2);
INSERT INTO products (id, name, description, price, stock, category_id) VALUES (2, 'Cyberpunk 2077 PS4', 'You''re breath taking !', 30, 15, 3);

INSERT INTO customers (id, email, first_name, last_name, subscription_id) VALUES (2, 'Jack@mail.com', 'jack', 'lumber', 3);
INSERT INTO customers (id, email, first_name, last_name, subscription_id) VALUES (3, 'rob@mail.com', 'robin', 'mj', 1);
INSERT INTO customers (id, email, first_name, last_name, subscription_id) VALUES (4, 'gab@mail.com', 'gab', 'dc', 2);

INSERT INTO sales (id, date, customer_id, employee_id) VALUES (98, '2022-11-11', 3, 2);
INSERT INTO sales (id, date, customer_id, employee_id) VALUES (99, '2022-11-11', 4, 1);

INSERT INTO product_sale (product_id, sale_id, quantity) VALUES (1, 99, 2);
INSERT INTO product_sale (product_id, sale_id, quantity) VALUES (2, 98, 1);

INSERT INTO users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) VALUES (1, 'User', 'u.u@user.com', null, '$2y$10$gTKsNmfhzn2JQRSvXvnst.z.QPd1MMTYpdgxpdixsnnMaVsagbgKi', null, '2022-12-06 21:18:02', '2022-12-06 21:18:02');

