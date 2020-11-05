<?php

namespace App\Http\Controllers\Backend;

use App\Models\LanguageModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OfferModel;
use App\Models\SubjectModel;
use App\Models\CourseModel;
use App\Models\CourseLessonModel;
use App\Models\UsersModel;
use Auth;
use Stripe\Stripe;

use App\Models\OrderCourseModel;
use App\Models\TransactionModel;

use App\Notifications\CommonNotification;
use App\Notifications\TeacherNotification;






class PaymentController extends Controller
{

	public function offer_payment($id, Request $request)
	{
		$offer = OfferModel::find($id);
		if(!empty($offer->lesson_per_rate))		
		{
			try {

				Stripe::setApiKey('sk_test_D5j27FF4gtD8YFOz0PXKNeDM');

				$finalprice = $offer->lesson_per_rate * 100;

				$session = \Stripe\Checkout\Session::create([
					'customer_email' => Auth::user()->email,
					'payment_method_types' => ['card'],
					'line_items' 	=> [[
						'name' 		=> 'visfforstudy.com',
						'description' => $offer->title,
						'images' 	=> ['https://visfforstudy.com/assets/img/logo-2x.png'],
						'amount' 	=> intval($finalprice),
						'currency' 	=> 'usd',
						'quantity' 	=> 1,
					]],
					'success_url' => url('student/offer/payment_success?item_id=' . base64_encode($id)),
					'cancel_url' => url('student/offer/payment_cancel'),
				]);

				$offer->trans_id = $session['id'];
				$offer->save();

				$data['session_id'] = $session['id'];
				return view('backend.stripe_charge', $data);

			} catch (\Stripe\Error\Card $e) {
				$body = $e->getJsonBody();
				$err = $body['error'];
				print('Status is:' . $e->getHttpStatus() . "\n");
				print('Type is:' . $err['type'] . "\n");
				print('Code is:' . $err['code'] . "\n");
				print('Param is:' . $err['param'] . "\n");
				print('Message is:' . $err['message'] . "\n");
				// $this->saveFailedTransaction($serial_arr, $price, $manufacturer, $email);
			} catch (\Stripe\Error\RateLimit $e) {
				echo "The server is busy. Try again in few minutes.";
				// $this->saveFailedTransaction($serial_arr, $price, $manufacturer, $email);
			} catch (\Stripe\Error\InvalidRequest $e) {
				echo "You have entered invalid data. Try again.";
				// $this->saveFailedTransaction($serial_arr, $price, $manufacturer, $email);
			} catch (\Stripe\Error\Authentication $e) {
				echo "If you see this error contact the support; Error: problem with API Key.";
				// $this->saveFailedTransaction($serial_arr, $price, $manufacturer, $email);
			} catch (\Stripe\Error\ApiConnection $e) {
				echo "Check your internet connection and try again: Error: Can't connect API.";
				// $this->saveFailedTransaction($serial_arr, $price, $manufacturer, $email);
			} catch (Exception $e) {
				echo "There ocurred an error but I can't see what is. Try again in few minutes or contact support";
				// $this->saveFailedTransaction($serial_arr, $price, $manufacturer, $email);
			}
		}
		else
		{
			$offer->is_payment = '1';
			$offer->save();

			$trans 				= new TransactionModel;
			$trans->user_id 	= $offer->user_id;
			$trans->student_id 	= Auth::user()->id;
			$trans->offer_id 	= $offer->id;
			$trans->total_amount = '0';
			$trans->trans_id 	= '';
			$trans->amount 		= '0';
			$trans->fee_amount 	= '0';
			$trans->total_amount = '0';
			$trans->type 		= 'offer';
			$trans->save();


			$offerupdate = OfferModel::find($id);
			$offerupdate->transaction_id = $trans->id;
			$offerupdate->save();


		// notification work
	        $user = UsersModel::getuser(Auth::user()->id);
	        $type = 'offerbook';
	        $id = $offerupdate->id;
	        $message = $user->getName(). ' Booked offer';
	        $user->notify(new CommonNotification($type, $id, $message));


	        $teacher_user    = UsersModel::getuser($offerupdate->user_id);
	        $teacher_user->notify(new TeacherNotification('offerbook', $offerupdate->id, 'Your offer has been Booked'));

		// notification work


					
			return redirect('student/offer-page')->with('success', 'Thank you! Offer successfully accepted');
		}
	}


