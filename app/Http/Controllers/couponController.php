<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\coupon;
use Response;
use DB;
use Auth;

class couponController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $coupons = coupon::orderBy('id','DESC')->paginate(5);
        return view('coupon.index',compact('coupons'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'coupon_code' => 'required|max:25|alpha_num',
            'description' => 'required',
			'from_date' => 'required|date|after:yesterday',
			'to_date' => 'required|date|after:from_date',
			'discount'=>'required|numeric|between:1,100',
			'max_redeem'=>'required|numeric',
        ]);

        coupon::create($request->all());
        return redirect()->route('coupon.index')
                        ->with('success','coupon created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coupon = coupon::find($id);
        return view('coupon.show',compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = coupon::find($id);
        return view('coupon.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
             'coupon_code' => 'required|max:25|alpha_num',
            'description' => 'required',
			'from_date' => 'required|date|after:yesterday',
			'to_date' => 'required|date|after:from_date',
			'discount'=>'required|numeric|between:1,100',
			'max_redeem'=>'required|numeric',
        ]);

        coupon::find($id)->update($request->all());
        return redirect()->route('coupon.index')
                        ->with('success','coupon updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        coupon::find($id)->delete();
        return redirect()->route('coupon.index')
                        ->with('success','coupon deleted successfully');
    }
	
	public function coupon_validator(Request $request)
	{
		$coupon_code = $request->input('coupon_code');
		$product_price = $request->input('product_price');
		$coupon_id_details = self::get_coupon_info($coupon_code);
		$data['coupon'] = $coupon_id_details;
		//$coupon_id = self::get_coupon_id($coupon_code);
		//if($coupon_id !='')
		if(count($coupon_id_details) != '0')
		{
			foreach ($coupon_id_details as $key => $value) 
			{
				$data['coupon_id'] = $value->id;				
				$coupon_discount = $value->discount;				
				$coupon_max_redeem = $value->max_redeem;				
			}
			if(self::coupon_expired($data['coupon_id']) == 'no')
			{
				if(self::coupon_used($data['coupon_id']) == 0)
				{
					$discount_amount = self::discouted_price($coupon_discount,$coupon_max_redeem,$product_price);
					$data['success']['message'] = "Coupon code applied successfully";
					$data['discount_amount'] = $discount_amount;
					//return response()->json($data);
				}
				else{
					$data['errors']['message'] = "Coupon code already used";
				}
			}
			else
			{
				$data['errors']['message'] = "Coupon code is expired";
				//return response()->json($data);
			}
		}
		else		
		{
			$data['errors']['message'] = "Coupon code not found";			
		}
		return response()->json($data);
	}
	public function get_coupon_info($coupon_code)
    {
		$coupon_id_detail = '';
		$coupon_id_details = array();
		$coupon_id_details = coupon::where('coupon_code', $coupon_code)
        ->get();
		if(!empty($coupon_id_details))
		{
			foreach ($coupon_id_details as $key => $value) 
			{
				$coupon_id_detail = $value->id;				
			}
		}
		//return $coupon_id_detail;
		return $coupon_id_details;
	}
	public function coupon_expired($coupon_id)
    {
		$current_date  = date('Y-m-d');
		$coupon_details = DB::table('coupons')
        ->select('*')
        ->where('id', $coupon_id)
        ->whereDate('to_date', '>=', $current_date)
        ->whereDate("from_date"," <= ",$current_date)
        ->get(); // you were missing the get method
		if(count($coupon_details)!= '0')
		{
			$coupon_expired = "no";
		}
		else
		{
			$coupon_expired = "yes";
		}
		return $coupon_expired;
	}
	public function coupon_used($coupon_id)
	{
		$user_id = Auth::user()->id;
		$coupon_used_details = DB::table('carts')
        ->select('*')
        ->where('user_id', $user_id)
        ->where('coupon_id', $coupon_id)
        ->get();
		return count($coupon_used_details);
	}
	public function discouted_price($coupon_discount,$coupon_max_redeem,$product_price)
	{
		$discount_amount = ($product_price * $coupon_discount)/100;
		$final_discount_amount = ($discount_amount > $coupon_max_redeem) ? ($product_price - $coupon_max_redeem) : ($product_price - $discount_amount);
		return $final_discount_amount;
	}
}
