<?php namespace DAO;


/**
 *
 */
interface Crud
{
	public function create($object); // Recibe un objeto y lo carga a su respectiva tabla en la base de datos.
	public function read($id); // Retorna un objeto de una tabla en particular pasando por parametro como atributo de busqueda un numero Id.
	public function readAll(); // Retorna una lista con todos los datos de una tabla en particular.
	public function update($object);// recibe un objeto por parametro y modifica los datos en su respectiva tabla en la base de datos.
	public function delete($object); // Elimina un objeto en su respectiva tabla en la base de datos.
}

?>