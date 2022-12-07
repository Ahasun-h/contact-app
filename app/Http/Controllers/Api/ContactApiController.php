<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $contacts = Contact::all();

        return response()->json([
            'status' => true,
            'contacts' => $contacts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //--- Validation Section Start ---//
        $rules = [
            'name'       => 'required|string',
            'email'      => 'required|email',
            'user_image' => 'required',
            'number'     => 'required|numeric',
            'company'    => 'required|string',
            'title'      => 'required|string',
            'group'      => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()), 422);
        }
        //--- Validation Section End ---//

        // Store Contact data
        $contact = Contact::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Contact Created successfully!",
            'contact' => $contact
        ], 200);
    }


    /**
     * Update Specific data in store
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function view($id){
        $contact = Contact::where('id',$id)->with('group')->first()->setHidden(['created_at','updated_at']);
        return response()->json([
            'status' => true,
            'contact' => $contact
        ]);
    }

    public function update(Request $request,$id){

        //--- Validation Section Start ---//
        $rules = [
            'name'       => 'required|string',
            'email'      => 'required|email',
            'user_image' => 'required',
            'number'     => 'required|numeric',
            'company'    => 'required|string',
            'title'      => 'required|string',
            'group'      => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()), 422);
        }
        //--- Validation Section End ---//

        // Store Contact data
        $contact = Contact::where('id',$id)->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Contact update successfully!",
            'contact' => $request->all()
        ], 200);
    }

    /**
     * Delete Data Form store
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){
        Contact::FindOrFail($id)->delete();
        return response()->json([
            'status' => true,
            'message' => "Contact Deleted successfully!",
        ], 200);
    }
}
