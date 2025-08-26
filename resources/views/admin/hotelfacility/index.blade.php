@extends('layouts.adminlte')
@section('content')
<div class="facility-management-container">
    <!-- Enhanced header with modern styling and better visual hierarchy -->
    <div class="page-header-modern">
        <div class="header-content">
            <div class="header-title-section">
                <div class="header-icon">
                    <i class="fas fa-concierge-bell"></i>
                </div>
                <div class="header-text">
                    <h1 class="page-title">Hotel Facility Management</h1>
                    <p class="page-subtitle">Kelola fasilitas hotel dengan mudah dan efisien</p>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('hotelfacility.create') }}" class="btn-add-modern">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Fasilitas</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Modern card design with enhanced table styling -->
    <div class="facility-card">
        <div class="card-body-modern">
            <div class="table-container">
                <table id="facilityList" class="table-modern">
                    <thead>
                        <tr>
                            <th><span class="th-content">No</span></th>
                            <th><span class="th-content">Nama Fasilitas</span></th>
                            <th><span class="th-content">Deskripsi</span></th>
                            <th><span class="th-content">Aksi</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $dt)
                            <tr class="table-row-modern">
                                <td><span class="row-number">{{ $loop->iteration }}</span></td>
                                <td>
                                    <div class="facility-name">
                                        <i class="fas fa-star facility-icon"></i>
                                        <span>{{ $dt->facility_name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="facility-description">
                                        {{ Str::limit($dt->detail, 80) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('hotelfacility.edit', $dt->id) }}" class="btn-action btn-edit" title="Edit Fasilitas">
                                            <i class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </a>
                                        <a href="{{ route('hotelfacility.delete', $dt->id) }}" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')" 
                                           class="btn-action btn-delete" title="Hapus Fasilitas">
                                            <i class="fas fa-trash"></i>
                                            <span>Hapus</span>
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

<style>
/* Modern Facility Management Styles */
.facility-management-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 1rem;
}

.page-header-modern {
    background: linear-gradient(135deg, #164e63 0%, #0891b2 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 8px 32px rgba(22, 78, 99, 0.3);
    color: white;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.header-title-section {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.header-icon {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    backdrop-filter: blur(10px);
}

.page-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0;
}

.page-subtitle {
    margin: 0.25rem 0 0 0;
    opacity: 0.9;
    font-size: 0.875rem;
}

.btn-add-modern {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
}

.btn-add-modern:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    color: white;
    text-decoration: none;
}

.facility-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(22, 78, 99, 0.1);
    overflow: hidden;
}

.card-body-modern {
    padding: 0;
}

.table-container {
    overflow-x: auto;
}

.table-modern {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
}

.table-modern thead {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

.table-modern th {
    padding: 1.5rem 1rem;
    text-align: left;
    border-bottom: 2px solid #e2e8f0;
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.th-content {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.table-row-modern {
    transition: all 0.2s ease;
    border-bottom: 1px solid #f1f5f9;
}

.table-row-modern:hover {
    background: rgba(22, 78, 99, 0.05);
    transform: translateX(4px);
}

.table-modern td {
    padding: 1.25rem 1rem;
    vertical-align: middle;
}

.row-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #164e63, #0891b2);
    color: white;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
}

.facility-name {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 600;
    color: #1f2937;
}

.facility-icon {
    color: #f59e0b;
    font-size: 1rem;
}

.facility-description {
    color: #6b7280;
    line-height: 1.5;
    font-size: 0.875rem;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
    border: 1px solid transparent;
}

.btn-edit {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
}

.btn-edit:hover {
    background: linear-gradient(135deg, #d97706, #b45309);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
    color: white;
    text-decoration: none;
}

.btn-delete {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

.btn-delete:hover {
    background: linear-gradient(135deg, #dc2626, #b91c1c);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    color: white;
    text-decoration: none;
}

/* DataTable Customization */
.dataTables_wrapper {
    padding: 1.5rem;
}

.dataTables_length,
.dataTables_filter {
    margin-bottom: 1rem;
}

.dataTables_filter input {
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    padding: 0.5rem 1rem;
    margin-left: 0.5rem;
    transition: border-color 0.2s ease;
}

.dataTables_filter input:focus {
    outline: none;
    border-color: #0891b2;
    box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.1);
}

.dataTables_info {
    color: #6b7280;
    font-size: 0.875rem;
}

.dataTables_paginate .paginate_button {
    padding: 0.5rem 1rem;
    margin: 0 0.25rem;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    background: white;
    color: #374151;
    text-decoration: none;
    transition: all 0.2s ease;
}

.dataTables_paginate .paginate_button:hover {
    background: #164e63;
    color: white;
    border-color: #164e63;
}

.dataTables_paginate .paginate_button.current {
    background: linear-gradient(135deg, #164e63, #0891b2);
    color: white;
    border-color: #164e63;
}

/* Responsive Design */
@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        text-align: center;
    }
    
    .header-title-section {
        flex-direction: column;
        text-align: center;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .btn-action span {
        display: none;
    }
    
    .table-modern th,
    .table-modern td {
        padding: 1rem 0.5rem;
    }
}

/* Loading Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.facility-card {
    animation: fadeInUp 0.6s ease forwards;
}
</style>

@section('js')
<script>
$(function() {
    // Enhanced DataTable initialization
    const table = $("#facilityList").DataTable({
        "responsive": true,
        "paging": true,
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
        "language": {
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Tidak ada data yang ditemukan",
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Tidak ada data tersedia",
            "infoFiltered": "(difilter dari _MAX_ total data)",
            "search": "Cari:",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            }
        },
        "buttons": [
            {
                extend: 'copy',
                text: '<i class="fas fa-copy"></i> Salin',
                className: 'btn btn-secondary btn-sm'
            },
            {
                extend: 'csv',
                text: '<i class="fas fa-file-csv"></i> CSV',
                className: 'btn btn-secondary btn-sm'
            },
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> Excel',
                className: 'btn btn-secondary btn-sm'
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                className: 'btn btn-secondary btn-sm'
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i> Cetak',
                className: 'btn btn-secondary btn-sm'
            }
        ],
        "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
               '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6">>' +
               '<"row"<"col-sm-12"tr>>' +
               '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
    });

    // Add loading animation to table rows
    setTimeout(() => {
        $('.table-row-modern').each(function(index) {
            $(this).css({
                'opacity': '0',
                'transform': 'translateY(20px)'
            });
            
            setTimeout(() => {
                $(this).css({
                    'transition': 'all 0.4s ease',
                    'opacity': '1',
                    'transform': 'translateY(0)'
                });
            }, index * 50);
        });
    }, 100);

    // Add click ripple effect to action buttons
    $('.btn-action').on('click', function(e) {
        const button = $(this);
        const ripple = $('<div class="ripple"></div>');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.css({
            'position': 'absolute',
            'width': size + 'px',
            'height': size + 'px',
            'left': x + 'px',
            'top': y + 'px',
            'background': 'rgba(255, 255, 255, 0.5)',
            'border-radius': '50%',
            'transform': 'scale(0)',
            'animation': 'ripple 0.6s ease-out',
            'pointer-events': 'none'
        });
        
        button.css('position', 'relative').append(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });

    // Add CSS for ripple animation
    $('<style>').text(`
        @keyframes ripple {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }
    `).appendTo('head');
});
</script>
@endsection
@endsection
