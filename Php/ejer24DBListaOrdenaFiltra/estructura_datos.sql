-- Creación de la base de datos (si no existe)
CREATE DATABASE IF NOT EXISTS facturacion_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE facturacion_db;

-- 1. Tabla auxiliar para el campo parametrizable (unidades de medida)
DROP TABLE IF EXISTS unidades_medida;
CREATE TABLE unidades_medida (
    id_uni VARCHAR(10) NOT NULL,
    descripcion VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_uni)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO unidades_medida (id_uni, descripcion) VALUES
('Lt', 'Litros (Lt)'),
('bls30kg', 'Bolsas 30 Kilogramos (bls30kg)'),
('bls20kg', 'Bolsas 20 Kilogramos (bls20kg)'),
('caja2lts', 'Cajas de 2 Litros (caja2lts)'),
('unidades', 'Unidades individuales');

-- 2. Tabla principal: 13) Renglones de factura de compra
DROP TABLE IF EXISTS renglones_factura;
CREATE TABLE renglones_factura (
    id_renglon INT(11) NOT NULL AUTO_INCREMENT,
    nro_factura VARCHAR(20) NOT NULL,
    cod_prod VARCHAR(20) NOT NULL,
    descripcion VARCHAR(150) NOT NULL,
    unidad_medida VARCHAR(10) NOT NULL,
    cantidad DECIMAL(10,2) NOT NULL,
    precio_unit DECIMAL(12,2) NOT NULL,
    total_renglon DECIMAL(14,2) NOT NULL,
    fecha_factura DATE NOT NULL,
    pdf_comprobante LONGBLOB NULL,
    PRIMARY KEY (id_renglon),
    KEY fk_unidad (unidad_medida),
    CONSTRAINT fk_renglones_unidades FOREIGN KEY (unidad_medida) REFERENCES unidades_medida (id_uni)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Poblado de datos de prueba variados para probar filtros y orden
INSERT INTO renglones_factura (nro_factura, cod_prod, descripcion, unidad_medida, cantidad, precio_unit, total_renglon, fecha_factura) VALUES
('FC-A-0001-00004821', 'PRD-9901', 'Modulo Memoria DDR5 32GB', 'unidades', 4.00, 48000.00, 192000.00, '2026-02-15'),
('FC-A-0001-00004821', 'PRD-9902', 'Disco SSD NVMe 2TB Gen4', 'unidades', 2.00, 115000.00, 230000.00, '2026-02-15'),
('FC-A-0001-00004822', 'INS-1010', 'Alcohol Isopropilico de Limpieza', 'Lt', 15.00, 6200.00, 93000.00, '2026-03-01'),
('FC-B-0002-00001150', 'INS-1011', 'Aceite Lubricante Turbinas', 'Lt', 8.00, 9400.00, 75200.00, '2026-03-12'),
('FC-A-0001-00004823', 'MAT-5020', 'Resina Epoxica Industrial', 'bls30kg', 10.00, 34000.00, 340000.00, '2026-03-20'),
('FC-A-0001-00004824', 'MAT-5021', 'Compuesto Siliconado Alta Densidad', 'bls20kg', 5.00, 27500.00, 137500.00, '2026-04-05'),
('FC-B-0002-00001155', 'INS-2050', 'Refrigerante Liquido Circuito Cerrado', 'caja2lts', 12.00, 14200.00, 170400.00, '2026-04-14'),
('FC-A-0001-00004825', 'PRD-9905', 'Microprocesador AMD EPYC Server', 'unidades', 1.00, 650000.00, 650000.00, '2026-04-18');