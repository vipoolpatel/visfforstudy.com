@extends('backend.layouts.app')

@section('content')

<!-- start: breadcrumb area -->
<div class="breadcrumb-area">
<div class="container">
<div class="row">
<div class="col-12">
  <div class="breadcrumb-items d-flex align-items-center">
        <span class="breadcrumb-trail">
              <a href="#" class="text-capitalize">{{ __('admin.Add_Language') }}</a>
        </span>
  </div>
</div>
</div>
</div>
</div>
<!-- end: breadcrumb area -->



<!-- start: main content -->
<div class="main-content">
<div class="container">
<!-- start: add admin section -->
<section class="add-admin-section">
<div class="section-content">
  <div class="row">
        <div class="col-12">
              <div class="add-admin-form-wrap">
                    <form action="{{ url('admin/language/add') }}" class="add-admin-form w-100" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                   

                          <div class="form-group">
                                <label>{{ __('admin.Language_Name') }}</label>
                                <input type="text" required value="{{ old('language_name') }}" name="language_name" class="form-control" placeholder="{{ __('admin.Language_Name') }}">
                          </div>
                          
                         
                          <div class="form-submit-btn-cont text-right">
                                <button type="submit" class="form-submit-btn reg-signup-btn deep-bg">{{ __('admin.Submit') }}</button>
                          </div>
                    </form>
              </div>
        </div>
  </div>
</div>
</section>
<!-- end: add admin section -->
</div>
</div>
<!-- end: main content -->




@endsection
