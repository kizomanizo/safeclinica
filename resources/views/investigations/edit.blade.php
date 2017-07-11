@extends('layouts.dashboard')

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">Edit {{ $investigation->name }}</h4>
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
                        <form role="form" method="POST" action="{{ url('investigations') }}/{{ $investigation->id }}">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Investigation Name</label>
                                <input type="text" name="name" id="name" class="form-control border-input"  placeholder="e.g. Urology" required="" value="{{ $investigation->name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Investigation Price</label>
                                <input type="text" name="price" id="price" class="form-control border-input" placeholder="e.g. 23000" required="" autofocus="" value="{{ $investigation->price }}">
                            </div>
                        </div>
                        <div class="col-md-8 col-md-offset-5">
                            <button type="submit" value="" class="btn btn-primary">
                                Edit {{ $investigation->name }}
                            </button>
                            <input type="hidden" name="created_at" value="{{$investigation->created_at}}">
                            <input type="hidden" name="user" value="{{ $investigation->user }}">
                            <input type="hidden" name="id" value="{{ $investigation->id }}">
                            {{ method_field('PUT') }}
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection