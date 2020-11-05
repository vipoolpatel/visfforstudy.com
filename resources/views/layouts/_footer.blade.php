@php
//use App\Models\SocialIconModel;
$record = DB::table('social_icon')->get();
@endphp

@include('backend.layouts._footer')