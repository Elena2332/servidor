package beans;

import java.util.Collection;
import java.util.HashMap;
import java.util.Set;

public class CarroCompra {

	private HashMap<Integer, LineaPedido> carro = new HashMap<Integer, LineaPedido>();   // k:= idItem
	
	
	public void aniadeLinea(LineaPedido linea)
	{
		if(carro.containsValue(linea))
		{
			Set<Integer> keys = carro.keySet();
			for(int key  : keys)
			{
				LineaPedido lin = carro.get(key);
				if(linea.getItem().equals(lin.getItem()))   // comparo los items
				{
					int nuevaCantidad = lin.getCantidad()+linea.getCantidad();   // sumar las cantidades
					lin.setCantidad(nuevaCantidad);
					carro.put(key, lin);       // actualizar la linea
					break;
				}
			}
		}
		else
			carro.put(linea.getItem().getId(), linea);  
	}
	
	public void borrarLinea(int idItem)
	{
		carro.remove(idItem);
	}
	
	public LineaPedido getLineaPedido(int idItem)
	{
		return carro.get(idItem);
	}
	
	
	public Collection<LineaPedido> getLineasPedidio()
	{
		return carro.values();
	}
	
	public double total()   //precio total del carro
	{
		double total = 0;
		Set<Integer> keys = carro.keySet();
		for(int key  : keys)
			total += carro.get(key).getItem().getPrecio();
		
		return total;
	}
	
	
	public void removeAll()   //vacia el carro
	{
		carro.clear();
	}
	
	
	public boolean vacio()
	{
		return carro.isEmpty();
	}

	
}
