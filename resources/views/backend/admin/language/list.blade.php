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
<!-- start: breadcrumb area -->
<div class="admin-filter-area request-filter-area breadcrumb-area">
   <div class="container">
      <div class="row align-items-end justify-content-between flex-lg-nowrap">
         <div class="col-12 col-lg-auto col-xl-auto flex-grow-1 mb-3 mb-lg-0">
            <div class="title-and-status d-md-flex justify-content-between justify-content-lg-start align-items-center">
               <h3 class="page-title breadcrumb-trail">
                  {{ __('admin.Language_List') }}
               </h3>
               <div class="status-search">
                  <p class="status-text">
                     <a href="{{ url('admin/language/add') }}" style="margin-left: 10px;" class="btn btn-danger">    {{ __('admin.Add_new_Language') }}</a>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-12 col-lg-auto col-xl-auto flex-lg-fill">
            <div class="admin-search-box">
               <form action="" class="admin-search-form" method="get">
                  <div class="admin-search-form-inner d-flex justify-content-center justify-content-md-end">
                     <div class="form-group m-0">
                        <label> {{ __('admin.Language_Name') }}</label>
                        <div class="input-group m-0 flex-nowrap">
                           <input type="text" name="language_name" value="{{ Request()->language_name }}" class="search-teacher-name" placeholder="{{ __('admin.Enter_a_name') }}">
                           <button type="submit" class="search-submit d-inline-flex align-items-center justify-content-center">
                           <span class="btn-text mr-2"> {{ __('admin.Search') }}</span>
                           <i class="fas fa-search"></i>
                           </button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end: breadcrumb area -->
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
                                    <th>{{ __('admin.Language_Name') }}</th>
                                    
                                    <th>{{ __('admin.Created_Date') }}</th>

                                    <th>{{ __('admin.Updated_Date') }}</th>                                    
                                    <th>{{ __('admin.Action') }}</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @forelse($getrecord as $value)
                                 <tr class="single-course-item">
                                   
                                    <td>{{ $value->language_name}}</td>
                                    <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                    <td>{{ date('d-m-Y h:i A', strtotime($value->updated_at)) }}</td>

                                    <td class="action" data-title="Action">
                                       <span class="action-btn-wrap">
                                       <a href="{{ url('admin/language/edit/'.$value->id) }}" class="button error-btn">
                                       <i class="fas fa-edit"></i>
                                       </a>
                                       
                                       <a onclick="delete_record('{{ url('admin/language/delete/'.$value->id) }}')" class="button trash-btn"><i class="far fa-trash-alt"></i></a>

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
                           <div style="clear: both;"></div>
                          <div style="float: right;margin-top: 20px;">
                           {{ $getrecord->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}  
                        </div>
                        <div style="clear: both;"></div>
                        <br />
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
<script type="text/javascript">
 
</script>
@endsection --}}