	public function payment_success(Request $request)
	{
		$id = base64_decode($request->item_id);
		$transaction = OfferModel::find($id);

		if(!empty($transaction))
		{
			\Stripe\Stripe::setApiKey('sk_test_D5j27FF4gtD8YFOz0PXKNeDM');
			$getdata = \Stripe\Checkout\Session::retrieve($transaction->trans_id);
		
			if (!empty($getdata->id) && $getdata->id == $transaction->trans_id) {

					$transaction->is_payment = '1';
					$transaction->trans_id = !empty($getdata->payment_intent)?$getdata->payment_intent:null;
					$transaction->save();

					$fee_amount = ($transaction->lesson_per_rate * 15) / 100; 

					$trans 				= new TransactionModel;
					$trans->user_id 	= $transaction->user_id;
					$trans->student_id 	= Auth::user()->id;
					$trans->offer_id 	= $transaction->id;
					$trans->total_amount = $transaction->id;
					$trans->trans_id 	= !empty($getdata->payment_intent)?$getdata->payment_intent:null;
					$trans->amount 		= $transaction->lesson_per_rate - $fee_amount;
					$trans->fee_amount 	= $fee_amount;
					$trans->total_amount = $transaction->lesson_per_rate;
					$trans->type 		= 'offer';
					$trans->save();


					$OfferModel = OfferModel::find($id);
					$OfferModel->transaction_id = $trans->id;
					$OfferModel->save();



					// notification work

			        $user = UsersModel::getuser(Auth::user()->id);
			        $type = 'offerbook';
			        $id = $OfferModel->id;
			        $message = $user->getName(). ' Booked offer';
			        $user->notify(new CommonNotification($type, $id, $message));


	    		    $teacher_user = UsersModel::getuser($OfferModel->user_id);
			        $teacher_user->notify(new TeacherNotification('offerbook', $OfferModel->id, 'Your offer has been Booked'));



					// notification work



					$this->updatewallet($transaction->user_id,$transaction->lesson_per_rate,$fee_amount);

					return redirect('student/offer-page')->with('success', 'Thank you! Payment successfully done!');		
			}
			else
			{
				return redirect('student/offer-page')->with('error','Due to some error please try again.');
			}
		}
		else
		{
			return redirect('student/offer-page')->with('error','Due to some error please try again.');		
		}

		
	}

	public function payment_cancel(Request $request)
	{
		return redirect('student/offer-page')->with('error','Due to some error please try again.');
	}



	public function book_order_course(Request $request)
	{
	 try {

		 	$getLesson = CourseLessonModel::find($request->lesson_id);
			$getCourse = CourseModel::find($getLesson->course_id);

			$order = new OrderCourseModel;
			$order->lesson_id 		= $request->lesson_id;
			$order->course_id 		= $getCourse->id;
			$order->student_id 		= Auth::user()->id;
			$order->user_id 		= $request->user_id;
			$order->subject_id 		= $request->subject_id;
			$order->booking_id 		= $request->booking_id;
			$order->level_of_student_id = $request->level_of_student_id;
			$order->lesson_type_id 		= $request->lesson_type_id;
			$order->lesson_per_rate 	= $getCourse->lesson_per_rate;
			$order->description 		= $request->description;
			$order->save();


			$order = OrderCourseModel::find($order->id);

			Stripe::setApiKey('sk_test_D5j27FF4gtD8YFOz0PXKNeDM');

			$finalprice = $getCourse->lesson_per_rate * 100;

			$session = \Stripe\Checkout\Session::create([
				'customer_email' 		=> Auth::user()->email,
				'payment_method_types' 	=> ['card'],
				'line_items' 			=> [[
					'name' 			=> 'visfforstudy.com',
					'description' 	=> $getCourse->course_title,
					'images' 		=> ['https://visfforstudy.com/assets/img/logo-2x.png'],
					'amount' 		=> intval($finalprice),
					'currency' 		=> 'usd',
					'quantity' 		=> 1,
				]],
				'success_url' => url('student/course/payment_success_course?item_id=' . base64_encode($order->id).'&user_id='.base64_encode($order->user_id)),
				'cancel_url' => url('student/course/payment_cancel_course?user_id='.base64_encode($order->user_id)),
			]);


			$order->trans_id = $session['id'];
			$order->save();

			$data['session_id'] = $session['id'];
			return view('backend.stripe_charge', $data);

		} catch (\Stripe\Error\Card $e) {
			$body = $e->getJsonBody();
			$err = $body['error'];
			print('Status is:' . $e->getHttpStatus() . "\n");
			print('Type is:' . $err['type'] . "\n");
			print('Code is:' . $err['code'] . "\n");
			print('Param is:' . $err['param'] . "\n");
			print('Message is:' . $err['message'] . "\n");
			// $this->saveFailedTransaction($serial_arr, $price, $manufacturer, $email);
		} catch (\Stripe\Error\RateLimit $e) {
			echo "The server is busy. Try again in few minutes.";
			// $this->saveFailedTransaction($serial_arr, $price, $manufacturer, $email);
		} catch (\Stripe\Error\InvalidRequest $e) {
			echo "You have entered invalid data. Try again.";
			// $this->saveFailedTransaction($serial_arr, $price, $manufacturer, $email);
		} catch (\Stripe\Error\Authentication $e) {
			echo "If you see this error contact the support; Error: problem with API Key.";
			// $this->saveFailedTransaction($serial_arr, $price, $manufacturer, $email);
		} catch (\Stripe\Error\ApiConnection $e) {
			echo "Check your internet connection and try again: Error: Can't connect API.";
			// $this->saveFailedTransaction($serial_arr, $price, $manufacturer, $email);
		} catch (Exception $e) {
			echo "There ocurred an error but I can't see what is. Try again in few minutes or contact support";
			// $this->saveFailedTransaction($serial_arr, $price, $manufacturer, $email);
		}
	}

