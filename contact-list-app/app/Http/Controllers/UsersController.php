<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class UsersController extends Controller
{
    public function list() {
        $contacts = Contact::all();
        
        return view ("list", ["contacts" => $contacts]);
    }

    public function add() {
        $contact = new Contact();
        $contact->state = "MG";

        return view ("contact", [ 
            "title" => "Add contact",
            "mode" => "add",
            "contact" => $contact ]);
    }

    public function edit($id) {
        $contact = Contact::findOrFail($id);
        
        return view ("contact", [
            "title" => "Update contact",
            "mode" => "edit",
            "contact" => $contact]);
    }

    public function view($id) {
        $contact = Contact::findOrFail($id);
        
        return view ("contact", [
            "title" => "View contact",
            "mode" => "view",
            "contact" => $contact]);
    }

    public function post(Request $request) {
        $contact = new Contact();
        $contact->firstName = $request->firstName;
        $contact->lastName = $request->lastName;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->phoneCategory = $request->phoneCategory;
        $contact->address = $request->address;
        $contact->city = $request->city;
        $contact->state = $request->state;
        $contact->zip = $request->zip;
        $contact->closeFriend = $request->closeFriend ? $request->closeFriend : "off";

        $contact->save();

        return redirect("/users/view/".$contact->id);
    }

    public function update($id, Request $request) {
        $contact = Contact::findOrFail($id);

        $contact->firstName = $request->firstName;
        $contact->lastName = $request->lastName;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->phoneCategory = $request->phoneCategory;
        $contact->address = $request->address;
        $contact->city = $request->city;
        $contact->state = $request->state;
        $contact->zip = $request->zip;
        $contact->closeFriend = $request->closeFriend ? $request->closeFriend : "off";

        $contact->save();
        return redirect("/users/view/".$contact->id);
    }

    public function delete($id) {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        
        return redirect("/users/list");
    }
}
