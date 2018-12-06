@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Embajadores</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive" id="cities-table">
                    <thead>
                    <tr>
                        <th>Email</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($postulations as $postulation)
                        <tr>
                            <td>{{ $postulation->email }}</td>
                            <td>{{ $postulation->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

