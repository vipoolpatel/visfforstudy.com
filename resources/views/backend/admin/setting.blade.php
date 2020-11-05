@extends('backend.layouts.app')
{{-- @section('stylesheet')
<style type="text/css">
</style>
@endsection  --}}
@section('content')
<!-- start: breadcrumb area -->
<div class="breadcrumb-area">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="breadcrumb-items d-flex align-items-center">
               <span class="breadcrumb-trail">
               <a href="#" class="text-capitalize">System setting</a>
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
      <!-- start: system setting section -->
      <section class="system-setting-section">
         <div class="section-content">
            <div class="row">
               <div class="col-12">
                  <div class="system-setting-form-wrap">
                     <form action="" class="general-setting-form w-100">
                        <div class="form-group single-row align-items-center type-field">
                           <label for="requestType" class="col-label-field">Request type</label>
                           <div class="col-input-field">
                              <select name="request-type" id="requestType" class="request-type form-control getdatarequest">
                              </select>
                              <div class="input-action-btn-cont d-inline-flex align-items-center">
                                 <button type="button" class="action-btn trash-btn delete_request_type"><i class="far fa-trash-alt"></i></button>
                                 <button type="button" class="action-btn edit-btn edit_request_type" ><i class="far fa-edit"></i></button>
                                 <button type="button" data-toggle="modal" data-target="#RequestModal" class="action-btn add-btn"><i class="fas fa-plus"></i></button>
                              </div>
                           </div>
                        </div>
                        <div class="form-group single-row align-items-center level-field">
                           <label for="levelStudent" class="col-label-field">Level</label>
                           <div class="col-input-field">
                              <select name="level-setting" id="levelStudent" class="level-setting form-control getlevelStudent">
                              </select>
                              <div class="input-action-btn-cont d-inline-flex align-items-center">
                                 <button type="button" class="action-btn trash-btn delete_level_student"><i class="far fa-trash-alt"></i></button>
                                 <button type="button"  class="action-btn edit-btn edit_level_student"><i class="far fa-edit"></i></button>
                                 <button type="button" data-toggle="modal" data-target="#LevelModal" class="action-btn add-btn"><i class="fas fa-plus"></i></button>
                              </div>
                           </div>
                        </div>
                        <div class="form-group single-row align-items-center type-field">
                           <label for="languageType" class="col-label-field">Language</label>
                           <div class="col-input-field">
                              <select name="language_name" id="languageType" class="form-control getdata_language">
                              </select>
                              <div class="input-action-btn-cont d-inline-flex align-items-center">
                                 <button type="button" class="action-btn trash-btn delete_language"><i class="far fa-trash-alt"></i></button>
                                 <button type="button" class="action-btn edit-btn edit_language" ><i class="far fa-edit"></i></button>
                                 <button type="button" data-toggle="modal" data-target="#LanguageModal" class="action-btn add-btn"><i class="fas fa-plus"></i></button>
                              </div>
                           </div>
                        </div>
                        <div class="form-group single-row align-items-center type-field">
                          <label for="bookingType" class="col-label-field">Booking</label>
                          <div class="col-input-field">
                            <select name="booking_name" id="bookingType" class="form-control showdatabooking">
                            </select>
                            <div class="input-action-btn-cont d-inline-flex align-items-center">
                              <button type="button" class="action-btn trash-btn delete_booking"><i class="far fa-trash-alt"></i></button>
                              <button type="button" class="action-btn edit-btn edit_booking"><i class="fas fa-edit"></i></button>
                              <button type="button" class="action-btn add-btn" data-toggle="modal" data-target="#BookingModal"><i class="fas fa-plus"></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="smtp-note d-md-flex">
                           <h4 class="title">SMTP Server:</h4>
                           <p class="desc">
                              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna  ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                           </p>
                        </div>
                        <div class="form-group single-row align-items-center smtp-field">
                           <h5 class="label col-label-field">Use SMTP</h5>
                           <div class="col-input-field">
                              <div class="smtp-check-box reg-form-check custom d-flex">
                                 <input type="checkbox" name="smtp-check" id="smtp-check" class="smtp-check reg-check form-check-input">
                                 <label for="smtp-check" class="form-check-label"></label>
                              </div>
                           </div>
                        </div>
                        <div class="form-group single-row align-items-center encryption-field">
                           <label for="encryptionSetting" class="col-label-field">Encryption</label>
                           <div class="col-input-field">
                              <input type="text" name="encryption-setting" id="encryptionSetting" class="encryption-setting form-control">
                           </div>
                        </div>
                        <div class="form-group single-row align-items-center host-field">
                           <label for="hostSeparationSetting" class="col-label-field">Host(s) separate with</label>
                           <div class="col-input-field">
                              <input type="text" name="host-setting" id="hostSeparationSetting" class="host-setting form-control">
                           </div>
                        </div>
                        <div class="form-group single-row align-items-center font-field">
                           <label for="fontSetting" class="col-label-field">Font</label>
                           <div class="col-input-field">
                              <input type="text" name="font-setting" id="fontSetting" class="font-setting form-control">
                           </div>
                        </div>
                        <div class="form-group single-row align-items-center user-field">
                           <label for="userSetting" class="col-label-field">User</label>
                           <div class="col-input-field">
                              <input type="text" name="user-setting" id="userSetting" class="user-setting form-control">
                           </div>
                        </div>
                        <div class="form-group single-row align-items-center password-field">
                           <label for="passwordSetting" class="col-label-field">Password</label>
                           <div class="col-input-field">
                              <input type="text" name="password-setting" id="passwordSetting" class="password-setting form-control">
                           </div>
                        </div>
                        <div class="form-submit-btn-cont text-center text-md-right">
                           <button type="submit" class="button form-cancel-btn">Cancel</button>
                           <button type="submit" class="button form-save-btn ml-2">Save</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end: system setting section -->
   </div>
