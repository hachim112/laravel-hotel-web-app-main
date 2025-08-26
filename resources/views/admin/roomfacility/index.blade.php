@extends('layouts.adminlte')
@section('content')
<style>
    .modern-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.18);
        border-radius: 20px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        transition: all 0.3s ease;
    }
    
    .modern-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px 0 rgba(31, 38, 135, 0.5);
    }
    
    .gradient-header {
        background: linear-gradient(135deg, #164e63, #0891b2, #f59e0b);
        color: white;
        border-radius: 20px 20px 0 0;
        padding: 20px;
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
    
    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    
    .modern-btn {
        background: linear-gradient(135deg, #0891b2, #164e63);
        border: none;
        border-radius: 12px;
        color: white;
        padding: 8px 16px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
    }
    
    .modern-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(8, 145, 178, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .modern-btn-warning {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }
    
    .modern-btn-warning:hover {
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
    }
    
    .modern-btn-danger {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }
    
    .modern-btn-danger:hover {
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
    }
    
    .modern-table {
        background: rgba(255,255,255,0.9);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .modern-table thead th {
        background: linear-gradient(135deg, #164e63, #0891b2);
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 15px;
        border: none;
    }
    
    .modern-table tbody tr {
        transition: all 0.3s ease;
    }
    
    .modern-table tbody tr:hover {
        background: linear-gradient(135deg, rgba(8, 145, 178, 0.1), rgba(245, 158, 11, 0.05));
        transform: scale(1.01);
    }
    
    .modern-table tbody td {
        padding: 15px;
        border: none;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        vertical-align: middle;
    }
    
    .btn-group-modern {
        display: flex;
        gap: 8px;
    }
    
    .page-header {
        background: linear-gradient(135deg, #164e63, #0891b2, #f59e0b);
        color: white;
        padding: 30px;
        border-radius: 20px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    
    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transform: translate(50px, -50px);
    }
    
    .page-header h1 {
        margin: 0;
        font-size: 2.5rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    
    .page-header p {
        margin: 10px 0 0 0;
        opacity: 0.9;
        font-size: 1.1rem;
    }
</style>

<div class="page-header">
    <h1>Room Facility Management</h1>
    <p>Manage and organize room facilities for Hotel Hebat</p>
</div>

<div class="modern-card">
    <div class="gradient-header">
        <h3 class="card-title mb-0" style="font-size: 1.5rem; font-weight: 600;">
            <i class="fas fa-bed mr-2"></i>FACILITY ROOM LIST
        </h3>
        <div class="card-tools" style="position: absolute; top: 20px; right: 20px;">
            <a href="{{ route('roomfacility.create') }}" class="modern-btn">
                <i class="fas fa-plus"></i>Add New Facility
            </a>
        </div>
    </div>
    
    <div class="card-body" style="padding: 30px;">
        <div class="modern-table">
            <table id="facilityRoomlist" class="table table-striped">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag mr-2"></i>No</th>
                        <th><i class="fas fa-concierge-bell mr-2"></i>Facility Name</th>
                        <th><i class="fas fa-cogs mr-2"></i>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $dt)
                        <tr>
                            <td><span class="badge badge-info">{{ $loop->iteration }}</span></td>
                            <td>
                                <strong style="color: #164e63;">{{ $dt->facility_name }}</strong>
                            </td>
                            <td>
                                <div class="btn-group-modern">
                                    <a href="{{ route('roomfacility.edit', $dt->id) }}" class="modern-btn modern-btn-warning">
                                        <i class="fas fa-edit"></i>Edit
                                    </a>
                                    <a href="{{ route('roomfacility.delete', $dt->id) }}" 
                                       onclick="return confirm('Are you sure you want to delete this facility?')" 
                                       class="modern-btn modern-btn-danger">
                                        <i class="fas fa-trash"></i>Delete
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
    $(function () {
        $("#facilityRoomlist").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"],
            "pageLength": 10,
            "language": {
                "search": "Search facilities:",
                "lengthMenu": "Show _MENU_ facilities per page",
                "info": "Showing _START_ to _END_ of _TOTAL_ facilities",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        }).buttons().container().appendTo('#facilityRoomlist_wrapper .col-md-6:eq(0)');
        
        // Add smooth animations to table rows
        $('#facilityRoomlist tbody tr').each(function(index) {
            $(this).css('animation-delay', (index * 0.1) + 's');
            $(this).addClass('animate__animated animate__fadeInUp');
        });
    });
</script>
@endsection
@endsection
