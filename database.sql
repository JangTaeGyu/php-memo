# Database 생성
create database memo;

use mysql;

# 계정 확인
select * from user;

# 계정 생성
create user cosmos@localhost identified by 'cosmos2017';

# Database 계정 권한 부여
grant all privileges on memo.* to cosmos@localhost;

# 권한 확인
show grants for cosmos@localhost;

# 회원정보
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '이름',
  `email` varchar(255) NOT NULL COMMENT '이메일',
  `password` varchar(255) NOT NULL COMMENT '비밀번호',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '가입일자',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '수정일자',
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='회원정보';

# 세션정보
CREATE TABLE `sessions` (
  `session_id` varchar(255) NOT NULL COMMENT '아이디',
  `session_expires` int(10) unsigned NOT NULL COMMENT '만료시간',
  `user_id` int(10) unsigned NOT NULL COMMENT 'user::id',
  `user_ip` varchar(255) NOT NULL COMMENT '아이피',
  `date` timestamp NULL DEFAULT NULL COMMENT '작성일자',
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# 메모정보
CREATE TABLE `memos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `memo` text NOT NULL COMMENT '메모',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '작성일자',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '수정일자',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='메모정보';
