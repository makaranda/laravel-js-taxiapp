@extends('layouts.frontend_dashboard')

@section('content')

<div class="user-profile-wrapper">
    <div class="row">
       <div class="col-lg-7">
          <div class="user-profile-card">
             <h4 class="user-profile-card-title">Profile Info</h4>
             <div class="user-profile-form">
                <form action="#" method="POST" id="updateProfile">
                    <input type="hidden" name="user_id" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="user_role" name="user_role" value="{{ Auth::user()->role }}">
                   <div class="row">
                      <div class="col-md-12">
                         <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" placeholder="Name">
                         </div>
                      </div>
                      <div class="col-md-6">
                         <div class="form-group">
                            <label>Gender</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->gender }}" placeholder="Gender">
                         </div>
                      </div>
                      <div class="col-md-6">
                         <div class="form-group">
                            <label>Birthday</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->birthday }}" placeholder="Birthday">
                         </div>
                      </div>
                      <div class="col-md-12">
                         <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->email }}" placeholder="Email">
                         </div>
                      </div>
                      <div class="col-md-12">
                         <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->phone }}" placeholder="Phone">
                         </div>
                      </div>
                      <div class="col-md-12">
                         <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->address }}" placeholder="Address">
                         </div>
                      </div>
                   </div>
                   <button type="button" class="theme-btn my-3"><span class="far fa-user"></span> Save Changes</button>
                </form>
             </div>
          </div>
       </div>
       <div class="col-lg-5">
          <div class="user-profile-card">
             <h4 class="user-profile-card-title">Change Password</h4>
             <div class="col-lg-12">
                <div class="user-profile-form">
                   <form action="#" id="updatePassword">
                      <input type="hidden" name="user_id" name="user_id" value="{{ Auth::user()->id }}">
                      <input type="hidden" name="user_role" name="user_role" value="{{ Auth::user()->role }}">
                      <div class="form-group">
                         <label>Old Password</label>
                         <input type="password" class="form-control" placeholder="Old Password" name="old_password">
                      </div>
                      <div class="form-group">
                         <label>New Password</label>
                         <input type="password" class="form-control" placeholder="New Password" name="new_password" id="new_password">
                      </div>
                      <div class="form-group">
                         <label>Re-Type Password</label>
                         <input type="password" class="form-control" placeholder="Re-Type Password" name="confirm_password">
                      </div>
                      <button type="button" class="theme-btn my-3"><span class="far fa-key"></span> Change Password</button>
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>


@endsection

@push('css')
<style>

</style>
@endpush
@push('scripts')
<script>

</script>

@endpush
