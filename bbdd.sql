CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `nacimiento` date,
  `avatar` varchar(200),
  `email` varchar(100) NOT NULL,
  `sexo` varchar(100),
  `fecha_reg` datetime NOT NULL,
  `descripcion` varchar(400)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `usuarios`
CHANGE `avatar` `avatar` VARCHAR(200)
CHARACTER SET latin1 COLLATE latin1_swedish_ci
NULL DEFAULT 'fotos_perfil/defaul.jpg';


CREATE TABLE `eventos` (
  `nombre` varchar(100) NOT NULL ,
  `fecha` date NOT NULL ,
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `usuario_org` int(11) NOT NULL,
  `aforo` int(10),
  `descripcion` varchar(100),
  `categoria` varchar(100),
  `ubicacion` varchar(100),
  `precio` int(10),
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_usuario` FOREIGN KEY (`usuario_org`) REFERENCES `usuarios`(`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET=latin1;


  CREATE TABLE `amistades` (
    `solicitante` int(11) NOT NULL,
    `solicitado` int(11) NOT NULL,
    `aceptado` bit default 0,
    PRIMARY KEY (`solicitado`,`solicitante`),
    CONSTRAINT `FK_solicitante` FOREIGN KEY (`solicitante`) REFERENCES `usuarios`(`id`),
    CONSTRAINT `FK_solicitado` FOREIGN KEY (`solicitado`) REFERENCES `usuarios`(`id`)
    ) ENGINE = InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `asistencia`(
  `evento` int(100) NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`evento` , `usuario`),
  CONSTRAINT `FK_evento_asistencia` FOREIGN KEY (`evento`) REFERENCES `eventos` (`id`),
  CONSTRAINT `FK_usuario_asistencia`FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`)

)ENGINE = InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `asistencia` ADD `estado` BIT(1) NOT NULL AFTER `usuario`; 
