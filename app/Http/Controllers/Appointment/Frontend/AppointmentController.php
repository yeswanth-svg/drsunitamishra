<?php

namespace App\Http\Controllers\Appointment\Frontend;

use App\Http\Controllers\Controller;
use App\Appointment;
use App\AppointmentBooking;
use App\AppointmentCategory;
use App\AppointmentReview;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public $base_path = 'frontend.pages.appointment.';
    public function page(Request $request){
        $sort = $request->sort ?? '';
        $cat_id = $request->cat ?? '';
        $search_term = $request->s ?? '';
        $appointment_query = Appointment::with(['lang_front'=>function($query) use($search_term){
            $query->where('title', 'LIKE', '%' . $search_term . '%');
        },'category_front']);
        $appointment_query->where(['status' => 'publish']);
        $sort_by = 'id';
        $sorting = 'desc';
        if (!empty($cat_id)){
            $appointment_query->where('categories_id' ,$cat_id);
        }
        if (!empty($sort)){
            switch ($sort){
                case('oldest'):
                    $sort_by = 'id';
                    $sorting = 'asc';
                    break;
                case('top_rated'):
                    $all_rated_appointment = AppointmentBooking::orderBy('ratings','desc')->get('appointment_id')->toArray();
                    $appointment_query->whereIn('id',array_unique($all_rated_appointment));
                    $sort_by = 'id';
                    $sorting = 'asc';
                    break;
                case('low_price'):
                    $sort_by = 'price';
                    $sorting = 'asc';
                    break;
                case('high_price'):
                    $sort_by = 'price';
                    $sorting = 'desc';
                    break;
                default:
                    $sort_by = 'id';
                    $sorting = 'desc';
                    break;
            }
        }
        $appointment_query->orderBy($sort_by,$sorting);
        $all_appointment = $appointment_query->paginate(9);
        $category_list = AppointmentCategory::with('lang_front')->where('status','publish')->get();
        return view($this->base_path.'appointment-all')->with([
            'all_appointment'=>$all_appointment,
            'sort'=>$sort,
            'category_list' => $category_list,
            'cat_id' => $cat_id,
            'search_term' => $search_term,
        ]);
    }
    public function single($slug,$id){
        $item = Appointment::with('lang_front')->find($id);
        return view($this->base_path.'single')->with(['item' =>$item]);
    }
    public function review(Request $request){
        $this->validate($request,[
            'appointment_id' => 'required|numeric',
            'ratings' => 'required|numeric',
            'message' => 'required|string'
        ],[
            'ratings.required' => __('Rating required'),
            'message.required' => __('Message required'),
        ]);

        $user_id = auth()->guard('web')->user()->id;

        $is_purchased = AppointmentBooking::where(['appointment_id' => $request->appointment_id,'user_id' => $user_id])->first();
        $old_review = AppointmentReview::where(['appointment_id' => $request->appointment_id,'user_id' => $user_id])->first();
        $data['type'] = 'danger';
        $data['msg'] = __('You have not used this service, you cannot leave feedback');

        if (!empty($is_purchased) && empty($old_review)){
            AppointmentReview::create([
                'user_id' => $user_id ?? null,
                'appointment_id' => $request->appointment_id,
                'message' => $request->message,
                'ratings' => $request->ratings
            ]);
            $data['type'] = 'success';
            $data['msg'] = __('Thanks for your feedback');
        }
        if (!empty($old_review)){
            $data['msg'] = __('You have already given your feedback');
        }
        return response()->json($data);
    }

    public function payment_success($id){
        $extract_id = substr($id,6);
        $extract_id =  substr($extract_id,0,-6);
        $appointment_booking = AppointmentBooking::findOrFail($extract_id);
        return view($this->base_path .'payment-success')->with(['booking' =>$appointment_booking]);
    }
    public function payment_cancel($id){
        $extract_id = substr($id,6);
        $extract_id =  substr($extract_id,0,-6);
        $appointment_booking = AppointmentBooking::findOrFail($extract_id);
        return view($this->base_path .'payment-cancel')->with(['booking' =>$appointment_booking]);
    }
    public function category($id){
        $cat_name = AppointmentCategory::with('lang_front')->find($id)->lang_front->name;
        $all_appointment = Appointment::with('lang_front')->where(['status' => 'publish','categories_id' => $id])->orderBy('id','desc')->paginate(9);
        return view($this->base_path.'appointment-category')->with(['cat_name'=>$cat_name,'all_appointment' => $all_appointment]);
    }

}
