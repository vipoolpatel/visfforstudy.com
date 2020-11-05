@extends('backend.layouts.app')

@section('content')

      <!-- start: breadcrumb area -->
      <div class="breadcrumb-area">
            <div class="container">
                  <div class="row">
                        <div class="col-12">
                              <div class="breadcrumb-items d-flex align-items-center">
                                    <span class="breadcrumb-trail">
                                          <a href="#" class="text-capitalize">
                                    {{ __('admin.Add_Category') }}
                                          </a>
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
                                                <form action="{{ url('admin/category/add') }}" class="add-admin-form w-100" method="post" enctype="multipart/form-data">
                                                  {{ csrf_field() }}
                                                {{--   <div class="form-group">
                                                    <label>Category Type</label>
                                                    <select class="form-control" name="parent_id">
                                                        <option value="0">Select Parent Category</option>
                                                        @foreach ($getcategory as $value_category)
                                                        <option value="{{ $value_category->id }}">{{ $value_category->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                  </div> --}}

    <div class="form-group">
          <label>
          {{ __('admin.Category_Name') }}
          </label>
          <input type="text" required value="{{ old('category_name') }}" name="category_name" class="form-control" placeholder="{{ __('admin.Category_Name') }}">
    </div>
      <div class="form-group">
          <label>
       Chinese Category Name
          </label>
          <input type="text" required value="{{ old('ch_category_name') }}" name="ch_category_name" class="form-control" placeholder="Chinese Category Name">
    </div>
                                                      
    <div class="form-group">
          <label> {{ __('admin.Category_Image') }}</label>
        <input type="file" style="padding: 0px;padding-left: 10px;" name="category_pic" class="form-control">
    </div>

    <div class="form-group">
      <label> {{ __('admin.Status') }}</label>
      <select name="status" required="" class="form-control">
          <option value="1"> {{ __('admin.Active') }} </option>
          <option value="2"> {{ __('admin.Inactive') }} </option>
        </select>
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
