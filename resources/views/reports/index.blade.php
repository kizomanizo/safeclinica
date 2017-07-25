@extends('layouts.dashboard')

@section('content')
{{ csrf_field() }}
<div class="content">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">Reports</h4>
            </div>
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Statistical Reports</h4>
                                    </div>
                                    <div class="content">
                                        <table class="table table-hover">
                                    <thead>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Male</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $male }}</td>
                                            <td>45</td>
                                            <td>77</td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td>9</td>
                                            <td>20</td>
                                        </tr>
                                    </tbody>
                                </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Financial Reports</h4>
                                    </div>
                                    <div class="content">
                                        Report contents 3
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Labo Reports</h4>
                                    </div>
                                    <div class="content">
                                        Reports 1
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Pharmacy Reports</h4>
                                    </div>
                                    <div class="content">
                                        Report contents 3
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
    </div>
</div>
@endsection