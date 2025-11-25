<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin MYTPL</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('template/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    
    <style>
        /* Modern Design Enhancements */
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --info-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        body {
            background: #f8f9fc;
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        /* Modern Sidebar */
        .sidebar {
            background: var(--primary-gradient) !important;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .sidebar-brand {
            height: 4.5rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar-brand-icon {
            font-size: 1.5rem;
        }

        .sidebar-brand-text {
            font-weight: 700;
            font-size: 1.2rem;
        }

        .sidebar .nav-item {
            margin: 0.2rem 0.5rem;
        }

        .sidebar .nav-link {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .sidebar .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: width 0.3s ease;
        }

        .sidebar .nav-link:hover::before {
            width: 100%;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }

        .sidebar .nav-link span {
            position: relative;
            z-index: 1;
        }

        .sidebar-heading {
            font-size: 0.75rem;
            font-weight: 800;
            color: rgba(255, 255, 255, 0.7) !important;
            letter-spacing: 0.05rem;
            padding: 0.5rem 1.5rem;
        }

        .sidebar-divider {
            border-color: rgba(255, 255, 255, 0.2) !important;
        }

        /* Modern Topbar */
        .topbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .topbar .navbar-search .form-control {
            border-radius: 2rem;
            padding-left: 2.5rem;
            border: 2px solid #e3e6f0;
            transition: all 0.3s ease;
        }

        .topbar .navbar-search .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        }

        .topbar .nav-link {
            transition: all 0.3s ease;
        }

        .topbar .nav-link:hover {
            transform: translateY(-2px);
        }

        /* Modern Cards */
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.25);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            border-radius: 1rem 1rem 0 0 !important;
            border: none;
            font-weight: 600;
        }
        
        .card-header * {
            color: white !important;
        }

        /* Stats Cards */
        .stats-card {
            border-radius: 1rem;
            padding: 1.5rem;
            color: white;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transition: all 0.5s ease;
        }

        .stats-card:hover::before {
            top: -100%;
            right: -100%;
        }

        .stats-card:hover {
            transform: translateY(-10px) scale(1.02);
        }

        .stats-card .icon {
            font-size: 3rem;
            opacity: 0.3;
            position: absolute;
            bottom: -10px;
            right: 15px;
        }

        /* Buttons */
        .btn {
            border-radius: 0.5rem;
            font-weight: 600;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            border: none;
        }

        .btn-warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
        }

        .btn-info {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
        }

        /* DataTables */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary-gradient) !important;
            border: none !important;
            border-radius: 0.35rem;
        }

        /* Badges */
        .badge {
            border-radius: 0.35rem;
            padding: 0.35em 0.65em;
            font-weight: 600;
        }

        /* Scroll to top button */
        .scroll-to-top {
            background: var(--primary-gradient);
            border-radius: 50%;
            width: 2.75rem;
            height: 2.75rem;
        }

        .scroll-to-top:hover {
            transform: scale(1.1);
        }

        /* Alerts */
        .alert {
            border-radius: 0.75rem;
            border: none;
            box-shadow: 0 0.15rem 1rem rgba(0, 0, 0, 0.1);
        }

        /* Modal */
        .modal-content {
            border-radius: 1rem;
            border: none;
        }

        .modal-header {
            background: var(--primary-gradient);
            color: white;
            border-radius: 1rem 1rem 0 0;
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.5s ease-out;
        }

        /* Hover Shadow for Quick Actions */
        .hover-shadow {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .hover-shadow:hover {
            background: #f8f9fc;
            box-shadow: 0 0.15rem 1rem rgba(0, 0, 0, 0.1);
        }

        /* Icon Circle */
        .icon-circle {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Fix Action Button Size - Make them smaller and cleaner */
        .btn-circle {
            width: 32px !important;
            height: 32px !important;
            padding: 0 !important;
            border-radius: 50% !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 0.75rem !important;
            transition: all 0.3s ease !important;
            margin: 0 2px !important;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        }

        .btn-circle:hover {
            transform: translateY(-3px) scale(1.1) !important;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .btn-circle i {
            font-size: 0.75rem !important;
            margin: 0 !important;
        }

        /* Action Buttons Container */
        .action-buttons {
            white-space: nowrap;
        }

        /* Table Enhancements */
        .table thead th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e3e6f0;
            background: linear-gradient(135deg, #f8f9fc 0%, #e3e6f0 100%);
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9fc;
        }

        .table td {
            vertical-align: middle;
        }


        /* Alternative: Square action buttons (cleaner look) */
        .btn-action {
            width: 32px;
            height: 32px;
            padding: 0;
            border-radius: 0.35rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            margin: 0 2px;
        }

        /* Table action column spacing */
        table td .btn {
            margin: 0 2px;
        }

        /* Better table styling */
        .table td {
            vertical-align: middle;
        }

        /* Dropdown Menu Fixes */
        .dropdown-menu {
            background: white;
            border: 1px solid #e3e6f0;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            padding: 0.5rem 0;
        }

        .dropdown-item {
            color: #5a5c69 !important;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            transform: translateX(5px);
        }

        .dropdown-item:active {
            background: var(--primary-gradient);
            color: white !important;
        }

        .dropdown-toggle {
            font-weight: 600;
        }

        .dropdown-divider {
            border-top: 1px solid #e3e6f0;
            margin: 0.5rem 0;
        }
    </style>
    
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    @stack('styles')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
       @include('layouts.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
               @include('layouts.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                    <!-- Page Heading -->
                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
              @include('layouts.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('template/js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('template/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('template/js/demo/datatables-demo.js')}}"></script>
    
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Global Delete Confirmation Script -->
    <script>
        // Modern Delete Confirmation with SweetAlert2
        function confirmDelete(url, itemName = 'data ini') {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus ${itemName}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74a3b',
                cancelButtonColor: '#858796',
                confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus!',
                cancelButtonText: '<i class="fas fa-times"></i> Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'animated-popup',
                    confirmButton: 'btn-lg',
                    cancelButton: 'btn-lg'
                },
                showClass: {
                    popup: 'animate__animated animate__fadeInDown animate__faster'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp animate__faster'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Submit delete form
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    
                    const csrfField = document.createElement('input');
                    csrfField.type = 'hidden';
                    csrfField.name = '_token';
                    csrfField.value = document.querySelector('meta[name="csrf-token"]').content;
                    
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    
                    form.appendChild(csrfField);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // Success Message (if redirected with success)
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false,
                position: 'top-end',
                toast: true,
                customClass: {
                    popup: 'colored-toast'
                },
                showClass: {
                    popup: 'animate__animated animate__fadeInRight'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutRight'
                }
            });
        @endif

        // Error Message (if redirected with error)
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonColor: '#e74a3b'
            });
        @endif
    </script>
    
    <style>
        /* SweetAlert2 Custom Styling */
        .animated-popup {
            border-radius: 1rem !important;
            font-family: 'Nunito', sans-serif !important;
        }
        
        .swal2-title {
            font-weight: 700 !important;
            color: #5a5c69 !important;
        }
        
        .swal2-html-container {
            color: #858796 !important;
        }
        
        .colored-toast.swal2-icon-success {
            background-color: #1cc88a !important;
            color: white !important;
        }
        
        .colored-toast .swal2-title {
            color: white !important;
            font-size: 1rem !important;
        }
        
        .colored-toast .swal2-html-container {
            color: white !important;
            font-size: 0.875rem !important;
        }
    </style>
    
    @stack('scripts')

</body>

</html>