	public function payment_success_course(Request $request)
	{
		$user_id = base64_decode($request->user_id);
		$item_id = base64_decode($request->item_id);
		$transaction = OrderCourseModel::find($item_id);

		if(!empty($transaction))
		{
			\Stripe\Stripe::setApiKey('sk_test_D5j27FF4gtD8YFOz0PXKNeDM');
			$getdata = \Stripe\Checkout\Session::retrieve($transaction->trans_id);
		
			if (!empty($getdata->id) && $getdata->id == $transaction->trans_id) {

				$transaction->is_payment = '1';
				$transaction->trans_id = !empty($getdata->payment_intent)?$getdata->payment_intent:null;
				$transaction->save();

				$fee_amount = ($transaction->lesson_per_rate * 15) / 100; 

				$trans 				= new TransactionModel;
				$trans->user_id 	= $transaction->user_id;
				$trans->student_id 	= Auth::user()->id;
				$trans->order_course_id = $transaction->id;
				$trans->trans_id 	= !empty($getdata->payment_intent)?$getdata->payment_intent:null;
				$trans->amount 		= $transaction->lesson_per_rate - $fee_amount;
				$trans->fee_amount 	= $fee_amount;
				$trans->total_amount = $transaction->lesson_per_rate;
				$trans->type 		= 'course';
				$trans->save();

				$OrderCourseModel 				  = OrderCourseModel::find($item_id);
				$OrderCourseModel->transaction_id = $trans->id;
				$OrderCourseModel->save();


				// notification work
		        $user = UsersModel::getuser(Auth::user()->id);
		        $type = 'coursebook';
		        $id = $OrderCourseModel->id;
		        $message = $user->getName(). ' Booked course';
		        $user->notify(new CommonNotification($type, $id, $message));


		        $teacher_user = UsersModel::getuser($transaction->user_id);
		        $teacher_user->notify(new TeacherNotification('coursebook', $OrderCourseModel->id, 'Your course has been Booked'));

				// notification work


				$this->updatewallet($transaction->user_id,$transaction->lesson_per_rate,$fee_amount);
				

				return redirect('book-lesson/'.$user_id)->with('success','Thank you! Course successfully booked.');

			}
			else
			{
				return redirect('book-lesson/'.$user_id)->with('error','Due to some error please try again.');
			}
		}
		else
		{
			return redirect('book-lesson/'.$user_id)->with('error','Due to some error please try again.');
		}
	}


	public function payment_cancel_course(Request $request)
	{
		$user_id = base64_decode($request->user_id);
		return redirect('book-lesson/'.$user_id)->with('error','Due to some error please try again.');
	}

	public function updatewallet($user_id, $amount, $fee_amount) {

		$user 		   = UsersModel::find($user_id);
		$net_income    = !empty($user->net_income) ? $user->net_income : 0;

		$teacheramount = $amount - $fee_amount;

		$total_income  = $net_income + $teacheramount;

		$total_amount = $user->total_amount + $amount;
		$fee_amount =  $user->fee_amount + $fee_amount;

		$user->net_income = $total_income;
		$user->fee_amount = $fee_amount;
		$user->total_amount = $user->total_amount + $amount;
		
		$user->save();
		
	}

}