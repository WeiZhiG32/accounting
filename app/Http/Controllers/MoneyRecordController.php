<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoneyRecord;

class MoneyRecordController extends Controller
{

    public function get_csrf_token()
    {
        //顯示Token
        return csrf_token();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //顯示全資料
        $MoneyRecord = MoneyRecord::all();
        return response()->json($MoneyRecord);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
               //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //新增資料
        $money_record = new MoneyRecord;
        $money_record->pay_name = $request->pay_name;
        $money_record->money_amount = $request->money_amount;
        $money_record->record_date = $request->record_date;
        $money_record->save();

        if(!$money_record){
            App::abort(500, 'Error');
        }

        //saved show OK message
        return response()->json(array('success' => true, 'money_record_added' => 1), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //查詢資料
        $money_record_select = MoneyRecord::find($id);

        if (empty($money_record_select)) {
            return response()->json(array('success' => false, 'money_record_updated' => 1), 404);
        } else {
            return response()->json(array('success' => true, 'money_record_updated' => 1,'data' => $money_record_select), 200);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //判斷是否有資料，來自上面 show 的 function
        $money_record_show = $this->show($id);
        
        // 解碼 JSON 的資料
        //方法1
        // $result = $money_record_show->getData();
        // $success = $result->success;

        //方法2
        $result = json_decode($money_record_show->getContent(), true);
        $success = $result['success'];

        //如果查詢不到資料
        if(!$success){
            return response()->json(array('success' => false, 'money_record_updated' => 0, 'message' => 'data not find!'), 200);
        }

        //更新資料
        $money_record_update = MoneyRecord::where('id',$id)->update($request->all());

        if(!$money_record_update){
            App::abort(500, 'Error');
        }
        //saved show OK message
        return response()->json(array('success' => true, 'money_record_updated' => 1), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //判斷是否有資料，來自上面 show 的 function
        $money_record_show = $this->show($id);
        
        // 解碼 JSON 的資料
        //方法1
        $result = $money_record_show->getData();
        $success = $result->success;

        //方法2
        // $result = json_decode($money_record_show->getContent(), true);
        // $success = $result['success'];

        //如果查詢不到資料
        if(!$success){
            return response()->json(array('success' => false, 'money_record_updated' => 0, 'message' => 'data not find!'), 200);
        }

        //刪除資料
        $money_record_delete = MoneyRecord::where('id',$id)->delete();

        if(!$money_record_delete){
            App::abort(500, 'Error');
        }
        //saved show OK message
        return response()->json(array('success' => true, 'money_record_delete' => 1), 200);
    }
}
