-- phpMyAdmin SQL Dump
-- version 3.4.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-03-2012 a las 20:06:54
-- Versión del servidor: 5.1.51
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `OSTB-CMS`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Articles`
--

CREATE TABLE IF NOT EXISTS `Articles` (
  `Article_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Article_PublicationDate` date NOT NULL,
  `Article_Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Article_Summary` text COLLATE utf8_unicode_ci NOT NULL,
  `Article_Content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Article_Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Articles Tables' AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `Articles`
--

INSERT INTO `Articles` (`Article_Id`, `Article_PublicationDate`, `Article_Title`, `Article_Summary`, `Article_Content`) VALUES
(5, '2012-03-06', 'OutSide The Box', 'Welcome to OutSide The Box', '<h2> Welcome to OutSide The Box </h2>\r\n\r\n<p> Have Fun Checking my projects </p>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
