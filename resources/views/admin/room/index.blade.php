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
        background: linear-gradient(135deg, #164e63, #0891b2);
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
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        animation: shimmer 3s infinite;
    }
    
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    
    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    
    .status-available {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }
    
    .status-occupied {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
    }
    
    .status-reserved {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }
    
    .status-out-of-service {
        background: linear-gradient(135deg, #6b7280, #4b5563);
        color: white;
    }
    
    .action-btn {
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .action-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255,255,255,0.3);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.3s ease;
    }
    
    .action-btn:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .btn-edit {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        border: none;
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        border: none;
    }
    
    .add-btn {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 10px 20px;
        border-radius: 15px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .table-modern {
        background: rgba(255,255,255,0.9);
        border-radius: 15px;
        overflow: hidden;
    }
    
    .table-modern thead th {
        background: linear-gradient(135deg, #164e63, #0891b2);
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        padding: 15px;
    }
    
    .table-modern tbody tr {
        transition: all 0.3s ease;
    }
    
    .table-modern tbody tr:hover {
        background: rgba(8, 145, 178, 0.1);
        transform: scale(1.01);
    }
    
    .table-modern tbody td {
        padding: 15px;
        vertical-align: middle;
        border-color: rgba(8, 145, 178, 0.1);
    }
</style>

<div class="container-fluid">
    <div class="modern-card">
        <div class="gradient-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1" style="font-weight: 700;">🏨 Room Management</h3>
                    <p class="mb-0 opacity-75">Manage hotel rooms and their availability</p>
                </div>
                <a href="{{ route('room.create') }}" class="add-btn">
                    <i class="fas fa-plus mr-2"></i>Add New Room
                </a>
            </div>
        </div>
        
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="roomlist" class="table table-modern">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Room Type</th>
                            <th>Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td><strong>{{$loop->iteration}}</strong></td>
                                <td>{{ $data->type_id }}</td>
                                <td><span class="badge badge-info">{{ $data->number }}</span></td>
                                <td>
                                    @if ($data->status == 'a')
                                        <span class="status-badge status-available">Available</span>
                                    @elseif ($data->status == 'o')
                                        <span class="status-badge status-occupied">Occupied</span>
                                    @elseif ($data->status == 'r')
                                        <span class="status-badge status-reserved">Reserved</span>
                                    @elseif ($data->status == 'os')
                                        <span class="status-badge status-out-of-service">Out of Service</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('room.edit', $data->id) }}" class="action-btn btn-edit">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </a>
                                        <a href="{{ route('room.delete', $data->id) }}" 
                                           onclick="return confirm('Are you sure you want to delete this room?')" 
                                           class="action-btn btn-delete ml-2">
                                            <i class="fas fa-trash mr-1"></i>Delete
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
</div>

@section('js')
<script>
    $(function () {
        $("#roomlist").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"],
            "pageLength": 10,
            "language": {
                "search": "Search rooms:",
                "lengthMenu": "Show _MENU_ rooms per page",
                "info": "Showing _START_ to _END_ of _TOTAL_ rooms",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        }).buttons().container().appendTo('#roomlist_wrapper .col-md-6:eq(0)');
        
        // Add smooth animations to table rows
        $('.table-modern tbody tr').each(function(index) {
            $(this).css('animation-delay', (index * 0.1) + 's');
            $(this).addClass('animate__animated animate__fadeInUp');
        });
    });
</script>
@endsection
@endsection
