@extends('layouts.dashboard')

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">Edit {{ $service->name }}</h4>
            </div>
                <div class="content">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                    <form role="form" method="POST" action="{{ url('services') }}/{{ $service->id }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Service Name</label>
                                <input type="text" name="name" id="name" class="form-control border-input"  placeholder="e.g. Laboratory" required="" value="{{ $service->name }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cash">Cash Payment</label>
                                <input type="text" name="cash" id="cash" class="form-control border-input" placeholder="e.g. 3000" required="" autofocus="" value="{{ $service->cash }}">
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="insurance">Insurance Payment</label>
                                <input type="text" name="insurance" id="insurance" class="form-control border-input" placeholder="e.g. 5000" required="" autofocus="" value="{{ $service->insurance }}">
                            </div>
                        </div>
                    </div>
                        <div class="col-md-8 col-md-offset-5">
                            <button type="submit" value="" class="btn btn-primary">
                                Edit {{ $service->name }}
                            </button>
                            <input type="hidden" name="created_at" value="{{$service->created_at}}">
                            <input type="hidden" name="user" value="{{ $service->user }}">
                            <input type="hidden" name="id" value="{{ $service->id }}">
                            {{ method_field('PUT') }}
                        </div>
                    </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection