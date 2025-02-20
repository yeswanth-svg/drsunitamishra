<a tabindex="0" class="btn btn-{{$btntype ?? 'success'}} btn-xs mb-3 mr-1 swal_alert_delete_button" data-msg="{{$msg}}" data-alerttype="{{$alerttype ?? 'warning'}}" data-desc="{{$desc ?? ''}}" data-alertbtntext="{{$alertbtntext ?? __('Yes,Please')}}">
    {{$text}}
</a>

<form method='post' action='{{$url}}' class="d-none">
<input type='hidden' name='_token' value='{{csrf_token()}}'>
<br>
<button type="submit" class="swal_alert_form_submit_btn d-none"></button>
 </form>