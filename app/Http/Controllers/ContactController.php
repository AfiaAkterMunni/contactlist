<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Email;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function show()
    {
        $contacts = Contact::get();
        // dd($contacts); 
        $categories = Category::get();
        return view('pages.contact', ['categories' => $categories, 'contacts' => $contacts]);
    }

    public function store(StoreContactRequest $request)
    {
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
        dd($data);
        $contact = Contact::create($data);
        Email::create([
            'email' => $request->input('email'),
            'contact_id' => $contact->id
        ]);
        return redirect(url('/'))->with('success', 'Contact Added Successfully!');
    }
}
