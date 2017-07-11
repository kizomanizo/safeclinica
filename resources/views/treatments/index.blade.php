@extends('layouts.dashboard')

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">Treatments</h4>
            </div>
                <div class="content">

                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                            <tr><th>ID</th>
                            <th>Treatment Name</th>
                            <th>Price</th>
                            <th>Added By</th>
                            <th>Added On</th>
                            <th>Edit</th>
                            <th>||</th>
                            <th>Delete</th>
                        </tr></thead>
                        <tbody>

                            @foreach ($treatments as $treatment)
                            <tr>
                                <td>{{ $treatment->id }}</td>
                                <td>{{ $treatment->name }}</td>
                                <td>{{ $treatment->price }}</td>
                                <td class="text-muted">{{ $treatment->user }}</td>
                                <td class="text-muted">{{ $treatment->created_at->format('d-M, Y') }}</td>
                                <td><a href="{{url('treatments')}}/{{$treatment->id}}/edit" >Edit</a></td>
                                <td>&nbsp;</td>
                                <td>
                                    <form role="form" action="{{url('treatments')}}/{{$treatment->id}}" method="post">
                                        {{ csrf_field() }}
                                        <input type="submit" class="btn-link text-warning" value="Delete" title="This action cannot be reversed" />
                                        {{ method_field('DELETE') }}
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <a href="{{ url('treatments/create') }}" class="link">Add another treatment</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection