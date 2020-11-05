@extends('backend.layouts.app')
@section('style')
<style type="text/css">
      .all-course-table tr > th {
            text-align: left;
      }
      .all-course-table tr > td {
            text-align: left !important;
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
						<h3 class="page-title breadcrumb-trail">{{ __('admin.Tutor_List') }}</h3>
						<div class="status-search">
							<p class="status-text">
                        <a href="{{ url('admin/tutor/add') }}" style="margin-left: 10px;" class="btn btn-danger">{{ __('admin.Add_new_Tutor') }}</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-auto col-xl-auto flex-lg-fill">
					<div class="find-multi-search-box">
						<form action="" method="get" class="multi-search-form d-flex align-items-end justify-content-end">
							<div class="input-group">
                      <div class="form-group">
                        <label for="lang-multi">{{ __('admin.Tutor_ID') }}</label>
                        <input type="text" name="id" value="{{ Request()->id }}" class="form-control" style="height: 35px;" placeholder="{{ __('admin.Enter_Tutor_ID') }}">
                     </div>

								<div class="form-group">
                           <label for="subject-multi">{{ __('admin.Select_Category') }}</label>
                           <select name="category_id" class="subject-multi form-control">
                                 <option value="">{{ __('admin.Category') }}</option>
                                 @foreach ($getcategory as $value_ca)
                                 <option {{ (Request()->category_id == $value_ca->id) ? 'selected' : '' }} value="{{ $value_ca->id }}">{{ $value_ca->getcategoryname() }}</option>
                                 @endforeach
                           </select>
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
									<label for="lang-multi">{{ __('admin.Student_Name') }}</label>
									<input type="text" name="name" value="{{ Request()->name }}" class="form-control" style="height: 35px;" placeholder="{{ __('admin.Enter_a_name') }}">
								</div>
							</div>
							<button type="submit" class="multi-search-submit d-inline-flex align-items-center justify-content-between">
								<span class="btn-text">{{ __('admin.Search') }}</span>
								<i class="fas fa-search"></i>
							</button>
                      <a href="{{ url('admin/tutor') }}" class="multi-search-submit d-inline-flex align-items-center justify-content-between" style="margin-left: 10px;color: #fff;">{{ __('admin.Reset') }}</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end: request filter/breadcrumb area -->

<!-- start: main content -->
<div class="main-content all-course-content">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <!-- start: all course content -->
            <section class="all-course-section admin-total-user-section">

               <div class="all-course-view">
                  <div class="course-tabulation w-100">
                     <div class="tab-content all-course-list-box">
                        <table class="all-course-table total-teacher-table">
                           <thead>
                              <tr class="course-list-heading">
                                 <th>{{ __('admin.Tutor_ID') }}</th>
                                 <th>{{ __('admin.Tutor_Name') }}</th>
                                 <th>{{ __('admin.Email') }}</th>
                                 <th>{{ __('admin.Category') }}</th>
                                    <th>Country</th>
                                 <th>{{ __('admin.Status') }}</th>
                                 <th>Chat History</th>
                                 <th>{{ __('admin.Action') }}</th>
                              </tr>
                           </thead>
                           <tbody>
                              @forelse($getrecord as $value)
                              <tr class="single-course-item">
                                   <td>{{ $value->id }}</td>
                                 <td class="teacher-name" data-title="Teacher name">

                                    <span class="info-wrap">
                                    @if($value->OnlineUser())
                                          <i class="fa fa-circle online-user"></i>
                                    @endif

                                    <span class="image">
                                           <img src="{!! $value->getImage() !!}" alt="tutor-image">
                                    </span>
                                    <span class="name">
                                    {{ ucfirst(!empty($value->name)?$value->name: '') }}
                                    {{ ucfirst(!empty($value->last_name)?$value->last_name: '') }}
                                    </span>
                                    </span>
                                 </td>
                                 <td>{{ $value->email }}</td>

                    <td>{{ ucfirst(!empty($value->getcategory->category_name) ? $value->getcategory->category_name : '') }}</td>
<td>{{ ucfirst(!empty($value->getcountry->nicename) ? $value->getcountry->nicename : '') }}</td>
                    <td>
                       <select class="form-control ChangeRequestStatus" id="{{ $value->id }}" style="width: 150px;">
                        <option value="1" {{ ($value->status == "1") ? 'selected' : ''}}>{{ __('admin.Active') }}</option>
                        <option value="0" {{ ($value->status == "0") ? 'selected' : ''}}>{{ __('admin.Inactive') }}</option>
                       </select>
                    </td>
                    <td>
                     <a href="{{ url('admin/chat-history/'.$value->id) }}" class="btn btn-danger">Chat History</a>
                    </td>
                                 <td class="action" data-title="Action">

                                    <span class="action-btn-wrap">
          <a href="{{ url('admin/tutor/view/'.$value->id) }}" class="button view-btn"><i class="far fa-eye"></i></a>
      <a href="{{ url('admin/tutor/edit/'.$value->id) }}" class="button error-btn">
      <i class="fas fa-edit"></i>
      </a>

      <a href="{{ url('admin/send_mssage/'.$value->id) }}" class="button view-btn">Chat</a>

                                    <a onclick="delete_record('{{ url('admin/tutor/delete/'.$value->id) }}')"  class="button trash-btn">
                                    <i class="far fa-trash-alt"></i>
                                    </a>




                                    </span>
                                 </td>
                              </tr>
                              @empty
                              <tr class="single-course-item">
                                 <td colspan="100%">{{ __('admin.Record_not_found') }}</td>
                              </tr>
                              @endforelse
                           </tbody>
                        </table>

                        <div style="float: right;margin-top: 20px;">
                            {{ $getrecord->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}
                        </div>

                     </div>
                  </div>
               </div>
            </section>
            <!-- end: all course content -->
         </div>
      </div>
   </div>
</div>
<!-- end: main content -->
@endsection

@section('script')
<script>
   $(document).ready(function(){
      $('.ChangeRequestStatus').change(function(){
         var id = $(this).attr('id');
         var status = $(this).val();
         $.ajax({
            type: 'GET',
            url:"{{ url('admin/tutor/change_tutor_studnet') }}",
            data: {id: id, status: status},
            dataType: 'json',
            success: function (data)
            {
               alert(data.success);
            }
         });
      });
   });
</script>
@endsection
