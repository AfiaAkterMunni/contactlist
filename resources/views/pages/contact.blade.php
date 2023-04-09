@extends('layouts.master')
@section('title', 'Contact')
@section('content')
<div class="content-area">
    <div class="row module-header">
        <h2 class="col-md-3 currentModule">
            <div class="page-icon"><i class="mailer-icon"></i></div>
            Contact
            <a href="#" class="popup btn btn_a" data-w="750" onclick="openContactForm()" style="min-width: 110px">
                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                    <title>Add Contact</title>
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M256 112v288M400 256H112"></path>
                </svg>
                <div class="add-label">
                    Add Contact
                </div>
            </a>
        </h2>
        <div class="col-md-1"></div>
        <div class="col-md-6">
            <div class="row">
                @if (auth()->user()->hasRole('admin'))
                <div class="col-md-8">
                    <form action="{{route('contact.search')}}" method="GET">
                        @csrf
                        <div class="search-input input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search" style="margin-right: 5px; border-radius: 5px; min-width:60px">
                            <span class="input-group-btn">
                                <button class="btn btn_a" type="submit" style="font-size: 14px; min-width:65px">Search</button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <a href="#" class="btn btn_a" style="min-width: 85px">
                        <svg fill="#448ac1" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="ionicon">
                            <title>Download</title>
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M2.5 14.75h11V16h-11zm.39-5.45 4.27 3.88a1.26 1.26 0 0 0 1.68 0l4.27-3.88a1.25 1.25 0 0 0-.84-2.18H9.8V1.25A1.25 1.25 0 0 0 8.55 0h-1.1A1.25 1.25 0 0 0 6.2 1.25v5.87H3.73a1.25 1.25 0 0 0-.84 2.18zm.84-.93h3.72V1.25h1.1v7.12h3.72L8 12.25 3.73 8.37z">
                                </path>
                            </g>
                        </svg>
                        <div class="add-label">
                            Download
                        </div>
                    </a>
                </div>
                @endif
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                <title>Sync</title>
                <path d="M434.67 285.59v-29.8c0-98.73-80.24-178.79-179.2-178.79a179 179 0 00-140.14 67.36m-38.53 82v29.8C76.8 355 157 435 256 435a180.45 180.45 0 00140-66.92" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"></path>
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M32 256l44-44 46 44M480 256l-44 44-46-44"></path>
            </svg>
        </div>
        <div class="col-md-.5 sm-none">
            <!-- Right -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect user-dropdown-toggler" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" onclick="myFunction()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <title>User</title>
                            <path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32">
                            </path>
                            <path d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path>
                        </svg>
                    </a>
                    <div class="dropdown-menu drop_manu" aria-labelledby="navbarDropdownMenuLink" id="myDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                    </div>
                </li>
            </ul>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
    <div class="mobile-nav">
        <div class="nav-item">
            <div class="nav-toggler" onclick="navToggle()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="nav-item">
            <div class="loader" onclick="sysnData()">
                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                    <title>Sync</title>
                    <path d="M434.67 285.59v-29.8c0-98.73-80.24-178.79-179.2-178.79a179 179 0 00-140.14 67.36m-38.53 82v29.8C76.8 355 157 435 256 435a180.45 180.45 0 00140-66.92" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32">
                    </path>
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M32 256l44-44 46 44M480 256l-44 44-46-44"></path>
                </svg>
            </div>
        </div>
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect user-dropdown-toggler" id="navbarDropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                    <title>User</title>
                    <path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                    <path d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                </svg>
            </a>
            <div class="dropdown-menu drop_manu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>

            </div>
        </div>
    </div>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible mb-0" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('success') }}
    </div>
    @endif
    @if (session('editsuccess'))
    <div class="alert alert-success alert-dismissible mb-0" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('editsuccess') }}
    </div>
    @endif
    @if (session('deletesuccess'))
    <div class="alert alert-success alert-dismissible mb-0" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('deletesuccess') }}
    </div>
    @endif
    @error('name')
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" style="font-size: 30px;">×</button>
        <p>{{ $message }}</p>
    </div>
    @enderror
    @error('email')
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" style="font-size: 30px;">×</button>
        <p>{{ $message }}</p>
    </div>
    @enderror
    @error('uniqueEmails')
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" style="font-size: 30px;">×</button>
        <p>{{ $message }}</p>
    </div>
    @enderror
    @error('emails')
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" style="font-size: 30px;">×</button>
        <p>{{ $message }}</p>
    </div>
    @enderror
    @error('emails.*')
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" style="font-size: 30px;">×</button>
        <p>{{ $message }}</p>
    </div>
    @enderror
    @error('mobile')
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" style="font-size: 30px;">×</button>
        <p>{{ $message }}</p>
    </div>
    @enderror
    @error('phone')
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" style="font-size: 30px;">×</button>
        <p>{{ $message }}</p>
    </div>
    @enderror
    @error('website')
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" style="font-size: 30px;">×</button>
        <p>{{ $message }}</p>
    </div>
    @enderror
    @error('company')
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" style="font-size: 30px;">×</button>
        <p>{{ $message }}</p>
    </div>
    @enderror
    @error('category')
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" style="font-size: 30px;">×</button>
        <p>{{ $message }}</p>
    </div>
    @enderror
    @error('country')
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" style="font-size: 30px;">×</button>
        <p>{{ $message }}</p>
    </div>
    @enderror
    @error('address')
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" style="font-size: 30px;">×</button>
        <p>{{ $message }}</p>
    </div>
    @enderror
    @error('emailIds')
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" style="font-size: 30px;">×</button>
        <p>{{ $message }}</p>
    </div>
    @enderror
    @error('action')
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" style="font-size: 30px;">×</button>
        <p>{{ $message }}</p>
    </div>
    @enderror
    <div id="page-content-wrapper">
        <div class="container-fluid xyz">
            <div class="row">
                <div class="col-lg-12 ">
                    <div id="datalist">
                        @if (count($emails) > 0)
                        <form action="{{route('contact.bulkaction')}}" method="POST">
                            @csrf
                            <div class="data-wraper">
                                <div class="data-wrap">
                                    <table class="databuilder-table table table-bordered table-striped info_table table-contact">
                                        <thead>
                                            <tr>
                                                <th class="bulk-action-th" width="2%">
                                                    <input value="" type="checkbox" id="allSelect" class="styled-checkbox">
                                                    <label class="checkbox-custom-label" for="allSelect"></label>
                                                </th>
                                                <th class="col-company" width="15%">
                                                    <div class="table-header-item">
                                                        <div class="headItem">Company Name</div>
                                                    </div>
                                                </th>
                                                <th class="col-name" width="15%">
                                                    <div class="table-header-item">
                                                        <div class="headItem">Name</div>
                                                    </div>
                                                </th>
                                                <th class="col-email" width="15%">
                                                    <div class="table-header-item">
                                                        <div class="headItem">Email</div>
                                                    </div>
                                                </th>
                                                <th class="col-phone" width="10%">
                                                    <div class="table-header-item">
                                                        <div class="headItem">Mobile No</div>
                                                    </div>
                                                </th>
                                                <th class="col-phone" width="10%">
                                                    <div class="table-header-item">
                                                        <div class="headItem">Phone No</div>
                                                    </div>
                                                </th>
                                                <th class="col-category" width="8%">
                                                    <div class="table-header-item">
                                                        <div class="headItem">Category</div>
                                                    </div>
                                                </th>
                                                <th class="col-address" width="20%">
                                                    <div class="table-header-item">
                                                        <div class="headItem">Address</div>
                                                    </div>
                                                </th>
                                                <th class="col-country" width="15%">
                                                    <div class="table-header-item">
                                                        <div class="headItem">Country</div>
                                                    </div>
                                                </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataTableBody">
                                            @foreach ($emails as $email)
                                            <tr class="data-row-item">
                                                <td class="bulk-action-td" width="2%">
                                                    <input value="{{$email->id}}" type="checkbox" name="emailIds[]" class="styled-checkbox data-check" id="{{$email->id}}">
                                                    <label class="checkbox-custom-label" for="{{$email->id}}"></label>
                                                </td>
                                                <td>{{$email->contact->company}}</td>
                                                <td>{{$email->contact->name}}</td>
                                                <td>{{$email->email}}</td>
                                                <td>{{$email->contact->mobile}}</td>
                                                <td>{{$email->contact->phone}}</td>
                                                <td>{{$email->contact->category->name}}</td>
                                                <td>{{$email->contact->address}}</td>
                                                <td>{{$email->contact->country}}</td>
                                                <td>
                                                    <div class="data-action">
                                                        <a data-w="750" href="{{route('contact.edit', ['id' => $email->id])}}" class="action-edit popup"><i class="mailer-icon edit"></i></a>
                                                        @if($email->status == false)
                                                        <a data-w="750" href="{{route('contact.inactive', ['id' => $email->id])}}" class="action-delete" title="inactive"><i class="mailer-icon delete"></i></a>
                                                        @else
                                                        <a data-w="750" href="{{route('contact.inactive', ['id' => $email->id])}}" class="action-delete" title="active"><i class="mailer-icon act"></i></a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if (auth()->user()->hasRole('admin'))
                                <div class="data-controller-wrap row">
                                    <div class="bulk-action-wrapper col-md-4">
                                        <select class="bulk-action custom-select custom-select-sm" name="action" id="bulk_action">
                                            <option disabled selected>-- With Selected --</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                        <button type="submit" class="bulk-action-btn" id="bulk_action_btn">Apply</button>
                                    </div>
                                    <div class="col-md-4">
                                        {{ $emails->links('includes.paginator') }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </form>
                        @else
                        <div class="alert alert-primary" role="alert">
                            <h4 class="alert-heading">Contact Not Found!!</h4>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ADD CONTACT POP UP DESIGN -->
<div class="popup-wrap" id="myContactForm" style="display: none;">
    <div class="popup-body " style="width:750px"><span class="closePopup" onclick="closeContactForm()"></span>
        <div class="popup-inner">
            <form class="ajx" method="POST" action="{{route('contact.store')}}">
                @csrf
                <div class="row">
                    <div class="formItem col-md-6">
                        <label>Name</label>
                        <div class="fieldArea">
                            <input type="text" name="name" value="" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="formItem col-md-6">
                        <label>Website</label>
                        <div class="fieldArea">
                            <input type="text" name="website" value="" class="form-control" placeholder="Website">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="formItem col-md-6">
                        <label>Mobile</label>
                        <div class="fieldArea">
                            <input type="text" name="mobile" value="" class="form-control" placeholder="Mobile Number">
                        </div>
                    </div>
                    <div class="formItem col-md-6">
                        <label>Phone</label>
                        <div class="fieldArea">
                            <input type="text" name="phone" value="" class="form-control" placeholder="Phone Number">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="formItem col-md-6">
                        <label>Company</label>
                        <div class="fieldArea">
                            <input type="text" name="company" value="" class="form-control" placeholder="Company">
                        </div>
                    </div>
                    <div class="formItem col-md-6">
                        <label>Address</label>
                        <div class="fieldArea">
                            <input type="text" name="address" value="" class="form-control" placeholder="Address">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="formItem col-md-6">
                        <label>Category</label>
                        <div class="fieldArea">
                            <select class="form-control pt-1" name="category" style="font-size: 15px;">
                                <option disabled selected>-- Select Contact Category --</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="formItem col-md-6">
                        <label>Country</label>
                        <div class="fieldArea">
                            <input type="text" name="country" value="" class="form-control" placeholder="Country">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="formItem col-md-12">
                        <label>Email</label>
                        <div class="fieldArea">
                            <textarea name="emails" class="form-control" placeholder="Email Address"></textarea>
                        </div>
                    </div>
                </div>
                <div class="formItem">
                    <label></label>
                    <button type="submit" class="btn btn-primary mailer-primary-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- EDIT CONTACT POP UP DESIGN -->
@if(isset($editContactEmailWise))
<div class="popup-wrap" id="editContactForm" style="display: @if ($edit)
    block
@else
    none
@endif">
    <div class="popup-body " style="width:750px"><a href="{{route('contact')}}" class="closePopup"></a>
        <div class="popup-inner">
            <form class="ajx" method="POST" action="{{route('contact.update', ['id' => $editContactEmailWise->id])}}">
                @csrf
                <div class="row">
                    <div class="formItem col-md-6">
                        <label>Name</label>
                        <div class="fieldArea">
                            <input type="text" name="name" value="{{$editContactEmailWise->contact->name}}" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="formItem col-md-6">
                        <label>Website</label>
                        <div class="fieldArea">
                            <input type="text" name="website" value="{{$editContactEmailWise->contact->website}}" class="form-control" placeholder="Website">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="formItem col-md-6">
                        <label>Mobile</label>
                        <div class="fieldArea">
                            <input type="text" name="mobile" value="{{$editContactEmailWise->contact->mobile}}" class="form-control" placeholder="Mobile Number">
                        </div>
                    </div>
                    <div class="formItem col-md-6">
                        <label>Phone</label>
                        <div class="fieldArea">
                            <input type="text" name="phone" value="{{$editContactEmailWise->contact->phone}}" class="form-control" placeholder="Phone Number">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="formItem col-md-6">
                        <label>Company</label>
                        <div class="fieldArea">
                            <input type="text" name="company" value="{{$editContactEmailWise->contact->company}}" class="form-control" placeholder="Company">
                        </div>
                    </div>
                    <div class="formItem col-md-6">
                        <label>Address</label>
                        <div class="fieldArea">
                            <input type="text" name="address" value="{{$editContactEmailWise->contact->address}}" class="form-control" placeholder="Address">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="formItem col-md-6">
                        <label>Category</label>
                        <div class="fieldArea">
                            <select class="form-control pt-1" name="category" style="font-size: 15px;">
                                <option disabled selected>-- Select Contact Category --</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" @if ($editContactEmailWise->contact->category_id == $category->id) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="formItem col-md-6">
                        <label>Country</label>
                        <div class="fieldArea">
                            <input type="text" name="country" value="{{$editContactEmailWise->contact->country}}" class="form-control" placeholder="Country">
                        </div>
                    </div>
                </div>
                <div class="formItem col-md-12">
                    <label>Email</label>
                    <div class="fieldArea">
                        <input type="text" name="email" value="{{$editContactEmailWise->email}}" class="form-control" placeholder="Email Address">
                    </div>
                </div>

                <div class="formItem">
                    <label></label>
                    <button type="submit" class="btn btn-primary mailer-primary-btn">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif


<script>
    // contact popup open
    function openContactForm() {
        document.getElementById("myContactForm").style.display = "block";
    }

    // contact popup close
    function closeContactForm() {
        document.getElementById("myContactForm").style.display = "none";
    }
    // edit contact popup close
    // function closeContactEditForm() {
    //     document.getElementById("editContactForm").style.display = "none";
    // }
    //logout dropdown
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
        document.getElementById("myDropdown").style = "position: absolute; transform: translate3d(-54px, 20px, 0px); top: 0px; left: 0px; will-change: transform;";
    }

    let check = document.getElementById('allSelect');
    check.addEventListener('click', function() {
        let checkboxes = document.getElementsByClassName('data-check');
        let n = checkboxes.length;
        for (let i = 0; i < n; i++) {
            checkboxes[i].checked = check.checked;
        }
    });

    let deletedata = document.getElementById('bulk_action_btn');
    console.log(deletedata.value);
    deletedata.addEventListener('click', function() {
        let selectitems = document.getElementsByClassName('data-check');
        let n = selectitems.length;
        for (let i = 0; i < n; i++) {
            if (selectitems[i].checked == true) {
                console.log(selectitems[i].value);
            }
        }
    });
    // console.log(selectitems);
</script>
@endsection