@extends('layouts.template')
@section('content')
<div class="container my-5">
	<div class="card shadow-lg">
		<div class="card-header bg-info text-white">
			<h2><i class="fas fa-concierge-bell me-2"></i> Receptionist Dashboard</h2>
		</div>
		<div class="card-body">
			<div class="mb-4 text-center">
				<a href="{{ route('receptionis.checkin') }}" class="btn btn-primary me-2">Check In</a>
				<a href="{{ route('receptionis.reservations') }}" class="btn btn-success me-2">Reservations</a>
				<a href="{{ route('receptionis.logs') }}" class="btn btn-warning">View Logs</a>
			</div>
			<h4 class="mt-4">Recent Bookings</h4>
			<table class="table table-bordered table-striped mt-2">
				<thead class="table-light">
					<tr>
						<th>Customer</th>
						<th>Room</th>
						<th>Check-in</th>
						<th>Check-out</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@forelse($recentBookings ?? [] as $booking)
						<tr>
							<td>{{ optional($booking->user)->name ?? '-' }}</td>
							<td>{{ optional($booking->room)->room_number ?? $booking->room_id ?? '-' }}</td>
							<td>{{ $booking->check_in ?? '-' }}</td>
							<td>{{ $booking->check_out ?? '-' }}</td>
							<td>{{ $booking->status ?? '-' }}</td>
							<td>
								<a href="#" class="btn btn-sm btn-info">Details</a>
							</td>
						</tr>
					@empty
						<tr><td colspan="6" class="text-center">No bookings found.</td></tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
