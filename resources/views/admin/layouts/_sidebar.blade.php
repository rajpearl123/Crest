@php($admin = Auth::guard('admin')->user())
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="bx bx-home-circle"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @if ($admin && ($admin->isSuperAdmin() || $admin->hasPermission('Subscribers')))
                    <li>
                        <a href="{{ route('admin.subscribers') }}">
                            <i class="bx bx-user-plus"></i>
                            <span>Subscribers</span>
                        </a>
                    </li>
                @endif
                @if ($admin && ($admin->isSuperAdmin() || $admin->hasPermission('Contact Us')))
                    <li>
                        <a href="{{ route('admin.contact-list') }}">
                            <i class="bx bx-envelope"></i>
                            <span>Contact Us</span>
                        </a>
                    </li>
                @endif
                @if ($admin && ($admin->isSuperAdmin() || $admin->hasPermission('Contact Us')))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-envelope"></i> <!-- Icon for Manage Contact Info (envelope for contact) -->
                            <span key="t-ecommerce">Manage Contact Info</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('admin.contact-info.view') }}" key="t-product-detail">
                                    <i class="bx bx-info-circle"></i>
                                    <!-- Icon for Contact Info (info circle for details) -->
                                    Contact Info
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.contact-info.edit') }}" key="t-orders">
                                    <i class="bx bx-edit"></i> <!-- Icon for Update Contact Info (edit for updating) -->
                                    Update Contact Info
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if ($admin && ($admin->isSuperAdmin() || $admin->hasPermission('Business Setting')))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-briefcase"></i>
                            <span key="t-ecommerce">Business Setting</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.business-setting.social-links') }}" key="t-product-detail"><i
                                        class="bx bx-link"></i> Social Links</a></li>
                            <li><a href="{{ route('admin.website-setting.index') }}" key="t-orders"><i
                                        class="bx bx-globe"></i> Website Setting</a></li>
                        </ul>
                    </li>
                @endif
                @if ($admin && $admin->isSuperAdmin())
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-slideshow"></i>
                            <span key="t-ecommerce">Slider Setting</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.banners.index') }}" key="t-products"><i
                                        class="bx bx-list-ul"></i> Slider List</a></li>
                            <li><a href="{{ route('admin.banners.create') }}" key="t-products"><i
                                        class="bx bx-plus"></i> Add Slider</a></li>
                        </ul>
                    </li>
                @endif
                @if ($admin && $admin->isSuperAdmin())
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-image"></i>
                            <span key="t-ecommerce">Page Banner Setting</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.page_banner.index') }}" key="t-products"><i
                                        class="bx bx-list-ul"></i> Banner List</a></li>
                        </ul>
                    </li>
                @endif
                @if ($admin && $admin->isSuperAdmin())
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-photo-album"></i>
                            <span key="t-ecommerce">Home Gallery Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.home_albums.index') }}" key="t-products"><i
                                        class="bx bx-list-ul"></i> Gallery List</a></li>
                            <li><a href="{{ route('admin.home_albums.edit') }}" key="t-products"><i
                                        class="bx bx-edit"></i> Edit Gallery</a></li>
                        </ul>
                    </li>
                @endif
                @if ($admin && $admin->isSuperAdmin())
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-category"></i>
                            <span key="t-ecommerce">Blog Category Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.blog-categories.index') }}" key="t-products"><i
                                        class="bx bx-list-ul"></i> Category List</a></li>
                            <li><a href="{{ route('admin.blog-categories.create') }}" key="t-products"><i
                                        class="bx bx-plus"></i> Add Category</a></li>
                        </ul>
                    </li>
                @endif
                @if ($admin && $admin->isSuperAdmin())
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-news"></i>
                            <span key="t-ecommerce">Blog Setting</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.blogs.index') }}" key="t-products"><i
                                        class="bx bx-list-ul"></i> Blog List</a></li>
                            <li><a href="{{ route('admin.blogs.create') }}" key="t-products"><i class="bx bx-plus"></i>
                                    Add Blog</a></li>
                            <li><a href="{{ route('admin.comments.index') }}" key="t-products"><i
                                        class="bx bx-comment"></i> Manage Comments</a></li>
                        </ul>
                    </li>
                @endif
                @if ($admin && $admin->isSuperAdmin())
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-wrench"></i>
                            <span key="t-ecommerce">Services Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.steps.index') }}" key="t-products"><i
                                        class="bx bx-list-ul"></i> Services List</a></li>
                            <li><a href="{{ route('admin.steps.create') }}" key="t-products"><i
                                        class="bx bx-plus"></i> Add Service</a></li>
                        </ul>
                    </li>
                @endif
                @if ($admin && $admin->isSuperAdmin())
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-images"></i>
                            <span key="t-ecommerce">Gallery Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.gallery.index') }}" key="t-products"><i
                                        class="bx bx-list-ul"></i> Gallery List</a></li>
                            <li><a href="{{ route('admin.gallery.create') }}" key="t-products"><i
                                        class="bx bx-plus"></i> Add Gallery</a></li>
                        </ul>
                    </li>
                @endif
                @if ($admin && $admin->isSuperAdmin())
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-folder"></i>
                            <span key="t-ecommerce">Gallery Category Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.gallery-categories.index') }}" key="t-products"><i
                                        class="bx bx-list-ul"></i> Category List</a></li>
                            <li><a href="{{ route('admin.gallery-categories.create') }}" key="t-products"><i
                                        class="bx bx-plus"></i> Add Category</a></li>
                        </ul>
                    </li>
                @endif
                @if ($admin && $admin->isSuperAdmin())
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-star"></i>
                            <span key="t-ecommerce">Testimonial Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.testimonials.index') }}" key="t-products"><i
                                        class="bx bx-list-ul"></i> Testimonial List</a></li>
                            <li><a href="{{ route('admin.testimonials.create') }}" key="t-products"><i
                                        class="bx bx-plus"></i> Add Testimonial</a></li>
                        </ul>
                    </li>
                @endif
                @if ($admin && $admin->isSuperAdmin())
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-video"></i>
                            <span key="t-ecommerce">Video Gallery Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.video-gallery.index') }}" key="t-products"><i
                                        class="bx bx-list-ul"></i> Video Gallery List</a></li>
                            <li><a href="{{ route('admin.video-gallery.create') }}" key="t-products"><i
                                        class="bx bx-plus"></i> Add Video</a></li>
                        </ul>
                    </li>
                @endif
                @if ($admin && $admin->isSuperAdmin())
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-movie"></i>
                            <span key="t-ecommerce">Home Video Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.video.index') }}" key="t-products"><i
                                        class="bx bx-list-ul"></i> Home Video</a></li>
                            <li><a href="{{ route('admin.video.edit') }}" key="t-products"><i
                                        class="bx bx-edit"></i> Update Home Video</a></li>
                        </ul>
                    </li>
                @endif
                @if ($admin && $admin->isSuperAdmin())
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-info-square"></i>
                            <span key="t-ecommerce">Aboutus page Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.about.index') }}" key="t-products"><i
                                        class="bx bx-book"></i> About Section</a></li>
                            <li><a href="{{ route('admin.why_choose_us.index') }}" key="t-products"><i
                                        class="bx bx-check-shield"></i> Why Choose us Section</a></li>
                            <li><a href="{{ route('admin.choose_us.index') }}" key="t-products"><i
                                        class="bx bx-check-circle"></i> Choose us Section</a></li>
                        </ul>
                    </li>
                @endif
                @if ($admin && $admin->isSuperAdmin())
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-collection"></i>
                            <span key="t-ecommerce">Album Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.albums.index') }}" key="t-products"><i
                                        class="bx bx-list-ul"></i> Album List</a></li>
                            <li><a href="{{ route('admin.albums.create') }}" key="t-products"><i
                                        class="bx bx-plus"></i> Add Album</a></li>
                        </ul>
                    </li>
                @endif


                @if ($admin && $admin->isSuperAdmin())
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-package"></i>
                            <span key="t-ecommerce">Package Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('admin.packages.index') }}" key="t-products">
                                    <i class="bx bx-list-ul"></i> 
                                    Package List
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.packages.create') }}" key="t-products">
                                    <i class="bx bx-add-to-queue"></i>
                                    Add Package
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.packages.user_requests') }}" key="t-products">
                                    <i class="bx bx-question-mark"></i>
                                    Package Queries
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if ($admin && $admin->isSuperAdmin())
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-package"></i>
                            <span key="t-ecommerce">Enquiry Appointments</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('admin.appointments') }}" key="t-products">
                                    <i class="bx bx-list-ul"></i> 
                                    Enquiry List
                                </a>
                            </li>
                           
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
