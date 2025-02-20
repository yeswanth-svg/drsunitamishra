<?php

namespace App\Http\Controllers\Appointment\Backend;

use App\Http\Controllers\Controller;
use App\Appointment;
use App\AppointmentBooking;
use App\AppointmentBookingTime;
use App\AppointmentCategory;
use App\AppointmentCategoryLang;
use App\AppointmentLang;
use App\Feedback;
use App\Helpers\FlashMsg;
use App\Language;
use App\Mail\FeedbackMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    public $base_view_path = 'backend.appointment.';
    public $languages;
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->languages = Language::all();
    }
    public function appointment_all()
    {
        $all_appointment = Appointment::with('lang')->get();
        return view($this->base_view_path . 'appointment-all')->with(['all_appointment' => $all_appointment]);
    }
    public function appointment_new()
    {
        $all_booking_time = AppointmentBookingTime::where('status' , 'publish')->get();
        $appointment_category = AppointmentCategory::with('lang')->where('status','publish')->get();
        return view($this->base_view_path . 'appointment-new')->with([
            'all_booking_time' => $all_booking_time,
            'appointment_category' => $appointment_category
        ]);
    }
    public function appointment_store(Request $request){
        $this->validate($request,[
            'booking_time_ids' => 'required|string|max:191',
            'max_appointment' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'image' => 'nullable|string',
            'status' => 'required|string',
            'appointment_status' => 'nullable|string',
            'title' => 'check_array:1',
            'slug' => 'check_array:1',
            'designation' => 'check_array:1',
            'short_description' => 'check_array:1',
            'meta_title' => 'check_array:1',
            'meta_tags' => 'check_array:1',
            'meta_description' => 'check_array:1',
            'additional_info' => 'check_array:1',
            'experience_info' => 'check_array:1',
            'specialized_info' => 'check_array:1',
        ],[
            'title.check_array' => __('Enter Title'),
            'slug.check_array' => __('Enter Slug'),
            'designation.check_array' => __('Enter Designation'),
            'slug.check_array' => __('Enter Slug'),
            'short_description.check_array' => __('Enter Short Description'),
            'meta_title.check_array' => __('Enter Meta Title'),
            'meta_tags.check_array' => __('Enter Meta Tags'),
            'meta_description.check_array' => __('Enter Meta Description'),
            'additional_info.check_array' => __('Enter Additional Info'),
            'experience_info.check_array' => __('Enter Experience Info'),
            'specialized_info.check_array' => __('Enter Specialized Info'),
        ]);
        DB::beginTransaction();
        try {
            $appointment_id = Appointment::create([
                'categories_id' => $request->categories_id,
                'booking_time_ids' => $request->booking_time_ids,
                'status' => $request->status,
                'appointment_status' => $request->appointment_status,
                'image' => $request->image,
                'max_appointment'=> $request->max_appointment,
                'price'=> $request->price
            ])->id;
            foreach ($this->languages as $lang){
                $lang_slug = $lang->slug;
                AppointmentLang::create([
                'lang' => $lang_slug,
                'appointment_id'=> $appointment_id,
                'location'=> $request->location[$lang_slug],
                'title'=> $request->title[$lang_slug],
                'designation'=> $request->designation[$lang_slug],
                'short_description'=> $request->short_description[$lang_slug],
                'description'=> $request->description[$lang_slug],
                'additional_info'=> $request->additional_info[$lang_slug],
                'experience_info'=> $request->experience_info[$lang_slug],
                'specialized_info'=> $request->specialized_info[$lang_slug],
                'meta_description'=> $request->meta_description[$lang_slug],
                'meta_title'=> $request->meta_title[$lang_slug],
                'meta_tags'=> $request->meta_tags[$lang_slug],
                'og_meta_description'=> $request->og_meta_description[$lang_slug],
                'og_meta_title'=> $request->og_meta_title[$lang_slug],
                'og_meta_image'=> $request->og_meta_image[$lang_slug],
                'slug'=> !empty($request->slug[$lang_slug]) ? Str::slug($request->slug[$lang_slug]) : Str::slug($request->title[$lang_slug]),]);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
        return back()->with(FlashMsg::item_new());
    }
    public function appointment_edit($id){
        $edit_items = Appointment::with('lang_all')->findOrFail($id);
        $check_diff =  array_merge(array_diff(exist_slugs($edit_items), all_lang_slugs()), array_diff(all_lang_slugs(), exist_slugs($edit_items)));
        if($check_diff != null){
           foreach ($check_diff as $key => $lang) {
            AppointmentLang::create([
                'lang' => $lang,
                'appointment_id'=> $id,
                'location'=> null,
                'title'=> null, 
                'designation'=> null, 
                'short_description'=> null, 
                'description'=> null, 
                'additional_info'=> null, 
                'experience_info'=> null, 
                'specialized_info'=> null, 
                'meta_description'=> null, 
                'meta_title'=> null, 
                'meta_tags'=> null, 
                'og_meta_description'=> null, 
                'og_meta_title'=> null, 
                'og_meta_image'=> null,
                'slug'=> null
            ]);
           }
        }
        $edit_items = Appointment::with('lang_all')->findOrFail($id);
        $all_booking_time = AppointmentBookingTime::where('status','publish')->get();
        $appointment_category =AppointmentCategory::with('lang')->where('status','publish')->get();
        return view($this->base_view_path.'appointment-edit')->with([
            'edit_items' => $edit_items,
            'all_booking_time' => $all_booking_time,
            'appointment_category' => $appointment_category,
        ]);
    }
    public function appointment_update(Request $request){
        $this->validate($request,[
            'booking_time_ids' => 'required|string|max:191',
            'max_appointment' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'image' => 'nullable|string',
            'status' => 'required|string',
            'appointment_status' => 'nullable|string',
            'title' => 'check_array:1',
            'slug' => 'check_array:1',
            'designation' => 'check_array:1',
            'short_description' => 'check_array:1',
            'meta_title' => 'check_array:1',
            'meta_tags' => 'check_array:1',
            'meta_description' => 'check_array:1',
            'additional_info' => 'check_array:1',
            'experience_info' => 'check_array:1',
            'specialized_info' => 'check_array:1',
        ],[
            'title.check_array' => __('Enter Title'),
            'slug.check_array' => __('Enter Slug'),
            'designation.check_array' => __('Enter Designation'),
            'slug.check_array' => __('Enter Slug'),
            'short_description.check_array' => __('Enter Short Description'),
            'meta_title.check_array' => __('Enter Meta Title'),
            'meta_tags.check_array' => __('Enter Meta Tags'),
            'meta_description.check_array' => __('Enter Meta Description'),
            'additional_info.check_array' => __('Enter Additional Info'),
            'experience_info.check_array' => __('Enter Experience Info'),
            'specialized_info.check_array' => __('Enter Specialized Info'),
        ]);
        DB::beginTransaction();
        try {
            Appointment::find($request->id)->update([
                'categories_id' => $request->categories_id,
                'booking_time_ids' => $request->booking_time_ids,
                'status' => $request->status,
                'appointment_status' => $request->appointment_status,
                'image' => $request->image,
                'max_appointment'=> $request->max_appointment,
                'price'=> $request->price
            ]);
            foreach ($this->languages as $lang){
                $lang_slug = $lang->slug;
                AppointmentLang::updateOrCreate(['appointment_id' => $request->id,'lang' => $lang->slug],[
                'lang' => $lang_slug,
                'location'=> $request->location[$lang_slug] ?? '',
                'title'=> $request->title[$lang_slug] ?? '',
                'designation'=> $request->designation[$lang_slug] ?? '',
                'short_description'=> $request->short_description[$lang_slug] ?? '',
                'description'=> $request->description[$lang_slug] ?? '',
                'additional_info'=> $request->additional_info[$lang_slug]  ?? [],
                'experience_info'=> $request->experience_info[$lang_slug] ?? [],
                'specialized_info'=> $request->specialized_info[$lang_slug] ?? [] ,
                'meta_description'=> $request->meta_description[$lang_slug] ?? '',
                'meta_title'=> $request->meta_title[$lang_slug] ?? '',
                'meta_tags'=> $request->meta_tags[$lang_slug] ?? '',
                'og_meta_description'=> $request->og_meta_description[$lang_slug] ?? '',
                'og_meta_title'=> $request->og_meta_title[$lang_slug] ?? '',
                'og_meta_image'=> $request->og_meta_image[$lang_slug] ?? '',
                'slug'=> !empty($request->slug[$lang_slug]) ? Str::slug($request->slug[$lang_slug] ?? 'x') : Str::slug($request->title[$lang_slug] ?? 'x')]);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
        return back()->with(FlashMsg::item_update());
    }
    public function appointment_delete($id){
        AppointmentLang::where('appointment_id',$id)->delete();
        Appointment::where('id',$id)->delete();
        return back()->with(FlashMsg::item_delete());
    }
    public function appointment_clone(Request $request)
    {
        $appointments = Appointment::find($request->item_id);
        $appointment_langs = AppointmentLang::where('appointment_id',$appointments->id)->get();
        $appointment_id = Appointment::create([
            'categories_id' => $appointments->categories_id,
            'booking_time_ids' => implode(',',array_column($appointments->booking_time_ids,'id')),
            'appointment_status' => $appointments->appointment_status,
            'image' => $appointments->image,
            'max_appointment'=> $appointments->max_appointment,
            'price'=> $appointments->price,
            'status' => 'draft',
        ])->id;
        foreach ($appointment_langs as $key => $data) {
            $slug = $data->slug;
            $check_slug = AppointmentLang::where('slug',$slug)->get();
            if (count($check_slug) > 0){
                $slug .= '-'.date('s');
            }
            AppointmentLang::create([
                'lang' => $data->lang,
                'appointment_id'=> $appointment_id,
                'location'=> $data->location,
                'title'=> $data->title,
                'designation'=> $data->designation,
                'short_description'=> $data->short_description,
                'description'=> $data->description,
                'additional_info'=> $data->additional_info,
                'experience_info'=> $data->experience_info,
                'specialized_info'=> $data->specialized_info,
                'meta_description'=> $data->meta_description,
                'meta_title'=> $data->meta_title,
                'meta_tags'=> $data->meta_tags,
                'og_meta_description'=> $data->og_meta_description,
                'og_meta_title'=> $data->og_meta_title,
                'og_meta_image'=> $data->og_meta_image,
                'slug'=> $slug
            ]);
        }
        return back()->with(FlashMsg::item_clone());
    }
    public function bulk_action(Request $request){
        AppointmentLang::whereIn('appointment_id',$request->ids)->delete();
        Appointment::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
    public function form_builder(){
        return view($this->base_view_path.'appointment-booking-form');
    }
    public function form_builder_save(Request $request){
        $this->validate($request,[
            'field_name' => 'required|max:191',
            'field_placeholder' => 'required|max:191',
        ]);
        unset($request['_token']);
        $all_fields_name = [];
        $all_request_except_token = $request->all();
        foreach ($request->field_name as $fname){
            $all_fields_name[] = strtolower(Str::slug(htmlspecialchars(strip_tags($fname))));
        }
        $all_request_except_token['field_name'] = $all_fields_name;
        $json_encoded_data = json_encode($all_request_except_token);

        update_static_option('appointment_booking_page_form_fields',$json_encoded_data);
        return redirect()->back()->with(['msg' => __('Form Updated...'),'type' => 'success']);
    }
    public function settings(){
        return view($this->base_view_path.'appointment-settings')->with(['all_languages' => $this->languages]);
    }
    public function settings_save(Request $request){
        $this->validate($request,[
            'appointment_notify_mail' => 'required|email|max:191'
        ]);
        foreach ($this->languages as $lang){
            $this->validate($request,[
                'appointment_single_'.$lang->slug.'_information_tab_title' => 'nullable|string',
                'appointment_single_'.$lang->slug.'_booking_tab_title' => 'nullable|string',
                'appointment_single_'.$lang->slug.'_feedback_tab_title' => 'nullable|string',
                'appointment_single_'.$lang->slug.'_appointment_booking_information_text' => 'nullable|string',
                'appointment_single_'.$lang->slug.'_appointment_booking_button_text' => 'nullable|string',
                'appointment_single_'.$lang->slug.'_appointment_booking_about_me_title' => 'nullable|string',
                'appointment_single_'.$lang->slug.'_appointment_booking_educational_info_title' => 'nullable|string',
                'appointment_single_'.$lang->slug.'_appointment_booking_additional_info_title' => 'nullable|string',
                'appointment_single_'.$lang->slug.'_appointment_booking_client_feedback_title' => 'nullable|string',
                'appointment_single_'.$lang->slug.'_appointment_booking_specialize_info_title' => 'nullable|string',
                'appointment_booking_'.$lang->slug.'_success_page_title' => 'nullable|string',
                'appointment_booking_'.$lang->slug.'_success_page_description' => 'nullable|string',
                'appointment_booking_'.$lang->slug.'_cancel_page_title' => 'nullable|string',
                'appointment_booking_'.$lang->slug.'_cancel_page_description' => 'nullable|string',
            ]);
            $fields_list = [
                'appointment_single_'.$lang->slug.'_information_tab_title',
                'appointment_single_'.$lang->slug.'_booking_tab_title',
                'appointment_single_'.$lang->slug.'_feedback_tab_title' ,
                'appointment_single_'.$lang->slug.'_appointment_booking_information_text',
                'appointment_single_'.$lang->slug.'_appointment_booking_button_text' ,
                'appointment_single_'.$lang->slug.'_appointment_booking_about_me_title' ,
                'appointment_single_'.$lang->slug.'_appointment_booking_educational_info_title',
                'appointment_single_'.$lang->slug.'_appointment_booking_additional_info_title',
                'appointment_single_'.$lang->slug.'_appointment_booking_specialize_info_title',
                'appointment_single_'.$lang->slug.'_appointment_booking_client_feedback_title',
                'appointment_booking_'.$lang->slug.'_success_page_title',
                'appointment_booking_'.$lang->slug.'_success_page_description',
                'appointment_booking_'.$lang->slug.'_cancel_page_title',
                'appointment_booking_'.$lang->slug.'_cancel_page_description',
                'appointment_page_'.$lang->slug.'_booking_button_text'
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }
        update_static_option('appointment_notify_mail',$request->appointment_notify_mail);
        return back()->with([
            'msg' => __('Settings Updated'),
            'type' => 'success'
        ]);
    }
}
