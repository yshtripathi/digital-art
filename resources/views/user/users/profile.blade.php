@extends('user.layouts.master')

@section('title','My Profile')

@section('main-content')
<div class="container-fluid px-4 py-5">
    @include('user.layouts.notification')
    
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-5">
      <h1 class="h3 mb-0 text-dark fw-800" style="font-weight: 800; letter-spacing: -0.5px;">Account Settings</h1>
    </div>

    <div class="row g-4">
        <!-- Profile Preview Card -->
        <div class="col-xl-4 col-lg-5">
            <div class="modern-card border-0 shadow-sm text-center p-5">
                <div class="position-relative d-inline-block mb-4">
                    <div class="profile-img-container shadow-lg" style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; border: 5px solid #fff; margin: 0 auto;">
                        @if($profile->photo)
                            <img src="{{$profile->photo}}" alt="profile" style="width: 100%; height: 100%; object-fit: cover;">
                        @else 
                            <img src="{{asset('backend/img/avatar.png')}}" alt="profile" style="width: 100%; height: 100%; object-fit: cover;">
                        @endif
                    </div>
                </div>
                
                <h4 class="fw-bold text-dark mb-1">{{$profile->name}}</h4>
                <p class="text-muted small mb-4">{{$profile->email}}</p>
                
                <div class="badge bg-soft-primary px-3 py-2" style="background: rgba(99, 102, 241, 0.1); color: #6366f1; border-radius: 10px;">
                    <i class="fas fa-user-shield me-2"></i> {{ucwords($profile->role)}}
                </div>

                <div class="mt-5 pt-4 border-top">
                    <div class="d-flex justify-content-around text-center">
                        <div>
                            <h6 class="fw-bold text-dark mb-0">{{\App\Models\Order::where('user_id', auth()->user()->id)->count()}}</h6>
                            <span class="small text-muted">Orders</span>
                        </div>
                        <div class="border-start border-end px-4">
                            <h6 class="fw-bold text-dark mb-0">{{number_format(auth()->user()->points_balance ?? 0)}}</h6>
                            <span class="small text-muted">Points</span>
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-0">{{\App\Models\ProductReview::where('user_id', auth()->user()->id)->count()}}</h6>
                            <span class="small text-muted">Reviews</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Form -->
        <div class="col-xl-8 col-lg-7 ps-xl-4">
            <div class="modern-card border-0 shadow-sm p-5 bg-white">
                <h5 class="fw-bold text-dark mb-4">Personal Information</h5>
                
                <form method="POST" action="{{route('user-profile-update',$profile->id)}}">
                    @csrf
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="small fw-bold text-uppercase opacity-50 mb-2">Full Name</label>
                            <input type="text" name="name" placeholder="Enter name" value="{{$profile->name}}" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <span class="text-danger small mt-2 d-block">{{$message}}</span>
                            @enderror
                        </div>
                
                        <div class="col-md-6">
                            <label class="small fw-bold text-uppercase opacity-50 mb-2">Email Address</label>
                            <input type="email" name="email" value="{{$profile->email}}" class="form-control opacity-50" disabled>
                        </div>

                        <div class="col-md-6">
                            <label class="small fw-bold text-uppercase opacity-50 mb-2">Profile Role</label>
                            <select name="role" class="form-control opacity-50" disabled>
                                <option value="user" selected>User</option>
                            </select>
                        </div>
                
                        <div class="col-12">
                            <label class="small fw-bold text-uppercase opacity-50 mb-2">Profile Photo URL</label>
                            <div class="input-group">
                                <input id="thumbnail" class="form-control @error('photo') is-invalid @enderror" type="text" name="photo" value="{{$profile->photo}}" placeholder="Paste image URL or choose file">
                                <button id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary px-4 rounded-end-4" type="button">
                                    <i class="fa fa-picture-o me-2"></i> Browse
                                </button>
                            </div>
                            @error('photo')
                                <span class="text-danger small mt-2 d-block">{{$message}}</span>
                            @enderror
                            <div id="holder" class="mt-3"></div>
                        </div>

                        <div class="col-12 mt-5">
                            <button type="submit" class="modern-btn modern-btn-solid w-100 py-3 shadow-lg">
                                Save Changes <i class="fas fa-save ms-2"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $(document).ready(function() {
        $('#lfm').filemanager('image');
    });
</script>
@endpush