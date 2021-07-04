<?php

namespace App\Http\Controllers\admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactStoreRequest;
use App\Http\Requests\Contact\ContactUdateRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();
     return view('admin.contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactStoreRequest $request, Contact $contact)
    {
       $contact->phone = $request->phone;
       $contact->email = $request->email;
       $contact->facebook = $request->facebook;
       $contact->linkedin = $request->linkedin;
       $contact->git = $request->git;

       $contact->save();
       return redirect()->to(route('contact.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactUdateRequest $request, Contact $contact)
    {
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->facebook = $request->facebook;
        $contact->linkedin = $request->linkedin;
        $contact->git = $request->git;
 
        $contact->save();
        return redirect()->to(route('contact.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
       $contact->delete();
       return redirect()->to(route('contact.index'));
    }

    public function editContact(Request $request){
        $contact = Contact::find($request->id);

        return response()->json(['data'=>$contact]);
    }
}
