@extends('layouts.template')
@section('content')
<div class="container my-5">
	<div class="card shadow-lg">
		<div class="card-header bg-primary text-white">
			<h2><i class="fas fa-user-shield me-2"></i> Admin Dashboard</h2>
		</div>
		<div class="card-body">
			<div class="row text-center">
				<div class="col-md-4 mb-4">
					<div class="p-4 bg-light rounded">
						<h5>Total Users</h5>
						<span class="display-6">{{ $totalUsers ?? 0 }}</span>
					</div>
				</div>
				<div class="col-md-4 mb-4">
					<div class="p-4 bg-light rounded">
						<h5>Total Bookings</h5>
						<span class="display-6">{{ $totalBookings ?? 0 }}</span>
					</div>
				</div>
				<div class="col-md-4 mb-4">
					<div class="p-4 bg-light rounded">
						<h5>Total Revenue</h5>
						<span class="display-6">{{ $totalRevenue ?? 0 }} DA</span>
					</div>
				</div>
			</div>
			<div class="mt-4 text-center">
				<a href="{{ route('roomtype.index') }}" class="btn btn-primary me-2">Manage Room Types</a>
				<a href="{{ route('admin.users') }}" class="btn btn-success me-2">Manage Users</a>
				<a href="{{ route('admin.bookings') }}" class="btn btn-info">View Bookings</a>
			</div>
		</div>
	</div>
</div>
@endsection
