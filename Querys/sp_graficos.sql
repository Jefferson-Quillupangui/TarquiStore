USE tarquistore
DELIMITER //
CREATE PROCEDURE `sp_con_graficos`(
		IN p_in_opcion TEXT, 
        IN p_in_iduser INT,
        IN p_in_anio varchar(20),
        IN p_in_mes varchar(20))
BEGIN

case p_in_opcion

	##Top productos mas vendidos
	 when 'AA' THEN  
     
		SELECT 	DISTINCT(b.product_id),
				b.name_product,
				SUM(b.quantity) as cantidad
				FROM orders a 
					join order_product b on a.id = b.order_id
				where a.order_status_cod = 'OE'
					and YEAR(a.delivery_date) =  p_in_anio ##'2021' 
					and  MONTH(a.delivery_date) = p_in_mes##'02'
				GROUP BY b.product_id
				order by cantidad desc
				Limit 10;
		
        ##Clientes por genero
        WHEN  'AB' THEN  
        
			SELECT 	
			CASE b.sex 
				WHEN 'H' THEN 'Hombre' 
				ELSE 'Mujer' 
			END  as genero,
				count(*) as cantidad
			FROM orders a 
			join clients b on a.client_id = b.id
			where a.order_status_cod = 'OE'
				and YEAR(a.delivery_date) =  p_in_anio ##'2021' 
				and  MONTH(a.delivery_date) = p_in_mes##'02'
			group by b.sex; 
            
		##Top productos mas vendidos por usuario
        WHEN  'AC' THEN  
        
			SELECT 	DISTINCT(b.product_id),
			b.name_product,
			SUM(b.quantity) as cantidad
			FROM orders a 
				join order_product b on a.id = b.order_id
			where a.order_status_cod = 'OE'
				and YEAR(a.delivery_date) = p_in_anio ##'2021' 
				and MONTH(a.delivery_date) = p_in_mes ##'02'
				and a.collaborator_id = p_in_iduser ##1
			GROUP BY b.product_id
			order by cantidad desc
			Limit 10;
            
		##Categorias mas vendidas por usuario
        WHEN  'AD' THEN  
        
			select
			 d.name, 
			 sum(a.quantity) as cantidad_vendidos
			FROM order_product as	a 
			INNER join orders as b on a.order_id = b.id
				inner join products c on a.product_id = c.id
				inner join categories as d on c.category_id	= d.id
			WHERE YEAR(b.delivery_date) =  p_in_anio ##'2021' 
					and MONTH(b.delivery_date) = p_in_mes ##'02'
					and b.collaborator_id = p_in_iduser ##1
			GROUP BY d.name;

	END CASE;
END
