CREATE USER 'usutfg'@'localhost' IDENTIFIED BY '1234';
GRANT ALL PRIVILEGES ON InventarioTFG.* TO 'usutfg'@'localhost';

create database InventarioTFG DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

use InventarioTFG;

/*

-- Tabla de productos
CREATE TABLE producto (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  descripcion TEXT,
  cantidad INT NOT NULL,
  precio DECIMAL(10, 2) NOT NULL,
  tipo ENUM('venta', 'uso_interno') NOT NULL
) engine=innodb;


-- Tabla de personas (clientes, proveedores, deudores o acreedores)
CREATE TABLE persona (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  tipo ENUM('cliente', 'proveedor', 'deudor', 'acreedor') NOT NULL,
  telefono VARCHAR(20) NOT NULL,
  direccion VARCHAR(255)
) engine=innodb;


-- Tabla de facturas (compra o venta)
CREATE TABLE factura (
  id INT AUTO_INCREMENT PRIMARY KEY,
  persona_id INT NOT NULL,
  fecha DATE NOT NULL,
  tipo ENUM('compra', 'venta') NOT NULL,
  total DECIMAL(10,2),
  FOREIGN KEY (persona_id) REFERENCES persona(id)
) engine=innodb;


-- Productos en cada factura (relación N:M)
CREATE TABLE factura_producto (
  id INT AUTO_INCREMENT PRIMARY KEY,
  factura_id INT NOT NULL,
  producto_id INT NOT NULL,
  cantidad INT NOT NULL,
  precio_unitario DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (factura_id) REFERENCES factura(id),
  FOREIGN KEY (producto_id) REFERENCES producto(id)
) engine=innodb;



-- Tabla para registrar deudas
CREATE TABLE deuda (
  id INT AUTO_INCREMENT PRIMARY KEY,
  persona_id INT NOT NULL,
  monto DECIMAL(10, 2) NOT NULL,
  descripcion TEXT,
  fecha DATE NOT NULL,
  FOREIGN KEY (persona_id) REFERENCES persona(id)
) engine=innodb;

-- Tabla de pagos realizados (control financiero)
CREATE TABLE pago (
  id INT AUTO_INCREMENT PRIMARY KEY,
  persona_id INT,
  deuda_id INT,
  fecha DATE NOT NULL,
  monto DECIMAL(10, 2) NOT NULL,
  metodo_pago ENUM('efectivo', 'Transferencia') NOT NULL,
  descripcion TEXT,
  FOREIGN KEY (persona_id) REFERENCES persona(id),
  FOREIGN KEY (deuda_id) REFERENCES deuda(id)
) engine=innodb;

-- Tabla para registrar contratos de alquiler
CREATE TABLE alquiler (
  id INT AUTO_INCREMENT PRIMARY KEY,
  empresa_arrendadora VARCHAR(100) NOT NULL,
  fecha_inicio DATE NOT NULL,
  fecha_fin DATE,
  monto_mensual DECIMAL(10, 2) NOT NULL
) engine=innodb;


-- Tabla de efectivo disponible en la empresa
CREATE TABLE efectivo (
  id INT AUTO_INCREMENT PRIMARY KEY,
  billetes DECIMAL(10, 2) NOT NULL DEFAULT 0,
  monedas DECIMAL(10, 2) NOT NULL DEFAULT 0,
  fecha_actualizacion DATE NOT NULL
) engine=innodb;

-- Tabla de cuentas bancarias (puede haber más de una)
CREATE TABLE cuenta_bancaria (
  id INT AUTO_INCREMENT PRIMARY KEY,
  banco VARCHAR(100) NOT NULL,
  numero_cuenta VARCHAR(50) NOT NULL,
  saldo DECIMAL(10, 2) NOT NULL,
  fecha_actualizacion DATE NOT NULL
) engine=innodb;

*/