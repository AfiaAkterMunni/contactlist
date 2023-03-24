@extends('layouts.master')
@section('title', 'Categories')
@section('content')

<div class="content-area">
    <div class="module-header">
        <h2 class="currentModule">
            <div class="page-icon"><i class="mailer-icon"></i></div>
            Categories
            <a href="#" class="popup btn btn_a" data-w="750" onclick="openCategoryForm()">
                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                    <title>Add Category</title>
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M256 112v288M400 256H112"></path>
                </svg>
                <div class="add-label">
                    Add Category
                </div>
            </a>
        </h2>
        <div class="header-right sm-none">
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
    @error('name')
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
                        <div class="data-wraper">
                            <div class="data-wrap">
                                <table class="databuilder-table table table-bordered table-striped info_table table-contact">
                                    <thead>
                                        <tr>
                                            <th class="bulk-action-th" width="2%">
                                                <input value="" type="checkbox" id="allSelect" class="styled-checkbox">
                                                <label class="checkbox-custom-label" for="allSelect"></label>
                                            </th>
                                            <th class="col-company" width="10%">
                                                <div class="table-header-item">
                                                    <div class="headItem">#</div>
                                                </div>
                                            </th>
                                            <th class="col-company" width="40%">
                                                <div class="table-header-item">
                                                    <div class="headItem">Category Name</div>
                                                </div>
                                            </th>
                                            <th class="col-name" width="40%">
                                                <div class="table-header-item">
                                                    <div class="headItem">Created By</div>
                                                </div>
                                            </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataTableBody">
                                        @foreach ($categories as $key => $category)
                                            <tr class="data-row-item">
                                                <td class="bulk-action-td" width="2%">
                                                    <input value="1" type="checkbox" class="styled-checkbox data-check" id="dataCheck10">
                                                    <label class="checkbox-custom-label" for="dataCheck10"></label>
                                                </td>
                                                <td class="col-company">{{$key + 1}}</td>
                                                <td class="col-company">{{$category->name}}</td>
                                                <td class="col-name"><span title="Contact Lists : ">{{$category->user->name}}</span></td>
                                                <td>
                                                    <div class="data-action">
                                                        <a data-w="750" href="{{route('category.edit', ['id' => $category->id])}}" class="action-edit popup"><i class="mailer-icon edit" style="width: 20px;"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="data-controller-wrap">
                                <div class="bulk-action-wrapper">
                                    <select class="bulk-action custom-select custom-select-sm" id="bulk_action">
                                        <option value=""></option>
                                        <option value="delete">Delete Selected</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    <button class="bulk-action-btn" id="bulk_action_btn">Apply</button>
                                </div>
                                <div class="item-per-page">
                                    <div class="item-per-page-toggle">
                                        <label>Per Page </label>
                                        <input type="number" id="ippIn" min="1"><span></span>
                                    </div>
                                    <ul id="ippList">
                                        <li>22</li>
                                        <li>50</li>
                                        <li>100</li>
                                        <li>500</li>
                                        <li>1000</li>
                                        <li>5000</li>
                                    </ul>
                                </div>
                                <div class="pagination-wrap pagination">
                                    <a href="" class="active" onclick="">1</a>
                                    <a href="" class="" onclick="">2</a>
                                    <a href="" class="" onclick="">Next »</a>
                                    <a href="" onclick="">Last</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ADD CATEGORY POP UP DESIGN -->
<div class="popup-wrap" id="myCategoryForm" style="display: none;">
    <div class="popup-body " style="width:550px"><span class="closePopup" onclick="closeCategoryForm()"></span>
        <div class="popup-inner">
            <form class="ajx" method="POST" action="{{route('category.store')}}">
                @csrf
                <div class="formItem">
                    <label class="mr-2">Category Name</label>
                    <div class="fieldArea">
                        <input type="text" name="name" value="" class="form-control" placeholder="Category Name" required>
                    </div>
                </div>
                @error('name')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror

                <div class="formItem">
                    <label class="mr-5"></label>
                    <button type="submit" class="btn btn-primary mailer-primary-btn mt-3">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit CATEGORY POP UP DESIGN -->
@if(isset($editCategory))
<div class="popup-wrap" id="editform" style="display: @if ($edit)
    block
@else
    none
@endif">
    <div class="popup-body " style="width:550px"><a href="{{route('categories')}}" class="closePopup"></a>
        <div class="popup-inner">
            <form class="ajx" method="POST" action="{{route('category.update', ['id' => $editCategory->id])}}">
                @csrf
                <div class="formItem">
                    <label class="mr-2">Category Name</label>
                    <div class="fieldArea">
                        <input type="text" name="name" value="{{ $editCategory->name }}" class="form-control" placeholder="Category Name" required>
                    </div>
                </div>
                @error('name')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror

                <div class="formItem">
                    <label class="mr-5"></label>
                    <button type="submit" class="btn btn-primary mailer-primary-btn mt-3">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif


<script>
    // category popup open
    function openCategoryForm() {
        document.getElementById("myCategoryForm").style.display = "block";
    }

    // category popup close
    function closeCategoryForm() {
        document.getElementById("myCategoryForm").style.display = "none";
    }
    // edit category popup close
    // function closeCategoryEditForm() {
    //     document.getElementById("editform").style.display = "none";
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