"#Proyecto-logistica"
MOHAMED YASER HADDAD EDDAHMANE
DAW 2 - SERVIDOR

<-----------------USUARIOS CREADOS: -------------------------------->
id email usuario password
1 user@user.com user user
2 admin@admin.com admin admin
3 yaser@yaser.com yaser yaser
4 alain@alain.com alain alain

<---------------TECNOLOGÍAS USADAS ---------------------------------->
HTML5 PHP  
 CSS3 MYSQL
BOOTSTRAP SQL
GIT

<----------------INTRODUCCIÓN---------------------------------------->
Se trata de un proyecto de logística donde mi objetivo controlar los productos y los almacenes en los que se encunetran estos. Para ello, podemos dividir el proyecto en tres partes:

    -La primera parte se trata del ALMACEN que está dividido en 5 php´s: (T_ALMACEN)
        - almacen-eliminar: Su función es que cada vez que el usuario pinche en la X del listado de almacenes,
            pueda eliminar dicho almacen.
        - almacen-ficha: Cuando pulsamos en el boton "Añadir nueo almacen" nos redirije a un formulario donde
            le ponemos el nombre y el lugar de docho almacen.
            También podemos acceder a este pinchando el link del almacen, este nos vuele a redirigir a este formulario donde podemos ver los datos guardados y podemos modificarlos.
        - almacen-guardar se encarga de insertar o modificar estos datos en la base de datos.
        - almacen-lista imprime una tabla con todos los registros de la tabla almacen en nuestra base de     datos.
        - buscar-almacen realiza una búqueda del almacen en la base de datos de la fila que coincide con la cadena de texto que se le pasa por el input.

    -La segunda parte se trata de productos, que está dividido en 7 php´s: (T_PRODUCTOS)
        - productos-eliminar: Su función es que cada vez que el usuario pinche en la X del listado de   productos, pueda eliminar dicho producto.
        - productos-ficha: Cuando pulsamos en el boton "Añadir nuevo producto" nos redirije a un formulario donde le le pasamos los siguientes parametros (codigo, nombre, estado y almacen).
        También podemos acceder a este pinchando el link de los productos, este nos vuelve a redirigir a este formulario donde podemos ver los datos guardados y podemos modificarlos.
        - productos-guardar se encarga de insertar o modificar estos datos en la base de datos.
        - productos-EstablecerEscasez es un script que se encarga de que podamos cambiar el estado del producto.  El tic significa que está bien abastecido y la exclamación que escasea dicho producto.
        - productos-escasos nos muestra una lista de los productos que tenemos que están escaseando y hay que abastecer.
        - productos-lista imprime una tabla con todos los registros de la tabla productos de nuestra base de datos.
        - busqueda-productos realiza una búqueda del producto en la base de datos de la fila que coincide con la cadena de texto que se le pasa por el input.

    -La tercera parte se trata de el control de usuarios, qué está dividido en 4 php´s: (t_users)
        - index es la página que se muestra al entrar en el proyecto donde nos da dos opciones:
            - INICIAR SESIÓN:  login que nos redirije a un formulario (valores: email, usuario, contraseña) que nos ayuda a acceder al proyecto (si tenemos cuenta).
            - REGISTRARSE: sign in que nos redirije a un formulario (valores:  email, usuario, contraseña, confirma contraseña) que nos ayuda a crear un usuario para luego poder iniciar sesión.
        - log out: es un botón que nos ayuda a cerrar la sesión que hayamos iniciado.

    Todo esto está conectado al archivo __varios.php que es el que realiza la conexión a la base de datos logistica.sql que se encunetra en la carpeta sql . También tenemos dos carpetas que son css ( que genera los estilos.css) e img/ (donde almacenamos las imagenes que hemos usado en el proyecto).
