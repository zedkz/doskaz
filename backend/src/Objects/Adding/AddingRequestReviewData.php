<?php


namespace App\Objects\Adding;


use App\Infrastructure\ObjectResolver\DataObject;

class AddingRequestReviewData implements DataObject
{
    public $id;

    /**
     * @var Form
     */
    public $form;

    /**
     * AddingRequestReviewData constructor.
     * @param $id
     * @param Form $form
     */
    public function __construct($id, Form $form)
    {
        $this->id = $id;
        $this->form = $form;
    }
}