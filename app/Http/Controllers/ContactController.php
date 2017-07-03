<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contact;

class ContactController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        if ($id == null) {
            return Contact::orderBy('id', 'asc')->get();
        } else {
            return $this->show($id);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $contact = new Contact;

        $contact->contact_name = $request->input('contact_name');
        $contact->contact_number = $request->input('contact_number');
        $contact->email = $request->input('email');
        $contact->label = $request->input('label');
        $contact->client_id = $request->input('client_id');
        $contact->save();

        return 'Contact record successfully created with id ' . $contact->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);
        return view('contacts.show',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $contact = Contact::find($id);

        $contact->contact_name = $request->input('contact_name');
        $contact->contact_number = $request->input('contact_number');
        $contact->email = $request->input('email');
        $contact->label = $request->input('label');
        $contact->save();

        return "Success updating user #" . $contact->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return Contact::where('id',$id)->delete();
    }
}
