USE tarquistore
DELIMITER //
CREATE PROCEDURE `sp_con_reportes`(
		IN p_in_opcion TEXT, 
        IN p_in_mes varchar(10),
        IN p_in_anio varchar(100),
        IN p_in_estado varchar(10),
        IN dato_busqueda VARCHAR(255))
BEGIN
 DECLARE var_mes varchar(10) ;
DECLARE var_anio  varchar(10);
DECLARE var_dia  varchar(10);
DECLARE var_fecha  varchar(50);
case p_in_opcion
	##1-REPORTE: compras por clientes (ordenes entregadas por cliente)
	 when 'AA' THEN  
		select c.name AS name_estado,
				b.identification,
                concat(b.name,' ',b.last_name) as name_complet,
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
        ##Ventas Por Vendedor
        WHEN  'AB' THEN  
			select c.identification,
					c.name,
					##MONTH(delivery_date) as mes,
					##YEAR(delivery_date) as anio,
					count(a.total_order) as cantidad,
					sum(a.total_order) as total
			from orders a inner join collaborators c 
				on c.id = a.collaborator_id
			where a.order_status_cod = p_in_estado ##'OE'
				and MONTH(delivery_date) = p_in_mes ##'03' 
				and YEAR(delivery_date) = p_in_anio ##'2021'
			group by c.identification, c.name
			order by cantidad desc;
		
        ##lISTADOS DE PRODUCTOS VENDIDOS
        WHEN 'AC' THEN
        SELECT ##YEAR(b.delivery_date),MONTH(b.delivery_date),
		 #d.name as nombre_categoria,
		 LPAD(product_id, 6, '0') as codigo_producto,
		 ##count(a.product_id) catidad_vendidos,
		 a.name_product, 
		 sum(a.quantity) as catidad_vendidos, 
		 sum(a.total_line) as total_venta_product
		FROM order_product as	a INNER join orders as b on a.order_id = b.id
														inner join products c on a.product_id = c.id
														inner join categories as d on c.category_id	= d.id
		WHERE YEAR(b.delivery_date) =  p_in_anio ##'2021' 
				and  MONTH(b.delivery_date) = p_in_mes ##'02'
		GROUP BY 
		d.name,a.product_id, a.name_product;
        
          ##REPORTE VENTAS DIARIAS (ordenes entregas por dia)
        WHEN  'AD' THEN  
       
			set var_mes = p_in_mes;
			set var_anio = p_in_anio;##'2020';
			set var_dia = '01';

			set var_fecha = (select concat(var_anio,"-",var_mes,"-",var_dia)) ;
            ##select var_fecha;
			call dias_mes_dinamico(var_fecha);
		
        ##5-VENTAS POR CATEGORIA ()
        WHEN 'AE' THEN
			
            SELECT 
			 LPAD(d.id, 6, '0') as codigo_categoria,
			 d.name as nombre_categoria,
			 COUNT(d.id) as cantidad_productos,
			 SUM(a.total_line) as monto_total
			FROM order_product as	a INNER join orders as b on a.order_id = b.id
															inner join products c on a.product_id = c.id
															inner join categories as d on c.category_id	= d.id
			WHERE YEAR(b.delivery_date) =  p_in_anio ##'2021' 
					and  MONTH(b.delivery_date) = p_in_mes##'02'
					and order_status_cod = p_in_estado ##'OE'
			GROUP BY d.id,d.name ;
		
        ##PEDIDOS ENTREGADOS
        WHEN 'AF' THEN
        
        SELECT 
			 LPAD(a.id, 6, '0') as id,
			a.delivery_date,
			a.delivery_time,
			a.delivery_address,
			a.total_order,
			a.total_comission,
			a.observation,
			#a.status_comission,
			b.name As nombre_estado,
			#a.sector_cod,
			d.name AS sector,
			a.city_sale_cod,
			c.name AS nombre_ciudad,
			#a.client_id,
			e.identification,
			CONCAT(e.name,' ',e.last_name) AS nombre_cliente,
			CONCAT(e.phone1,' ',e.phone2) AS telefono,
			e.email,
			#a.collaborator_id,
			f.name AS nombre_colaborador,
			f.identification AS identification_colaborador,
			a.order_status_cod
			FROM orders a INNER JOIN order_statuses b ON a.order_status_cod = b.codigo
										INNER JOIN city_sales c ON a.city_sale_cod = c.codigo
										INNER JOIN sectors d ON a.sector_cod = d.codigo
										INNER JOIN clients e ON a.client_id = e.id
										INNER JOIN collaborators f ON a.collaborator_id = f.id
										WHERE  
												YEAR(a.delivery_date) =  p_in_anio 
                                            AND  MONTH(a.delivery_date) = p_in_mes##'02'
                                            AND a.order_status_cod = p_in_estado; ##'OE'
                                        
        
	END CASE;
END