</div>
<!-- end: main content -->
<!-- Request type add Modal Start -->
<div class="modal fade" id="RequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Request type add</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form id="RequestAddForm" enctype="multipart/form-data" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
               <div class="form-group">
                  <label for="request_type_name" class="col-form-label">Request type :</label>
                  <input type="text" class="form-control" id="request_type_name" name="request_type_name">
               </div>
               <div class="form-group">
                  <label for="ch_request_type_name">Chinese Request type :</label>
                  <input type="text" class="form-control" id="ch_request_type_name" name="ch_request_type_name">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" name="submit" class="btn btn-primary">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- Request type add Modal End -->
<!-- Request type Edit Modal Start -->
<div class="modal fade" id="EditRequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Request type edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form id="RequestUpdateForm" enctype="multipart/form-data" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
               <div class="form-group">
                  <label for="edit_request_type_name" class="col-form-label">Request type :</label>
                  <input type="text" class="form-control" id="edit_request_type_name" name="request_type_name">
                  <input type="hidden" class="form-control" id="edit_request_type_id" name="id">
               </div>
               <div class="form-group">
                  <label for="edit_ch_request_type_name">Chinese Request type :</label>
                  <input type="text" name="ch_request_type_name" id="edit_ch_request_type_name" class="form-control">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" name="submit" class="btn btn-primary">Update</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- Request type Edit Modal End -->
<!-- Level of Student add Modal Start -->
<div class="modal fade" id="LevelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Level of student add</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form id="LevelAddForm" enctype="multipart/form-data" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
               <div class="form-group">
                  <label for="level_of_student_name" class="col-form-label">Level of student name :</label>
                  <input type="text" class="form-control" id="level_of_student_name" name="level_of_student_name">
               </div>
               <div class="form-group">
                  <label for="ch_level_of_student_name">Chinese Level of student name :</label>
                  <input type="text" name="ch_level_of_student_name" id="ch_level_of_student_name" class="form-control">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" name="submit" class="btn btn-primary">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- Level of Student add Modal End -->
<!-- Level of Student edit Modal Start -->
<div class="modal fade" id="EditLevelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Level of student edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form id="LevelUpdateForm" enctype="multipart/form-data" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
               <div class="form-group">
                  <label for="level_of_student_name" class="col-form-label">Level of student name :</label>
                  <input type="text" class="form-control" id="edit_level_of_student_name" name="level_of_student_name">
                  <input type="hidden" id="edit_level_student_id" name="id" />
               </div>
               <div class="form-group">
                  <label for="edit_ch_level_of_student_name">Chinese Level of student name :</label>
                  <input type="text" name="ch_level_of_student_name" id="edit_ch_level_of_student_name" class="form-control">
               </div>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" name="submit" class="btn btn-primary">Update</button>
            </div>
         </form>
      </div>
   </div>
