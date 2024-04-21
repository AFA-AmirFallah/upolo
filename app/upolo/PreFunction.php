<?php

namespace App\upolo;

class PreFunction
{
    /**
     * type function TODO (This function is not include this version)
     * validation_input function use to validation data to save on table and data sanitizement
     */
    private function validation_input(string $table_name, array $input_arr)
    {

        return true;
    }
    /**
     * type function TODO (This function is not include this version)
     * avoid_duplication function use to avoid duplication in table
     */
    private function avoid_duplication(string $table_name, array $input_arr)
    {

        return true;
    }
    /**
     * type function TODO (This function is not include this version)
     * permission_checker function use to check user permission to do the request
     */
    private function permission_checker(string $table_name, array $input_arr)
    {

        return true;
    }

    public function validation(string $table_name, array $input_arr)
    {

        $validation_input = $this->validation_input($table_name, $input_arr);
        if(!$validation_input){
            return [
                'result'=>false,
                'msg'=>'data is not valid'
            ];
        }
        $avoid_duplication = $this->avoid_duplication($table_name, $input_arr);
        if(!$avoid_duplication){
            return [
                'result'=>false,
                'msg'=>'input data is duplicated with existing'
            ];
        }
        $permission_checker = $this->permission_checker($table_name, $input_arr);
        if(!$permission_checker){
            return [
                'result'=>false,
                'msg'=>'you have not permission to do this job'
            ];
        }
        return [
            'result'=>true,
            'msg'=>'ok'
        ];
    }
}
