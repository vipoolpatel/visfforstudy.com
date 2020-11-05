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




    <!-- start: breadcrumb area --> 
    <div class="breadcrumb-area">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="breadcrumb-items d-flex align-items-center">
              <span class="breadcrumb-trail">
                <a href="#" class="text-capitalize">Booking Lesson Course</a>
              </span>
            
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end: breadcrumb area -->



    <!-- start: main content -->
    <div class="main-content all-course-content">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <!-- start: all course content -->
            <section class="all-course-section">
              <div class="all-course-view">
                <div class="course-tabulation w-100">
              
                  <div class="tab-content all-course-list-box">
                    
                      <table class="all-course-table">
                        <thead>
                          <tr class="course-list-heading">
                            <th class="teacher-name">ID</th>
                            <th class="teacher-name">Student Name</th>
                            <th class="course-title">Course Title</th>
                            <th class="date">Date</th>
                            <th class="time">Time</th>
                            <th class="duration">Duration</th>
                            <th class="price">Price</th>
                            <th class="price">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                        @forelse($getOrder as $value)

                          <tr class="single-course-item">
                            <td>{{ $value->id }}</td>
                            <td class="teacher-name" data-title="Teacher name">
                              <span class="info-wrap">
                                <span class="image">
                                  <img src="{!! $value->getstudent->getImage() !!}" alt="tutor-image">
                                </span>
                                
                                <span class="name" style="text-transform: capitalize;">{{ $value->getstudent->name }} {{ $value->getstudent->last_name }}</span>
                               </span>
                            </td>
                            <td class="course-title" data-title="Course title">{{ $value->getcourse->course_title }}</td>
                            <td class="date" data-title="Date">{{ date('Y-m-d',$value->getlesson->lesson_date) }}</td>
                            <td class="time" data-title="Time">{{ date('h:i A',$value->getlesson->lesson_date) }}</td>
                            <td class="duration" data-title="Duration">{{ $value->getlesson->duration }} min</td>
                            <td class="price" data-title="Price">${{ number_format($value->lesson_per_rate,2) }}</td>
                            <td>
                                <a href="" class="btn btn-danger">Join Class Room</a>
                                <a href="{{ url('tutor/lesson/view/'.$value->id) }}" class="btn btn-primary"><i class="far fa-eye"></i></a>
                            </td>
                          </tr>
                        @empty


                          <tr class="single-course-item">
                            <td colspan="100%">Booking course not found.</td>
                          </tr>


                        @endforelse


                        </tbody>
                      </table>

                      <div style="clear: both;"></div>

                      <div style="float: right;margin-top: 20px;">
                          {{ $getOrder->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}  
                      </div>

                      <div style="clear: both;"></div>
                        <br />

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
