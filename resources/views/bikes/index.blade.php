@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
                         @if (session('success'))
                     <div class="alert alert-success">
                         {{ session('success') }}
                     </div>
                 @endif
              <h2>Special Announcement</h2>
              @newYearsSale(10)
            <h2>List of Bikes</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>ART</th>
                        <th>Brand</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Availability</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bikes as $bike)
                    <tr>
                        <td>{{ $bike->id }}</td>
                        <td>{{ $bike->name }}</td>
                        <td>{{ $bike->article }}</td>
                        <td>{{ $bike->bikeBrand ? $bike->bikeBrand->name : 'No Brand' }}</td>
                        <td>{{ $bike->bikeType ? $bike->bikeType->type : 'No Type' }}</td>
                        <td>${{ number_format($bike->price, 2) }}</td>
                        <td>{{ $bike->availability ? 'Yes' : 'No' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $bikes->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
