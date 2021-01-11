CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `nacimiento` date NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sexo` varchar(100) NOT NULL,
  `fecha_reg` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


CREATE TABLE `eventos` (
  `nombre` varchar(100) NOT NULL ,
  `fecha` date NOT NULL ,
  `id` int(100) NOT NULL ,
  `usuario_org` int(11) NOT NULL,
  `aforo` int(10),
  `descripcion` varchar(100),
  `categoria` varchar(100),
  `ubicacion` varchar(100),
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_usuario` FOREIGN KEY (`usuario_org`) REFERENCES `usuarios`(`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET=latin1;
