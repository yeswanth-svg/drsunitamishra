<?php

namespace App\Http\Controllers\Appointment\Backend;

use App\Http\Controllers\Controller;
use App\AppointmentReview;
use Illuminate\Http\Request;

class AppointmentReviewController extends Controller
{
    //appointment_all
    public $base_view_path = 'backend.appointment.';
    public function review_all(){
        $all_reviews = AppointmentReview::with('appointment')->get();
        return view($this->base_view_path.'appointment-review-all')->with(['all_reviews' => $all_reviews]);
    }
    public function review_delete($id){
        AppointmentReview::findOrFail($id)->delete();
        return back()->with([
           'msg' => __('Update Success'),
           'type' => 'success'
        ]);
    }
}
