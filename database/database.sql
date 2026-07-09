

USE `railway`;

-- Tabla: categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `created_at`) VALUES
	(1, 'Hamburguesas', 'Especialidades artesanales con carne premium', '2026-06-28 17:31:55'),
	(2, 'Bebidas', 'Gaseosas y jugos naturales', '2026-06-28 17:31:55'),
	(3, 'salsas', 'naturales y citricas', '2026-06-28 18:31:23');

-- Tabla: productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `disponible` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `fk_productos_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `disponible`, `created_at`) VALUES
	(1, 1, 'Tech Burger', 'Doble carne, queso cheddar, tocino y salsa de la cocina', 7.80, 1, '2026-06-28 17:31:55'),
	(2, 1, 'Cyber Cheese', 'Carne simple con extra queso fundido', 5.50, 1, '2026-06-28 17:31:55'),
	(4, 1, 'Angel Lopez', 'rfefe', 5.00, 1, '2026-07-05 20:25:16');

-- Tabla: usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(50) DEFAULT 'empleado',
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `password`, `rol`) VALUES
	(1, 'Administrador ALP', 'admin@burgertech.com', 'admin123', 'admin'),
	(2, 'Angel Lopez', 'Loorangel01@hotmail.com', '1234', 'empleado');

-- Tabla: pedidos (despues de productos y usuarios por las FK)
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `producto_id` (`producto_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `fk_pedidos_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  CONSTRAINT `fk_pedidos_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pedidos` (`id`, `producto_id`, `usuario_id`, `cantidad`, `total`, `fecha`) VALUES
	(1, 1, 1, 2, 15.60, '2026-07-05 16:40:10');

