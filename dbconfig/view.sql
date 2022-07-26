CREATE VIEW produtos_stock AS 
SELECT * from  productos WHERE stock >=1;

CREATE VIEW ventas_cabecera AS 
SELECT id,  neto, total, date_format(fecha, '%Y-%m-%d') AS fecha FROM ventas ;

CREATE VIEW v_compras AS 
SELECT a.id_compra, a.id_proveedor, b.ruc, b.razon_social, a.id_usuario, c.nombre,
a.fecha, factura, tipo, a.vencimiento, a.productos, a.impuesto, a.neto, a.total, a.estado, a.metodopago
 FROM compras a 
INNER JOIN proveedores b ON a.id_proveedor = b.id_proveedor
INNER JOIN usuarios c ON a.id_usuario = c.id ;

CREATE VIEW v_detalle_ventas AS 
SELECT a.codigo, b.id AS id_cliente, b.documento AS ruc,  b.nombre AS cliente, c.nombre AS vendedor, productos, impuesto, 
a.metodo_pago, a.neto,
 a.total, DATE_FORMAT(a.fecha,'%Y-%m-%d') as fecha, a.id , c.id as id_vendedor,DATE_FORMAT(a.fecha,'%d/%m/%Y') AS f,
 case when impuesto = 0 then round(total / 11)  END AS imp 
FROM ventas a INNER JOIN clientes b ON a.id_cliente = b.id  
INNER JOIN usuarios c ON a.id_vendedor = c.id ORDER BY fecha DESC, codigo DESC ;

-- CREATE VIEW v_productos_total AS SELECT  id_categoria, categoria, SUM(total) AS total FROM (
-- 	SELECT  a.id_categoria, b.categoria, precio_compra * stock  AS total FROM productos a INNER JOIN categorias b ON a.id_categoria = b.id ORDER BY total DESC

-- 	) a GROUP BY id_categoria;

create view v_productos_total_a as
SELECT  a.id_categoria, b.categoria, precio_compra * stock  AS total FROM productos a INNER JOIN categorias b ON a.id_categoria = b.id ORDER BY total DESC;

CREATE VIEW v_productos_total AS SELECT  id_categoria, categoria, SUM(total) AS total FROM (v_productos_total_a)  GROUP BY id_categoria;