</div>


<!-- Level of Student edit Modal End -->
{{-- Language Modal Add Start --}}
<div class="modal fade" id="LanguageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Language add</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form id="LanguageAddForm" enctype="multipart/form-data" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
               <div class="form-group">
                  <label for="language_name" class="col-form-label">Language name :</label>
                  <input type="text" class="form-control" id="language_name" name="language_name">
                  <span id="error2" class="text-danger clear"></span>
               </div>
               <div class="form-group">
                  <label for="ch_language_name">Chinese Language name :</label>
                  <input type="text" name="ch_language_name" id="ch_language_name" class="form-control">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" name="submit" class="btn btn-primary">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
{{-- Language Modal Add End --}}
{{-- Language Modal Edit Start --}}
<div class="modal fade" id="EditLanguageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Language edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form id="LanguageUpdateForm" enctype="multipart/form-data" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
               <div class="form-group">
                  <label class="col-form-label">Language name :</label>
                  <input type="text" class="form-control" id="edit_language_name" name="language_name">
                    <span id="error2" class="text-danger clear"></span>
                  <input type="hidden" id="edit_language_name_id" name="id" />

               </div>
               <div class="form-group">
                  <label for="edit_ch_language_name">Chinese Language name :</label>
                  <input type="text" name="ch_language_name" id="edit_ch_language_name" class="form-control">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" name="submit" class="btn btn-primary">Update</button>
            </div>
         </form>
      </div>
   </div>
</div>
{{-- Language Modal Edit End --}}
{{-- Booking Modal Add Start --}}
<div class="modal fade" id="BookingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Booking add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="BookingAddForm" enctype="multipart/form-data" method="POST">
        {{ csrf_field() }}
      <div class="modal-body">
        <div class="form-group">
           <label for="booking_name">Booking name :</label>
           <input type="text" name="booking_name" id="booking_name" class="form-control">
        </div>
        <div class="form-group">
           <label for="ch_booking_name">Chinese Booking name :</label>
           <input type="text" name="ch_booking_name" id="ch_booking_name" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>

    </div>
  </div>
</div>
{{-- Booking Modal Add End --}}
{{-- Booking Modal Edit Start --}}
<div class="modal fade" id="EditBookingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Booking edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form id="BookingUpdateForm" enctype="multipart/form-data" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
               <div class="form-group">
                  <label for="edit_booking_name" class="col-form-label">Booking name :</label>
                  <input type="text" class="form-control" id="edit_booking_name" name="booking_name">
                  <input type="hidden" class="form-control" id="edit_booking_name_id" name="id">
               </div>
               <div class="form-group">
                  <label for="edit_ch_booking_name">Chinese Booking name :</label>
                  <input type="text" name="ch_booking_name" id="edit_ch_booking_name" class="form-control">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Update</button>
            </div>
         </form>
      </div>
   </div>
