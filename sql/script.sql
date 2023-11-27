-- Crear la base de datos
CREATE DATABASE punto_de_venta;

-- Seleccionar la base de datos
USE punto_de_venta;

-- Crear la tabla PAGO
CREATE TABLE PAGO (
    metodo_pago VARCHAR(255) PRIMARY KEY
);

-- Crear la tabla COMPRA
CREATE TABLE COMPRA (
    id_compra INT AUTO_INCREMENT PRIMARY KEY,
    productos TEXT,
    metodo_pago VARCHAR(255),
    monto DECIMAL(10,2),
    fecha DATE,
    FOREIGN KEY (metodo_pago) REFERENCES PAGO(metodo_pago)
);

-- Crear la tabla CLIENTE
CREATE TABLE CLIENTE (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY
);

-- Crear la tabla PROVEEDOR
CREATE TABLE PROVEEDOR (
    id_proveedor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    clasificacion VARCHAR(255),
    contacto VARCHAR(255),
    monto_pago DECIMAL(10,2),
    fechas_pago TEXT
);

-- Crear la tabla REPORTE
CREATE TABLE REPORTE (
    datos_ventas TEXT,
    datos_proveedores TEXT,
    datos_inventario TEXT
);

-- Crear la tabla REGISTRO_DE_VENTA
CREATE TABLE REGISTRO_DE_VENTA (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    pago VARCHAR(255),
    productos TEXT,
    fecha DATE,
    FOREIGN KEY (pago) REFERENCES PAGO(metodo_pago)
);

-- Crear la tabla PRODUCTOS
CREATE TABLE PRODUCTOS (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    categoria VARCHAR(255),
    fecha_vencimiento DATE,
    precio DECIMAL(10,2),
    cantidad INT
);

-- Agregar campo 'total' en tabla 'REGISRO_DE_VENTA'
ALTER TABLE REGISTRO_DE_VENTA
ADD COLUMN total DECIMAL(10, 2);