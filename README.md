                                        API ZAPATILLAS 

Esta API nos permite obtener los datos de nuestra pagina web "Just Us" almacenados en una base de datos. Esto se logra mediante distintos operaciones y metodos los cuales los utilizamos mediante una URL.

 • METODO GET:

    Podemos utilizar este metodo de las siguientes maneras:

        GET	      /zapatillas	   	            Mostrara todas las zapatillas disponibles.
        GET	      /zapatillas/ID	            Mostrara la zapatilla con el ID pasado en la url.
    
 • METODO POST:

    Este metodo agrega una zapatilla con la informacion que le pasamos mediante un formato JSON. 

        POST      /zapatillas                   
                                    Ejemplo:        
                                            {
                                            "nombre": "Zapatilla de Ejemplo",
                                            "marca": "Adidas",
                                            "talle": "41-42-43-44",
                                            "precio": 750,
                                            "imagen" : null,
                                            "id_categoria_fk" : 2
                                            }
    El ID no se lo tendremos que pasar ya que es autoincremental.
                                        
 • METODO DELETE:

    Este metodo nos permite eliminar la zapatilla que contenga el ID que enviamos mendiante la URL.

        DELETE   /zapatillas/ID               La zapatilla con el ID enviado mediante la URL se eliminara de la base de datos.

 • ORDENAMIENTO:

    Para poder ordenar los productos debemos pasar los siguientes parametros mediante la solicitud GET:

        /zapatillas?sort=precio&order=ASC o DESC

    En el campo SORT podremos ordenar por: ID, nombre, marca, precio, talle, id_categoria_fk.
    En el campo ORDER se prodra ordenar de manera ascendente(ASC) o descendente(DESC). Esto es a libre elección del usuario.

• PAGINACIÓN: 

    Podremos realizar una paginación de los productos mediante una solicitud GET de la siguiente manera:

        /zapatillas?limit=0,5

    En este caso se mostraran se mostraran los productos del 0 hasta el 5. Esto es a eleccion del usuario. En primer valor luego del signo =  nos indica a partir de que valor comenzaremos a mostrar los productos, mientras que el valor seguido a la , nos indica el ultimo producto que mostraremos.

• FILTRADO POR CATEGORIA:

    Para realizar un filtrado por categoria debemos realizar una solicitud GET de la siguiente manera.

        /zapatillas?categoria=Urbana
    
    En este caso nos mostraran todas las zapatillas urbanas. Tambien podremos filtrar por Deportivas o Montaña.

