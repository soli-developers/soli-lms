@extends('layouts.app')
@section('content')
        <section class="content">
            <div class="container-fluid">
                <section class="content-header">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="container-fluid ">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>{{__('app.add')}} un nouvel {{ __('pkg_rh/specialite.singular')}}</h1>
                            </div>
                        </div>
                    </div>
                </section>
                
                <div class="card">
                    <div class="card-body">
                        @include('pkg_rh.specialites.form')
                    </div>
                </div>
            </div>
        </section>
@endsection