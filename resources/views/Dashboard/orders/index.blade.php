@extends('includes.dashboard')

@section('title')

@stop


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0 ml-1">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{trans('msite.orders')}}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.welcome')}}">{{trans('msite.Home')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('msite.orders')}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">


            <div class="row">
                <div class="col-md-8">

                    <div class="card card-statistics h-100">
                        @include('includes.errors')
                        <div class="card-header" style="background-color:rgba(0,0,0,.03)">
                            <h5 class="modal-title">{{trans('msite.orders')}}  <small>{{ $orders->total() }}</small></h5>
                        </div>
                        <br>
                        <form action="{{route('dashboard.orders.index')}}" method="get">
                            <div class="row">
                                <div class="col-md-3 ml-3">
                                    <input type="text" name="search" class="form-control" id=""
                                           placeholder="{{trans('msite.search')}}" value="{{request()->search}}">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search fa-fw"></i>
                                        {{trans('msite.search')}}</button>


                                </div>
                            </div>
                        </form>
                        @if ($orders->count() > 0)
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <tr>
                                    <th>@lang('msite.client_name')</th>
                                    <th>@lang('msite.price')</th>
                                    {{--                                        <th>@lang('msite.status')</th>--}}
                                    <th>@lang('msite.created_at')</th>
                                    <th>@lang('msite.action')</th>
                                </tr>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->client->name }}</td>
                                        <td>{{ number_format($order->total_price, 2) }}</td>
                                        {{--<td>--}}
                                        {{--<button--}}
                                        {{--data-status="@lang('msite.' . $order->status)"--}}
                                        {{--data-url="{{ route('dashboard.orders.update_status', $order->id) }}"--}}
                                        {{--data-method="put"--}}
                                        {{--data-available-status='["@lang('msite.processing')", "@lang('msite.finished') "]'--}}
                                        {{--class="order-status-btn btn {{ $order->status == 'processing' ? 'btn-warning' : 'btn-success disabled' }} btn-sm"--}}
                                        {{-->--}}
                                        {{--@lang('msite.' . $order->status)--}}
                                        {{--</button>--}}
                                        {{--</td>--}}
                                        <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm order-products"
                                                    data-url="{{ route('dashboard.orders.products', $order->id) }}"
                                                    data-method="get"
                                            >
                                                <i class="fa fa-list"></i>
                                                @lang('msite.show')
                                            </button>
                                            @if (auth()->user()->hasPermission('orders_update'))
                                                <a href="{{ route('dashboard.clients.orders.edit', ['client' => $order->client->id, 'order' => $order->id]) }}" class="btn btn-warning btn-sm"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                                    </svg> @lang('msite.edit')</a>
                                            @else
                                                <a href="#" disabled class="btn btn-warning btn-sm disabled"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                                    </svg> @lang('msite.edit')</a>
                                            @endif

                                            @if (auth()->user()->hasPermission('orders_delete'))
                                                <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="post" style="display: inline-block;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}

                                                    <button type="button" class="btn delete btn-danger btn-sm" href="#" data-toggle="modal" data-target="#delete-{{$order->id}}">
                                                        <i class="fas fa-trash">
                                                        </i>
                                                        {{trans('msite.delete')}}
                                                    </button>
                                                    <form action="{{ route('dashboard.products.destroy', $order->id) }}" method="post">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}


                                                        <div class="modal fade" id="delete-{{$order->id}}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title"><i class="icon fas fa-exclamation-triangle"></i> @lang('msite.confirm_delete')</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>@lang('msite.are_you_sure_delete_order_of') "{{$order->client->name}}"</p>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">

                                                                        <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:rgba(0,0,0,.03)">@lang('msite.close')</button>


                                                                        <button type="submit" class="btn delete btn-danger">@lang('msite.confirm')</button>

                                                                    </div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                    </form>





                                                </form>

                                            @else
                                                <a href="#" class="btn btn-danger btn-sm disabled" disabled><i class="fa fa-trash"></i> @lang('msite.delete')</a>
                                            @endif

                                        </td>

                                    </tr>

                                @endforeach



                            </table>
                            <br>
                            {{ $orders->appends(request()->query())->links() }}

                        </div>

                        @else

                            <div class="card-body">
                                <h3>@lang('msite.no_records')</h3>
                            </div>

                        @endif










                        </div>
                </div> <!--end if col-8-->
                <div class="col-md-4">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" style="margin-bottom: 10px">@lang('msite.show_products')</h3>
                        </div><!-- end of card header -->

                        <div class="card-body">

                            <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                                <div class="loader"></div>
                                <p style="margin-top: 10px">@lang('msite.loading')</p>
                            </div>

                            <div id="order-product-list">

                            </div><!-- end of order product list -->

                        </div><!-- end of card body -->

                    </div><!-- end of card -->

                </div><!-- end of col -->
            </div>

        </section>
    </div>

@endsection
@section('js')

@endsection
