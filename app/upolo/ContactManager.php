<?php

namespace App\upolo;

use App\Models\company;
use App\Models\contact;
use App\Models\contact_note;

class ContactManager
{


    /**
     * The function create_company used to add new company to company table after validation and sanitizement
     */
    private function create_company(array $request)
    {
        $company_data = [
            'Name' => $request['Name'],
            'NationalCode' => $request['NationalCode'] ?? null
        ];
        $PreFunction = new PreFunction;
        $validity = $PreFunction->validation('companies', $company_data);
        if (!$validity['result']) {
            return $validity;
        }
        $insert_company = company::create($company_data);
        return [
            'result' => true,
            'msg' => 'ok',
            'data' => $insert_company
        ];
    }
    /**
     * The function  create_contact add new contact to company`s contact
     */
    private function create_contact(array $request)
    {
        $contact_data = [
            'Name' => $request['Name'],
            'Family' => $request['Family'],
            'MobileNo' => $request['MobileNo'],
            'NationalCode' => $request['NationalCode'],
            'company_id' => $request['company_id'],
        ];
        $PreFunction = new PreFunction;
        $validity = $PreFunction->validation('contacts', $contact_data);
        if (!$validity['result']) {
            return $validity;
        }
        $insert_contact = contact::create($contact_data);
        return [
            'result' => true,
            'msg' => 'ok',
            'data' => $insert_contact
        ];
    }
    /**
     * The function  get_contact_list return list of contacts with or without select company 
     */
    private function get_contact_list(array $request)
    {
        if (isset($request['company_id'])) { // if select company`s contact
            $contact_list = contact::all();
            $contact_list = contact::where('company_id', $request['company_id'])->get();
        } else { // if user ask to show all contacts
            $contact_list = contact::all();
        }
        return [
            'result' => true,
            'msg' => 'ok',
            'data' => $contact_list
        ];
    }
    /**
     *  The function get_single_contact return single contact with get single contact id
     */
    private function get_single_contact(array $request)
    {
        $contact_id = $request['contact_id'];
        $single_contact = contact::find($contact_id);
        return [
            'result' => true,
            'msg' => 'ok',
            'data' => $single_contact
        ];
    }
    /**
     * this function is an internal function to check the contact is exist or not
     */
    private function is_contact_exist($id)
    {
        $contact_src = contact::where('id', $id)->first();
        if ($contact_src == null) {
            return false;
        }
        return true;
    }
    /**
     * The function add_note_to_contact use to add note to customers
     */
    private function add_note_to_contact(array $request)
    {
        $contact_id = $request['contact_id'];
        if (!$this->is_contact_exist($contact_id)) {
            return [
                'result' => false,
                'msg' => 'the main contact is not exist',
                'data' => null
            ];
        }
        $note = $request['note'];
        $note_data = [
            'contact_id' => $contact_id,
            'note' => $note
        ];
        $PreFunction = new PreFunction;
        $validity = $PreFunction->validation('contact_notes', $note_data);
        if (!$validity['result']) {
            return $validity;
        }

        $note_src = contact_note::create($note_data);
        return [
            'result' => true,
            'msg' => 'ok',
            'data' => $note_src
        ];
    }
    /**
     * The function get_company_list return all existing company list
     */
    private function get_company_list(array $request)
    {
        $company_src = company::all();
        return [
            'result' => true,
            'data' => $company_src
        ];
    }
    /**
     *  The search_contact function use to search users by name or family
     */
    private function search_contact(array $request)
    {
        $search_text = $request['search_text'];
        $search_result = contact::where('Name', 'like', "%$search_text%")->orWhere('Family', 'like', "%$search_text%")->get();
        return [
            'result' => true,
            'msg' => 'ok',
            'data' => $search_result
        ];
    }
    /**
     * The main function of this class
     */
    public function call_contact_manager(array $request)
    {
        $request_function = $request['function'];
        switch ($request_function) {
            case 'create_company':
                return $this->create_company($request);
            case 'create_contact':
                return $this->create_contact($request);
            case 'get_contact_list':
                return $this->get_contact_list($request);
            case 'get_single_contact':
                return $this->get_single_contact($request);
            case 'add_note_to_contact':
                return $this->add_note_to_contact($request);
            case 'get_company_list':
                return $this->get_company_list($request);
            case 'search_contact':
                return $this->search_contact($request);
            default:
                return [
                    'result' => false,
                    'msg' => 'the function is not define',
                    'data' => null
                ];
                break;
        }
    }
}
