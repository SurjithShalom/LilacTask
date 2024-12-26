@extends('Users.layout')
@section('styles')
<style>
    .search-box {
        padding: 20px;
        margin-bottom: 20px;
    }
    .user-card {
        padding: 15px;
        margin-bottom: 15px;
        background: white;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .user-name {
        font-size: 18px;
        margin-bottom: 5px;
    }
    .user-details {
        color: #666;
    }
    body{
        background: #f8f9fa;
    }
</style>
@endsection
@section('content')
<div class="container mt-4">
        <div class="search-box card">
        <input type="text" class="form-control" id="searchInput" placeholder="Search name/designation/department" autocomplete="off">
    </div>

    <div id="usersList" class="row">
        @foreach($users as $user)
        <div class="col-md-6 user-item">
            <div class="user-card">
                <h4>{{ $user->name }}</h4>
                <p>{{ $user->designation->name }}</p>
                <p>{{ $user->department->name }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    var searchTimer;
    $('#searchInput').on('keyup', function() {
        clearTimeout(searchTimer);
        const searchValue = $(this).val();
        
        searchTimer = setTimeout(function() {
            $.ajax({
                url: '{{ route("users.search") }}',
                method: 'GET',
                data: { search: searchValue },
                success: function(users) {
                    $('#usersList').empty();
                    users.forEach(function(user) {
                        $('#usersList').append(`
                            <div class="col-md-6 user-item">
                                <div class="user-card">
                                    <h4>${user.name}</h4>
                                    <p>${user.designation.name}</p>
                                    <p>${user.department.name}</p>
                                </div>
                            </div>
                        `);
                    });
                }
            });
        }, 300);
    });
});
</script>
@endpush