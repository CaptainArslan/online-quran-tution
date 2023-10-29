<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SettingController extends Controller
{
    public function updateSettings(Request $req)
    {
        $setting = $req->except('_token');
        $count = 1;
        foreach ($setting as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $set = Setting::where('name', $key)->first() ?: new Setting();
            $set->name = $key;

            if ($req->hasFile($key)) {
                $count++;
                $document_path = uploadFile($value, 'uploads/setting_files', $count);
                $set->value = $document_path;
            } else {
                $set->value = $value;
            }
            $set->save();
        }

        return redirect()->back()->with('message', 'Setting Updated Successfully');
    }

    // // setting crud
    // public function setting(){

    //     $twitter = Setting::where('key','twitter_link')->first();
    //     $facebook = Setting::where('key','facebook_link')->first();
    //     $contact = Setting::where('key','contact_email')->first();
    //     $site_logo = Setting::where('key','site_logo')->first();
    //     $site_name = Setting::where('key','site_name')->first();
    //     $instagram_link = Setting::where('key','instagram_link')->first();
    //     $phone = Setting::where('key','contact_phone')->first();
    //     $seo_meta = Setting::where('key','seo_meta_data')->first();
    //     $meta_description = Setting::where('key','meta_description')->first();
    //     $comission_rate = Setting::where('key','comission_rate')->first();
    //     $data = [
    //         'twitter' => $twitter->value,
    //         'facebook' => $facebook->value,
    //         'contact' => $contact->value,
    //         'site_logo' => $site_logo->value,
    //         'site_name' => $site_name->value,
    //         'instagram_link' => $instagram_link->value,
    //         'phone' => $phone->value,
    //         'seo_meta' => $seo_meta->value,
    //         'meta_description' => $meta_description->value,
    //         'comission_rate' => $comission_rate->value,
    //     ];

    //     if (View::exists('admin.setting.create')) {
    //         return view('admin.setting.create')->with($data);
    //     }
    // }
    // public function add_setting(Request $request){

    //     request()->validate([
    //         'setting' => 'max:190',
    //         'status' => 'max:190',

    //             ]);
    //     updateSettings($request);
    //     return redirect()->route('setting')->with('message','Success');
    // }
}
