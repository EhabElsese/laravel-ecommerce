@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item active">الملف الشخصي
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل الملف الشخصي </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('update.profile',$admin -> id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="id" value="{{$admin -> id}}">
                                            <div class="form-body">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">الاسم</label>
                                                    <input type="text" name="name" value="{{$admin -> name}}" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                    @error('name')
                                                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">البريد الالكترونى </label>
                                                    <input type="email" name="email" value="{{$admin -> email}}"  class="form-control" id="exampleFormControlInput1" placeholder="">
                                                    @error('email')
                                                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
@endsection
