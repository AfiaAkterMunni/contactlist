@extends('layouts.master')
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
        <div class="loader">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                <title>Sync</title>
                <path d="M434.67 285.59v-29.8c0-98.73-80.24-178.79-179.2-178.79a179 179 0 00-140.14 67.36m-38.53 82v29.8C76.8 355 157 435 256 435a180.45 180.45 0 00140-66.92" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"></path>
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M32 256l44-44 46 44M480 256l-44 44-46-44"></path>
            </svg>
        </div>
        <div class="searchBox">
            <div class="search-input">
                <span class="searchCancel" onclick="searchCancel(event)">×</span>
                <input type="text" onkeyup="searchData(event)" placeholder="Search" class="searchInput form-control">
            </div>
        </div>
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
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
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
                                            <th class="col-company" width="20%">
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
                                        <tr class="data-row-item">
                                            <td class="bulk-action-td" width="2%">
                                                <input value="1" type="checkbox" class="styled-checkbox data-check" id="dataCheck10">
                                                <label class="checkbox-custom-label" for="dataCheck10"></label>
                                            </td>
                                            <td class="col-company">Franz Barta GmbH</td>
                                            <td class="col-name"><span title="Contact Lists : ">Franz Barta GmbH</span></td>
                                            <td class="col-email">office@barta.at</td>
                                            <td class="col-phone">+43 1 8946894</td>
                                            <td class="col-category">Apparel</td>
                                            <td class="col-address">null</td>
                                            <td class="col-country">Austria</td>
                                            <td>
                                                <div class="data-action"><a data-w="750" href="/contact/edit/10" class="action-edit popup"><i class="mailer-icon edit"></i></a><a onclick="deleteData(event,this)" href="/contact/delete/10" class="action-delete "><i class="mailer-icon delete"></i></a></div>
                                            </td>
                                        </tr>
                                        <tr class="data-row-item">
                                            <td class="bulk-action-td" width="2%"><input value="2" type="checkbox" class="styled-checkbox data-check" id="dataCheck9"><label class="checkbox-custom-label" for="dataCheck9"></label></td>
                                            <td class="col-company">The Woolmark Company</td>
                                            <td class="col-name"><span title="Contact Lists : ">The Woolmark Company</span></td>
                                            <td class="col-email">trade-extension@wool.com</td>
                                            <td class="col-phone">+61 2 8295310-0</td>
                                            <td class="col-category">Apparel</td>
                                            <td class="col-address">null</td>
                                            <td class="col-country">Australia</td>
                                            <td>
                                                <div class="data-action"><a data-w="750" href="/contact/edit/9" class="action-edit popup"><i class="mailer-icon edit"></i></a><a onclick="deleteData(event,this)" href="/contact/delete/9" class="action-delete "><i class="mailer-icon delete"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="data-row-item">
                                            <td class="bulk-action-td" width="2%">
                                                <input value="3" type="checkbox" class="styled-checkbox data-check" id="dataCheck8">
                                                <label class="checkbox-custom-label" for="dataCheck8"></label>
                                            </td>
                                            <td class="col-company">R*CONCEPT by Ferrer-Dalmau</td>
                                            <td class="col-name">
                                                <span title="Contact Lists : ">R*CONCEPT by Ferrer-Dalmau</span>
                                            </td>
                                            <td class="col-email">wer@livingrconcept.com</td>
                                            <td class="col-phone">+34 93 4874015</td>
                                            <td class="col-category">Apparel</td>
                                            <td class="col-address">null</td>
                                            <td class="col-country">&ZeroWidthSpace;&ZeroWidthSpace;Spain</td>
                                            <td>
                                                <div class="data-action"><a data-w="750" href="/contact/edit/8" class="action-edit popup"><i class="mailer-icon edit"></i></a><a onclick="deleteData(event,this)" href="/contact/delete/8" class="action-delete "><i class="mailer-icon delete"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="data-row-item">
                                            <td class="bulk-action-td" width="2%"><input value="4" type="checkbox" class="styled-checkbox data-check" id="dataCheck7"><label class="checkbox-custom-label" for="dataCheck7"></label></td>
                                            <td class="col-company">SmartSports4GoodLife</td>
                                            <td class="col-name"><span title="Contact Lists : ">SmartSports4GoodLife</span></td>
                                            <td class="col-email">mcentellas@indescat.org</td>
                                            <td class="col-phone">+34 93 7824474</td>
                                            <td class="col-category">Apparel</td>
                                            <td class="col-address">null</td>
                                            <td class="col-country">&ZeroWidthSpace;&ZeroWidthSpace;Spain</td>
                                            <td>
                                                <div class="data-action"><a data-w="750" href="/contact/edit/7" class="action-edit popup"><i class="mailer-icon edit"></i></a><a onclick="deleteData(event,this)" href="/contact/delete/7" class="action-delete "><i class="mailer-icon delete"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="data-row-item">
                                            <td class="bulk-action-td" width="2%"><input value="5" type="checkbox" class="styled-checkbox data-check" id="dataCheck6"><label class="checkbox-custom-label" for="dataCheck6"></label></td>
                                            <td class="col-company">FOOTBALL FACTORY - Mariánské Hory-Ostrava</td>
                                            <td class="col-name"><span title="Contact Lists : ">Zoncolan s.r.o.</span></td>
                                            <td class="col-email">info@arsyline.cz</td>
                                            <td class="col-phone">+420 603 918 478</td>
                                            <td class="col-category">Promo</td>
                                            <td class="col-address">Mojmírovců 200/8 709 00 Ostrava-Marianske Hory, CZ</td>
                                            <td class="col-country">CZECH REPUBLIC</td>
                                            <td>
                                                <div class="data-action"><a data-w="750" href="/contact/edit/6" class="action-edit popup"><i class="mailer-icon edit"></i></a><a onclick="deleteData(event,this)" href="/contact/delete/6" class="action-delete "><i class="mailer-icon delete"></i></a>
                                                </div>
                                            </td>
                                        </tr>
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
            <form class="ajx" action="">
                <div class="formItem">
                    <label class="mr-2">Category Name</label>
                    <div class="fieldArea">
                        <input type="text" name="category" value="" class="form-control" placeholder="Category Name">
                    </div>
                </div>
                <div class="formItem">
                    <label class="mr-5"></label>
                    <button type="submit" class="btn btn-primary mailer-primary-btn mt-3">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>

    // category popup open
    function openCategoryForm() {
      document.getElementById("myCategoryForm").style.display = "block";
    }

    // category popup close
    function closeCategoryForm() {
      document.getElementById("myCategoryForm").style.display = "none";
    }

    //logout dropdown
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
      document.getElementById("myDropdown").style = "position: absolute; transform: translate3d(-54px, 20px, 0px); top: 0px; left: 0px; will-change: transform;";
    }

    let check = document.getElementById('allSelect');
    check.addEventListener('click', function () {
      let checkboxes = document.getElementsByClassName('data-check');
      let n = checkboxes.length;
      for (let i = 0; i < n; i++) {
        checkboxes[i].checked = check.checked;
      }
    });

    let deletedata = document.getElementById('bulk_action_btn');
    deletedata.addEventListener('click', function () {
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