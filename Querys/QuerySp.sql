USE tarquistore
DELIMITER //
CREATE PROCEDURE sp_con_reportes(
		IN p_in_opcion TEXT, 
        IN p_in_mes varchar(10),
        IN p_in_anio varchar(100),
        IN p_in_estado varchar(10),
        IN dato_busqueda VARCHAR(255))
BEGIN
case p_in_opcion
	##1-REPORTE: compras por clientes (ordenes entregadas por cliente)
	 when 'AA' THEN  
		select c.name AS name_estado,
				b.identification,b.name,
                b.last_name, 
                count(client_id) as cantidad_ordenes ,  
                sum(total_order) as total_orden
				##id,delivery_date,delivery_time,delivery_address,total_order,total_comission,observation,
				##status_comission,sector_cod,city_sale_cod,client_id,collaborator_id,order_status_cod
				from orders a inner join clients b on a.client_id = b.id
							 inner join order_statuses c on a.order_status_cod = c.codigo
				where order_status_cod = p_in_estado ##'OE' 
						and MONTH(delivery_date) = p_in_mes ##'02' 
                        and YEAR(delivery_date) = p_in_anio ##'2021'
				GROUP BY  c.name, b.identification,b.name,b.last_name;
        
        ##WHEN  'AC' THEN  
		
	END CASE;
END

//
DELIMITER ;