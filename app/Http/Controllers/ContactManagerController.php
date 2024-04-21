<?php

namespace App\Http\Controllers;

use App\upolo\ContactManager;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Throwable;

class ContactManagerController extends Controller
{
    public function main()
    {
        $sample_data = [
            'function' => 'search_contact',
            'search_text'=>'sea'
        ];
        $sample_data = json_encode($sample_data);
        return view('welcome', ['sample_data' => $sample_data]);
    }
    /**
     * This function is use to validate input 
     */
    private function input_validation(Request $request)
    {
        $return = [];
        // if the function not define in request
        if (!$request->has('data')) {
            $return = [
                'result' => false,
                'msg' => 'The call has not data',
                'data' => null
            ];
        }

        try {
            $api_data = json_decode($request->data, 1);
            if (!isset($api_data['function'])) {
                $return = [
                    'result' => false,
                    'msg' => 'if the function not define in request',
                    'data' => $api_data
                ];
            } else {
                $return = [
                    'result' => true,
                    'msg' => 'ok',
                    'data' => $api_data
                ];
            }
        } catch (Throwable $e) {
            $return = [
                'result' => false,
                'msg' => 'The call data is not valid',
                'data' => null
            ];
        }

        return $return;
    }

    public function content_manager(Request $request)
    {
        $validation = $this->input_validation($request);
        if (!$validation['result']) {
            return  json_encode($validation);
        }
        $cm = new ContactManager;
        return $cm->call_contact_manager($validation['data']);
    }

    public function undefine_address($undefine_address = null, $undefine_address2 = null)
    {
        return 'The request address is not define!';
    }
}
