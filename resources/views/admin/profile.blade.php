@extends('layout.admin')

@section('title', 'Profile - Koperasi Daya Masyarakat Indonesia')

@section('content')
<div id="page-wrapper" style="min-height: 356px;">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Profile</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="active">Profile</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <!-- .row -->
        <div class="row">
            <div class="col-md-4 col-xs-12">
                <div class="white-box">
                    <div class="user-bg"> <img width="100%" alt="user" src="{{ asset('admin-css/images/user.png') }}">
                        <div class="overlay-box">
                            <div class="user-content">
                                <a href="javascript:void(0)"><img src="{{ asset('admin-css/images/user.png') }}" class="thumb-lg img-circle" alt="img"></a>
                                <h4 class="text-white">{{ Auth::user()->name }} </h4>
                                <h5 class="text-white">{{ Auth::user()->email }} </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-xs-12">
                <div class="white-box">
                    <ul class="nav nav-tabs tabs customtab">
                        <li class="tab active">
                            <a href="#profile" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Profile</span> </a>
                        </li>
                        <li class="tab">
                            <a href="#password" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Change Password</span> </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="password">
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label class="col-md-12">New Password</label>
                                    <div class="col-md-6">
                                        <input type="password" name="password"  class="form-control"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Confirm New Password</label>
                                    <div class="col-md-6">
                                        <input type="password" name="confirm"  class="form-control"> </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group" style="margin-top: 10px;">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-info btn-sm">Change Password</button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                        <div class="tab-pane" id="messages">
                            <div class="steamline">
                            </div>
                        </div>
                        <div class="tab-pane active" id="profile">
                            <form class="form-horizontal form-material">
                                <div class="form-group">
                                    <label class="col-md-12">Nama</label>
                                    <div class="col-md-12">
                                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control form-control-line"> </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email"  class="form-control form-control-line" value="{{ Auth::user()->email }}" name="email" id="example-email"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Telepon</label>
                                    <div class="col-md-12">
                                        <input type="text" name="telepon" value="{{ Auth::user()->telepon }}" class="form-control form-control-line"> </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
