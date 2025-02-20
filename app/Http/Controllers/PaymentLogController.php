<?php

namespace App\Http\Controllers;


use App\AppointmentBooking;
use App\Mail\ContactMessage;
use App\Mail\PlaceOrder;
use App\Order;
use App\PaymentLogs;
use App\PricePlan;
use App\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use KingFlamez\Rave\Facades\Rave;
use Unicodeveloper\Paystack\Facades\Paystack;


class PaymentLogController extends Controller
{
    public function order_payment_form(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'order_id' => 'required|string',
            'payment_gateway' => 'required|string',
        ]);
        $order_details = Order::find($request->order_id);
        $payment_log_id = PaymentLogs::create([
            'email' => $request->email,
            'name' => $request->name,
            'package_name' => $order_details->package_name,
            'package_price' => $order_details->package_price,
            'package_gateway' => $request->payment_gateway,
            'order_id' => $request->order_id,
            'status' => 'pending',
            'track' => Str::random(10) . Str::random(10),
        ])->id;
        $payment_details = PaymentLogs::find($payment_log_id);


        if ($request->payment_gateway === 'paypal') {

            /**
             * @required param list
             * $args['amount']
             * $args['description']
             * $args['item_name']
             * $args['ipn_url']
             * $args['cancel_url']
             * $args['payment_track']
             * return redirect url for paypal
             * */
            $redirect_url =  paypal_gateway()->charge_customer([
                'amount' => $payment_details->package_price,
                'description' => 'Payment For Package Order Id: #' . $request->order_id . ' Package Name: ' . $payment_details->package_name . ' Payer Name: ' . $request->name . ' Payer Email:' . $request->email,
                'item_name' => 'Payment For Package Order Id: #'.$request->order_id,
                'ipn_url' => route('frontend.paypal.ipn'),
                'cancel_url' => route('frontend.order.payment.cancel',$payment_details->id),
                'payment_track' => $payment_details->track,
            ]);

            session()->put('order_id',$request->order_id);
            return redirect()->away($redirect_url);

        } elseif ($request->payment_gateway === 'paytm') {

            /**
             *
             * charge_customer()
             * @required params
             * int order_id
             * string name
             * string email
             * int/float amount
             * string/url callback_url
             * */
            $redirect_url =  paytm_gateway()->charge_customer([
                'order_id' => $payment_details->track,
                'email' => $payment_details->email,
                'name' => $payment_details->name,
                'amount' => $payment_details->package_price,
                'callback_url' => route('frontend.paytm.ipn')
            ]);
            return $redirect_url;

        } elseif ($request->payment_gateway === 'mollie') {

            /**
             * @required param list
             * amount
             * description
             * redirect_url
             * order_id
             * track
             * */
            $return_url =  mollie_gateway()->charge_customer([
                'amount' => $payment_details->package_price,
                'description' => 'Payment For Order Id: #' . $request->order_id . ' Package Name: ' . $payment_details->package_name . ' Payer Name: ' . $request->name . ' Payer Email:' . $request->email,
                'web_hook' => route('frontend.mollie.webhook'),
                'order_id' => $payment_details->order_id,
                'track' => $payment_details->track,
            ]);
            return $return_url;

        } elseif ($request->payment_gateway === 'stripe') {

            $stripe_data['order_id'] = $payment_details->order_id;
            $stripe_data['route'] = route('frontend.stripe.charge');
            return view('payment.stripe')->with('stripe_data', $stripe_data);

        } elseif ($request->payment_gateway === 'razorpay') {

            /**
             *
             * @param array $args
             * @paral list
             * price
             * title
             * description
             * route
             * order_id
             *
             * @return @view with param
             */
            $redirect_url = razorpay_gateway()->charge_customer([
                'price' => $payment_details->package_price,
                'title' => $payment_details->package_name,
                'description' => 'Payment For Package Order Id: #'.$payment_details->id.' Plan Name: '.$payment_details->package_name.' Payer Name: '.$payment_details->name.' Payer Email:'.$payment_details->email,
                'route' => route('frontend.razorpay.ipn'),
                'order_id' => $payment_details->order_id
            ]);
            return $redirect_url;

        } elseif ($request->payment_gateway === 'flutterwave') {

            /**
             * @required params
             * name
             * email
             * ipn_route
             * amount
             * description
             * order_id
             * track
             *
             * */
            $view_file =  flutterwaverave_gateway()->charge_customer([
                'name' => $payment_details->package_name,
                'email' => $payment_details->email,
                'order_id' => $payment_details->order_id,
                'amount' => $payment_details->package_price,
                'track' => $payment_details->track,
                'description' =>  'Payment For Order Id: #'.$payment_details->id.' Package Name: '.$payment_details->package_name.' Payer Name: '.$payment_details->name.' Payer Email:'.$payment_details->email,
                'callback' => route('frontend.flutterwave.callback'),
            ]);
            return $view_file;

        } elseif ($request->payment_gateway == 'paystack') {
           /**
             * @required param list
             * 'amount'
             * 'package_name'
             * 'name'
             * 'email'
             * 'order_id'
             * 'track'
             * */
            $order = Order::where('id', $request->order_id)->first();
            $view_file = paystack_gateway()->charge_customer([
                'amount' => $payment_details->package_price,
                'package_name' => $payment_details->package_name,
                'name' => $payment_details->name,
                'email' => $payment_details->email,
                'order_id' => $payment_details->order_id,
                'track' => $payment_details->track,
                'type' => 'order',
                'route' => route('frontend.paystack.pay'),
            ]);
            return $view_file;

        } elseif ($request->payment_gateway == 'manual_payment') {
            $order = Order::where('id', $request->order_id)->first();
            $order->status = 'pending';
            $order->save();
            PaymentLogs::where('order_id', $request->order_id)->update(['transaction_id' => $request->trasaction_id]);
            $this->send_order_mail($order_details->id);
            $order_id = Str::random(6) . $request->order_id . Str::random(6);
            return redirect()->route('frontend.order.payment.success', $order_id);

        } 
        return redirect()->route('homepage');
    }

    public function paypal_ipn(Request $request)
    {
        $package_order_id = session()->get('order_id');
        session()->forget('order_id');
        /**
         * @required param list
         * $args['request']
         * $args['cancel_url']
         * $args['success_url']
         *
         * return @void
         * */
        $payment_data = paypal_gateway()->ipn_response([
            'request' => $request,
            'cancel_url' => route('frontend.order.payment.cancel',$package_order_id),
            'success_url' => route('frontend.order.payment.success',$package_order_id)
        ]);
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($package_order_id, $payment_data['transaction_id']);
            $this->send_order_mail($package_order_id);
            $order_id = Str::random(6) . $package_order_id . Str::random(6);
            return redirect()->route('frontend.order.payment.success',$order_id);
        }
        abort(404);
    }

    public function razorpay_ipn(Request $request)
    {

        $payment_details = PaymentLogs::where('order_id',$request->order_id)->first();
        /**
         *
         * @param array $args
         * require param list
         * request
         * @return array|string[]
         *
         */
        $payment_data = razorpay_gateway()->ipn_response(['request' => $request]);
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_details->order_id, $payment_data['transaction_id']);
            $this->send_order_mail($payment_details->order_id);
            $order_id = Str::random(6) . $payment_details->order_id. Str::random(6);
            return redirect()->route('frontend.order.payment.success',$order_id);
        }
        abort(404);
    }

    public function paytm_ipn(Request $request)
    {

        $order_id = $request['ORDERID'];
        $payment_logs = PaymentLogs::where( 'track', $order_id )->first();
        /**
         *
         * ipn_response()
         *
         * @return array
         * @param
         * transaction_id
         * status
         * */
        $payment_data = paytm_gateway()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_logs->order_id, $payment_data['transaction_id']);
            $this->send_order_mail($payment_logs->order_id);
            $order_id = Str::random(6) . $payment_logs->order_id . Str::random(6);
            return redirect()->route('frontend.order.payment.success',$order_id);
        }
        abort(404);
    }

    public function mollie_webhook()
    {

        /**
         *
         * @param array $args
         * require param list
         * request
         * @return array|string[]
         *
         */
        $payment_data = mollie_gateway()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route('frontend.order.payment.success',$order_id);
        }
        abort(404);
    }

    public function stripe_ipn(Request $request){
        /**
         * @require params
         * */
        $order_id = session()->get('stripe_order_id');
        session()->forget('stripe_order_id');

        $payment_data = stripe_gateway()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_order_mail($order_id);
            $encoded_order_id = Str::random(6) . $order_id . Str::random(6);
            return redirect()->route('frontend.order.payment.success',$encoded_order_id);
        }
        abort(404);
    }

    public function stripe_charge(Request $request)
    {
        $order_details = PaymentLogs::where('order_id',$request->order_id)->first();

        /**
         * @require params
         *
         * product_name
         * amount
         * description
         * ipn_url
         * cancel_url
         * order_id
         *
         * */

        $stripe_session =  stripe_gateway()->charge_customer([
            'product_name' => $order_details->package_name,
            'amount' => $order_details->package_price,
            'description' => 'Payment From '. get_static_option('site_'.get_default_language().'_title').'. Package Order ID #'.$order_details->id .', Payer Name: '.$order_details->name.', Payer Email: '.$order_details->email,
            'ipn_url' => route('frontend.stripe.ipn'),
            'order_id' => $request->order_id,
            'cancel_url' => route('frontend.order.payment.cancel',$request->order_id)
        ]);
        return response()->json(['id' => $stripe_session['id']]);
    }

    public function flutterwave_pay(Request $request)
    {
        Rave::initialize(route('frontend.flutterwave.callback'));
    }

    /**
     * Obtain Rave callback information
     * @return \Illuminate\Http\RedirectResponse
     */
    public function flutterwave_callback(Request $request)
    {

       /**
         *
         * @param array $args
         * @required param list
         * request
         *
         * @return array
         */
        $payment_data = flutterwaverave_gateway()->ipn_response([
            'request' => $request
        ]);

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $payment_log = PaymentLogs::where( 'track', $payment_data['track'] )->first();
            $this->update_database($payment_log->order_id, $payment_data['transaction_id']);
            $this->send_order_mail($payment_log->order_id);
            $order_id = Str::random(6) . $payment_log->order_id . Str::random(6);
            return redirect()->route('frontend.order.payment.success',$order_id);
        }
        abort(404);
    }

    public function paystack_pay()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }
    public function paystack_callback(Request $request)
    {

        /**
         * return params
         * transaction_id
         * type
         * track
         * */

        $payment_data = paystack_gateway()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete') {
            $func_name = 'update_data_and_mail_' . $payment_data['type'];
            return $this->$func_name($payment_data);
        }
        abort(404);
    }

    public function update_data_and_mail_product($payment_data)
    {
        ProductOrder::where('payment_track', $payment_data['track'])->update([
            'transaction_id' => $payment_data['transaction_id'],
            'payment_status' => 'complete'
        ]);
        rest_cart_session();
        $default_lang = get_default_language();
        $site_title = get_static_option('site_'.$default_lang.'_title');
        $product_order_details =  ProductOrder::where('payment_track', $payment_data['track'])->first();
        Mail::to(get_static_option('site_global_email'))->send(new \App\Mail\ProductOrder($product_order_details,'owner',__('You Have A New Product Order From ').$site_title));
        Mail::to($product_order_details->billing_email)->send(new \App\Mail\ProductOrder($product_order_details,'customer',__('You order has been placed in ').$site_title));
        return redirect()->route('frontend.product.payment.success',Str::random(6).$product_order_details->id.Str::random(6));
    }
    private function update_data_and_mail_appointment($payment_data){
        $booking_details = AppointmentBooking::where('payment_track', $payment_data['track'])->first();
        AppointmentBooking::findOrFail($booking_details->id)->update([
            'transaction_id' => $payment_data['transaction_id'],
            'payment_status' => 'complete',
            'status' => 'confirm'
        ]);

        $new_appointment_booking = AppointmentBooking::findOrFail($booking_details->id);
        $all_custom_fields = $new_appointment_booking->custom_fields;
        unset($all_custom_fields['appointment_id']);
        $all_custom_fields['booking_id'] = '#' . $new_appointment_booking->id;
        //mail to admin
        $admin_email = get_static_option('appointment_notify_mail') ?? get_static_option('site_global_email');
        Mail::to($admin_email)->send(new ContactMessage(
            $all_custom_fields,
            $new_appointment_booking->all_attachment,
            __('you have new appointment booking')
        ));
        //mail to user
        Mail::to($new_appointment_booking->email)->send(new ContactMessage(
            $all_custom_fields,
            $new_appointment_booking->all_attachment,
            __('you have new appointment booking')
        ));

        $order_id = random_int(123456, 999999) . $booking_details->id . random_int(123456, 999999);
        return redirect()->route('frontend.appointment.payment.success', $order_id);
    }
    private function update_database($order_id, $transaction_id)
    {
        Order::where('id', $order_id)->update(['payment_status' => 'complete']);
        PaymentLogs::where('order_id', $order_id)->update([
            'transaction_id' => $transaction_id,
            'status' => 'complete'
        ]);

    }
    public function send_order_mail($order_id)
    {
        $order_details = Order::find($order_id);
        $package_details = PricePlan::where('id', $order_details->package_id)->first();
        $all_fields = unserialize($order_details->custom_fields,['class'=> false]);
        unset($all_fields['package']);
        $all_attachment = unserialize($order_details->attachment,['class'=> false]);
        $order_mail = get_static_option('order_page_form_mail') ? get_static_option('order_page_form_mail') : get_static_option('site_global_email');
        Mail::to($order_mail)->send(new PlaceOrder($all_fields, $all_attachment, $package_details));
    }
}
