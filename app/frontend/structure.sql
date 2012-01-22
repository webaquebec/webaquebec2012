CREATE TABLE presentation (
    id int(11) NOT NULL AUTO_INCREMENT,
    ordering int(11),
    starred boolean DEFAULT 0,
    presenter_name varchar(255) NOT NULL,
    presenter_image varchar(255) NOT NULL,
    presenter_resume text NOT NULL,
    conference_name varchar(255) NOT NULL,
    conference_resume text NOT NULL,
    conference_goals text NOT NULL,
    tags varchar(1024) NOT NULL,
    website varchar(1024) NOT NULL,
    twitter_handle varchar(255) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS event_day;
CREATE TABLE event_day (
    id int(11) NOT NULL AUTO_INCREMENT,
    date DATE,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO event_day (id, date) VALUES
(1, '2012-02-23'),
(2, '2012-02-24');

DROP TABLE IF EXISTS room;
CREATE TABLE room (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255),
    color varchar(7),
    ordering int(11),
    overlaps_all bool,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO room (id, name, color, overlaps_all, ordering) VALUES
(1, 'Grand Hall', '#3e3e3e', 1, 0),
(2, 'Libéo', '#ff0000', 0, 1),
(3, 'iXmédia', '#ffff00', 0, 2),
(4, 'VETIQ', '#ff00ff', 0, 3),
(5, 'Korem', '#ff4488', 0, 4);

DROP TABLE IF EXISTS plage_horaire;
CREATE TABLE plage_horaire (
    id int(11) NOT NULL AUTO_INCREMENT,
    event_day_id int(11),
    start_hour int(11),
    start_minute int(11),
    end_hour int(11),
    end_minute int(11),
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE horaire (
    plage_horaire_id int(11) NOT NULL,
    room_id int(11),
    presentation_id int(11)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;