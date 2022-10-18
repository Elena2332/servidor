#	Nombres de las imágenes de ítems de la categoría ‘X’
select imagen from imagenes where exists 
	(select id from items where id = id_item and exists 
		(select id_cat from categorias where id_cat=id));
	
#	Nombre e email de los usuarios que han pujado por ítems con un precio de partida entre 1000 y 5000
select nombre,email from usuarios where exists 
	(select id from items where preciopartida>1000 and preciopartida<5000 
		and exists (select id from pujas where id_user = usuarios.id and id_item=items.id));
	
#	Fecha, nombre de usuario y nombre de ítem de la última puja
select Max(fecha), usuarios.nombre ,items.nombre 
from pujas,usuarios,items
where usuarios.id = pujas.id_user 
and items.id = pujas.id_item ;

#	Cantidad de usuarios que tienen algún ítem, pero ninguna puja
select count(*) from usuarios where exists 
	(select * from items where usuarios.id = id_user)
	and not exists(select * from pujas where id_user = id);

#	Por cada fecha anterior al ‘2020/10/10’ en la que haya pujas, cuántas pujas hay y valor medio de éstas
select count(*),avg(cantidad) from pujas where fecha<'2020/10/10';

#	Valor más alto pujado y a qué ítem (nombre) corresponde
select Max(cantidad), items.nombre from pujas,items where items.id = pujas.id_item ;

#	Nombre de los ítems de categoría ‘X’, junto a cantidad media pujada por cada uno
select items.nombre, avg(pujas.cantidad) from items,pujas,categorias 
where categorias.id=items.id_cat 
and items.id=pujas.id 
and categoria='flores'; 

#	Nombre y precio de partida de los ítems que no tienen ninguna imagen y tienen más de 3 pujas
select nombre, preciopartida from items
where items.id not in (select id_item from imagenes)
and 3<(select count(*) from pujas where pujas.id_item = items.id);

#	Nombres de las categorías en las que hay al menos de 3 subastas vigentes
select categoria from categorias c where 2<
	(select count(id_cat) from items,pujas where fechafin > fecha 
	and c.id=id_cat and items.id = pujas.id_item);

#	Nombre y descripción de los ítems cuya máxima puja al menos duplica el precio de partida
select nombre,descripcion from items where preciopartida*2<(select Max(cantidad) from pujas where id=id_item);
