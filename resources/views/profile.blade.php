@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    <h2>{{ $user->name }}</h2>
                    <hr>
                    @if ($isConnected)
                        <div class="float-right"><a href="/profile/disconnect" class="btn btn-secondary btn-sm">Disconnect</a></div>
                        <p>
                            You are connected to KidDiary
                            <span class="badge badge-pill badge-primary">
                            @if($kiddiaryUser['role'] == 1)
                                PARENT
                            @elseif($kiddiaryUser['role'] == 2)
                                SCHOOL ADMINISTRATOR
                            @elseif($kiddiaryUser['role'] == 3)
                                HOSPITAL ADMINISTRATOR
                            @else
                                SOMEONE SPECIAL
                            @endif
                            </span>
                        </p>
                        <p>Citizen ID is {{ $kiddiaryUser['citizen_id'] }}.</p>
                        <hr>
                        <h4>Your schools</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">School</th>
                                <th scope="col">Name</th>
                                <th scope="col">Location</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($schools as $school)
                                <tr>
                                <th scope="row"><a href="#">{{ $school['school_code'] }}</a></th>
                                <td>{{ $school['name'] }}</td>
                                <td>{{ $school['sub_district'] }} {{ $school['district'] }} {{ $school['province'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <a href="/profile/connect" class="btn btn-secondary">Connect to KidDiary</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
