-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2017 at 10:08 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wpp`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `id_Area` int(11) NOT NULL,
  `descripcion` varchar(250) CHARACTER SET utf8 NOT NULL,
  `id_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `id_Empresa` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `region` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empresas`
--

INSERT INTO `empresas` (`id_Empresa`, `nombre`, `region`, `ciudad`, `direccion`, `telefono`, `activo`) VALUES
(1, 'Ejemplo', 'Metropolitana', 'Santiago', 'asdf 1234', 12345678, 1),
(2, 'Nombre Empresa', 'Metropolitana', 'Santiago', 'calle falsa 123', 12345678, 1);

-- --------------------------------------------------------

--
-- Table structure for table `perfiles`
--

CREATE TABLE IF NOT EXISTS `perfiles` (
  `id_Perfil` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellidoPat` varchar(250) NOT NULL,
  `apellidoMat` varchar(250) NOT NULL,
  `rut` varchar(100) NOT NULL,
  `fechaIngreso` date NOT NULL,
  `fechaCreacion` date NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `edad` varchar(250) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `activo` int(11) NOT NULL,
  `id_Area` int(11) NOT NULL,
  `id_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_User` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellidoPat` varchar(250) NOT NULL,
  `apellidoMat` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `nivel` int(11) NOT NULL,
  `id_Empresa` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_User`, `password`, `nombre`, `apellidoPat`, `apellidoMat`, `email`, `nivel`, `id_Empresa`) VALUES
(1, '47d30d46cd84d49254849edf819ec3e6e179ba4e', 'nombreSuperAdmin', 'apSuperAdmin', '', 'superadmin@mail.com', 1, 1),
(3, '47d30d46cd84d49254849edf819ec3e6e179ba4e', 'nombreAdmin', 'apAdmin', '', 'admin@mail.com', 2, 2),
(5, '5c8669b488d5dba91645950c1fdefa64beb653c4', 'nombreUsuario', 'apUsuario', '', 'usuario@mail.com', 1, 2),
(6, '5c8669b488d5dba91645950c1fdefa64beb653c4', 'Pedrito', 'Gonzales', '', 'aaaa@gmail.com', 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_Area`);

--
-- Indexes for table `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_Empresa`);

--
-- Indexes for table `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id_Perfil`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_User`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id_Area` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_Empresa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id_Perfil` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_User` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
