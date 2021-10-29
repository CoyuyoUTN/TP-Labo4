<?php namespace interface;


/**
 *
 */
interface Crud
{
	public function create($objet);
	public function read($id);
	public function readAll();
	public function update($object);
	public function delete($object);
}

?>