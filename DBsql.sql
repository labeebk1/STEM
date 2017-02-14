/* View Entries */

SELECT * FROM events;
SELECT * FROM students;
SELECT * FROM users;

/* Delete Entries */

Delete from events where username = 'Teacher1';

/* Create Custom Entries */

INSERT INTO `events` (`username`, `student`, `hours`, `date`, `created`, `status`) VALUES
('Teacher1', 'Student1', '2', '2017-02-20', '2017-02-20 06:15:17', 1);

/* Update Paid Status */

update events
set status = replace(status,'1','0')
where username = 'hussainsobia@hotmail.com' and status = '1'


/* Creatiing a Table */

CREATE TABLE IF NOT EXISTS `events` (
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hours` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Block'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci



CREATE TABLE IF NOT EXISTS `students` (
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;