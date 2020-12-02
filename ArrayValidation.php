<?php
require_once('ValidationInterface.php');

class ArrayValidation implements ValidationInterface
{
    private $inputArray;

    public function setArray($inputArray){
        $this->_setArray($inputArray);
    }

    private function _setArray($inputArray)
    {
        if (!is_array($inputArray)) {
            throw new Exception('Invalid input array.');
        }
        $this->inputArray = $inputArray;
    }

    public function check(){
        $rules = [
            'name' => ['required'],
            'phone' => ['required', 'numeric'],
            'email' => ['required', 'email'],
            'message' => ['required', 'min_length(25)'],
        ];
        $validation_result = SimpleValidator\Validator::validate($this->inputArray, $rules);
        if ($validation_result->isSuccess() == true) {
            $response = [
                'status' => true,
            ];
        } else {
            $errorMsg  = '';
            foreach($validation_result->getErrors() as $error){
                $errorMsg .= $error . '<br>';
            }
            $response = [
                'status' => false,
                'errorMsg' => $errorMsg
            ];
        }
        return $response;
    }

}