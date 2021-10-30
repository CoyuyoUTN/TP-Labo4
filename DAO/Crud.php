<?php namespace DAO;


/**
 *
 */
interface Crud
{
	public function create($object);
	public function read($id);
	public function readAll();
	public function update($object);
	public function delete($object);
}

?>