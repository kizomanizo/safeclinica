@extends('layouts.dashboard')

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">Add a Lab Investigation</h4>
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

                    <form action="{{ url('investigations') }}" role="form" method="POST">
                    <div class="row">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Investigation Name</label>
                                <input type="text" name="name" id="name" class="form-control border-input"  placeholder="e.g. Dialysis" required="" autofocus="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Investigation Price</label>
                                <input type="text" name="price" id="price" class="form-control border-input" placeholder="e.g. 13000" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Investigation Type</label>
                                <input type="text" name="type" id="type" class="form-control border-input"  placeholder="e.g. Serology" required="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-md-8 col-md-offset-5">
                            <button type="submit" class="btn btn-primary">
                                Add investigation
                            </button>
                        </div>
                </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection