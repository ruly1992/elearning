-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 5.6.14 - MySQL Community Server (GPL)
-- OS Server:                    Win32
-- HeidiSQL Versi:               9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table portal_learning.artikel
CREATE TABLE IF NOT EXISTS `artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `type` enum('public','private') NOT NULL DEFAULT 'public',
  `status` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `published` datetime NOT NULL,
  `featured_image` varchar(255) NOT NULL,
  `slider` varchar(255) NOT NULL,
  `contributor_id` int(11) NOT NULL,
  `editor_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table portal_learning.artikel_has_tags
CREATE TABLE IF NOT EXISTS `artikel_has_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artikel_id` int(11) NOT NULL,
  `tags_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table portal_learning.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table portal_learning.kategori_has_artikel
CREATE TABLE IF NOT EXISTS `kategori_has_artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_id` int(11) NOT NULL,
  `artikel_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table portal_learning.komentar
CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `parent` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `artikel_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table portal_learning.links
CREATE TABLE IF NOT EXISTS `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table portal_learning.media
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `file_size` int(11) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `artikel_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table portal_learning.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table portal_learning.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `featured_image` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `contributor_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table portal_learning.tags
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag` (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table portal_learning.visitors
CREATE TABLE IF NOT EXISTS `visitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(64) NOT NULL,
  `access_url` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `times` int(11) NOT NULL DEFAULT '1',
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table portal_learning.visitor_artikel
CREATE TABLE IF NOT EXISTS `visitor_artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(50) NOT NULL,
  `times` int(11) NOT NULL DEFAULT '1',
  `artikel_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
