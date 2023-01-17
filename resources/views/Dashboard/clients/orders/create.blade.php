@extends('includes.dashboard')

@section('title')
    @lang('msite.create')
@stop


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0 ml-1">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{trans('msite.create_order')}}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.welcome')}}">{{trans('msite.Home')}}</a></li>


                            <li class="breadcrumb-item "><a
                                    href="{{route('dashboard.clients.index')}}">{{trans('msite.clients')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('msite.create_order')}}</li>
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
                            <h3 class="box-title" style="margin-bottom: 10px">@lang('msite.categories')</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
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
                                                            <th>@lang('msite.name')</th>
                                                            <th>@lang('msite.stock')</th>
                                                            <th>@lang('msite.price')</th>
                                                            <th>@lang('msite.add')</th>
                                                        </tr>

                                                        @foreach ($category->products as $product)
                                                            <tr>
                                                                <td>{{ $product->name }}</td>
                                                                <td>{{ $product->stock }}</td>
                                                                <td>{{ number_format($product->sale_price, 2) }}</td>
                                                                <td>
                                                                    <a href=""
                                                                       id="product-{{ $product->id }}"
                                                                       data-name="{{ $product->name }}"
                                                                       data-id="{{ $product->id }}"
                                                                       data-price="{{ $product->sale_price }}"
                                                                       class="btn btn-success btn-sm add-product-btn">
                                                                        <i class="fa fa-plus"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </table><!-- end of table -->

                                                @else
                                                    <h5>@lang('msite.no_records')</h5>
                                                @endif

                                            </div><!-- end of panel body -->

                                        </div><!-- end of panel collapse -->

                                    </div>
                                    </div>


                                @endforeach

                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>

                </div>


                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">

                            <h3 class="box-title">@lang('msite.orders')</h3>

                        </div>



                        <div class="panel-body">

                            <form action="{{ route('dashboard.clients.orders.store', $client->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('post') }}

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


                                    </tbody>

                                </table><!-- end of table -->

                                <h4 class="form-control"> @lang('msite.total') : <span class="total-price">0</span></h4>

                                <button  class="btn btn-primary btn-block disabled" id="add-order-form-btn"><i class="fa fa-plus"></i> @lang('msite.add_order')</button>

                            </form>



                        </div>

                        </div>
                </div>







            </div>

        </section>
    </div>

@endsection
@section('js')

@endsection
