@extends('includes.dashboard')

@section('title')
    @lang('msite.edit_order')
@stop


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0 ml-1">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{trans('msite.edit_order')}}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.welcome')}}">{{trans('msite.Home')}}</a></li>


                            <li class="breadcrumb-item "><a
                                    href="{{route('dashboard.orders.index')}}">{{trans('msite.orders')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('msite.edit_order')}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">

            <div class="row">


                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" style="margin-bottom: 10px">@lang('msite.categories')</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">


                                @foreach($categories as $category)
                                <div class="panel-group">

                                    <div class="panel panel-info">

                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#{{ str_replace(' ', '-', $category->name) }}">{{ $category->name }}</a>
                                            </h4>
                                        </div>

                                        <div id="{{ str_replace(' ', '-', $category->name) }}" class="panel-collapse collapse">

                                            <div class="panel-body">

                                                @if ($category->products->count() > 0)

                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>@lang('site.name')</th>
                                                            <th>@lang('site.stock')</th>
                                                            <th>@lang('site.price')</th>
                                                            <th>@lang('site.add')</th>
                                                        </tr>

                                                        @foreach ($category->products as $product)
                                                            <tr>
                                                                <td>{{ $product->name }}</td>
                                                                <td>{{ $product->stock }}</td>
                                                                <td>{{ $product->sale_price }}</td>
                                                                <td>
                                                                    <a href=""
                                                                       id="product-{{ $product->id }}"
                                                                       data-name="{{ $product->name }}"
                                                                       data-id="{{ $product->id }}"
                                                                       data-price="{{ $product->sale_price }}"
                                                                       class="btn {{ in_array($product->id, $order->products->pluck('id')->toArray()) ? 'btn-default disabled' : 'btn-success add-product-btn' }} btn-sm">
                                                                        <i class="fa fa-plus"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </table><!-- end of table -->

                                                @else
                                                    <h5>@lang('site.no_records')</h5>
                                                @endif

                                            </div><!-- end of panel body -->

                                        </div><!-- end of panel collapse -->

                                    </div><!-- end of panel primary -->

                                </div><!-- end of panel group -->


                                @endforeach


                        </div>
                        <!-- /.card-body -->
                    </div>

                </div><!--end of col-->


                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">

                            <h3 class="card-title">@lang('msite.orders')</h3>

                        </div>



                        <div class="panel-body">

                            <form action="{{ route('dashboard.clients.orders.update', ['order' => $order->id, 'client' => $client->id]) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('put') }}

                                @include('includes.errors')


                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>@lang('msite.product')</th>
                                        <th>@lang('msite.quantity')</th>
                                        <th>@lang('msite.price')</th>
                                    </tr>
                                    </thead>

                                    <tbody class="order-list">

                                    @foreach ($order->products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td><input type="number" name="products[{{ $product->id }}][quantity]" data-price="{{ number_format($product->sale_price, 2) }}" class="form-control input-sm product-quantity" min="1" value="{{ $product->pivot->quantity }}"></td>
                                            <td class="product-price">{{ number_format($product->sale_price * $product->pivot->quantity, 2) }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm remove-product-btn" data-id="{{ $product->id }}"><span class="fa fa-trash"></span></button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>


                                </table><!-- end of table -->

                                <h4>@lang('msite.total') : <span class="total-price">{{ number_format($order->total_price, 2) }}</span></h4>

                                <button class="btn btn-primary btn-block" id="form-btn"><i class="fa fa-edit"></i> @lang('msite.edit_order')</button>

                            </form>



                        </div>

                    </div>


                    @if ($client->orders->count() > 0)

                        <div class="card card-primary">

                            <div class="card-header">

                                <h3 class="card-title" style="margin-bottom: 10px">@lang('msite.previous_orders')
                                    <small>{{ $orders->total() }}</small>
                                </h3>

                            </div><!-- end of card header -->

                            <div class="card-body">

                                <div id="accordion">


                                    <div class="card-group">

                                        <div class="card-body ">
                                        @foreach ($orders as $order)

                                            <div class="card-header " style="background-color: #F7F7F7 ">
{{--                                                <h4 class="panel-title">--}}
{{--                                                    <a data-toggle="collapse" href="#{{ $order->created_at->format('d-m-Y-s') }}">{{ $order->created_at->toFormattedDateString() }}</a>--}}
{{--                                                </h4>--}}
                                                <a class="d-block w-100 " data-toggle="collapse"
                                                   href="#collapseOne-{{$order->created_at->format('d-m-Y-s')}}">
                                                    <h4 > {{ $order->created_at->toFormattedDateString() }}</h4>
                                                </a>
                                            </div>
                                            <div id="collapseOne-{{$order->created_at->format('d-m-Y-s')}}" class="collapse" data-parent="#accordion">

{{--                                            <div id="{{ $order->created_at->format('d-m-Y-s') }}" class="panel-collapse collapse">--}}

                                                <div class="panel-body">

                                                    <ul class="list-group" style="list-style-type: none;">
                                                        @foreach ($order->products as $product)
                                                            <li class="list-group-item-info p-3">  <h5> {{ $product->name }}</h5></li>
                                                        @endforeach
                                                    </ul>

                                                </div><!-- end of panel body -->

                                            </div><!-- end of panel collapse -->

                                            @endforeach
                                        </div><!-- end of panel primary -->

                                    </div><!-- end of panel group -->

                                </div>

                                {{ $orders->links() }}

                            </div><!-- end of card body -->

                        </div><!-- end of card -->

                    @endif


                </div>

            </div>

        </section>
    </div>

@endsection
@section('js')

@endsection
