@extends('layouts.adminlte')
@section('content')
<style>
    .modern-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.18);
        border-radius: 20px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
    }
    
    .gradient-header {
        background: linear-gradient(135deg, #164e63, #0891b2, #f59e0b);
        background-size: 200% 200%;
        animation: gradientShift 3s ease infinite;
        color: white;
        border-radius: 20px 20px 0 0;
        position: relative;
        overflow: hidden;
    }
    
    .gradient-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        animation: shimmer 2s infinite;
    }
    
    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    
    .add-btn {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border: none;
        border-radius: 25px;
        padding: 8px 20px;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
    }
    
    .add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.6);
        color: white;
        text-decoration: none;
    }
    
    .room-image {
        border-radius: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .room-image:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }
    
    .action-btn-group .btn {
        border-radius: 20px;
        margin: 0 2px;
        transition: all 0.3s ease;
        border: none;
        font-weight: 500;
    }
    
    .action-btn-group .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    
    .btn-success {
        background: linear-gradient(135deg, #10b981, #059669);
    }
    
    .btn-warning {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }
    
    .table-modern {
        background: rgba(255,255,255,0.9);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .table-modern thead th {
        background: linear-gradient(135deg, #164e63, #0891b2);
        color: white;
        border: none;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 15px;
    }
    
    .table-modern tbody tr {
        transition: all 0.3s ease;
        border: none;
    }
    
    .table-modern tbody tr:hover {
        background: linear-gradient(135deg, rgba(22, 78, 99, 0.05), rgba(8, 145, 178, 0.05));
        transform: scale(1.01);
    }
    
    .table-modern tbody td {
        padding: 15px;
        vertical-align: middle;
        border: none;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    .price-badge {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: 600;
        display: inline-block;
    }
    
    .facilities-text {
        background: linear-gradient(135deg, #164e63, #0891b2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 600;
    }
</style>

<div class="modern-card">
    <div class="gradient-header">
        <div class="card-header border-0">
            <h3 class="card-title mb-0">
                <i class="fas fa-bed mr-2"></i>ROOM TYPE MANAGEMENT
            </h3>
            <div class="card-tools">
                <a href="{{ route('roomtype.create') }}" class="add-btn">
                    <i class="fas fa-plus mr-1"></i>Add New Room Type
                </a>
            </div>
        </div>
    </div>
    
    <div class="card-body p-4">
        <div class="table-responsive">
            <table id="facilityList" class="table table-modern">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag mr-1"></i>No</th>
                        <th><i class="fas fa-tag mr-1"></i>Name</th>
                        <th><i class="fas fa-info-circle mr-1"></i>Information</th>
                        <th><i class="fas fa-image mr-1"></i>Photo</th>
                        <th><i class="fas fa-dollar-sign mr-1"></i>Price</th>
                        <th><i class="fas fa-star mr-1"></i>Facilities</th>
                        <th><i class="fas fa-cogs mr-1"></i>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $dt)
                        <tr>
                            <td><span class="badge badge-primary">{{ $loop->iteration }}</span></td>
                            <td>
                                <strong class="text-primary">{{ $dt->name }}</strong>
                            </td>
                            <td>
                                <div style="max-width: 200px;">
                                    {{ Str::limit($dt->information, 50) }}
                                </div>
                            </td>
                            <td>
                                <img src="{{ asset('images/tipekamar/'.$dt->foto) }}" 
                                     width="80" 
                                     height="60" 
                                     class="room-image" 
                                     alt="{{ $dt->name }}"
                                     style="object-fit: cover;">
                            </td>
                            <td>
                                <span class="price-badge">
                                    Rp {{ number_format($dt->price, 0, ',', '.') }}
                                </span>
                            </td>
                            <td>
                                <span class="facilities-text">{{ Str::limit($dt->facilities, 30) }}</span>
                            </td>
                            <td>
                                <div class="action-btn-group">
                                    <a href="{{ route('detail.room', $dt->id) }}" 
                                       class="btn btn-sm btn-success" 
                                       title="Book Now">
                                        <i class="fas fa-calendar-check"></i>
                                    </a>
                                    <a href="{{ route('roomtype.edit', $dt->id) }}" 
                                       class="btn btn-sm btn-warning" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('roomtype.delete', $dt->id) }}" 
                                       onclick="return confirm('Are you sure you want to delete this room type?')" 
                                       class="btn btn-sm btn-danger" 
                                       title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('js')
<script>
    $(function() {
        $("#facilityList").DataTable({
            "responsive": true,
            "paging": true,
            "pageLength": 10,
            "buttons": ["copy", "csv", "excel", "pdf", "print"],
            "language": {
                "search": "Search room types:",
                "lengthMenu": "Show _MENU_ room types per page",
                "info": "Showing _START_ to _END_ of _TOTAL_ room types",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        }).buttons().container().appendTo('#facilityList_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
@endsection
