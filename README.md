Una forma simple de agregar stored procedures en tu proyecto laravel a través de las migraciones.

Para implementar este script deberás agregar esta migración al final de las otras migraciones, para evitar errores con tablas que no existen.

> [!NOTE]
> Con este script deberás almacenar las funciones almacenadas en la ruta `database/migrations/sp`, pero si quieres cambiarlo puedes hacerlo simplemente cambiando el siguiente script:
 
```php 
database_path('migrations/sp')
```
## Reglas
Para implementar este script sin problemas en tu proyecto debes seguir las siguientes reglas para evitar errores:
* Debes crear un stored procedure por archivo `sql`, como en el ejemplo.
* El nombre del archivo debe ser igual al del stored procedure. Esto nos sirve para eliminar el stored procedure almacenado y volver a crearlo en caso de algún cambio en su funcionamiento.
* No debe contener un delimiter el código `sql`.
* Siempre colocar la migración al final de la carpeta para evitar errores.

