<style>
    :root {
        --primary: #4361ee;
        --primary-light: #4895ef;
        --secondary: #3f37c9;
        --success: #4cc9f0;
        --danger: #f72585;
        --warning: #f8961e;
        --info: #4895ef;
        --dark: #212529;
        --light: #f8f9fa;
    }

    body {
        font-family: "Inter", sans-serif;
        background-color: #f7fafc;
        color: #2d3748;
    }

    .sidebar {
        transition: all 0.3s ease;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .nav-item {
        transition: all 0.2s ease;
        border-radius: 0.5rem;
    }

    .nav-item:hover {
        transform: translateX(5px);
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 9999px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background-color: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background-color: var(--secondary);
        transform: translateY(-2px);
    }

    .btn-danger {
        background-color: var(--danger);
        color: white;
    }

    .btn-danger:hover {
        background-color: #d1146a;
        transform: translateY(-2px);
    }

    .search-input {
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }

    .search-input:focus {
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
    }

    @media (max-width: 768px) {
        .sidebar {
            position: fixed;
            top: 0;
            left: -100%;
            z-index: 50;
            height: 100vh;
        }

        .sidebar.active {
            left: 0;
        }
    }

    /* Animation for alerts */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert {
        animation: slideIn 0.3s ease;
    }
</style>
