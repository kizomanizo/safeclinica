@extends('layouts.dashboard')

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">Available Insurances</h4>
            </div>
                <div class="content">

                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                            <tr><th>ID</th>
                            <th>Insurance Name</th>
                            <th>Added By</th>
                            <th>Added On</th>
                            <th>Edit</th>
                            <th>||</th>
                            <th>Delete</th>
                        </tr></thead>
                        <tbody>

                            @foreach ($insurances as $insurance)
                            <tr>
                                <td>{{ $insurance->id }}</td>
                                <td>{{ $insurance->name }}</td>
                                <td class="text-muted">{{ $insurance->user }}</td>
                                <td class="text-muted">{{ $insurance->created_at->format('d-M, Y') }}</td>
                                <td><a href="{{url('insurances')}}/{{$insurance->id}}/edit" >Edit</a></td>
                                <td>&nbsp;</td>
                                <td>
                                    <form role="form" action="{{url('insurances')}}/{{$insurance->id}}" method="post">
                                        {{ csrf_field() }}
                                        <input type="submit" class="btn-link text-warning" value="Delete" title="This action cannot be reversed" />
                                        {{ method_field('DELETE') }}
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <a href="{{ url('insurances/create') }}" class="link">Add another insurance</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection