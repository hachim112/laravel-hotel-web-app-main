@extends('layouts.adminlte')
@section('content')
<style>
    .user-management-container {
        background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .management-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
    }
    
    .card-header {
        background: linear-gradient(135deg, #0891b2, #0e7490);
        color: white;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        animation: shimmer 3s infinite;
    }
    
    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    
    .header-title {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .add-user-btn {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border: none;
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }
    
    .add-user-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .users-table {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .users-table thead th {
        background: linear-gradient(135deg, #0891b2, #0e7490);
        color: white;
        font-weight: 600;
        padding: 1.5rem 1rem;
        border: none;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.875rem;
    }
    
    .users-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .users-table tbody tr:hover {
        background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
        transform: scale(1.01);
        box-shadow: 0 5px 15px rgba(8, 145, 178, 0.1);
    }
    
    .users-table tbody td {
        padding: 1.5rem 1rem;
        vertical-align: middle;
        border: none;
    }
    
    .user-name {
        font-weight: 600;
        color: #0f172a;
        font-size: 1rem;
    }
    
    .user-email {
        color: #64748b;
        font-size: 0.875rem;
    }
    
    .role-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .role-admin {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        color: white;
    }
    
    .role-user {
        background: linear-gradient(135deg, #059669, #047857);
        color: white;
    }
    
    .role-manager {
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
        color: white;
    }
    
    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    
    .btn-edit {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    
    .btn-edit:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        color: white;
        text-decoration: none;
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    
    .btn-delete:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }
    
    .delete-form {
        display: inline-block;
        margin: 0;
    }
    
    /* Loading spinner */
    .loading-spinner {
        display: none;
        width: 20px;
        height: 20px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #0891b2;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Delete confirmation modal */
    .delete-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        backdrop-filter: blur(5px);
    }
    
    .modal-content {
        background: white;
        margin: 15% auto;
        padding: 2rem;
        border-radius: 15px;
        width: 90%;
        max-width: 400px;
        text-align: center;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    }
    
    .modal-title {
        color: #dc2626;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .modal-text {
        color: #64748b;
        margin-bottom: 2rem;
    }
    
    .modal-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }
    
    .modal-btn {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .modal-btn-cancel {
        background: #e2e8f0;
        color: #64748b;
    }
    
    .modal-btn-confirm {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        color: white;
    }
    
    .modal-btn:hover {
        transform: translateY(-1px);
    }
    
    @media (max-width: 768px) {
        .user-management-container {
            padding: 1rem 0;
        }
        
        .management-card {
            margin: 0 1rem;
            border-radius: 15px;
        }
        
        .card-header {
            padding: 1.5rem;
        }
        
        .header-title {
            font-size: 1.5rem;
        }
        
        .users-table {
            font-size: 0.875rem;
        }
        
        .users-table thead th,
        .users-table tbody td {
            padding: 1rem 0.5rem;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 4px;
        }
    }
</style>

<div class="user-management-container">
    <div class="container">
        <div class="management-card">
            <div class="card-header">
                <h2 class="header-title">👥 User Management</h2>
            </div>
            
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <p class="text-muted mb-0">Manage system users and their roles</p>
                    </div>
                    <a href="{{ route('admin.users.create') }}" class="add-user-btn">
                        <span>➕</span>
                        Add New User
                    </a>
                </div>
                
                <div class="users-table-container">
                    <table class="table users-table mb-0">
                        <thead>
                            <tr>
                                <th>👤 Name</th>
                                <th>📧 Email</th>
                                <th>🏷️ Role</th>
                                <th>⚡ Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="user-name">{{ $user->name }}</div>
                                </td>
                                <td>
                                    <div class="user-email">{{ $user->email }}</div>
                                </td>
                                <td>
                                    <span class="role-badge role-{{ strtolower($user->role) }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn-edit">
                                            <span>✏️</span>
                                            Edit
                                        </a>
                                        <button class="btn-delete" onclick="showDeleteModal({{ $user->id }}, '{{ $user->name }}')">
                                            <span>🗑️</span>
                                            Delete
                                        </button>
                                        <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST" class="delete-form">
                                            @csrf 
                                            @method('DELETE')
                                        </form>
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
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="delete-modal">
    <div class="modal-content">
        <h3 class="modal-title">⚠️ Confirm Delete</h3>
        <p class="modal-text">Are you sure you want to delete user <strong id="deleteUserName"></strong>? This action cannot be undone.</p>
        <div class="modal-buttons">
            <button class="modal-btn modal-btn-cancel" onclick="hideDeleteModal()">Cancel</button>
            <button class="modal-btn modal-btn-confirm" onclick="confirmDelete()">Delete User</button>
        </div>
    </div>
</div>

<script>
let deleteUserId = null;

function showDeleteModal(userId, userName) {
    deleteUserId = userId;
    document.getElementById('deleteUserName').textContent = userName;
    document.getElementById('deleteModal').style.display = 'block';
    
    // Add animation
    setTimeout(() => {
        document.querySelector('.modal-content').style.transform = 'scale(1)';
        document.querySelector('.modal-content').style.opacity = '1';
    }, 10);
}

function hideDeleteModal() {
    document.querySelector('.modal-content').style.transform = 'scale(0.9)';
    document.querySelector('.modal-content').style.opacity = '0';
    
    setTimeout(() => {
        document.getElementById('deleteModal').style.display = 'none';
        deleteUserId = null;
    }, 200);
}

function confirmDelete() {
    if (deleteUserId) {
        // Show loading state
        const confirmBtn = document.querySelector('.modal-btn-confirm');
        const originalText = confirmBtn.innerHTML;
        confirmBtn.innerHTML = '<div class="loading-spinner" style="display: inline-block;"></div> Deleting...';
        confirmBtn.disabled = true;
        
        // Submit the form
        setTimeout(() => {
            document.getElementById('delete-form-' + deleteUserId).submit();
        }, 500);
    }
}

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideDeleteModal();
    }
});

// Add hover effects to table rows
document.addEventListener('DOMContentLoaded', function() {
    const tableRows = document.querySelectorAll('.users-table tbody tr');
    
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.01)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
});
</script>
@endsection
