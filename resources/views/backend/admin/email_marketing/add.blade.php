@extends('backend.layouts.app')

@section('content')

<!-- start: breadcrumb area -->
<div class="breadcrumb-area">
<div class="container">
<div class="row">
<div class="col-12">
<div class="breadcrumb-items d-flex align-items-center">
<span class="breadcrumb-trail">
<a href="{{ url('admin/email-marketing') }}" class="text-capitalize">{{ __('admin.Email_marketing') }}</a>
</span>
<span class="breadcr-separator">
<i class="fas fa-chevron-right"></i>
</span>
<span class="breadcrumb-trail">
<a href="{{ url('admin/email-marketing') }}" class="text-capitalize">{{ __('admin.Add_email_marketing') }}</a>
</span>
</div>
</div>
</div>
</div>
</div>
<!-- end: breadcrumb area -->


<!-- start: main content -->
<div class="main-content admin-add-content">
<div class="container">
<div class="row">
<div class="col-12">
       
<!-- start: all offer content -->
<section class="email-marketing-section all-offer-section">
        @include('message') 
<div class="all-course-view">
<div class="course-tabulation w-100">
<div class="tabulation-header">
<ul class="nav nav-tabs">
<li>
<a data-toggle="tab" href="#addEmailMarketingTab" class="active">{{ __('admin.Add_email_marketing') }}</a>
</li>
<li>
<a data-toggle="tab" href="#subscribeListTab">{{ __('admin.Email_subscribe_list') }}</a>
</li>
</ul>
</div>    

<div class="tab-content all-course-list-box">
<div id="addEmailMarketingTab" class="tab-pane in active add-email-marketing">
<div class="add-form-wrapper">
<form action="" class="add-email-marketing-form">
<div class="form-group subject-field">
      <label for="marketingSubject">Subject</label>
      <input type="text" name="marketing-subject" id="marketingSubject" class="marketing-subject form-control" placeholder="Add a name">
</div>
<div class="form-group type-field">
      <label for="marketingType">Type</label>
      <select name="marketing-type" id="marketingType" class="marketing-type form-control">
            <option selected>Select type</option>
            <option>Type 1</option>
            <option>Type 2</option>
      </select>
</div>
<div class="form-group email-field">
      <label for="emailSelect">Email</label>
      <select name="email-select" id="emailSelect" class="email-select form-control">
            <option selected>All</option>
            <option>Email 1</option>
            <option>Email 2</option>
            <option>Email 3</option>
      </select>
</div>
<div class="form-group body-field">
      <label for="emailBody">Body</label>
      <textarea name="email-body" id="emailBody" class="email-body form-control cols="10" rows="5"></textarea>
</div>
<div class="form-submit-btn-cont text-right pb-5">
      <button type="submit" class="form-submit-btn reg-signup-btn deep-bg">Submit</button>
</div>
</form>
</div>
</div>
<div id="subscribeListTab" class="tab-pane email-subscribe-list">
<table class="all-course-table">
<thead>
<tr class="course-list-heading">
      <th class="id">{{ __('admin.ID') }}</th>
      <th class="email">{{ __('admin.Email') }}</th>
      <th class="date">{{ __('admin.Created_Date') }}</th>
     {{--  <th class="time">Time</th> --}}
      <th class="action">{{ __('admin.Action') }}</th>
</tr>
</thead>
<tbody>
        @forelse($getrecord as $value)

<tr class="single-course-item">
    <td class="id" data-title="ID">{{ $value->id }}</td>
     <td class="email" data-title="Email">{{ $value->email }}</td>
      <td class="date" data-title="Created date">{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
      {{-- <td class="time" data-title="Time">08:30pm</td> --}}
      <td class="action" data-title="Action">
            <span class="action-btn-wrap">
                  <a href="{{ url('admin/email-marketing/delete/'.$value->id) }}" class="button trash-btn">
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
<div style="clear: both;"></div>
<div style="float: right;margin-top: 20px;">
{{ $getrecord->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}  
</div> 
<div style="clear: both;"></div>
<br />
</div>
</div>
</div>
</div>
</section>
<!-- end: all offer content -->
</div>
</div>
</div>
</div>
<!-- end: main content -->



@endsection
