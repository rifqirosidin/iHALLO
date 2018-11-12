@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table border="1" align="center">
                        <th>Download</th>
                        <th>Upload</th>
                        <th>Alltime</th>
                        <tr>
                            @forelse($quotas as $quota)
                            <td>{{ $quota->download }}  </td>
                            <td>{{ $quota->upload }}</td>
                            <td>{{ $quota->alltime }}</td>

                        </tr>
                        @empty
                            <tr>
                                <td colspan="3">Tidak Ada Paket</td>
                            </tr>

                        @endforelse

                    </table>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
