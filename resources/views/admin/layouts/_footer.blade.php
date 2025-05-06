@php $websiteSetting = App\Models\WebsiteSetting::first(); @endphp

<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
            <p>{{$websiteSetting->copyright}}</p>
            </div>
        </div>
    </div>
</footer>