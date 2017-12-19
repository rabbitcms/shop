@extends(\Request::ajax() ? 'backend::layouts.empty' : 'backend::layouts.master')
@section('content')
    <div id="shop" data-require="rabbitcms/shop:init" data-permanent="permanent" class="ajax-portlet">
        <router-view></router-view>
    </div>
@stop