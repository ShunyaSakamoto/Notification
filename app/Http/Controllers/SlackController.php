<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\SlackRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SlackController extends Controller
{
    public function index()
    {
        return view('slack.index');
    }

    public function create(SlackRequest $request)
    {
        // 検証済みデータを取得
        $validated_data = $request->validated();

        DB::beginTransaction();
        try {
            // お問合わせ情報を保存
            $user = User::create([
                'name' => $validated_data['name'],
                'email' => $validated_data['email'],
                'content' => $validated_data['content'],
            ]);
    
            // Slack通知
            \Slack::send($user);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();
            return $e;
        }

        return redirect()->route('slack.complete', ['id' => base64_encode($user->id)]);
    }

    public function complete(Request $request)
    {
        $id = base64_decode($request->id);
        
        $user = User::find($id);

        if (!isset($user)) {
            return redirect()->route('slack.index');
        }

        return view('slack.complete', compact('user'));
    }
}
