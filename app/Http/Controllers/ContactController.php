<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkActionRequest;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function show()
    {
        if (auth()->user()->hasRole('user')) {
            $emails = Email::where('status', true)->whereHas('contact', function ($query) {
                $query->where('created_by', auth()->id());
            })->latest()->limit(5)->get();
        } else {
            $emails = Email::where('status', true)->with('contact')->latest()->paginate(15);
        }
        $categories = Category::get();
        $countries = Contact::distinct()->whereNotNull('country')->get(['country']);
        return view('pages.contact', ['categories' => $categories, 'countries' => $countries, 'emails' => $emails, 'editContactEmailWise' => null, 'edit' => false]);
    }

    public function store(StoreContactRequest $request)
    {
        $emails = $request->input('uniqueEmails');
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
        foreach ($emails as $email) {
            Email::create([
                'email' => $email,
                'contact_id' => $contact->id
            ]);
        }
        $msg = count($emails) . ' new emails added successfully, '. count($request->input('emails'))-count($emails)  . ' emails already exists';
        return redirect(url('/'))->with('success', $msg);
    }

    public function edit($id)
    {
        $editContactEmailWise = Email::with('contact')->find($id);
        if (auth()->user()->hasRole('user')) {
            $emails = Email::where('status', true)->whereHas('contact', function ($query) {
                $query->where('created_by', auth()->id());
            })->latest()->limit(5)->get();
        } else {
            $emails = Email::where('status', true)->with('contact')->latest()->paginate(15);
        }
        $categories = Category::get();
        return view('pages.contact', ['editContactEmailWise' => $editContactEmailWise, 'emails' => $emails, 'categories' => $categories, 'edit' => true]);
    }

    public function update(UpdateContactRequest $request, $id)
    {
        $email = Email::with('contact')->find($id);
        Email::where('id', $id)->update([
            'email' => $request->input('email')
        ]);
        Contact::where('id', $email->contact->id)->update([
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'phone' => $request->input('phone'),
            'website' => $request->input('website'),
            'company' => $request->input('company'),
            'category_id' => $request->input('category'),
            'country' => $request->input('country'),
            'address' => $request->input('address'),
        ]);
        return redirect(url('/'))->with('editsuccess', 'Contact Updated Successfully!');
    }

    public function inactive($id)
    {
        $contact = Email::find($id);

        if ($contact->status == true) {
            Email::where('id', $id)->update([
                'status' => false
            ]);
            return redirect(url('/'))->with('deletesuccess', 'Contact Inactive Successfully!');
        }
        else {
            Email::where('id', $id)->update([
                'status' => true
            ]);
            return redirect(url('/'))->with('deletesuccess', 'Contact Active Successfully!');
        }
        // return redirect(url('/'))->with('deletesuccess', 'Contact Deleted Successfully!');
    }
    
    public function search(Request $request)
    {
        $emails = Email::where('email', 'LIKE', "$request->search")
            ->orWhereHas('contact', function ($query) use ($request) {
                $query->where('company', 'LIKE', "%$request->search%")->orWhere('phone', 'LIKE', "$request->search")->orWhere('country', 'LIKE', "%$request->search%");
            })->paginate(15);

        $categories = Category::get();
        return view('pages.contact', ['emails' => $emails, 'categories' => $categories, 'editContactEmailWise' => null, 'edit' => false]);
    }
    
    
    public function getContactByCategory($id)
    {
        $emails = Email::whereHas('contact', function($query) use($id) {
                $query->where('category_id', $id);
            })->paginate(15);

        $categories = Category::get();
        return view('pages.contact', ['emails' => $emails, 'categories' => $categories, 'editContactEmailWise' => null, 'edit' => false]);
    }

    public function bulkaction(BulkActionRequest $request)
    {
        Email::whereIn('id', $request->input('emailIds'))->update([
            'status' => $request->input('action') == 'active' ? true : false
        ]);
        $msg = $request->input('action') == 'active' ? 'Contacts Active Successfully!' : 'Contacts Inactive Successfully!';
        return redirect(url('/'))->with('deletesuccess', $msg);
    }
    
}
