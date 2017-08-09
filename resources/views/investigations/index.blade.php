@extends('layouts.dashboard')

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">Lab Investigations</h4>
            </div>
                <div class="content">

                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                            <tr><th>ID</th>
                            <th>Investigation Name</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Added By</th>
                            <th>Added On</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr></thead>
                        <tbody>

                            @foreach ($investigations as $investigation)
                            <tr>
                                <td>{{ $investigation->id }}</td>
                                <td>{{ $investigation->name }}</td>
                                <td>{{ $investigation->price }}</td>
                                <td>{{ $investigation->type }}</td>
                                <td class="text-muted">{{ $investigation->user }}</td>
                                <td class="text-muted">{{ $investigation->created_at->format('d-M, Y') }}</td>
                                <td><a href="{{url('investigations')}}/{{$investigation->id}}/edit" >Edit</a></td>
                                <td>
                                    <form role="form" action="{{url('investigations')}}/{{$investigation->id}}" method="post">
                                        {{ csrf_field() }}
                                        <input type="submit" class="btn-link text-warning" value="Delete" title="This action cannot be reversed" />
                                        {{ method_field('DELETE') }}
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $investigations->links() }}
                    <p><a href="{{ url('investigations/create') }}" class="link">Add another investigation</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection