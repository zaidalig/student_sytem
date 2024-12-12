@extends('masteradmin')
@section('title')
Student Details
@endsection

@section('content')
<div class="title text-center my-3">
    <h2 class="text-primary">{{ $student->Name }} Details</h2>
</div>
<div class="row">
    <div class="col-md-6 offset-md-3">
        <table class="table table-bordered">
            <tr>
                <td class="w-25">Student Id</td>
                <td>{{ $student->id }}</td>
            </tr>
            <tr>
                <td>Student Name</td>
                <td>{{ $student->Name }}</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>{{ $student->Phone }}</td>
            </tr>
            <tr>
                <td>Birth</td>
                <td>{{ $student->Birth }}</td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>{{ $student->Gender }}</td>
            </tr>
            <tr>
                <td>Class</td>
                <td>{{ $student->Class }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{{ $student->Address }}</td>
            </tr>
            <tr>
                <td>Father Name</td>
                <td>{{ $student->fatherName }}</td>
            </tr>
            <tr>
                <td>Father Phone</td>
                <td>{{ $student->fatherPhone }}</td>
            </tr>
            <tr>
                <td>Attend Days</td>
                <td>{{ $totalAttend }} out of {{ $totalDays }} Days ({{ ($totalAttend / $totalDays) * 100 }}%)</td>
            </tr>
            <tr>
                <td>Absend Days</td>
                <td>{{ $totalAbsend }} out of {{ $totalDays }} Days ({{ ($totalAbsend / $totalDays) * 100 }}%)</td>
            </tr>
            <tr>
                <td>Student Status</td>
                <td>{{ $student->Status }}</td>
            </tr>

        </table>
        <a href="{{ route('admin.student.edit', $student->id) }}" class="btn btn-primary btn-block my-2">Edit
            Student</a>

        <form action="{{ route('admin.student.delete', $student->id) }}" method="POST">
            @csrf
            @method('DELETE')
        <button class="btn btn-danger btn-block"
            onclick="showDeleteModal('{{ route('admin.student.delete', $student->id) }}')">Delete Student</button>

        </form>
    </div>
</div>


<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="deleteConfirmationLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this student? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    let deleteUrl = ''; // To store the URL dynamically

    function showDeleteModal(url) {
        deleteUrl = url; // Set the delete URL for the confirmation
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
        deleteModal.show();
    }

    document.getElementById('confirmDelete').addEventListener('click', function () {
        const deleteForm = document.createElement('form'); // Create a new form dynamically
        deleteForm.action = deleteUrl; // Assign the stored URL
        deleteForm.method = 'POST';

        // Add CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        deleteForm.appendChild(csrfInput);

        // Add DELETE method
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        deleteForm.appendChild(methodInput);

        document.body.appendChild(deleteForm); // Append the form to the document
        deleteForm.submit(); // Submit the form
    });
</script>


@endsection