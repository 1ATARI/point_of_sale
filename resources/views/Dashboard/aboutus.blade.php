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
                        <h1 class="m-0">{{trans('msite.aboutus')}}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.welcome')}}">{{trans('msite.Home')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('msite.aboutus')}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">

            <div class="row">
                <div class="card-body">
                    <div class="card card-statistics h-100">
                        @include('includes.errors')
                        <div class="card-header" style="background-color:rgba(0,0,0,.03)">
                            <h5 class="modal-title">{{trans('msite.aboutus')}}</h5>
                        </div>
                        <br>


                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                        <div class="card bg-light d-flex flex-fill">
                                            <div class="card-header text-muted border-bottom-0">
                                                Web Developer
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <h2 class="lead"><b>Youssef Mohamed</b></h2>
                                                        <p class="text-muted text-sm"><b>About: </b> Web Developer /PHP Laravel </p>
                                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                                            <li class="small"><span class="fa-li"><i
                                                                        class="fas fa-lg fa-building"></i></span>
                                                                Address: Egypt,Alexandria

                                                            </li>
                                                                <br>
                                                            <li class="small"><span class="fa-li"><i
                                                                        class="fas fa-lg fa-phone"></i></span>
                                                                Phone #: + 20 - 10 92 757 979
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-5 text-center">
                                                        <img src="{{asset('uploads/users_image/default.png')}}" alt="user-avatar"
                                                             class="img-circle img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="text-right">
                                                    <a href="http://wa.me/+01092757979" target="_blank" class="btn btn-sm bg-teal">
                                                        <i class="fas fa-comments"></i>
                                                    </a>
                                                    <a href="https://www.linkedin.com/in/youssef-mohamed-8b0718240/"   target="_blank" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-user"></i> View Profile
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <h3 class="text-center">@lang('msite.info')</h3>
                                <p class="text-center">i'm youssef mohamed FCI student
                                    <br>This is the first project I tried to apply what I learned in Laravel.<br>
                                    I hope I created a good project
                                    This site is for the point of sale, you can create,read,update,delete, (user (admin) ,Categories,products ,Clients,orders)
                                    and give user(admin) permissions to create,read,update,delete (user (admin) ,Categories,products ,Clients,orders)
                                    <br>There were many bugs in the design because I downloaded it in both Arabic and English
                                    Not from the official website, but from someone who modified it to suit Arabic and English
                                    I had to solve a lot of problems with it in css and Arabic bootstrap<br> </p>

                                <h5 class="text-center alert alert-danger">I recommend to use it in English to get the best experience</h5>
                            </div>
                            <!-- /.card-body -->




                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
@section('js')

@endsection
