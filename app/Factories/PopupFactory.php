<?php
namespace App\Factories;

use App\Models\Popup;


class PopupFactory
{
    //one methode to create all type of popups because it's have same attribute and one model
    public static function create(array $attributes = [])
    {
        return Popup::create($attributes);
    }
}