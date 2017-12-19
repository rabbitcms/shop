@extends(\Request::ajax() ? 'backend::layouts.empty' : 'backend::layouts.master')
@section('content')
    <div class="portlet box blue-hoki ajax-portlet" data-require="rabbitcms/shop:table" data-permanent="permanent">
        <div class="portlet-title">
            <div class="caption">@mlang('backend.Products')</div>
            <div class="actions">
                @can('shop.products.write')
                    <a class="btn btn-default btn-sm" rel="ajax-portlet"
                       href="{{route('backend.shop.products.create')}}">
                        <i class="fa fa-plus"></i> @mlang('backend::common.buttons.create')</a>
                @endcan
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover data-table"
                       data-link="{{route('backend.shop.products.index',[],false)}}">
                    <thead>
                    <tr role="row" class="heading">
                        <th style="width: 100px;">@mlang('backend.Id')</th>
                        <th>@mlang('backend.Article')</th>
                        <th>@mlang('backend.Caption')</th>
                        <th style="width: 100px;">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@stop
