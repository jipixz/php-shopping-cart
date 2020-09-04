CREATE TABLE IF NOT EXISTS `products` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(50) NOT NULL,
	`desc` text NOT NULL,
	`price` decimal(7,2) NOT NULL,
	`rrp` decimal(7,2) NOT NULL DEFAULT '0.00',
	`quantity` int(11) NOT NULL,
	`img` text NOT NULL,
	`date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `products` (`id`, `name`, `desc`, `price`, `rrp`, `quantity`, `img`, `date_added`) VALUES
(1, 'Melon', '<p>El mejor melón del país.</p>\r\n<h3>Características</h3>\r\n<ul>\r\n<li>Las más frescas que encontrarás.</li>\r\n<li>Orgánica.</li>\r\n<li>Cultivado por las mejores personas.</li>\r\n<li>Apoya local.</li>\r\n</ul>', '12.99', '0.00', 19, 'melon.jpg', '2020-09-02 17:55:22'),
(2, 'Plátano', '', '7.99', '19.99', 45, 'platano.jpg', '2020-09-02 17:55:22'),
(3, 'Pera', '', '9.00', '0.00', 23, 'pera.jpg', '2020-09-02 17:55:22'),
(4, 'Manzana', '', '19.99', '0.00', 14, 'manzana.jpg', '2020-09-02 17:55:22'),
(5, 'Leche', '', '23.00', '0.00', 23, 'leche.jpg', '2020-09-02 17:55:22'),
(6, 'Cereal', '', '39.99', '35.00', 65, 'cereal.jpg', '2020-09-02 17:55:22'),
(7, 'Laptop', '', '4999.99', '4499.99', 4, 'laptop.jpg', '2020-09-02 17:55:22'),
(8, 'Café', '', '43.99', '0.00', 54, 'cafe.jpg', '2020-09-02 17:55:22'),
(9, 'USB', '', '340.00', '0.00', 21, 'usb.jpg', '2020-09-02 17:55:22'),
(10, 'Disco Duro', '', '709.99', '0.00', 7, 'hdd.jpg', '2020-09-02 17:55:22'),
(11, 'Caguama', '', '36.99', '2.00', 192, 'cheve.jpg', '2020-09-02 17:55:22'),
(12, 'Termo', '', '429.99', '0.00', 65, 'termo.jpg', '2020-09-02 17:55:22'),
(13, 'Lámpara', '', '49.99', '0.00', 23, 'lampara.jpg', '2020-09-02 17:55:22'),
(14, 'Galletas', '', '16.00', '0.00', 75, 'galletas.jpg', '2020-09-02 17:55:22'),
(15, 'Celular', '', '5793.0', '5499.99', 64, 'celular.jpg', '2020-09-02 17:55:22'),
(16, 'Cartera', '', '239.99', '199.99', 78, 'cartera.jpg', '2020-09-02 17:55:22'),
(17, 'Libreta', '', '19.99', '0.00', 24, 'libreta.jpg', '2020-09-02 17:55:22'),
(18, 'TV', '', '12313.99', '9999.99', 2, 'tv.jpg', '2020-09-02 17:55:22');