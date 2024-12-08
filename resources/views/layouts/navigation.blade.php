
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-home"></i><span class="nav-text">Dashboard</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('dashboard')}}">Dashboard 1</a></li>
                            <li><a href="{{route('dashboard2')}}">Dashboard 2</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-app-store"></i><span class="nav-text">Business Settings</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('creed-tags.index')}}">Creed Tags</a></li>
                            <li><a href="{{route('business-type.index')}}">Business Type</a></li>
                            <li><a href="{{route('business-category.index')}}">Business Category</a></li>
                            <li><a href="{{route('business-subcategory.index')}}">Business SubCategory</a></li>
                            <li><a href="{{route('business-tags.index')}}">Business Tags</a></li>
                            <li><a href="{{route('restaurant.index')}}">Restaurant</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-04"></i><span class="nav-text">User Management</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('users.index')}}">Admin Users</a></li>
                            <li><a href="{{route('roles.index')}}">Roles</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('company-info.index')}}" aria-expanded="false">
                        <i class="icon icon-settings"></i><span class="nav-text">Company Info</span></a>
                    </li>
                    <li><a href="{{route('csv.form')}}" aria-expanded="false">
                        <i class="icon icon-globe-2"></i><span class="nav-text">Import CSV</span></a>
                    </li>
                    <li class="nav-label">Apps</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-app-store"></i><span class="nav-text">Apps</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('app-profile')}}">Profile</a></li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Email</a>
                                <ul aria-expanded="false">
                                    <li><a href="{{route('email-compose')}}">Compose</a></li>
                                    <li><a href="{{route('email-inbox')}}">Inbox</a></li>
                                    <li><a href="{{route('email-read')}}">Read</a></li>
                                </ul>
                            </li>
                            <li><a href="{{route('app-calender')}}">Calendar</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-chart-bar-33"></i><span class="nav-text">Charts</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('chart-flot')}}">Flot</a></li>
                            <li><a href="{{route('chart-morris')}}">Morris</a></li>
                            <li><a href="{{route('chart-chartjs')}}">Chartjs</a></li>
                            <li><a href="{{route('chart-chartist')}}">Chartist</a></li>
                            <li><a href="{{route('chart-sparkline')}}">Sparkline</a></li>
                            <li><a href="{{route('chart-peity')}}">Peity</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Components</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-world-2"></i><span class="nav-text">Bootstrap</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('ui-accordion')}}">Accordion</a></li>
                            <li><a href="{{route('ui-alert')}}">Alert</a></li>
                            <li><a href="{{route('ui-badge')}}">Badge</a></li>
                            <li><a href="{{route('ui-button')}}">Button</a></li>
                            <li><a href="{{route('ui-modal')}}">Modal</a></li>
                            <li><a href="{{route('ui-button-group')}}">Button Group</a></li>
                            <li><a href="{{route('ui-list-group')}}">List Group</a></li>
                            <li><a href="./ui-media-object.html">Media Object</a></li>
                            <li><a href="./ui-card.html">Cards</a></li>
                            <li><a href="./ui-carousel.html">Carousel</a></li>
                            <li><a href="./ui-dropdown.html">Dropdown</a></li>
                            <li><a href="./ui-popover.html">Popover</a></li>
                            <li><a href="./ui-progressbar.html">Progressbar</a></li>
                            <li><a href="./ui-tab.html">Tab</a></li>
                            <li><a href="./ui-typography.html">Typography</a></li>
                            <li><a href="./ui-pagination.html">Pagination</a></li>
                            <li><a href="./ui-grid.html">Grid</a></li>

                        </ul>
                    </li>

                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-plug"></i><span class="nav-text">Plugins</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('uc-select2')}}">Select 2</a></li>
                            <li><a href="{{route('uc-nestable')}}">Nestedable</a></li>
                            <li><a href="{{route('uc-noui-slider')}}">Noui Slider</a></li>
                            <li><a href="{{route('uc-sweetalert')}}">Sweet Alert</a></li>
                            <li><a href="{{route('uc-toastr')}}">Toastr</a></li>
                            <li><a href="{{route('map-jqvmap')}}">Jqv Map</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('widget-basic')}}" aria-expanded="false"><i class="icon icon-globe-2"></i><span
                                class="nav-text">Widget</span></a></li>
                    <li class="nav-label">Forms</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-form"></i><span class="nav-text">Forms</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('form-element')}}">Form Elements</a></li>
                            <li><a href="{{route('form-wizard')}}">Wizard</a></li>
                            <li><a href="{{route('form-editor-summernote')}}">Summernote</a></li>
                            <li><a href="{{route('form-pickers')}}">Pickers</a></li>
                            <li><a href="{{route('form-validation-jquery')}}">Jquery Validate</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Table</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-layout-25"></i><span class="nav-text">Table</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('table-bootstrap-basic')}}">Bootstrap</a></li>
                            <li><a href="{{route('table-datatable-basic')}}">Datatable</a></li>
                        </ul>
                    </li>

                    <li class="nav-label">Extra</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-copy-06"></i><span class="nav-text">Pages</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('page-register')}}">Register</a></li>
                            <li><a href="{{route('page-login')}}">Login</a></li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Error</a>
                                <ul aria-expanded="false">
                                    <li><a href="{{route('page-error-400')}}">Error 400</a></li>
                                    <li><a href="{{route('page-error-403')}}">Error 403</a></li>
                                    <li><a href="{{route('page-error-404')}}">Error 404</a></li>
                                    <li><a href="{{route('page-error-500')}}">Error 500</a></li>
                                    <li><a href="{{route('page-error-503')}}">Error 503</a></li>
                                </ul>
                            </li>
                            <li><a href="{{route('page-lock-screen')}}">Lock Screen</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>