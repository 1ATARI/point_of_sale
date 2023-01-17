@extends('includes.dashboard')

@section('title')

@stop


@section('content')
    <div class="content-wrapper">
        <section class="content">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{trans('msite.Dashboard')}}
                            </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">{{trans('msite.Home')}}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <div class="row">
                <div class="card-body">
                        @include('includes.errors')


                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{$categories_count}}</h3>

                                        <p>@lang('msite.categories')</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="{{route('dashboard.categories.index')}}" class="small-box-footer">@lang('msite.show') <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{$products_count}}<sup style="font-size: 20px"></sup></h3>

                                        <p>@lang('msite.products')</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="{{route('dashboard.products.index')}}" class="small-box-footer">@lang('msite.show') <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{$clients_count}}</h3>

                                        <p>@lang('msite.clients')</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                    <a href="{{route('dashboard.clients.index')}}" class="small-box-footer">@lang('msite.show') <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{$users_count}}</h3>

                                        <p>@lang('msite.users')</p>
                                    </div>
                                    <div class="icon">
{{--                                        <i class="ion ion-pie-graph"></i>--}}
                                        <i class="ion ion-person"></i>
                                    </div>
                                    <a href="{{route('dashboard.users.index')}}" class="small-box-footer">@lang('msite.show') <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                        </div>







                </div>
            </div>

            <div class="box box-solid">
                <div class="card card-statistics h-100">

                <div class="box-header">
                    <h3 class="box-title">@lang('msite.sales_graph')</h3>
                </div>
                <div class="box-body border-radius-none">
                    <div class="chart" id="line-chart" style="height: 250px;"></div>
                </div>
                </div>
                <!-- /.box-body -->
            </div>

        </section>
    </div>

@endsection
@section('js')
    <script>

        //line chart
        var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: [
                    @foreach ($sales_data as $data)
                {
                    ym: "{{ $data->year }}-{{ $data->month }}", sum: "{{ $data->sum }}"
                },
                @endforeach
            ],
            xkey: 'ym',
            ykeys: ['sum'],
            labels: ['@lang('msite.total')'],
            lineWidth: 2,
            hideHover: 'auto',
            gridStrokeWidth: 0.4,
            pointSize: 4,
            gridTextFamily: 'Open Sans',
            gridTextSize: 10
        });
    </script>

@endsection
