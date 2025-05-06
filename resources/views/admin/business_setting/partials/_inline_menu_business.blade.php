
<div class="row inline-page-menu my-4">
    <ul class="list-unstyled d-flex flex-wrap gap-3 mx-3">
        <li class="{{ Request::is('business/bookings') ?'active':'' }} mx-3">
            <a href="{{ route('admin.business-setting.about-us') }}">
                About Us <span></span>
            </a>
        </li>
        
        <li class="text-capitalize {{ Request::is('admin/business-setting/privacy-policy') || Request::is('admin/business-setting/terms-conditions') || Request::is('admin/business-setting/privacy-policy') ? 'active' : '' }}">
            <a href="{{ route('admin.business-setting.privacy-policy') }}">Privacy Policy</a>
        </li>        
        <li class="text-capitalize {{ Request::is('admin/business-setting/refund-policy') || Request::is('admin/business-setting/terms-conditions') || Request::is('admin/business-setting/privacy-policy') ? 'active' : '' }}">
            <a href="{{ route('admin.business-setting.refund-policy') }}">Refund Policy</a>
        </li>        
       
        <li class="{{ Request::is('business/bookings/previous') ?'active':'' }} mx-3">
            <a href="{{ route('admin.business-setting.terms-conditions') }}">Terms & Condition</a>
        </li>
        <li class="text-capitalize {{ Request::is('business/bookings/canceled') ?'active':'' }} mx-3">
            <a href="{{route('admin.business-setting.why-choose-us')}}">Why Choose US</a>
        </li>
        
    </ul>
</div>
