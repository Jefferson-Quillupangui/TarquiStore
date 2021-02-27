##REPORTE VENTAS DIARIAS (ordenes entregas por dia)
#	RESULTADO: DIA - CANTIDAD_ENTREGADOS_X_DIA - MONTO_ENTREGADOS_X_DIA
##drop procedure dias_mes_dinamico
#-----------------------------INICIO-------------------------------------------------
DELIMITER //
create  PROCEDURE `dias_mes_dinamico`(IN `dia_entrada` DATE)
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
COMMENT ''
BEGIN
/*
Author: Rafael Vázquez
Date: 2015-08-01
Description: Procedure to get every day of the month
*/

#Declaration of variables
DECLARE var_inicio, var_final INT DEFAULT 0;
DECLARE fecha_Inicial,fecha_Final, fecha_incremento DATE;
DECLARE var_cantidad_ordenes INT;
DECLARE var_total_orden DECIMAL(8,2);
DECLARE var_fecha_orden DATE;

#AVariable initializations
SET fecha_Inicial = dia_entrada;
SET fecha_Final= LAST_DAY(fecha_Inicial);
SET var_inicio = EXTRACT(DAY FROM fecha_Inicial);
SET var_final = EXTRACT(DAY FROM fecha_Final);
SET fecha_incremento = fecha_Inicial;

#consultas
#SET var_cantidad_pedidos = (SELECT DISTINCT(a.delivery_date) FROM orders as a WHERE  order_status_cod='OE' AND a.delivery_date = '2021-02-01' GROUP BY a.delivery_date);

#Create a temporaty table to store every day of a month
CREATE TEMPORARY TABLE tmp_dias_mes(
id INT,
dia_mes DATE,
cantidad_ordenes int,
total_ordenes decimal(8,2)
);

#Get every day of the month
WHILE var_inicio <= var_final DO

SET var_fecha_orden = (SELECT DISTINCT(a.delivery_date) FROM orders as a WHERE  order_status_cod='OE' AND a.delivery_date = fecha_incremento GROUP BY a.delivery_date);

IF (fecha_incremento =  var_fecha_orden) THEN
	SET var_total_orden = (SELECT SUM(total_order)  FROM orders as a WHERE  order_status_cod='OE' AND a.delivery_date = fecha_incremento GROUP BY a.delivery_date);
	SET var_cantidad_ordenes = (SELECT COUNT(a.id)  FROM orders as a WHERE  order_status_cod='OE' AND a.delivery_date = fecha_incremento GROUP BY a.delivery_date);
ELSE 
	SET var_cantidad_ordenes = 0;
    SET var_total_orden = 0.00;
    
END IF;

INSERT INTO tmp_dias_mes (id,dia_mes,cantidad_ordenes,total_ordenes) values(var_inicio, fecha_incremento, var_cantidad_ordenes, var_total_orden);
SET fecha_incremento = DATE_ADD(fecha_incremento, INTERVAL 1 DAY);
SET var_inicio = var_inicio + 1;
END WHILE;

#Show the temporary table
SELECT * FROM tmp_dias_mes;

#Drop the temporary table

DROP TABLE tmp_dias_mes;
END