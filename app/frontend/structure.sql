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

DROP TABLE IF EXISTS horaire;
CREATE TABLE horaire (
    id int(11) NOT NULL AUTO_INCREMENT,
    plage_horaire_id int(11) NOT NULL,
    room_id int(11),
    presentation_id int(11),
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `iw_teams` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `slogan` varchar(255) NOT NULL,
  `position` int(2) NOT NULL DEFAULT '5' COMMENT 'Display position',
  `hashtag` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `iw_team_members` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `iw_teamsID` int(2) NOT NULL,
  `first` varchar(30) NOT NULL,
  `last` varchar(30) NOT NULL,
  `title` varchar(60) NOT NULL COMMENT 'Team Member Title (eg.: Designer)',
  `twitter_username` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `iw_team_members` ADD INDEX `fk_iw_team_members__iw_teams__ID` (iw_teamsID), 
  ADD CONSTRAINT `fk_iw_team_members__iw_teams__ID` 
    FOREIGN KEY (iw_teamsID) 
    REFERENCES iw_teams (ID);

CREATE TABLE `iw_event` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `ts_publication` int(10) NOT NULL,
  `title` varchar(150) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `iw_remote_users` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `provider` ENUM('F', 'T') NOT NULL DEFAULT 'F' COMMENT 'F : Facebook ; T : Twitter',
  `remote_id` varchar(255) NOT NULL,
  `first` varchar(30) NOT NULL,
  `last` varchar(30) NOT NULL,
  `pic_url` varchar(255) NOT NULL,
  `ban` ENUM('0', '1') NOT NULL DEFAULT '0' COMMENT '1 : ban user',
  `type` ENUM('C','T','S') NOT NULL DEFAULT 'C' COMMENT 'C : Client ; T : Team Member ; S : Staff',
  `iw_team_membersID` int(5) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `iw_remote_users` ADD INDEX `fk_iw_remote_users__iw_teams_members__ID` (iw_team_membersID), 
  ADD CONSTRAINT `fk_iw_remote_users__iw_teams_members__ID` 
    FOREIGN KEY (`ID`) 
    REFERENCES `iw_team_members` (`ID`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION;

CREATE TABLE `iw_ballots` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `ts_start` int(11) NOT NULL,
  `ts_end` int(11) NOT NULL,
  `display_results_realtime` ENUM('0','1') NOT NULL DEFAULT '1' COMMENT 'Display (1) or Hide (0) Real Time Results during the ballot.',
  `display_results` ENUM('0','1') NOT NULL DEFAULT '0' COMMENT 'If display_results_realtime = 0, Display (1) Or Hide (0) Final Ballot Results',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `iw_ballots_results` (
  `iw_ballotsID` int(5) NOT NULL,
  `iw_teamsID` int(2) NOT NULL,
  `votes_count` int(10) NOT NULL,
  PRIMARY KEY (`iw_ballotsID`,`iw_teamsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `iw_ballots_results` ADD INDEX `fk_iw_ballots_results__iw_teams__ID` (iw_teamsID), 
  ADD CONSTRAINT `fk_iw_ballots_results__iw_teams__ID` 
    FOREIGN KEY (`iw_teamsID`) 
    REFERENCES `iw_teams` (`ID`);

ALTER TABLE `iw_ballots_results` ADD INDEX `fk_iw_ballots_results__iw_ballots__ID` (iw_ballotsID), 
  ADD CONSTRAINT `fk_iw_ballots_results__iw_ballots__ID` 
    FOREIGN KEY (`iw_ballotsID`) 
    REFERENCES `iw_ballots` (`ID`);

CREATE TABLE `iw_ballots_votes` (
  `iw_ballotsID` int(5) NOT NULL,
  `iw_remote_usersID` int(10) NOT NULL,
  `iw_teamsID` int(2) NOT NULL,
  PRIMARY KEY (`iw_ballotsID`,`iw_remote_usersID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `iw_ballots_votes` ADD INDEX `fk__iw_ballots_votes__iw_teams__ID` (iw_teamsID), 
  ADD CONSTRAINT `fk__iw_ballots_votes__iw_teams__ID` 
    FOREIGN KEY (`iw_teamsID`) 
    REFERENCES `iw_teams` (`ID`);

ALTER TABLE `iw_ballots_votes` ADD INDEX `fk_iw_ballots_votes__iw_ballots__ID` (iw_ballotsID), 
  ADD CONSTRAINT `fk_iw_ballots_votes__iw_ballots__ID` 
    FOREIGN KEY (`iw_ballotsID`) 
    REFERENCES `iw_ballots` (`ID`);

ALTER TABLE `iw_ballots_votes` ADD INDEX `fk_iw_ballots_votes__iw_remote_users__ID` (iw_remote_usersID), 
  ADD CONSTRAINT `fk_iw_ballots_votes__iw_remote_users__ID` 
    FOREIGN KEY (`iw_remote_usersID`) 
    REFERENCES `iw_remote_users` (`ID`);

CREATE TABLE `iw_chatroom` (
  `ID` INT(5) NOT NULL AUTO_INCREMENT,
  `iw_teamsID` int(2) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`ID`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `iw_chatroom` ADD INDEX `fk_iw_chatroom__iw_teams__ID` (iw_teamsID), 
  ADD CONSTRAINT `fk_iw_chatroom__iw_teams__ID` 
    FOREIGN KEY (`iw_teamsID`) 
    REFERENCES `iw_teams` (`ID`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION;

CREATE TABLE `iw_chatroom_message` (
  `ID` int(15) NOT NULL AUTO_INCREMENT,
  `iw_chatroomID` INT(5) NOT NULL,
  `iw_remote_usersID` int(10) NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `iw_chatroom_message` ADD INDEX `fk_iw_chatroom_message__iw_remote_users_ID` (iw_remote_usersID), 
  ADD CONSTRAINT `fk_iw_chatroom_message__iw_remote_users_ID` 
    FOREIGN KEY (`iw_remote_usersID`) 
    REFERENCES `iw_remote_users` (`ID`) 
    ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `iw_chatroom_message` ADD INDEX `fk_iw_chatroom_message__iw_chatroom__ID` (iw_chatroomID), 
  ADD CONSTRAINT `fk_iw_chatroom_message__iw_chatroom__ID` 
    FOREIGN KEY (`iw_chatroomID`) 
    REFERENCES `iw_chatroom` (`ID`) 
    ON DELETE CASCADE ON UPDATE CASCADE;





ALTER TABLE `iw_ballots` CHANGE `ID` `id` INT(5) NOT NULL AUTO_INCREMENT  ;

ALTER TABLE `iw_event` CHANGE `ID` `id` INT(10) NOT NULL AUTO_INCREMENT  ;
ALTER TABLE `iw_event` ADD `ts_end_publication` INT(10) NOT NULL AFTER `ts_publication` ;
ALTER TABLE `iw_event` ADD `archived` ENUM('0','1') DEFAULT '0' NULL AFTER `text` ;


ALTER TABLE `iw_ballots` ADD `archived` ENUM('0','1') DEFAULT '0' NULL AFTER `display_results` ;
ALTER TABLE `iw_ballots_votes` ADD `email` VARCHAR(100)  NOT NULL  DEFAULT ''  AFTER `iw_teamsID`;
ALTER TABLE `iw_ballots_votes` ADD `IP` VARCHAR(16)  NOT NULL  DEFAULT ''  AFTER `email`;
ALTER TABLE `iw_ballots_votes` DROP FOREIGN KEY `fk_iw_ballots_votes__iw_remote_users__ID`;
ALTER TABLE `iw_ballots_votes` DROP INDEX `fk_iw_ballots_votes__iw_remote_users__ID`;
ALTER TABLE `iw_ballots_votes` DROP PRIMARY KEY;
ALTER TABLE `iw_ballots_votes` ADD PRIMARY KEY (`iw_ballotsID`, `email`);
