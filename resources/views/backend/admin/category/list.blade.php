@extends('backend.layouts.app')
@section('style')
<style type="text/css">
      .all-course-table tr > th {
            text-align: left;
      }
      .all-course-table tr > td {
            text-align: left;
      }
</style>
@endsection 
@section('content')


<!-- start: request filter/breadcrumb area -->
<div class="request-filter-area breadcrumb-area">
   <div class="container">
      <div class="row align-items-end justify-content-between flex-lg-nowrap">
         <div class="col-12 col-lg-auto col-xl-auto flex-grow-1 mb-3 mb-lg-0">
            <div class="title-and-status d-md-flex justify-content-between justify-content-lg-start align-items-center">
               <h3 class="page-title breadcrumb-trail">{{ __('admin.Category_List') }}</h3>
               <div class="status-search">
                  <p class="status-text">
                     <a href="{{ url('admin/category/add') }}" style="margin-left: 10px;" class="btn btn-danger">{{ __('admin.Add_new_Category') }}</a>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-12 col-lg-auto col-xl-auto flex-lg-fill">
            <div class="find-multi-search-box">
               <form action="" method="get" class="multi-search-form d-flex align-items-end justify-content-end">
                  <div class="input-group">
                      <div class="form-group">
                        <label for="lang-multi">{{ __('admin.Category_ID') }}</label>
                        <input type="text" name="id" value="{{ Request()->id }}" class="form-control" style="height: 35px;" placeholder="{{ __('admin.Enter_Category_ID') }}">
                     </div>
                     
                     <div class="form-group">
                        <label for="lang-multi">{{ __('admin.Select_Status') }}</label>
                        <select name="status" class="lang-multi form-control">
                           <option value="">{{ __('admin.Select_Status') }}</option>
                           <option {{ (Request()->status ==  '1') ? 'selected' : '' }} value="1">{{ __('admin.Active') }}</option>
                           <option {{ (Request()->status ==  '2') ? 'selected' : '' }} value="2">{{ __('admin.Inactive') }}</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="lang-multi">{{ __('admin.Category_Name') }}</label>
                        <input type="text" name="category_name" value="{{ Request()->category_name }}" class="form-control" style="height: 35px;" placeholder="{{ __('admin.Enter_a_name') }}">
                     </div>
                  </div>
                  <button type="submit" class="multi-search-submit d-inline-flex align-items-center justify-content-between">
                     <span class="btn-text">{{ __('admin.Search') }}</span>
                     <i class="fas fa-search"></i>
                  </button>
                  <a href="{{ url('admin/category') }}" class="multi-search-submit d-inline-flex align-items-center justify-content-between" style="margin-left: 10px;color: #fff;">{{ __('admin.Reset') }}</a>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end: request filter/breadcrumb area -->



<!-- start: main content -->
<div class="main-content withdraw-request-content">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <!-- start: all offer content -->
            <section class="all-withdraw-request-section all-offer-section">
               @include('message')
               <div class="all-course-view all-withdraw-request">
                  <div class="course-tabulation w-100">
                     <div class="tab-content all-course-list-box">
                        {{-- Start --}}
                        <div class="tab-pane in active pending-withdraw">
                           <table class="all-course-table">
                              <thead>
                                 <tr class="course-list-heading">
                                    {{-- <th>Parent Category</th> --}}
                                    <th>{{ __('admin.Category_ID') }}</th>
                                    <th>{{ __('admin.Category_Name') }}</th>
                                    <th> Chinese Category Name</th>
                                    <th>{{ __('admin.Image') }}</th>
                                    <th>{{ __('admin.Status') }}</th>
                                    <th>{{ __('admin.Created_Date') }}</th>
                                    <th>{{ __('admin.Action') }}</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @forelse($getrecord as $value)
                                 <tr class="single-course-item">
                                   {{--  <td>
                                       {{ ucfirst(!empty($value->getcategoryparent->category_name)?$value->getcategoryparent->category_name: '') }}
                                    </td> --}}
                                    <td>{{ $value->id}}</td>
                                    <td>{{ $value->category_name}}</td>
                                    <td>{{ $value->ch_category_name}}</td>
                                    <td class="teacher-name">
                                       @if(!empty($value->category_pic) && file_exists('upload/category/'.$value->category_pic) )
                                       <img style="width: 100px;height: 100px;" src="{{ url('upload/category/'.$value->category_pic) }}" alt="tutor-image">
                                       @endif                                    
                                    </td>
<td>
<select class="form-control ChangeReviewStatus" id="{{ $value->id  }}" style="width: 150px;">
   <option value="1" <?=($value->status == '1') ? 'selected' : ''?>>{{ __('admin.Active') }}</option>
   <option value="2" <?=($value->status == '2') ? 'selected' : ''?>>{{ __('admin.Inactive') }}</option>
</select>
</td>
                                    <td>{{ date('Y-m-d h:i A', strtotime($value->created_at)) }}</td>
                                    <td class="action" data-title="Action">
                                       <span class="action-btn-wrap">
                                       <a href="{{ url('admin/category/edit/'.$value->id) }}" class="button error-btn">
                                       <i class="fas fa-edit"></i>
                                       </a>
                                 

                                           <a onclick="delete_record('{{ url('admin/category/delete/'.$value->id) }}')" class="button trash-btn"><i class="far fa-trash-alt"></i></a>


                                       </span>
                                    </td>
                                 </tr>
                                 @empty
                                 <tr  class="single-course-item">
                                    <td colspan="100%">{{ __('admin.Record_not_found') }}</td>
                                 </tr>
                                 @endforelse
                              </tbody>
                           </table>
                           <div style="float: right">
                              {{ $getrecord->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}
                           </div>
                        </div>
                        {{-- End --}}
                     </div>
                  </div>
               </div>
            </section>
            <!-- end: all offer content -->
         </div>
      </div>
   </div>
</div>

@endsection
{{-- @section('script')
<<script type="text/javascript"></script>
@endsection   --}}
@section('script')
<script type="text/javascript">
   $('.ChangeReviewStatus').change(function(){
           var id = $(this).attr('id');
           var status = $(this).val();
           $.ajax({
                  type:'GET',
                  url:"{{url('admin/category/change_review_status')}}",
                  data: {id:id,status:status},
                  dataType: 'JSON',
                  success:function(data){
                     alert(data.success);
                  }
           });
   }); 
</script>
@endsection
