@extends('layouts.dashboard')

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">Users</h4>
            </div>
                <div class="content">

                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Added On</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        {{ $role->name }}
                                    @endforeach
                                </td>
                                <td class="text-muted">{{ $user->created_at->format('d-M, Y') }}</td>
                                <td><a href="{{url('users')}}/{{$user->id}}/edit" >Edit</a></td>
                                <td>
                                    <form role="form" action="{{url('users')}}/{{$user->id}}" method="post">
                                        {{ csrf_field() }}
                                        <input type="submit" class="btn-link text-warning" value="Delete" title="This action cannot be reversed" />
                                        {{ method_field('DELETE') }}
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <a href="{{ url('users/create') }}" class="link">Add another user</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection