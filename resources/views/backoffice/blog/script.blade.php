<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script>
    // Handle form submission with AJAX
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('#meForm');
        if (form) {
            form.addEventListener('submit', handleFormSubmit);
        }

        initializeDataTable();
        setupDeleteButtons();
    });

    /**
     * Handle form submission
     * @param {Event} e - The submit event
     */
    function handleFormSubmit(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(errorData => {
                    throw new Error(errorData.message || 'Terjadi kesalahan');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showSuccessAlert(data.message);
                setTimeout(() => {
                    window.location.href = "{{ route('blog.index') }}";
                }, 3000);
            } else {
                throw new Error(data.message || 'Gagal menyimpan data');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showErrorAlert(error.message || 'Terjadi kesalahan. Silakan coba lagi.');
        });
    }

    /**
     * Initialize DataTable
     */
    function initializeDataTable() {
        $('#example').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            pageLength: 10,
            language: {
                paginate: {
                    previous: "Sebelumnya",
                    next: "Berikutnya"
                },
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data tersedia",
                zeroRecords: "Data tidak ditemukan",
            }
        });
    }

    /**
     * Setup delete buttons with confirmation
     */
    function setupDeleteButtons() {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const deleteUrl = button.getAttribute('data-url');
                confirmDelete(deleteUrl);
            });
        });
    }

    /**
     * Show confirmation dialog for delete action
     * @param {string} deleteUrl - The URL for the delete request
     */
    function confirmDelete(deleteUrl) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data ini akan dihapus dan tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then(result => {
            if (result.isConfirmed) {
                sendDeleteRequest(deleteUrl);
            }
        });
    }

    /**
     * Send DELETE request to the server
     * @param {string} deleteUrl - The URL for the delete request
     */
    function sendDeleteRequest(deleteUrl) {
        $.ajax({
            url: deleteUrl,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            success: function(response) {
                if (response.success) {
                    showSuccessAlert(response.message);
                    location.reload(); // Reload the page after deletion
                } else {
                    showErrorAlert(response.message);
                }
            },
            error: function(xhr, status, error) {
                showErrorAlert('Terjadi kesalahan saat menghapus data.');
            }
        });
    }

    /**
     * Show success alert
     * @param {string} message - The success message
     */
    function showSuccessAlert(message) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: message,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
        });
    }

    /**
     * Show error alert
     * @param {string} message - The error message
     */
    function showErrorAlert(message) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: message,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
        });
    }
</script>
