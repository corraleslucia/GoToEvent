create table artists (
id_artist int unsigned auto_increment,
name varchar (50),
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
    constraint pk_users primary key (id_user),
    constraint unq_users unique (mail)
);


create table tickets(
    id_ticket int unsigned auto_increment,
    id_user int unsigned,
    id_calendar int unsigned,
    id_event_seat int unsigned,
    id_seats_type int unsigned,
    quantity int unsigned not null,
    price float unsigned not null,
    total float unsigned not null,
    constraint pk_tickets primary key (id_ticket),
    constraint fk_tickets_users foreign key (id_user) references users(id_user),
    constraint fk_tickets_calendars foreign key (id_calendar) references calendars(id_calendar),
    constraint fk_tickets_event_seats foreign key (id_event_seat) references event_seats(id_event_seat),
    constraint fk_tickets_seats_type foreign key (id_seats_type) references seats_type(id_seats_type)
);

insert into users (mail, pass, name, last_name, user_type) values ("admin@admin", "admin", "Admin", "Admin", 1);
