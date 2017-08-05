@extends('layouts.dashboard')

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">Edit {{ $treatment->name }}</h4>
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

                <form role="form" method="POST" action="{{ url('treatments') }}/{{ $treatment->id }}">
                <div class="row">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Treatment Name</label>
                            <input type="text" name="name" id="name" class="form-control border-input"  placeholder="e.g. Athequine 100ml" required="" value="{{ $treatment->name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">Price per unit</label>
                            <input type="text" name="price" id="price" class="form-control border-input" placeholder="e.g. 200" required="" autofocus="" value="{{ $treatment->price }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="drug">Drug generic</label>
                            <input type="text" name="drug" id="drug" class="form-control border-input" placeholder="e.g. Penicillin- oral" required="" value="{{ $treatment->drug }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">Type Group</label>
                            <input type="text" name="type" id="type" class="form-control border-input" placeholder="e.g. antibiotics" required="" value="{{ $treatment->type }}">
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-5">
                        <button type="submit" value="" class="btn btn-primary">
                            Edit {{ $treatment->name }}
                        </button>
                        <input type="hidden" name="created_at" value="{{$treatment->created_at}}">
                        <input type="hidden" name="user" value="{{ $treatment->user }}">
                        <input type="hidden" name="id" value="{{ $treatment->id }}">
                        {{ method_field('PUT') }}
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
@endsection