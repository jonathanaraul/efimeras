-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-09-2014 a las 03:36:54
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `efimeras`
--
CREATE DATABASE IF NOT EXISTS `efimeras` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `efimeras`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `background`
--

CREATE TABLE IF NOT EXISTS `background` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `home` tinyint(1) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BC68B4508D93D649` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `background`
--

INSERT INTO `background` (`id`, `user`, `published`, `home`, `name`, `path`, `ip`, `created`, `updated`) VALUES
(4, 1, 1, 1, 'Efi1', '853795ce12735e8e29be52e69be73c9723ad337d.jpeg', '::1', '0000-00-00 00:00:00', '2014-07-29 03:46:00'),
(5, 1, 1, 1, 'Efi2', '0b453eb7b2a199c72bdd8d4716ce2eced50ad1b0.jpeg', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 1, 1, 'Efi3', '9d5e5d16ada73e094a2014aecbe5b7666212bf36.jpeg', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 1, 1, 'Efi4', '081e2387d76a33ae4daf492b58c39c834cc5b067.jpeg', '::1', '0000-00-00 00:00:00', '2014-07-29 06:01:45'),
(8, 1, 1, 1, 'Efi5', '4afa2aa815cd0fca535fa5ba1ea02ffae4169d51.jpeg', '::1', '0000-00-00 00:00:00', '2014-07-29 06:05:13'),
(9, 1, 1, 1, 'Efi6', 'f6f02749ad154be5a5540a5c7712d448c5baf78e.jpeg', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 1, 1, 'Efi7', 'dd2b298a4af234442d784b4b4347e3ef80302c3e.jpeg', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 1, 1, 1, 'Efi8', '3e9fbe3a0da0d0ae2d3a0c3a7296d6972022ca2c.jpeg', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 1, 1, 1, 'Efi9', '0d95d349b4c01ab2e8492c202e130f3a5636dd3d.jpeg', '::1', '0000-00-00 00:00:00', '2014-07-29 05:54:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `background` int(11) NOT NULL,
  `theme` int(11) NOT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `template` tinyint(1) NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_meta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `upper_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lower_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `friendly_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tags` longtext COLLATE utf8_unicode_ci,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `menu` int(11) DEFAULT NULL,
  `templateMenu` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_64C19C18D93D649` (`user`),
  KEY `IDX_64C19C1BC68B450` (`background`),
  KEY `IDX_64C19C19775E708` (`theme`),
  KEY `IDX_64C19C17D053A93` (`menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `user`, `background`, `theme`, `published`, `template`, `keywords`, `description_meta`, `name`, `upper_text`, `lower_text`, `path`, `friendly_name`, `tags`, `content`, `ip`, `created`, `updated`, `menu`, `templateMenu`) VALUES
