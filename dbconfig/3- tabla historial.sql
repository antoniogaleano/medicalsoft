
CREATE TABLE usuarios (
                id INT AUTO_INCREMENT NOT NULL,
                nombre TEXT NOT NULL,
                usuario TEXT NOT NULL,
                password TEXT NOT NULL,
                perfil TEXT NOT NULL,
                foto TEXT,
                estado INT,
                ultimo_login DATETIME,
                fecha DATETIME,
                PRIMARY KEY (id)
);


CREATE TABLE clientes (
                id INT AUTO_INCREMENT NOT NULL,
                nombre TEXT,
                documento TEXT,
                email TEXT,
                telefono TEXT,
                direccion TEXT,
                fecha_nacimiento DATE,
                compras INT DEFAULT 0,
                ultima_compra DATETIME,
                fecha DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
                PRIMARY KEY (id)
);


CREATE TABLE historial (
                id_historial INT AUTO_INCREMENT NOT NULL,
                id INT NOT NULL,
                fecha DATE,
                motivo TEXT,
                esf_od TEXT,
                esf_oi TEXT,
                cilindro_od TEXT,
                cilindro_oi TEXT,
                eje_od TEXT,
                eje_oi TEXT,
                adicion_od TEXT,
                adicion_oi TEXT,
                dnp_od TEXT,
                dnp_oi TEXT,
                di TEXT,
                alt TEXT,
                monofocal TEXT,
                monofocal_descri TEXT,
                estuche TEXT,
                bifocal TEXT,
                bifocal_descri TEXT,
                progesivo TEXT,
                progresivo_descri TEXT,
                armazon TEXT,
                id_doctor INT,
                doctor TEXT,
                retiro DATETIME,
                total DOUBLE PRECISIONS,
                anticipo DOUBLE PRECISIONS,
                receta TEXT,
                id_usuario INT NOT NULL,
                PRIMARY KEY (id_historial)
);


CREATE INDEX clientes_historial_fk USING BTREE
 ON historial
 ( id ASC );

CREATE INDEX id_usuario_fk USING BTREE
 ON historial
 ( id_usuario ASC );

ALTER TABLE historial ADD CONSTRAINT id_usuario_fk
FOREIGN KEY (id_usuario)
REFERENCES usuarios (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE historial ADD CONSTRAINT clientes_historial_fk
FOREIGN KEY (id)
REFERENCES clientes (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
