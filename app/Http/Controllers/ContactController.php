<?php

namespace App\Http\Controllers;

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
        return view('pages.contact', ['categories' => $categories, 'emails' => $emails, 'editContactEmailWise' => null, 'edit' => false]);
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
        foreach ($emails as $email) {
            Email::create([
                'email' => $email,
                'contact_id' => $contact->id
            ]);
        }
        return redirect(url('/'))->with('success', 'Contact Added Successfully!');
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
                $query->where('company', 'LIKE', "%$request->search%")->orWhere('phone', 'LIKE', "$request->search");
            })->paginate(15);

        $categories = Category::get();
        return view('pages.contact', ['emails' => $emails, 'categories' => $categories, 'editContactEmailWise' => null, 'edit' => false]);
    }
    
    public function bulkaction(Request $request)
    {
        dd($request->all());
        // if($request->action == 'active')
        // {
        //     dd('active');
        // }
        // else if($request->action == 'inactive')
        // {
        //     dd('inactive');
        // }
        // else
        // {
        //     dd('null');
        // }
    }
}
