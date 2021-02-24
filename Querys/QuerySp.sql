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
			SELECT b.name,
            b.identification, 
            comissions.quantity_orders, 
            comissions.total_comission 
            FROM comissions inner join collaborators as b on comissions.collaborator_id = b.id
            WHERE comissions.month =  p_in_mes and comissions.year = p_in_anio;
		
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
			call dias_mes_dinamico('2021-02-01');
		
        
	END CASE;
END