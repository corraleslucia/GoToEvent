<?php namespace daos;

/**
 *
 */
interface IDao
{
    public function create($v);
    public function read ($v);
    public function readAll ();
    public function update ($v, $newV);
    public function delete ($v);
}



 ?>
