 -- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla optivision.cajas
CREATE TABLE IF NOT EXISTS `cajas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sucursal` varchar(50) DEFAULT NULL,
  `caja` varchar(50) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `inicia` int(11) DEFAULT NULL,
  `timbrado` varchar(50) DEFAULT NULL,
  `vence` timestamp NULL DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `ticket` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `índice_1` (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla optivision.cajas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cajas` DISABLE KEYS */;
/*!40000 ALTER TABLE `cajas` ENABLE KEYS */;

-- Volcando estructura para tabla optivision.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(250) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla optivision.categorias: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `categoria`, `fecha`) VALUES
	(2, 'ESTUCHES', '2020-07-21 21:26:35');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla optivision.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text,
  `documento` text,
  `email` text,
  `telefono` text,
  `direccion` text,
  `fecha_nacimiento` date DEFAULT NULL,
  `compras` int(11) DEFAULT '0',
  `ultima_compra` date DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `índice_1` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla optivision.clientes: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id`, `nombre`, `documento`, `email`, `telefono`, `direccion`, `fecha_nacimiento`, `compras`, `ultima_compra`, `fecha`) VALUES
	(2, 'ANTONIO GALEANO', '3518733-6', 'galeanoantonio6@gmail.com', '(0983)386-288', 'LUQUE', '2020-01-01', 0, NULL, '2020-07-21 21:34:31');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Volcando estructura para tabla optivision.compras
CREATE TABLE IF NOT EXISTS `compras` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `id_proveedor` int(11) NOT NULL DEFAULT '0',
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  `fecha` date DEFAULT NULL,
  `factura` text,
  `tipo` text,
  `vencimiento` date DEFAULT NULL,
  `productos` text,
  `impuesto` double DEFAULT NULL,
  `neto` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `estado` text,
  `metodopago` text,
  PRIMARY KEY (`id_compra`),
  KEY `índice_1` (`id_compra`) USING BTREE,
  KEY `fk__proveedores` (`id_proveedor`) USING BTREE,
  KEY `fk_compras_usuarios` (`id_usuario`) USING BTREE,
  CONSTRAINT `fk__proveedores` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_compras_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla optivision.compras: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;

-- Volcando estructura para tabla optivision.configuracion
CREATE TABLE IF NOT EXISTS `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text,
  `clave` text,
  `valor` text,
  `registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `índice_1` (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla optivision.configuracion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;

-- Volcando estructura para tabla optivision.empresas
CREATE TABLE IF NOT EXISTS `empresas` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `denominacion` varchar(150) DEFAULT NULL,
  `ruc` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`),
  KEY `índice_1` (`id_empresa`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla optivision.empresas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` (`id_empresa`, `denominacion`, `ruc`, `telefono`, `direccion`, `correo`, `logo`) VALUES
	(14, 'OPTIVISION', '0', '0991 828.348', 'Adolfo Zaracho 142 c/ Susana Gamarra. Caazapá', 'correo@correo.com', 'vistas/img/plantilla/OPTIVISION/972.jpg');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;

-- Volcando estructura para tabla optivision.historial
CREATE TABLE IF NOT EXISTS `historial` (
  `id_historial` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `motivo` text,
  `esf_od` text,
  `esf_oi` text,
  `cilindro_od` text,
  `cilindro_oi` text,
  `eje_od` text,
  `eje_oi` text,
  `adicion_od` text,
  `adicion_oi` text,
  `dnp_od` text,
  `dnp_oi` text,
  `di` text,
  `alt` text,
  `monofocal` text,
  `monofocal_descri` text,
  `estuche` text,
  `bifocal` text,
  `bifocal_descri` text,
  `progesivo` text,
  `progresivo_descri` text,
  `armazon` text,
  `id_doctor` int(11) DEFAULT NULL,
  `doctor` text,
  `retiro` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `anticipo` double DEFAULT NULL,
  `receta` text,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_historial`),
  KEY `clientes_historial_fk` (`id`) USING BTREE,
  KEY `id_usuario_fk` (`id_usuario`) USING BTREE,
  CONSTRAINT `clientes_historial_fk` FOREIGN KEY (`id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla optivision.historial: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
INSERT INTO `historial` (`id_historial`, `id`, `fecha`, `motivo`, `esf_od`, `esf_oi`, `cilindro_od`, `cilindro_oi`, `eje_od`, `eje_oi`, `adicion_od`, `adicion_oi`, `dnp_od`, `dnp_oi`, `di`, `alt`, `monofocal`, `monofocal_descri`, `estuche`, `bifocal`, `bifocal_descri`, `progesivo`, `progresivo_descri`, `armazon`, `id_doctor`, `doctor`, `retiro`, `total`, `anticipo`, `receta`, `id_usuario`) VALUES
	(1, 2, '2020-07-21', 'CAMBIO DE LENTE', '+1', '+25', '2', '40', '20', '10', '+1', '+2', '', '', '', '', 'true', 'MONOFOCAL ANTIREFLEX', 'SI', '', '', '', '', 'GUCCI', NULL, 'HOUSE', '2020-07-31 15:00:00', 500000, 200000, '', 3);
/*!40000 ALTER TABLE `historial` ENABLE KEYS */;

-- Volcando estructura para tabla optivision.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `codigo` text NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` text NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` double NOT NULL,
  `precio_venta` double NOT NULL,
  `ventas` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `barcode` text,
  PRIMARY KEY (`id`),
  KEY `categorias_productos_fk` (`id_categoria`),
  CONSTRAINT `categorias_productos_fk` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla optivision.productos: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`id`, `id_categoria`, `codigo`, `descripcion`, `imagen`, `stock`, `precio_compra`, `precio_venta`, `ventas`, `fecha`, `barcode`) VALUES
	(2, 2, '202', 'ESTUCHE GUCCI', 'vistas/img/productos/default/anonymous.png', 10, 350000, 500000, 0, '2020-07-21 21:30:04', '0');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla optivision.proveedores
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `ruc` text,
  `razon_social` text,
  `telefono` text,
  `direccion` text,
  `correo` text,
  `estado` text,
  `totalcompra` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id_proveedor`),
  KEY `índice_1` (`id_proveedor`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla optivision.proveedores: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;

-- Volcando estructura para tabla optivision.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `usuario` text NOT NULL,
  `password` text NOT NULL,
  `perfil` text NOT NULL,
  `foto` text,
  `estado` int(11) DEFAULT NULL,
  `ultimo_login` timestamp NULL DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla optivision.usuarios: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
	(1, 'ANTONIO', 'admin', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrador', 'vistas/img/usuarios/admin/622.png', 1, '2020-07-21 21:22:39', '2020-06-25 21:07:25'),
	(2, 'VENDEDOR', 'VENDEDOR', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Vendedor', 'vistas/img/usuarios/VENDEDOR/511.png', 1, '2020-07-21 21:18:19', NULL),
	(3, 'DAMARIS RIVAS', 'DAMARIS', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrador', 'vistas/img/usuarios/DAMARIS/395.jpg', 1, '2020-07-21 21:38:27', NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para tabla optivision.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL DEFAULT '',
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` text NOT NULL,
  `impuesto` double NOT NULL,
  `neto` double NOT NULL,
  `total` double NOT NULL,
  `metodo_pago` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `índice_1` (`id`) USING BTREE,
  KEY `usuarios_ventas_fk` (`id_vendedor`),
  KEY `clientes_ventas_fk` (`id_cliente`),
  CONSTRAINT `clientes_ventas_fk` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuarios_ventas_fk` FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla optivision.ventas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
