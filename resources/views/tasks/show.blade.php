@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <h1> Task</h1>
                        <ul>
                            <li>{{$task->body}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
