@extends('layouts.dashboard')

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">Services</h4>
            </div>
                <div class="content">

                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                            <tr><th>ID</th>
                            <th>Service Name</th>
                            <th>Cash</th>
                            <th>Insurance</th>
                            <th>Added By</th>
                            <th>Added On</th>
                            <th>Edit</th>
                            <th>||</th>
                            <th>Delete</th>
                        </tr></thead>
                        <tbody>

                            @foreach ($services as $service)
                            <tr>
                                <td>{{ $service->id }}</td>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->cash }}</td>
                                <td>{{ $service->insurance }}</td>
                                <td class="text-muted">{{ $service->user }}</td>
                                <td class="text-muted">{{ $service->created_at->format('d-M, Y') }}</td>
                                <td><a href="{{url('services')}}/{{$service->id}}/edit" >Edit</a></td>
                                <td>&nbsp;</td>
                                <td>
                                    <form role="form" action="{{url('services')}}/{{$service->id}}" method="post">
                                        {{ csrf_field() }}
                                        <input type="submit" class="btn-link text-warning" value="Delete" title="This action cannot be reversed" />
                                        {{ method_field('DELETE') }}
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <a href="{{ url('services/create') }}" class="link">Add another service</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection