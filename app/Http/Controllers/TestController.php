<?php

namespace App\Http\Controllers;

use App\Jobs\AddUserBalance;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function index(Request $request)
    {
        $amount = $request->input('amount',1);
        $user = User::query()->first();
        if ($user){
            // 创建一个新的队列任务实例
            $job = new AddUserBalance($user, $amount);
            // 将任务添加到队列中
            dispatch($job);
        }

        return response()->json(['message' => 'success']);
    }


}
