<?php

namespace App\Http\Controllers;

trait HelperTrait
{
    public $validationPhone = 'regex:/^((\+)?(\d)(\s)?(\()?[0-9]{3}(\))?(\s)?([0-9]{3})(\-)?([0-9]{2})(\-)?([0-9]{2}))$/';
    public $validationPassword = 'required|confirmed|min:3|max:50';
    public $validationInteger = 'required|integer';
    public $validationString = 'required|min:3|max:255';
    public $validationText = 'required|min:5|max:1200';
//    public $validationColor = 'regex:/^(hsv\((\d+)\,\s(\d+)\%\,\s(\d+)\%\))$/';
//    public $validationSvg = 'required|mimes:svg|max:10';
    public $validationJpgAndPng = 'mimes:jpg,png|max:2000';
    public $validationJpg = 'mimes:jpg|max:2000';
    public $validationPng = 'mimes:png|max:2000';
    public $validationDate = 'regex:/^(\d{2})\/(\d{2})\/(\d{4})$/';

//    public function getRequestValidation()
//    {
//        return [
//            'name' => 'required|min:3|max:255',
//            'email' => 'required|email',
//            'phone' => $this->validationPhone,
//            'i_agree' => 'required|accepted'
//        ];
//    }

//    public function processingFile(Request $request, $field, $path, $newFileName)
//    {
//        $fileName = $request->file($field)->getClientOriginalName();
//        $request->file($field)->move(base_path('public/'.$path), $newFileName);
//    }
}
