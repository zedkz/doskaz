<?php


namespace App\Complaints;


interface ComplaintExporter
{
    public function execute(int $id): \SplFileObject;
}