(1, 1, 6, 6, 1, 1, 'noticias', 'noticias', 'Noticias', 'noticias', 'noticias', NULL, 'noticias', 'tagnoticia1, tagnoticia2, tagnoticia3', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?</p>\r\n\r\n<p>Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>', '::1', '2014-07-22 05:44:51', '2014-09-05 03:28:54', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `email`
--

INSERT INTO `email` (`id`, `email`, `created`, `updated`) VALUES
(2, 'jonathan.araul@gmail.com', '2014-08-24 05:14:02', '2014-08-24 05:14:02'),
(3, 'juan@gmail.com', '2014-08-24 00:00:00', '2014-08-24 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fos_user`
--

CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaRegistro` datetime NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `name`, `path`, `fechaRegistro`, `descripcion`) VALUES
(1, 'jonathan.araul', 'jonathan.araul', 'jonathan.araul@gmail.com', 'jonathan.araul@gmail.com', 1, 'hxphtd1ox14w0csosog0kc0g4wsoko0', '0xBgpAyww2D9amSwbBo0PtsvsCoDX2cQ65X4aOZ5CLDH3Y3B5apeCWi/kqHW8dJ5OLPnyDrOu4nl5iT8DybPRA==', '2014-09-05 03:25:33', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:9:"ROLE_USER";}', 0, NULL, 'Jonathan Araul', '1012871_817926508225412_2461521584647138733_n.jpg', '2014-06-27 02:11:43', 'web developer'),
(2, 'R_Francos', 'r_francos', 'info@ramonfrancos.es', 'info@ramonfrancos.es', 1, 'dl8em23gup4oggo0ckg48ggcscgwwws', '9KQAy6ZR2VWeXplfJZ4fWHIjdCkOP4S4vgmhM3ZCnPtmJoGEdXLDkMyMdiZKoT6a/davigBZ+u5iH5p5zAQuZA==', '2014-07-15 19:50:46', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:9:"ROLE_USER";}', 0, NULL, 'Ramón', 'photo.jpg', '2014-07-15 19:50:45', 'Profesor'),
(3, 'REALEGO', 'realego', 'info@realego.es', 'info@realego.es', 1, 'jpsfl4lprrkc4044g8o0o48kowk0ggc', 'cokt+2bl2c2R4SA78AzWLYvUyQegl86jqc94RIYWb7oKDfipVg/6h+Fr4hGw6zCQHXUbgSI9NwhVtSkPZqmDRA==', '2014-08-14 13:43:30', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:9:"ROLE_USER";}', 0, NULL, 'Realego', '1622859_1375356429405551_897463730_n.jpg', '2014-07-31 12:55:46', 'REALEGO Oficina Creativa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitation`
--

CREATE TABLE IF NOT EXISTS `invitation` (
  `code` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `sent` tinyint(1) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE IF NOT EXISTS `mensaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asunto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `destinatario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `redactor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenido` longtext COLLATE utf8_unicode_ci NOT NULL,
  `newsletter` tinyint(1) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`id`, `asunto`, `destinatario`, `redactor`, `contenido`, `newsletter`, `created`, `updated`) VALUES
(1, 'miasunto', 'jonathan.araul@gmail.com', 'juan@gmail.com', 'Este es mi mensaje de prueba', 0, '2014-08-23 22:56:12', '2014-08-23 22:56:12'),
(2, 'Asunto', 'jonathan.araul@gmail.com', 'hjimenez45@gmail.com', 'Este es un mensaje de queja bla bla bla bla blaaaaa', 0, '2014-08-23 23:04:07', '2014-08-23 23:04:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `published` tinyint(1) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7D053A938D93D649` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `user`, `name`, `description`, `published`, `created`, `updated`) VALUES
(1, 1, 'Principal', 'Menu del front de efimeras', 1, '2014-07-28 23:33:00', '2014-07-31 12:59:16'),
(2, 1, 'Menu Prueba', 'Menu prueba', 1, '2014-09-03 06:36:43', '2014-09-03 06:36:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_item`
--

CREATE TABLE IF NOT EXISTS `menu_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` int(11) NOT NULL,
  `page` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `user` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `rank` int(11) NOT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D754D5507D053A93` (`menu`),
  KEY `IDX_D754D550140AB620` (`page`),
  KEY `IDX_D754D55064C19C1` (`category`),
  KEY `IDX_D754D5508D93D649` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `menu_item`
--

INSERT INTO `menu_item` (`id`, `menu`, `page`, `category`, `user`, `name`, `description`, `rank`, `published`, `tipo`, `created`, `updated`) VALUES
(1, 1, 1, NULL, 1, 'EFÍMERAS MASTER', 'MAster en Arquitectura Efímera', 0, 1, 0, '2014-07-31 00:00:00', '2014-07-31 13:20:16'),
(2, 1, NULL, 1, 1, 'Noticias', 'Noticias', 6, 1, 1, '2014-07-31 07:24:00', '2014-07-31 13:33:02'),
(3, 1, 2, NULL, 1, 'EXPERTO EN ARQUITETURAS INTERACTIVAS', 'Arquitecturas', 2, 1, 0, '2014-07-31 13:20:05', '2014-07-31 13:26:20'),
(4, 1, NULL, NULL, 1, 'Espacio 1', 'espacio 1', 1, 1, 2, '2014-07-31 13:20:40', '2014-07-31 13:21:00'),
(5, 1, NULL, NULL, 1, 'Espacio2', 'Espacio2', 5, 1, 2, '2014-07-31 13:20:53', '2014-07-31 13:33:02'),
(6, 1, 3, NULL, 1, 'Experto en Arquitectura Efímera Social y Participativa', 'Experto en Arquitectura Efímera Social y Participativa', 3, 1, 0, '2014-07-31 13:25:06', '2014-07-31 13:27:55'),
(7, 1, 4, NULL, 1, 'Título de Especialista en Instalaciones Efímeras', 'Título de Especialista en Instalaciones Efímeras', 4, 1, 0, '2014-07-31 13:32:52', '2014-07-31 13:33:02'),
(8, 2, 1, NULL, 1, 'Master', 'master', 1, 1, 0, '2014-09-03 06:37:49', '2014-09-03 06:37:49'),
(9, 2, NULL, 1, 1, 'Noticias', 'noticias', 2, 1, 1, '2014-09-03 06:38:33', '2014-09-03 06:38:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asunto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `redactor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenido` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `newsletter`
--

INSERT INTO `newsletter` (`id`, `asunto`, `redactor`, `contenido`, `created`, `updated`) VALUES
(2, 'otro', '', '<p>otro mas</p>', '2014-08-24 23:27:23', '2014-08-24 23:27:23'),
(3, 'kdkjedne', '', '<p>excelente</p>', '2014-08-24 23:39:30', '2014-08-24 23:39:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `newsletters_emails`
--

CREATE TABLE IF NOT EXISTS `newsletters_emails` (
  `id_newsletter` int(11) NOT NULL,
  `id_email` int(11) NOT NULL,
  PRIMARY KEY (`id_newsletter`,`id_email`),
  KEY `IDX_14D1DBA7DB0F051F` (`id_newsletter`),
  KEY `IDX_14D1DBA79173D44` (`id_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `newsletters_emails`
--

INSERT INTO `newsletters_emails` (`id_newsletter`, `id_email`) VALUES
(3, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `background` int(11) NOT NULL,
  `theme` int(11) NOT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `template` tinyint(1) NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_meta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `upper_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lower_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `friendly_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `user` int(11) NOT NULL,
  `tags` longtext COLLATE utf8_unicode_ci,
  `reservacion` tinyint(1) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `category` int(11) DEFAULT NULL,
  `templateMenu` tinyint(1) NOT NULL,
  `menu` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_140AB6208D93D649` (`user`),
  KEY `IDX_140AB620BC68B450` (`background`),
  KEY `IDX_140AB6209775E708` (`theme`),
  KEY `IDX_140AB62064C19C1` (`category`),
  KEY `IDX_140AB6207D053A93` (`menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `page`
--

INSERT INTO `page` (`id`, `background`, `theme`, `published`, `template`, `keywords`, `description_meta`, `name`, `upper_text`, `lower_text`, `path`, `friendly_name`, `content`, `ip`, `user`, `tags`, `reservacion`, `created`, `updated`, `category`, `templateMenu`, `menu`) VALUES
(1, 4, 5, 1, 0, 'Bienvenido', 'EFÍMERAS MASTER', 'EFÍMERAS MASTER', 'Bienvenido', 'Bienvenido', NULL, 'efÍmeras-master', '<p>Nuevo M&aacute;ster en Efimeras<br />\r\nAbierto periodo de Pre-inscripci&oacute;n</p>\r\n\r\n\r\n<p>Nuestra nueva web del M&aacute;ster en Ef&iacute;meras est&aacute; en CONSTRUCCI&Oacute;N</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Aqu&iacute; tienes un avance de la informaci&oacute;n:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>M&Aacute;STER EN EF&Iacute;MERAS</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Ef&iacute;meras se transforma en M&aacute;ster</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Te presentamos el primer M&aacute;ster en la Universidad espa&ntilde;ola centrado en la formaci&oacute;n de nuevos &aacute;mbitos de actuaci&oacute;n para arquitectos, interioristas, dise&ntilde;adores, ingenieros, arquitectos t&eacute;cnicos, artistas etc, implicados con nuevas maneras de ver la arquitectura, dise&ntilde;o y el arte, m&aacute;s adecuados a la sociedad que impera en la actualidad.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Este T&iacute;tulo responde a un mercado emergente cada vez m&aacute;s activo y complejo, que requiere de profesionales con formaci&oacute;n multidisciplinar y alto grado de especializaci&oacute;n, llevando a cabo proyectos completos desde su planteamiento y gesti&oacute;n, su desarrollo y ejecuci&oacute;n hasta su comunicaci&oacute;n y difusi&oacute;n.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>El M&aacute;ster est&aacute; compuesto por tres t&iacute;tulos independientes y complementarios donde el alumno se formar&aacute; como experto en la realizaci&oacute;n de proyectos tecnol&oacute;gicos ef&iacute;meros e interactivos, como experto en arquitecturas participativas ef&iacute;meras y sociales y como especialista en instalaciones ef&iacute;meras ya sean art&iacute;sticas, arquitect&oacute;nicas, paisaj&iacute;sticas o escenogr&aacute;ficas.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Para la obtenci&oacute;n del T&iacute;tulo de M&aacute;ster se tendr&aacute; que realizar un proyecto Fin de M&aacute;ster.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Experto en Arquitecturas Interactivas</p>\r\n\r\n<p>15 ects (450 horas)</p>\r\n\r\n<p>M&aacute;s informaci&oacute;n&hellip;</p>\r\n\r\n<p>+</p>\r\n\r\n<p>Experto en Arquitecturas Ef&iacute;mera Social y Participativa</p>\r\n\r\n<p>15 ects (450 horas)</p>\r\n\r\n<p>M&aacute;s informaci&oacute;n&hellip;</p>\r\n\r\n<p>+</p>\r\n\r\n<p>Especialista en Instalaciones Ef&iacute;meras</p>\r\n\r\n<p>30 ects (900 horas)</p>\r\n\r\n<p>M&aacute;s informaci&oacute;n&hellip;</p>\r\n\r\n<p>+</p>\r\n\r\n<p>Proyecto Fin de M&aacute;ster</p>\r\n\r\n<p>10 ects (300 horas)</p>\r\n\r\n<p><strong>=</strong></p>\r\n\r\n<p>M&Aacute;STER<strong> EN </strong><strong>EF&Iacute;MERAS </strong><strong>70 ects </strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Plazos y Horarios</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Todas las clases son presenciales y se realizar&aacute;n en la Escuela T&eacute;cnica Superior de Arquitectura de Madrid en horario de tarde de lunes a viernes<br />\r\ndesde las 15:30h hasta las 20:45.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Puedes empezar indistintamente y obtener tu t&iacute;tulo:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Experto en Arquitectura Ef&iacute;mera Social y Participativa</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>M&aacute;s informaci&oacute;n&hellip;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Cr&eacute;ditos:</strong><br />\r\n15 ects</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Pre-inscripci&oacute;n: </strong><br />\r\nA partir del 25 de Junio de 2014</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Inscripci&oacute;n: </strong><br />\r\nDesde el 7 de Julio al 25 septiembre de 2014</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Matr&iacute;cula:</strong><br />\r\nDesde el 1 de Septiembre hasta el 28 septiembre de 2014</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>I</strong><strong>nicio del Curso</strong>:</p>\r\n\r\n<p><em>2-3 octubre de 2014<br />\r\n&oacute;<br />\r\n2-3 octubre de 2015</em></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Experto </strong><strong>en Arquitecturas Interactivas</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>M&aacute;s informaci&oacute;n&hellip;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Cr&eacute;ditos:</strong><br />\r\n15 ects</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Pre-inscripci&oacute;n: </strong><br />\r\nA partir del 25 de Junio de 2014</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Inscripci&oacute;n: </strong><br />\r\nDesde el 7 de Julio al 25 septiembre de 2014</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Matr&iacute;cula:</strong><br />\r\nDesde el 1 de Septiembre hasta el 28 septiembre de 2014</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Inicio del Curso</strong>:<br />\r\n2-3 octubre de 2014<br />\r\n&oacute;<br />\r\n2-3 octubre de 2015</p>\r\n\r\n<p><strong>Especialista </strong><strong>en Instalaciones Ef&iacute;meras</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>M&aacute;s informaci&oacute;n&hellip;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Cr&eacute;ditos:</strong><br />\r\n30 ects</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Pre-inscripci&oacute;n: </strong><br />\r\nA partir del 25 de Junio de 2014</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Inscripci&oacute;n: </strong><br />\r\nDesde el 7 de Julio de 2014 al 10 enero de 2015</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Matr&iacute;cula:</strong><br />\r\nDesde el 20 de Diciembre de 2014 hasta el 12 enero de 2015</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Inicio del Curso:</strong><br />\r\n18-19 enero 2015</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Proyecto F&iacute;n de M&aacute;ster:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Cr&eacute;ditos:</strong><br />\r\n10 ects</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Pre-inscripci&oacute;n: </strong><br />\r\nA partir del 8 de enero de 2016</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Inscripci&oacute;n:</strong><br />\r\nDesde el 8 de enero al 15 de febrero de 2016</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Matr&iacute;cula: </strong><br />\r\nDesde el 1 de Febrero de 2016</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Inicio del Proyecto Fin de M&aacute;ster</strong><br />\r\n1 de marzo 2016</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>PRECIOS Y PLAZOS DE MATRICULA</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Inicio:</strong> 2-3 de Octubre de 2014</p>\r\n\r\n<p><strong>Finalizaci&oacute;n:</strong> 2-5 de julio de 2016</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Los alumnos que se matriculen del m&aacute;ster tienen un descuento del 10% sobre el precio total del coste de la matr&iacute;cula por t&iacute;tulos asociados.</p>\r\n\r\n<p>Adem&aacute;s existen unas becas de colaboraci&oacute;n de 1.000 euros sobre el precio con descuento</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Preinscripci&oacute;n e Inscripci&oacute;n:</strong> desde 25 de junio hasta 25 Septiembre de 2014</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>1&ordm;Pago: 900 &euro;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Matr&iacute;cula: </strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>2&ordm; Pago: 2.300 &euro; antes del 15 de noviembre 2014</p>\r\n\r\n<p>3&ordm; Pago: 2.300 &euro; antes del 15 de enero 2015</p>\r\n\r\n<p>4&ordm; Pago: 2.300 &euro; antes 15 de abril 2015</p>\r\n\r\n<p>5&ordm; Pago: 2.250 &euro; antes del 25 de Septiembre 2015</p>\r\n\r\n<p>6&ordm; Pago: Proyecto Fin de M&aacute;ster con construcci&oacute;n prototipo: 1.000 &euro; antes del 15 de febrero 2016</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>INSCRiBETE YA!!!</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Porque formamos profesionales en el campo de las Arquitecturas, Tecnolog&iacute;as e Instalaciones Ef&iacute;meras,un &aacute;mbito de trabajo emergente que a partir de hora tiene una formaci&oacute;n espec&iacute;fica oficial y acad&eacute;mica universitaria.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Si quieres m&aacute;s informaci&oacute;n sobre el M&aacute;ster en Ef&iacute;meras o los diferentes T&iacute;tulos que lo componen, escr&iacute;benos a efimeras.arquitectura@upm.es.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Nuestra nueva pagina del m&aacute;ster esta en construcci&oacute;n</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>* En cada uno de los T&iacute;tulos se otorgar&aacute;n becas de colaboraci&oacute;n de ayuda a la Matr&iacute;cula.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '150.214.223.250', 1, 'tag1', 0, '2014-07-29 22:10:12', '2014-07-31 13:34:41', NULL, 0, NULL),
(2, 4, 1, 1, 1, 'interactivas', 'Experto en Arquitecturas', 'EXPERTO EN ARQUITECTURAS INTERACTIVAS', 'interactivas', 'interactivas', NULL, 'experto-en-arquitecturas-interactivas', '<p>T&iacute;tulo de Experto en Arquitecturas Interactivas</p>\r\n\r\n<p><strong>T&iacute;tulo perteneciente al M&aacute;ster Ef&iacute;meras</strong></p>\r\n\r\n<p><em>&ldquo;Actualmente la tecnolog&iacute;a se ha democratizado<br />\r\nconsiderablemente y su sencillez facilita que personas<br />\r\nantes ajenas puedan hacer uso de ella de manera muy diversa,<br />\r\npermitiendo realizar en muy poco tiempo<br />\r\ncreaciones sorprendentes.&rdquo;</em></p>\r\n\r\n<p><em>Chema D&iacute;ez del Corral. Arquitecto</em></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>En la actualidad las instalaciones interactivas se desenvuelven en un amplio campo de acci&oacute;n, museos; macro-eventos de todo tipo; montajes ef&iacute;meros en la calle; exposiciones art&iacute;sticas, en escenograf&iacute;as, en el mundo de la publicidad o en acontecimientos de muy diversa &iacute;ndole. A partir de ahora tienes la oportunidad de formarte acad&eacute;micamente en este campo emergente.<br />\r\n<br />\r\nEn este nuevo t&iacute;tulo de postgrado, formamos expertos capaces de dirigir y realizar proyectos creativos y art&iacute;sticos utilizando las nuevas tecnolog&iacute;as. Estas herramientas ofrecen infinitas posibilidades espaciales, formales y tecnol&oacute;gicas que a&uacute;n se encuentran por desarrollar.<br />\r\n<br />\r\nEl objetivo principal es abrir el campo de visi&oacute;n y los recursos expresivos al aportar al alumno de los conocimientos necesarios, para comprender el funcionamiento y el uso de estas nuevas tecnolog&iacute;as para dise&ntilde;ar, realizar y dirigir multitud de proyectos tecnol&oacute;gicos diferentes : Smart home, impresi&oacute;n 3d, video-mapping, realidad aumentada, aplicaciones m&oacute;viles art&iacute;sticas, serious games, Instalaciones interactivas en exposiciones y en el espacio p&uacute;blico&hellip;, ya que gracias a las diferentes tecnolog&iacute;as aparecidas en estos &uacute;ltimos a&ntilde;os es posible comunicar conceptos e ideas, y crear sensaciones y experiencias espaciales que de otra manera ser&iacute;a imposible.<br />\r\n<br />\r\nAdem&aacute;s el T&iacute;tulo ofrece 100 horas de pr&aacute;cticas con empresas y estudios del sector, facilitando a los alumnos la incorporaci&oacute;n a la experiencia del mundo laboral.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Contenidos Acad&eacute;micos </strong></p>\r\n\r\n<p><strong>M&Oacute;DULO 1 - </strong><strong>Teor&iacute;a</strong></p>\r\n\r\n<p><strong>Introducci&oacute;n a las Nuevas Tecnolog&iacute;as</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Se le presenta al alumno una visi&oacute;n global del panorama, dando a conocer: las nuevas posibilidades que estas tecnolog&iacute;as nos permiten y las herramientas que tenemos a nuestra disposici&oacute;n, as&iacute; como un recorrido por las mejores creaciones.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>M&Oacute;DULO 3 - Arduino<br />\r\nElectr&oacute;nica &ldquo;<em>DO IT YOUR SELF&rdquo;</em></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Arduino es una plataforma que tiene como fin acercar la electr&oacute;nica al p&uacute;blico en general haci&eacute;ndola m&aacute;s sencilla y accesible, cuando ves que unos amigos han creado un robot o unos estudiantes han mandado un sat&eacute;lite, muy seguramente est&aacute;n jugando con Arduino.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Workshop 2:<br />\r\nInteractuando con objetos cotidianos</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Utilizando arduino hackeamos objetos del d&iacute;a a d&iacute;a para hacerlos que respondan ante distintos inputs</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>M&Oacute;DULO 2 - </strong><strong>Processing</strong></p>\r\n\r\n<p><strong>Programaci&oacute;n Creativa</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Se introduce al alumno en el mundo de la programaci&oacute;n utilizando la herramienta Processing ya que es un lenguaje de programaci&oacute;n muy sencillo enfocado para dise&ntilde;adores gr&aacute;ficos, artistas y arquitectos</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Workshop 1:</strong><br />\r\n<strong>Dibujo Generativo. Interactividad, orden y caos</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Workshop en el que utilizaremos processing para aprender a programar creando distintos dise&ntilde;os generativos que respondan a &ldquo;est&iacute;mulos&rdquo; externos, patrones de crecimiento y aletoreidad.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>M&Oacute;DULO 4 &ndash; Grasshopper<br />\r\nHerramientas de Generaci&oacute;n Visual</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Es un programa de dibujo con herramientas de programaci&oacute;n visual que permite<br />\r\nrepresentar elementos complejos gracias a reglas sencillas.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Workshop 3:<br />\r\nInteractuando con el espacio tridimensional</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Elaboraci&oacute;n de un modelo interactivo de generaci&oacute;n de formas din&aacute;micas. Asociar un comportamiento a un efecto visual digital.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>M&Oacute;DULO 5 - Instalaciones Interactivas</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>En este m&oacute;dulo estudiaremos c&oacute;mo realizar una instalaci&oacute;n interactiva aplicando lo aprendido en los anteriores m&oacute;dulos</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Workshop 4: Videomapping interactivo. </strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dise&ntilde;o y creaci&oacute;n de una instalaci&oacute;n de videomapping, trabajando dicha t&eacute;cnica as&iacute; como dando valor al montaje</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Workshop 5: Escenograf&iacute;a interactiva. </strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Utilizaremos lo aprendido para crear un espacio cambiante e interactivo, todo un espect&aacute;culo inmersivo.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Workshop 6: Visualizando la ciudad.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Utilizando las nuevas tecnolog&iacute;as tenemos dos misiones: leer la ciudad de una manera nueva y mostrarla al mundo con visualizaciones y gr&aacute;ficos interactivos.</p>\r\n\r\n<p><strong>Pr&aacute;cticas </strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Adem&aacute;s el T&iacute;tulo ofrece 100 horas de pr&aacute;cticas empresas del sector facilitando a los alumnos la incorporaci&oacute;n a la experiencia del mundo pr&aacute;ctico y social.</p>\r\n\r\n<p><strong>Plazo: Matr&iacute;cula, Pagos y Desarrollo</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Preinscripci&oacute;n:</strong> desde 25 de junio hasta 25 Septiembre (www.upm.es/atenea)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Inscripci&oacute;n </strong><strong>y reserva de plaza:</strong> Hasta el 1 de octubre del 2014. 350 Euros</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Matr&iacute;cula</strong>:A partir del 15 de septiembre hasta el 1 de octubre para hacer efectiva la matr&iacute;cula, se tendr&aacute; que abonar un &uacute;nico pago de 2.500 euros restantes, o bien si se prefiere en 2 plazos a lo largo del curso.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Pago fraccionado: </strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>1&ordm; Pago: 1.500 euros antes del 1 de octubre de 2014</p>\r\n\r\n<p>2&ordm; Pago: 1.000 euros antes del 1 de diciembre de 2014</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>* Se otorgar&aacute;n becas parciales internas sobre el importe de la matr&iacute;cula. Las becas no se otorgar&aacute;n sobre el importe de la Inscripci&oacute;n.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Inicio del Curso</strong>: 2-3 octubre de 2014</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Desarrollo del Curso</strong>: Del 6 de octubre al 20 de diciembre</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Presentaci&oacute;n Oral</strong>: 8,9,10 de enero 2015</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Pr&aacute;cticas en empresas y estudios</strong>: Del 12 de enero al 12 de febrero de 2015</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Este T&iacute;tulo de Experto se puede realizar independientemente o como parte del M&aacute;ster en Ef&iacute;meras.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Los antiguos alumnos que ya han cursado el t&iacute;tulo de Especializaci&oacute;n en Instalaciones Ef&iacute;meras de 30ects, tienen la posibilidad de obtener el m&aacute;ster con la realizaci&oacute;n de los dos nuevos cursos de Experto y el Proyecto Fin de M&aacute;ster.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Todas las clases son presenciales y se realizar&aacute;n en la Escuela T&eacute;cnica Superior de Arquitectura de Madrid en horario de tarde de lunes a viernes desde las 15:30h hasta las 20:45.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>INCRIBETE YA!!!</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Porque formamos profesionales en el campo de las Instalaciones Ef&iacute;meras, un &aacute;mbito de trabajo emergente que tiene una formaci&oacute;n espec&iacute;fica oficial y acad&eacute;mica universitaria.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Si quieres m&aacute;s informaci&oacute;n sobre el M&aacute;ster en Ef&iacute;meras o los diferentes T&iacute;tulos que lo componen, escr&iacute;benos a efimeras.arquitectura@upm.es.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>FacebookTumblrTwitterPinterest<strong>Informacion de contacto:</strong><strong>www.instalacionesefimeras.com</strong><br />\r\nefimeras.arquitectura@upm.es<br />\r\nEscuela T&eacute;cnica Superior de Arquitectura de Madrid</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Avenida Juan de Herrera, 4</p>\r\n\r\n<p>28040 MADRID<br />\r\nPabell&oacute;n Nuevo, Tercera Planta</p>\r\n\r\n<p>Tel&eacute;fono: 913364402/ 913365272.</p>', '2.138.45.162', 1, 'arquitectura, interactiva, efimera, tecnólogia, robotica', 1, '2014-07-31 13:18:53', '2014-07-31 18:12:23', NULL, 0, NULL),
(3, 4, 4, 1, 0, 'Experto en Arquitectura Efímera Social y Participativa', 'Experto en Arquitectura Efímera Social y Participativa', 'Experto en Arquitectura Efímera Social y Participativa', 'Experto en Arquitectura Efímera Social y Participativa', 'Experto en Arquitectura Efímera Social y Participativa', NULL, 'experto-en-arquitectura-ef', '<p>Arquitectura Ef&iacute;mera Social y Participativa</p>\r\n\r\n<p>T&iacute;tulo perteneciente al M&aacute;ster en Ef&iacute;meras</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><em>&ldquo;En este nuevo t&iacute;tulo de postgrado de Experto en<br />\r\nArquitectura Ef&iacute;mera Social y Participativo, exploramos<br />\r\nlas distintas aplicaciones de los sistemas de arquitecturas ef&iacute;meras<br />\r\ncon especial atenci&oacute;n a sus implicaciones sociales y constructivas<br />\r\nen el &aacute;mbitodom&eacute;stico y del espacio p&uacute;blico&rdquo;</em></p>\r\n\r\n<p>Carmelo Rodr&iacute;guez.</p>\r\n\r\n<p>Componente de PKMN. Coordinador del T&iacute;tulo</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Respondemos a una formaci&oacute;n universitaria de vanguardia necesaria para la formaci&oacute;n de un nuevo campo de trabajo profesional, como pueden ser los colectivos multidisciplinares que interact&uacute;an con la sociedad utilizando estrategias participativas dando respuesta a las necesidades contempor&aacute;neas.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>En el postgrado trabajaremos con compactos asociados a la escala del mobiliario, con estructuras m&oacute;viles, transformables y flexibles, con kit de piezas, con t&eacute;rminos como reciclaje y ciudadan&iacute;a, con intervenciones paisaj&iacute;sticas en &aacute;mbitos urbanos y con sistemas de construcci&oacute;n pop-up, realizando prototipos e intervenciones a escala real.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>El equipo de profesorado est&aacute; compuesto por especialistas multidisciplinares que imparten diferentes m&oacute;dulos de conocimiento, dentro de estos existen clases te&oacute;ricas y Workshops donde se construyen prototipos a escala real, se realizan visitas al exterior, se participa en concursos, se realizan conferencias y se participa en un festival de arquitectura ef&iacute;mera.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Este T&iacute;tulo de Experto se puede realizar independientemente o como parte del M&aacute;ster en Ef&iacute;meras, siendo el itinerario a recorrer por el alumno indistinto.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Contenidos Acad&eacute;micos </strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>M&Oacute;DULO 1</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>El valor de &ldquo;lo peque&ntilde;o&rdquo; en lo dom&eacute;stico</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Workshop 1:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>T&uacute; casa en una maleta</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>M&Oacute;DULO 4</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Espacio p&uacute;blico. Reciclaje y ciudadan&iacute;a</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Workshop 4:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Construcci&oacute;n de prototipo urbano en un espacio ciudadano</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>M&Oacute;DULO 2</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Estructuras m&oacute;viles, flexibles y transportables</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Workshop 2:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dise&ntilde;o de una POP-UP Store para una marca asociada</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><strong>M&Oacute;DULO 5</strong></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><strong>El huerto urbano</strong></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Workshop 5:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Construcci&oacute;n de elementos de apoyo a un Huerto Urbano</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>M&Oacute;DULO 3</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Vivienda ef&iacute;mera &ldquo;low-cost&rdquo;</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Workshop 3:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>H&aacute;zlo t&uacute; mismo</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><strong>Pr&aacute;cticas </strong> </strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Adem&aacute;s el T&iacute;tulo ofrece 100 horas de pr&aacute;cticas con colectivos como <strong>PKMN, Zuloark, Basurama o Todo por la Praxis</strong> facilitando a los alumnos la incorporaci&oacute;n a la experiencia del mundo pr&aacute;ctico y social.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Desarrollo del Curso </strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Inicio del Curso:</strong> 2-3 octubre de 2014</p>\r\n\r\n<p><strong>Desarrollo del Curso:</strong> Del 6 de octubre al 20 de diciembre</p>\r\n\r\n<p><strong>Presentaci&oacute;n Oral:</strong> 8,9,10 de enero 2015</p>\r\n\r\n<p><strong>Pr&aacute;cticas en colectivos y estudios:</strong> Del 12 de enero al 12 de febrero de 2015</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Precios y Plazo de Matr&iacute;cula </strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Pre-inscripci&oacute;n: A partir del 25 de junio de 2014 (www.upm.es/atenea)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Inscripci&oacute;n y reserva de plaza:</strong> Hasta el 1 de octubre del 2014. 350 Euros</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Matr&iacute;cula:</strong> A partir del 15 de septiembre hasta el 1 de octubre para hacer efectiva la matr&iacute;cula, se tendr&aacute; que abonar un &uacute;nico pago de 2.500 euros restantes, o bien si se prefiere en 2 plazos a lo largo del curso.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Pago fraccionado: </strong></p>\r\n\r\n<p>1&ordm; Pago: 1.500 euros antes del 1 de octubre del 2014</p>\r\n\r\n<p>2&ordm; Pago: 1.000 euros antes del 1 de diciembre del 2014</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>* Se otorgar&aacute;n becas parciales internas sobre el importe de la matr&iacute;cula. Las becas no se otorgar&aacute;n sobre el importe de la Inscripci&oacute;n.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>INCRIBETE YA!!!</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Porque formamos profesionales en el campo de las Instalaciones Ef&iacute;meras, un &aacute;mbito de trabajo emergente que tiene una formaci&oacute;n espec&iacute;fica oficial y acad&eacute;mica universitaria.</p>\r\n\r\n<p>Si quieres m&aacute;s informaci&oacute;n sobre el M&aacute;ster en Ef&iacute;meras o los diferentes T&iacute;tulos que lo componen, escr&iacute;benos a efimeras.arquitectura@upm.es.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Nota</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Los antiguos alumnos que ya han cursado Instalaciones Ef&iacute;meras de 30ects, tienen la posibilidad de obtener el m&aacute;ster con la realizaci&oacute;n de los dos nuevos cursos de Experto y el Proyecto Fin de M&aacute;ster.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>FacebookTumblrTwitterPinterest</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Informacion de contacto:</strong><strong>www.instalacionesefimeras.com</strong><br />\r\nefimeras.arquitectura@upm.es<br />\r\nEscuela T&eacute;cnica Superior de Arquitectura de Madrid</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Avenida Juan de Herrera, 4</p>\r\n\r\n<p>28040 MADRID<br />\r\nPabell&oacute;n Nuevo, Tercera Planta</p>\r\n\r\n<p>Tel&eacute;fono: 913364402/ 913365272.</p>', '::1', 1, 'arquitectura, interactiva, efimera, tecnología', 1, '2014-07-31 13:23:58', '2014-09-03 06:39:00', NULL, 1, 2),
(4, 4, 7, 1, 0, 'Especialista en Instalaciones Efímeras', 'Especialista en Instalaciones Efímeras', 'Especialista en Instalaciones Efímeras', 'Especialista en Instalaciones Efímeras', 'Especialista en Instalaciones Efímeras', NULL, 'especialista-en-instalaciones-efimeras', '<p>T&iacute;tulo de Especialista en Instalaciones Ef&iacute;meras<br />\r\n7&ordf; Edicci&oacute;n</p>\r\n\r\n<p>Instalaciones Ef&iacute;meras ahora pertenece al M&aacute;ster Ef&iacute;meras<br />\r\nABIERTO PLAZO DE PRE-INSCRIPCI&Oacute;N</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><em>&ldquo;De car&aacute;cter innovador, experimental y perecedero,<br />\r\nla instalaci&oacute;n ef&iacute;mera es una de las expresiones que m&aacute;s se adecuan a la<br />\r\nrealidad arquitect&oacute;nica, art&iacute;stica, cultural y social actual&rdquo; </em></p>\r\n\r\n<p>Carmen Blasco (Directora del M&aacute;ster)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Esta disciplina responde a un mercado, cada vez m&aacute;s activo, variado y complejo, que requiere de profesionales con una formaci&oacute;n multidisciplinar con un alto grado de especializaci&oacute;n para la incorporaci&oacute;n a los nuevos empleos emergentes que se est&aacute;n produciendo en este &aacute;mbito profesional.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>El T&iacute;tulo de Especializaci&oacute;n en Instalaciones Ef&iacute;meras se puede realizar independientemente o como parte del M&aacute;ster en Ef&iacute;meras (70 ects),cuyo itinerario a recorrer por el alumno puede ser indistinto.(Experto en Arquitectura Interactiva+ Experto en Arquitectura Ef&iacute;mera y Urbanismo Participativo+ Proyecto Fin de M&aacute;ster).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>El equipo de profesorado est&aacute; compuesto por especialistas multidisciplinares que imparten diferentes m&oacute;dulos de conocimiento: Arte y montajes expositivos, Dise&ntilde;o e Imagen, Arquitecturas Alternativas, Paisajismo, Escenograf&iacute;a y Comunicaci&oacute;n. Dentro de estos existen clases te&oacute;ricas y Workshops donde se construyen prototipos a escala real, se realizan visitas al exterior, se participa en concursos, se realizan conferencias y se participa en un festival de arquitectura ef&iacute;mera.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Con respecto a los contenidos de los Workshops cada a&ntilde;o se van actualizando en funci&oacute;n de las necesidades de la sociedad actual y las oportunidades. Este pr&oacute;ximo curso 2015 ser&aacute;n:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Contenidos</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>M&Oacute;DULO 1</strong></p>\r\n\r\n<p><strong>Arte y Exposiciones</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Workshop 1: </strong></p>\r\n\r\n<p>El stand en el Pabell&oacute;n</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Workshop </strong><strong>2:</strong></p>\r\n\r\n<p>Exposiciones. Museograf&iacute;a y Dise&ntilde;o de montajes</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>M&Oacute;DULO 4</strong></p>\r\n\r\n<p><strong>Arquitecturas Alternativas</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Workshop</strong><strong>:</strong><br />\r\nArquitectura Textil e Hinchable</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>M&Oacute;DULO 7</strong></p>\r\n\r\n<p><strong>Escenograf&iacute;a</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Workshop</strong><strong>:</strong><br />\r\nEl Teatro Ambulante</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>M&Oacute;DULO 2</strong></p>\r\n\r\n<p><strong>Imagen y Dise&ntilde;o</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Workshop</strong><strong> 1: </strong></p>\r\n\r\n<p>Fotograf&iacute;a y Dise&ntilde;o Gr&aacute;fico</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Workshop</strong><strong> 2: </strong><br />\r\nAcupuntura Colectiva en el Espacio P&uacute;blico (Acci&oacute;n Urbana)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>M&Oacute;DULO 5</strong></p>\r\n\r\n<p><strong>T&eacute;cnicas Audiovisuales</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Workshop</strong><strong> 1:</strong><br />\r\nProyecto audiovisual</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Workshop</strong><strong> 2:</strong><br />\r\nProyecciones de Audiovisuales &amp; Retroproyecciones</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Proyecto Final de Curso</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>M&Oacute;DULO 3</strong></p>\r\n\r\n<p><strong>Comunicaci&oacute;n</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Workshop</strong><strong> 1:</strong></p>\r\n\r\n<p>Comunicaci&oacute;n Verbal, Gestual y Gr&aacute;fica</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Workshop 2:</strong><br />\r\nNuevos Medios de Comunicaci&oacute;n. Web, Blog y Redes Sociales</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Workshop 3:</strong><br />\r\nCreatividad en proyectos empresariales</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>M&Oacute;DULO 6</strong></p>\r\n\r\n<p><strong>Paisajismo</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Workshop</strong><strong>: </strong><br />\r\nEl Jard&iacute;n Ef&iacute;mero</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Pr&aacute;cticas</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Uno de los objetivos del T&iacute;tulo de Especializaci&oacute;n en Instalaciones Ef&iacute;meras es la incorporaci&oacute;n del alumno al mundo laboral en el amplio campo de las instalaciones ef&iacute;meras.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Por este motivo se realizar&aacute;n 200 horas de pr&aacute;cticas al finalizar la parte docente del Curso en las mejores empresas, estudios del sector tanto a nivel nacional como la posibilidad de realizarlas en estudios de artistas consagrados en Nueva York.<br />\r\n(+ Informaci&oacute;n en colaboradores)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Plazos de Desarrollo del Curso</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Inicio del Curso:</strong> 18-19 enero 2015</p>\r\n\r\n<p><strong>Desarrollo del Curso: </strong>Del 23 enero al 30 de junio</p>\r\n\r\n<p><strong>Presentaci&oacute;n Final Oral:</strong> 12 de julio</p>\r\n\r\n<p><strong>Pr&aacute;cticas en empresas y estudios: </strong>Entre 15 de julio al 30 de octubre 2015</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Horarios y Lugar</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Todas las clases son presenciales y se realizar&aacute;n en la Escuela T&eacute;cnica Superior de Arquitectura de Madrid en horario de tarde de lunes a viernes desde las 15:30h hasta las 20:45.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Plazos de Matriculaci&oacute;n y Pagos</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Pre-inscripci&oacute;n:</strong> A partir del 25 de junio de 2014 (www.upm.es/atenea)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Inscripci&oacute;n:</strong> Desde 25 de junio hasta 10 de enero</p>\r\n\r\n<p>Reserva de Plaza: 575 euros</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Matr&iacute;cula: </strong> A partir del 20 de diciembre hasta el 16 de enero, para hacer efectiva la matr&iacute;cula, se tendr&aacute; que abonar en un &uacute;nico pago los 5.000 euros restantes, o bien si se prefiere en 3 plazos a lo largo del curso.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Pago fraccionado:</p>\r\n\r\n<p>1&ordm; Pago: 2.500 euros a partir del 20 de diciembre hasta el 16 de enero.</p>\r\n\r\n<p>2&ordm; Pago: 1.250 euros antes del 4 de marzo.</p>\r\n\r\n<p>3&ordm; Pago: 1.250 euros antes del 4 de mayo.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>* Se otorgar&aacute;n becas parciales internas sobre el importe de la matr&iacute;cula. Las becas no se otorgar&aacute;n sobre el importe de la Inscripci&oacute;n.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Obtenci&oacute;n del T&iacute;tulo de M&aacute;ster en Ef&iacute;meras habiendo cursado las ediciones anteriores de T&iacute;tulo de Especialista en Instalaciones Ef&iacute;meras (30ects)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Los antiguos alumnos que ya han cursado Instalaciones Ef&iacute;meras de 30ects, tienen la posibilidad de obtener el m&aacute;ster con la realizaci&oacute;n de los dos nuevos cursos de Experto y el Proyecto Fin de M&aacute;ster.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>INCRIBETE YA!!!</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Porque formamos profesionales en el campo de las Instalaciones Ef&iacute;meras, un &aacute;mbito de trabajo emergente que tiene una formaci&oacute;n espec&iacute;fica oficial y acad&eacute;mica universitaria.</p>\r\n\r\n<p>Si quieres m&aacute;s informaci&oacute;n sobre el M&aacute;ster en Ef&iacute;meras o los diferentes T&iacute;tulos que lo componen, escr&iacute;benos a efimeras.arquitectura@upm.es.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>FacebookTumblrTwitterPinterest</p>', '150.214.223.250', 1, NULL, 0, '2014-07-31 13:32:23', '2014-07-31 13:38:54', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` int(11) DEFAULT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rdate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `checked` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `tickets` int(11) NOT NULL,
  `published` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_42C84955140AB620` (`page`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `reservation`
--

INSERT INTO `reservation` (`id`, `page`, `name`, `phone`, `email`, `rdate`, `date`, `checked`, `lang`, `tickets`, `published`) VALUES
(1, 2, 'probando', '3344', 'probando@gmail.com', '10 junio', '2014-08-23 23:09:31', 0, 1, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rank` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `home` tinyint(1) NOT NULL,
  `suspended` tinyint(1) NOT NULL,
  `type` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `search`
--

CREATE TABLE IF NOT EXISTS `search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `search`
--

INSERT INTO `search` (`id`, `name`, `created`, `updated`) VALUES
(1, 'master', '2014-06-30 22:47:52', '0000-00-00 00:00:00'),
(2, 'innovador', '2014-06-30 22:48:21', '0000-00-00 00:00:00'),
(3, 'efimera', '2014-06-30 22:48:31', '0000-00-00 00:00:00'),
(4, 'efimera', '2014-06-30 22:48:38', '0000-00-00 00:00:00'),
(5, 'innovador', '2014-07-03 01:55:24', '0000-00-00 00:00:00'),
(6, 'probando', '2014-08-24 05:44:13', '2014-08-24 05:44:13'),
(7, 'otro', '2014-08-24 05:52:18', '2014-08-24 05:52:18'),
(8, 'otromas', '2014-08-24 05:52:47', '2014-08-24 05:52:47'),
(9, 'otromas', '2014-08-24 05:53:17', '2014-08-24 05:53:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `published` tinyint(1) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9F74B8988D93D649` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `setting`
--

INSERT INTO `setting` (`id`, `published`, `name`, `value`, `user`, `created`, `updated`) VALUES
(1, 1, 'email', 'jonathan.araul@gmail.com', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'facebook', 'https://www.facebook.com/realego.realego?fref=ts', 1, '2014-08-24 21:55:59', '2014-08-24 22:09:45'),
(3, 1, 'twitter', 'https://twitter.com/', 1, '2014-08-24 22:27:00', '2014-08-24 22:27:00'),
(4, 1, 'tuenti', 'https://www.tuenti.com/', 1, '2014-08-25 03:43:46', '2014-08-25 03:43:46'),
(5, 1, 'pinterest', 'https://es.pinterest.com/', 1, '2014-08-25 03:44:12', '2014-08-25 03:44:12'),
(6, 1, 'lugar', 'https://maps.google.es/maps/ms?ie=UTF8&t=h&oe=UTF8&msa=0&msid=213942746742807131548.00045a3cf2f7558f27c89&dg=feature', 1, '2014-08-25 05:22:18', '2014-08-25 05:22:18'),
(7, 1, 'Telefono', '913366497 / 913365272', 1, '2014-08-25 05:30:12', '2014-08-25 05:30:12'),
(8, 1, 'email institucional', 'efimeras.arquitecturas@upm.es', 1, '2014-08-25 05:31:04', '2014-08-25 05:31:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `published` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `theme`
--

INSERT INTO `theme` (`id`, `name`, `color`, `descripcion`, `published`) VALUES
(1, 'Purpura', '#dcaccb', 'Purpura', 1),
(2, 'Verde', '#00ff3b', 'Verde fosforecente', 1),
(3, 'probando', '#f89406', 'Prueba', 1),
(4, 'Naranja', '#ff7a00', 'naranja', 1),
(5, 'Azul oscuro', '#3300ff', 'Azul oscuro', 1),
(6, 'Amarillo', '#fff500', 'Amarillado', 1),
(7, 'INSTALACIONES EFÍMERAS', '#d7579f', 'Tema para el curso de especialización en Instalaciones Efímeras.', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `background`
--
ALTER TABLE `background`
  ADD CONSTRAINT `FK_BC68B4508D93D649` FOREIGN KEY (`user`) REFERENCES `fos_user` (`id`);

--
-- Filtros para la tabla `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `FK_64C19C17D053A93` FOREIGN KEY (`menu`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `FK_64C19C18D93D649` FOREIGN KEY (`user`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_64C19C19775E708` FOREIGN KEY (`theme`) REFERENCES `theme` (`id`),
  ADD CONSTRAINT `FK_64C19C1BC68B450` FOREIGN KEY (`background`) REFERENCES `background` (`id`);

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `FK_7D053A938D93D649` FOREIGN KEY (`user`) REFERENCES `fos_user` (`id`);

--
-- Filtros para la tabla `menu_item`
--
ALTER TABLE `menu_item`
  ADD CONSTRAINT `FK_D754D550140AB620` FOREIGN KEY (`page`) REFERENCES `page` (`id`),
  ADD CONSTRAINT `FK_D754D55064C19C1` FOREIGN KEY (`category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_D754D5507D053A93` FOREIGN KEY (`menu`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `FK_D754D5508D93D649` FOREIGN KEY (`user`) REFERENCES `fos_user` (`id`);

--
-- Filtros para la tabla `newsletters_emails`
--
ALTER TABLE `newsletters_emails`
  ADD CONSTRAINT `FK_14D1DBA79173D44` FOREIGN KEY (`id_email`) REFERENCES `email` (`id`),
  ADD CONSTRAINT `FK_14D1DBA7DB0F051F` FOREIGN KEY (`id_newsletter`) REFERENCES `newsletter` (`id`);

--
-- Filtros para la tabla `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `FK_140AB62064C19C1` FOREIGN KEY (`category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_140AB6207D053A93` FOREIGN KEY (`menu`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `FK_140AB6208D93D649` FOREIGN KEY (`user`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_140AB6209775E708` FOREIGN KEY (`theme`) REFERENCES `theme` (`id`),
  ADD CONSTRAINT `FK_140AB620BC68B450` FOREIGN KEY (`background`) REFERENCES `background` (`id`);

--
-- Filtros para la tabla `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C84955140AB620` FOREIGN KEY (`page`) REFERENCES `page` (`id`);

--
-- Filtros para la tabla `setting`
--
ALTER TABLE `setting`
  ADD CONSTRAINT `FK_9F74B8988D93D649` FOREIGN KEY (`user`) REFERENCES `fos_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
