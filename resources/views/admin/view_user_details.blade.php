@include('admin.includes.header')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 text-white"><i class="fas fa-users"></i> User Family Details</h4>
                            <a href="{{ url('admin/users-list') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left"></i> Back to Users
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse ($UsersDetails as $family)
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="card h-100 shadow-sm border-0">
                                            <div class="card-body text-center">
                                                <!-- Profile Icon -->
                                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto"
                                                    style="width: 100px; height: 100px;">
                                                    <i class="fas fa-user fa-3x text-primary"></i>
                                                </div>
                                                <h5 class="mt-3 mb-1 text-primary">{{ $family->name }}</h5>
                                                <span class="badge badge-info px-3 py-2">
                                                    {{ ucfirst($family->relation) }}
                                                </span>
                                                <hr>
                                                <table class="table table-sm table-borderless mb-0 text-left">
                                                    <tbody>
                                                        <tr>
                                                            <th width="40%" class="text-muted">Age:</th>
                                                            <td>{{ $family->age }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-muted">Created:</th>
                                                            <td>{{ $family->created_at ? \Carbon\Carbon::parse($family->created_at)->format('j M, Y') : '-' }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer bg-light text-center">
                                                <button class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center">
                                        <p class="text-muted">
                                            <i class="fas fa-info-circle"></i> No Family Members Found
                                        </p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('admin.includes.footer')
