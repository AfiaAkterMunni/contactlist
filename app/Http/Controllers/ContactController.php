<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function show()
    {
        $emails = Email::with('contact')->get();
        // dd($emails);
        // $contacts = Contact::with('emails')->get();
        $categories = Category::get();
        return view('pages.contact', ['categories' => $categories, 'emails' => $emails, 'editContact' => null, 'edit' => false]);
    }

    public function store(StoreContactRequest $request)
    {
        $emails = $request->emails;
        $data = [
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'phone' => $request->input('phone'),
            'website' => $request->input('website'),
            'company' => $request->input('company'),
            'category_id' => $request->input('category'),
            'country' => $request->input('country'),
            'address' => $request->input('address'),
            'created_by' => Auth::id()
        ];
        $contact = Contact::create($data);
        foreach($emails as $email)
        {
            Email::create([
                'email' => $email,
                'contact_id' => $contact->id
            ]);
        }
        return redirect(url('/'))->with('success', 'Contact Added Successfully!');
    }
    public function edit($id)
    {
        $editContact = Contact::with('emails')->find($id);
        $emails = Email::with('contact')->get();
        $categories = Category::get();
        return view('pages.contact', ['editContact' => $editContact, 'emails' =>$emails, 'categories' => $categories, 'edit' => true]);
    }

    public function update(Request $request, $id)
    {
        Contact::where('id', $id)->update([
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'phone' => $request->input('phone'),
            'website' => $request->input('website'),
            'company' => $request->input('company'),
            'category_id' => $request->input('category'),
            'country' => $request->input('country'),
            'address' => $request->input('address'),
        ]);
        // dd($request);
        // Category::where('id', $id)->update([
        //     'name' => $request->name
        // ]);
        return redirect(url('/'))->with('editsuccess', 'Contact Updated Successfully!');
    }
}