</div>
{{-- Booking Modal End --}}
@endsection
@section('script')
<script type="text/javascript">
   $(document).ready(function(){

   getdatarequest();
   getdatalevelStudent();
   getdatalanguage();
   getdatabooking();
   // Request Type Full form Add edit update Delete Start
   // Add Request Type Start

           $('#RequestAddForm').on('submit', function(event) {
                   event.preventDefault();

                   $.ajax({
                         type:"POST",
                             url:"{{ url('admin/setting/request_insert') }}",
                             data:$('#RequestAddForm').serialize(),
                             dataType: 'json',
                            //  success: function(response) {
                            // $('#RequestModal').modal('hide');

                            //  $('#RequestAddForm')[0].reset();
                            //  $('#getSuccessmessage').show();
                            //  $('#getSuccessmessage').html(response.success);
                            //   if(response.success){
                            //         getdatarequest();
                            //   }
                           // location.reload();
                        //   }
                              success: function(response){
                                $('#RequestModal').modal('hide');
                                  $('#RequestAddForm')[0].reset();
                                success_message(response.success);

                                       getdatarequest();

                           }

                   });
           });


           function getdatarequest(){

                   $.ajax({
                         url: "{{ url('admin/setting/get_data_request') }}",
                         type: 'GET',
                         dataType: "JSON",
                         success: function (response)
                         {
                         $('.getdatarequest').html(response);
                 }

                   });
           }
   // Add Request Type End
   // Edit Request Type Start
           $('.edit_request_type').click(function(){

                   var id  = $('#requestType').val();

             var name = $('option:selected', '#requestType').attr('data-val');
             var c_name = $('option:selected', '#requestType').attr('data-c');

                   $('#edit_request_type_name').val(name);
                   $('#edit_ch_request_type_name').val(c_name);
                   $('#edit_request_type_id').val(id);

                   $('#EditRequestModal').modal('show');
           });

   // Edit Request Type End

   // Update Request Type Start

           $('#RequestUpdateForm').on('submit', function(event){
                   event.preventDefault();

                   var edit_id  = $("#edit_request_type_id").val();
                   var edit_request_type_name  = $("#edit_request_type_name").val();
                   var edit_ch_request_type_name  = $("#edit_ch_request_type_name").val();
                   var token = $(this).data("token");

                   $.ajax({
                           url:"{{ url('admin/setting/update_request_type') }}",
                           method: "POST",
                           data: {
                                   edit_id: edit_id,
                                   edit_request_type_name: edit_request_type_name,
                                   edit_ch_request_type_name: edit_ch_request_type_name,
                                   "_token": "{{ csrf_token() }}"
                           },
                           dataType:"json",
                           // success:function(response)
                           //         {

                           //         $('#EditRequestModal').modal('hide');
                           //         $('#getSuccessmessage').show();
                           //         $('#getSuccessmessage').html(response.success);
                           //         if(response.success){
                           //                 getdatarequest();
                           //         }
                           //         }

                             success: function(response){
                                $('#EditRequestModal').modal('hide');
                                success_message(response.success);

                                       getdatarequest();

                           }
                   });

           });

   // Update Request Type End
   // Delete Request Type Start

           $('.delete_request_type').click(function(){
                   var ids = '1';
                   delete_record_new(ids);
           });

    function delete_record_new(ids) {
           swal({
                   title: 'Are you sure?',
                   text: "You want to proceed ?",
                   type: 'warning',
                   showCancelButton: true,
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Yes, delete it!',
                   showLoaderOnConfirm: true,
                   preConfirm: function() {
                     return new Promise(function() {
                             if(ids == '1'){
                                   delete_data();
                             }else if(ids == '2'){
                                   delete_data_level_student();
                             }else if(ids == '3'){
                                   delete_data_language();
                             }else if(ids == '4'){
                                   delete_data_booking();
                             }
                     });
               },
                   allowOutsideClick: false
           });
    }

    function delete_data() {
           var id = $('#requestType').val();
                   // alert(id);
                   var token = $(this).data("token");

                   $.ajax({
                           url:"{{ url('admin/setting/request_type_delete') }}/"+id,
                           type: "POST",
                           dataType: "JSON",
                           data: {
                                   "id": id,
                                   "_token": "{{ csrf_token() }}"
                           },
                           success: function (response) {
                                   success_message(response.success);

                                           getdatarequest();

                           }
                   });
    }
   // Delete Request Type End
   // Request Type Full form Add edit update Delete End
   // Level Student Full Form Add Edit Delete Start

   // Level Student Add Form Start

           $('#LevelAddForm').on('submit', function(event) {
                   event.preventDefault();

                   $.ajax({
                           type: "POST",
                           url:"{{ url('admin/setting/level_of_student_insert') }}",
                           data:$('#LevelAddForm').serialize(),
                           dataType: 'json',
                           // success: function(response) {
                           //  $('#LevelModal').modal('hide');
                           //  $('#LevelAddForm')[0].reset();
                           // $('#getSuccessmessage').show();
                           // $('#getSuccessmessage').html(response.success);

                           // if(response.success){
                           //         getdatalevelStudent();
                           // }
                           // }
                         success: function(response){
                            $('#LevelModal').modal('hide');
                            $('#LevelAddForm')[0].reset();
                            success_message(response.success);
                            getdatalevelStudent();

                       }
                   });
           });

           function getdatalevelStudent()
           {
           $.ajax({
               url: "{{ url('admin/setting/get_data_level_Student') }}",
               type: 'GET',
               dataType: "JSON",
               success: function (response)
               {
               $('.getlevelStudent').html(response);
               }

           });
           }
   // Level Student Add Form End

   // Level Student Edit Start

           $('.edit_level_student').click(function(){
                   var id = $('#levelStudent').val();
                   //alert(id);
                   var name = $('option:selected', '#levelStudent').attr('data-val');
                   var c_name = $('option:selected', '#levelStudent').attr('data-c');
                   $('#edit_level_of_student_name').val(name);
                   $('#edit_ch_level_of_student_name').val(c_name);
                   $('#edit_level_student_id').val(id);
                   $('#EditLevelModal').modal('show');
           });
   // Level Student Edit End

   // Level Student Update Start

           $('#LevelUpdateForm').on('submit', function(event) {
                   event.preventDefault();
                   var edit_id  = $("#edit_level_student_id").val();
                   var edit_level_of_student_name  = $("#edit_level_of_student_name").val();
                   var edit_ch_level_of_student_name  = $("#edit_ch_level_of_student_name").val();
                   var token = $(this).data("token");

                   $.ajax({
                           url:"{{ url('admin/setting/update_level_student') }}",
                           method: "POST",
                           data: {
                                   edit_id: edit_id,
                                   edit_level_of_student_name: edit_level_of_student_name,
                                   edit_ch_level_of_student_name: edit_ch_level_of_student_name,

                                   "_token": "{{ csrf_token() }}"
                           },
                           dataType: "json",
                           success: function(response){
                       				$('#EditLevelModal').modal('hide');
                           			success_message(response.success);

                                  		 getdatalevelStudent();

                           }
                   });
           });
   // Level Student Update End

   // Level Student Delete Start

           $('.delete_level_student').click(function(){

                   var ids = '2';
                   delete_record_new(ids);

           });

           function delete_data_level_student()
           {

                   var id = $('#levelStudent').val();
                   //alert(id);
                   var token = $(this).data("token");

                   $.ajax({
                           url: "{{ url('admin/setting/level_student_delete') }}/"+id,
                           type: 'POST',
                           dataType: "JSON",
                           data: {
                                   "id": id,
                                   "_token": "{{ csrf_token() }}"
                           },
                         success: function (response)
                         {
                            $('#getSuccessmessage').show();
                            $('#getSuccessmessage').html(response.success);
                            swal("Success", "{{ session('success') }}", "success");

                              getdatalevelStudent();

                         }
           });
           }
   // Level Student  Delete End

   // Level Student Full Form Add Edit Delete End

   //  Language Start
   $('#LanguageAddForm').on('submit', function(event){
      event.preventDefault();
      $.ajax({
           type: "POST",
           url:"{{ url('admin/setting/language_insert') }}",
           data:$('#LanguageAddForm').serialize(),
           dataType: 'json',
            success: function(response) {

              if (response.success)
              {
                  $('#LanguageModal').modal('hide');
                  $('#LanguageAddForm')[0].reset();
                  success_message(response.message);
                  getdatalanguage();
              }
              else
              {
                 error_message(response.message);
              }
         }
      });

   });
   function getdatalanguage()
   {
     $.ajax({
         url: "{{ url('admin/setting/get_data_language') }}",
         type: 'GET',
         dataType: "JSON",
         success: function (response)
         {
         $('.getdata_language').html(response);
         }

     });
   }

   $('.edit_language').click(function(){

           var id  = $('#languageType').val();

           var name   = $('option:selected', '#languageType').attr('data-val');
           var c_name = $('option:selected', '#languageType').attr('data-c');
           $('#edit_language_name').val(name);
           $('#edit_ch_language_name').val(c_name);
           $('#edit_language_name_id').val(id);

           $('#EditLanguageModal').modal('show');
   });

          $('#LanguageUpdateForm').on('submit', function(event) {
               event.preventDefault();
               var edit_id               = $("#edit_language_name_id").val();
               var edit_language_name    = $("#edit_language_name").val();
               var edit_ch_language_name = $("#edit_ch_language_name").val();
               var token = $(this).data("token");

                   $.ajax({
                      url:"{{ url('admin/setting/update_language_name') }}",
                      method: "POST",
                      data: {
                          edit_id: edit_id,
                          edit_language_name: edit_language_name,
                          edit_ch_language_name: edit_ch_language_name,
                          "_token": "{{ csrf_token() }}"
                          },
                           dataType: "json",
                           success: function(response){

                            if (response.success)
                            {
                                $('#EditLanguageModal').modal('hide');
                                success_message(response.message);
                                getdatalanguage();
                            }
                            else
                            {
                               error_message(response.message);
                            }

                    }
                   });
           });

          $('.delete_language').click(function(){
                   var ids = '3';
                   delete_record_new(ids);
          });

           function delete_data_language()
           {
              var id = $('#languageType').val();
              var token = $(this).data("token");
              $.ajax({
                  url: "{{ url('admin/setting/language_delete') }}/"+id,
                  type: 'POST',
                  dataType: "JSON",
                  data: {
                     "id": id,
                     "_token": "{{ csrf_token() }}"
                     },
                     success: function (response) {
                         success_message(response.success);
                         getdatalanguage();
                    }
              });
           }


   //  Language End

   // Booking start

     $('#BookingAddForm').on('submit', function(event) {
          event.preventDefault();
         $.ajax({
            type: "POST",
            url:"{{ url('admin/setting/booking_insert') }}",
            data:$('#BookingAddForm').serialize(),
            dataType: 'json',
            success: function(response) {
              if (response.success)
              {
                  $('#BookingModal').modal('hide');
                  $('#BookingAddForm')[0].reset();
                  success_message(response.message);
                  getdatabooking();
              }
              else
              {
                 error_message(response.message);
              }
         }

         });
   });

   function getdatabooking(){

           $.ajax({
                 url: "{{ url('admin/setting/get_data_booking') }}",
                 type: 'GET',
                 dataType: "JSON",
                 success: function (response)
                 {
                 $('.showdatabooking').html(response);
                 }

           });
   }

   $('.edit_booking').click(function(){

           var id  = $('#bookingType').val();

           var name = $('option:selected', '#bookingType').attr('data-val');
           var c_name = $('option:selected', '#bookingType').attr('data-c');

           $('#edit_booking_name').val(name);
           $('#edit_ch_booking_name').val(c_name);
           $('#edit_booking_name_id').val(id);

           $('#EditBookingModal').modal('show');
   });

   $('#BookingUpdateForm').on('submit', function(event) {
        event.preventDefault();
        var edit_id               = $("#edit_booking_name_id").val();
        var edit_booking_name     = $("#edit_booking_name").val();
        var edit_ch_booking_name  = $("#edit_ch_booking_name").val();
        var token = $(this).data("token");

            $.ajax({
               url:"{{ url('admin/setting/update_booking_name') }}",
               method: "POST",
               data: {
                   edit_id: edit_id,
                   edit_booking_name: edit_booking_name,
                   edit_ch_booking_name: edit_ch_booking_name,
                   "_token": "{{ csrf_token() }}"
                   },
                    dataType: "json",
                    success: function(response){

                     if (response.success)
                     {
                         $('#EditBookingModal').modal('hide');
                         success_message(response.message);
                         getdatabooking();
                     }
                     else
                     {
                        error_message(response.message);
                     }

             }
            });
    });

    $('.delete_booking').click(function(){
             var ids = '4';
             delete_record_new(ids);
    });

     function delete_data_booking()
     {
        var id = $('#bookingType').val();
        var token = $(this).data("token");
        $.ajax({
            url: "{{ url('admin/setting/booking_delete') }}/"+id,
            type: 'POST',
            dataType: "JSON",
            data: {
               "id": id,
               "_token": "{{ csrf_token() }}"
               },
               success: function (response) {
                   success_message(response.success);
                   getdatabooking();
              }
        });
     }



   // Booking End

   });
</script>
@endsection
