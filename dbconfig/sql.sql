#source /home/sql.sql;
CREATE TABLE usuarios (
                id INT AUTO_INCREMENT NOT NULL,
                nombre TEXT NOT NULL,
                usuario TEXT NOT NULL,
                password TEXT NOT NULL,
                perfil TEXT NOT NULL,
                foto TEXT,
                estado INT,
                ultimo_login timestamp,
                fecha timestamp,
                PRIMARY KEY (id)
);


CREATE TABLE proveedores (
                id_proveedor INT AUTO_INCREMENT NOT NULL,
                ruc TEXT,
                razon_social TEXT,
                telefono TEXT,
                direccion TEXT,
                correo TEXT,
                estado TEXT,
                totalcompra DECIMAL(10),
                PRIMARY KEY (id_proveedor)
);


CREATE INDEX índice_1 USING BTREE
 ON proveedores
 ( id_proveedor ASC );

CREATE TABLE configuracion (
                id INT AUTO_INCREMENT NOT NULL,
                descripcion TEXT,
                clave TEXT,
                valor TEXT,
                registro timestamp DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
);


CREATE INDEX índice_1 USING BTREE
 ON configuracion
 ( id ASC );

CREATE TABLE empresas (
                id_empresa INT AUTO_INCREMENT NOT NULL,
                denominacion VARCHAR(150),
                ruc VARCHAR(50),
                telefono VARCHAR(50),
                direccion VARCHAR(250),
                correo VARCHAR(100),
                logo VARCHAR(100),
                PRIMARY KEY (id_empresa)
);


CREATE INDEX índice_1 USING BTREE
 ON empresas
 ( id_empresa ASC );

CREATE TABLE compras (
                id_compra INT AUTO_INCREMENT NOT NULL,
                id_proveedor INT DEFAULT 0 NOT NULL,
                id_usuario INT DEFAULT 0 NOT NULL,
                fecha DATE,
                factura TEXT,
                tipo TEXT,
                vencimiento DATE,
                productos TEXT,
                impuesto DOUBLE ,
                neto DOUBLE ,
                total DOUBLE ,
                estado TEXT,
                metodopago TEXT,
                PRIMARY KEY (id_compra)
);


CREATE INDEX índice_1 USING BTREE
 ON compras
 ( id_compra ASC );

CREATE INDEX fk__proveedores USING BTREE
 ON compras
 ( id_proveedor ASC );

CREATE INDEX fk_compras_usuarios USING BTREE
 ON compras
 ( id_usuario ASC );

CREATE TABLE clientes (
                id INT AUTO_INCREMENT NOT NULL,
                nombre TEXT,
                documento TEXT,
                email TEXT,
                telefono TEXT,
                direccion TEXT,
                fecha_nacimiento DATE,
                compras INT DEFAULT 0,
                ultima_compra date,
                fecha timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
                PRIMARY KEY (id)
);


CREATE INDEX índice_1 USING BTREE
 ON clientes
 ( id ASC );

CREATE TABLE ventas (
                id INT AUTO_INCREMENT NOT NULL,
                codigo VARCHAR(50) DEFAULT '' NOT NULL,
                id_cliente INT NOT NULL,
                id_vendedor INT NOT NULL,
                productos TEXT NOT NULL,
                impuesto DOUBLE  NOT NULL,
                neto DOUBLE  NOT NULL,
                total DOUBLE  NOT NULL,
                metodo_pago TEXT NOT NULL,
                fecha timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
                PRIMARY KEY (id)
);


CREATE INDEX índice_1 USING BTREE
 ON ventas
 ( id ASC );

CREATE TABLE categorias (
                id INT AUTO_INCREMENT NOT NULL,
                categoria VARCHAR(250),
                fecha timestamp DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
);


CREATE TABLE cajas (
                id INT AUTO_INCREMENT NOT NULL,
                sucursal VARCHAR(50),
                caja VARCHAR(50),
                usuario VARCHAR(50),
                estado VARCHAR(50),
                inicia INT,
                timbrado VARCHAR(50),
                vence timestamp,
                tipo VARCHAR(50),
                ticket INT,
                PRIMARY KEY (id)
);


CREATE INDEX índice_1 USING BTREE
 ON cajas
 ( id ASC );

CREATE TABLE productos (
                id INT AUTO_INCREMENT NOT NULL,
                id_categoria INT NOT NULL,
                codigo TEXT NOT NULL,
                descripcion TEXT NOT NULL,
                imagen TEXT NOT NULL,
                stock INT NOT NULL,
                precio_compra DOUBLE  NOT NULL,
                precio_venta DOUBLE  NOT NULL,
                ventas INT NOT NULL,
                fecha timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
                barcode TEXT,
                PRIMARY KEY (id)
);


ALTER TABLE compras ADD CONSTRAINT fk_compras_usuarios
FOREIGN KEY (id_usuario)
REFERENCES usuarios (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE ventas ADD CONSTRAINT usuarios_ventas_fk
FOREIGN KEY (id_vendedor)
REFERENCES usuarios (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE compras ADD CONSTRAINT fk__proveedores
FOREIGN KEY (id_proveedor)
REFERENCES proveedores (id_proveedor)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE ventas ADD CONSTRAINT clientes_ventas_fk
FOREIGN KEY (id_cliente)
REFERENCES clientes (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE productos ADD CONSTRAINT categorias_productos_fk
FOREIGN KEY (id_categoria)
REFERENCES categorias (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
