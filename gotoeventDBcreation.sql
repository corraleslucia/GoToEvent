create database gotoevent;
use gotoevent;

create table artists (
id_artist int unsigned auto_increment,
name varchar (50),
img varchar (255),
constraint pk_artists primary key(id_artist),
constraint unq_artists_name unique (name)
);

create table categories (
    id_category int unsigned auto_increment,
    description varchar(50),
    constraint pk_categories primary key (id_category),
    constraint unq_categories unique (description)
);

create table locations (
    id_location int unsigned auto_increment,
    name varchar (50),
    capacity int unsigned,
    adress varchar(50),
    city varchar(50),
    constraint pk_locations primary key (id_location),
    constraint unq_locations_name_adress_city unique (name,adress,city)
);


create table seats_type (
id_seats_type int unsigned auto_increment,
name varchar (50),
constraint pk_seats_type primary key(id_seats_type),
constraint unq_seats_type_name unique (name)
);

create table events(
    id_event int unsigned auto_increment,
    description varchar (50),
    id_category int unsigned,
    constraint pk_events primary key (id_event),
    constraint fk_events_categories_id_category foreign key (id_category) references categories (id_category),
    constraint unq_events_description unique (description)
);

create table calendars (
    id_calendar int unsigned auto_increment,
    calendar_date date not null,
    calendar_time time not null,
    id_location int unsigned,
    id_event int unsigned,
    constraint pk_calendars primary key (id_calendar),
    constraint unq_calendars unique (calendar_date, calendar_time, id_location),
    constraint fk_calendars_locations_id_location foreign key (id_location) references locations (id_location),
    constraint fk_calendars_events_id_event foreign key (id_event) references events (id_event)
);

create table artists_in_calendars (
    id_artist int unsigned,
    id_calendar int unsigned,
    constraint pk_artists_in_calendars primary key (id_artist,id_calendar),
    constraint fk_artists_in_calendars_id_artist foreign key (id_artist) references artists (id_artist),
    constraint fk_artists_in_calendars_id_calendar foreign key (id_calendar) references calendars (id_calendar)
);

create table event_seats (
id_event_seat int unsigned auto_increment,
id_seat_type int unsigned,
total_quantity int unsigned not null,
price decimal not null,
remaning_quantity int unsigned not null,
id_calendar int unsigned,
constraint pk_event_seats primary key (id_event_seat),
constraint fk_event_seats_seats_type_id_seat_type foreign key (id_seat_type) references seats_type (id_seats_type),
constraint fk_event_seats_calendars_id_calendar foreign key (id_calendar) references calendars (id_calendar),
constraint unq_event_seats unique (id_calendar,id_seat_type)
);


create table users(
    id_user int unsigned auto_increment,
    mail varchar(50),
    pass varchar(50),
    name varchar(50),
    last_name varchar(50),
    user_type tinyint unsigned not null,
    img varchar (255),
    constraint pk_users primary key (id_user),
    constraint unq_users unique (mail)
);

create table purchases (
    id_purchase int unsigned auto_increment,
    purchase_date date,
    total int unsigned,
    id_user int unsigned,
    constraint pk_purchases primary key (id_purchase),
    constraint fk_purchases_users foreign key (id_user) references users (id_user)
);

create table purchase_lines (
    id_purchase_line int unsigned auto_increment,
    id_event_seat int unsigned,
    quantity int unsigned,
    price float,
    id_purchase int unsigned,
    constraint pk_purchase_lines primary key (id_purchase_line),
    constraint fk_purchase_lines_purchases foreign key (id_purchase) references purchases (id_purchase)
);
create table tickets(
    id_ticket int unsigned auto_increment,
    ticket_number int unsigned,
    qr varchar(255),
    id_purchase_line int unsigned,
    constraint pk_tickets primary key (id_ticket),
    constraint fk_tickets_purchase_lines foreign key (id_purchase_line) references purchase_lines (id_purchase_line)
);
