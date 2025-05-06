
<div class="row inline-page-menu my-4">
    <ul class="list-unstyled d-flex flex-wrap gap-3 mx-3">
        <li class="{{ Request::is('admin/website-setting/website-setting') ?'active':'' }} mx-3">
            <a href="{{ route('admin.website-setting.index') }}">
                Website Setting <span></span>
            </a>
        </li>
        
       {{-- <li class="text-capitalize {{ Request::is('admin/website-setting/banners') || Request::is('admin/business-setting/banners') || Request::is('admin/business-setting/banners') ? 'active' : '' }}">
            <a href="{{ route('admin.website-setting.banners') }}">Home Banners</a>
        </li>   --}}      
       
        {{-- <li class="{{ Request::is('business/bookings/previous') ?'active':'' }} mx-3">
            <a href="{{ route('admin.business-setting.terms-conditions') }}">Terms & Condition</a>
        </li> --}}
        {{-- <li class="text-capitalize {{ Request::is('business/bookings/canceled') ?'active':'' }} mx-3">
            <a href="">Canceled Bookings</a>
        </li> --}}
        
    </ul>
</div>
