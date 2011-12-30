CREATE TABLE presentation (
    uid int(11) NOT NULL AUTO_INCREMENT,
    ordering int(11),
    starred boolean DEFAULT 0,
    presenter_name_first varchar(255) NOT NULL,
    presenter_name_last varchar(255) NOT NULL,
    presenter_image varchar(255) NOT NULL,
    presenter_resume text NOT NULL,
    conference_name varchar(255) NOT NULL,
    conference_resume text NOT NULL,
    conference_goals text NOT NULL,
    tags varchar(1024) NOT NULL,
    website varchar(1024) NOT NULL,
    twitter_handle varchar(255) NOT NULL,
    PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;