<?php
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Setting;
use Mail as Mail;
use Image as Image;
use App\Models\Inquiry;
use Carbon\Carbon;
use Illuminate\Http\Request;


function indexPlans(){
    $location = getLocation();
        if(isset($location) || !empty($location)){
        return  $plan = Plan::whereHas('country', function($q)use($location){
            $q->where('code', '=', '001');
        })->get();
         }
        if(empty($location) || !isset($location) || is_null($location)){
         return $plan =   Plan::whereHas('country', function($q){
            $q->where('code', '=', '001')->orWhere('name', '=', 'United Kingdom' );
        })->get();
        }
}


function indexPlansPrivate()
{
    $location = getLocation();
        if(isset($location) || !empty($location)){
        return  $plan = Plan::where('is_private',false)->whereHas('country', function($q)use($location){
            $q->where('code', '=', '001');
        })->get();
         }
        if(empty($location) || !isset($location) || is_null($location)){
         return $plan =   Plan::where('is_private',false)->whereHas('country', function($q){
            $q->where('code', '=', '001')->orWhere('name', '=', 'United Kingdom' );
        })->get();
        }
}


function getLocation()
    {

        $url = 'http://api.ipinfodb.com/v3/ip-city/?key=345f70aec9a0975ea4290c4cf8c4276dbf8ce326c3946825467d68ea27bb185d&format=json';

        // $url .= '&ip='.$_SERVER['REMOTE_ADDR']; //for live server

        $s = curl_init();
        curl_setopt($s,CURLOPT_URL,$url);
        curl_setopt($s,CURLOPT_RETURNTRANSFER,1);
        $res  = curl_exec($s);
        curl_close($s);
        $r = json_decode($res);

        if($r->statusCode == 'OK')
        {
            return $r;
        }
        return 'FAILED';
    }


function pendingInquiries(){
    return Inquiry::where('to', '<', Carbon::now())->get();
}

function makeImage($file, $dir = 'uploads/avatar/', $w=126, $h=126){
	$fullPath = $dir . time() . $file->getClientOriginalName();
	$image = Image::make($file);

	if($w && $h)
		$image = $image->resize($w , $h);

	$image = $image->encode($file->getClientOriginalExtension(),75);
	$image->save($fullPath);
	return $fullPath;
}

function uploadAvatar($file, $path){
    $name = time().'-'.str_replace(' ', '-', $file->getClientOriginalName());
    $file->move($path,$name);
    return $path.'/'.$name;
}

function uploadFile($file, $path = 'audios',$count){
    $name = $count.time().'_'.str_replace(' ', '-', $file->getClientOriginalName());
    $file->move($path,$name);
    return $path.'/'.$name;
}

function updateSettings(Request $req)
{
    $setting = $req->except('_token');
    foreach ($setting as $key => $value) {
        if(empty($value))
            continue;
        $set = Setting::where('key', $key)->first() ?: new Setting();
        $set->key = $key;
        $set->value = $value;
        $set->save();
    }
    return ['success', 'Setting Updated Successfully'];
}

function sendMail($data)
{
    if (array_key_exists("pdf",$data)) {
        $mail = Mail::send($data['view'], ['data' => $data['data']], function ($message) use ($data) {
            $message->to($data['to'], $data['name'])->subject($data['subject'])->attachData($data['pdf']->output(), "invoice.pdf");
        });
    }else {
        $mail = Mail::send($data['view'], ['data' => $data['data']], function ($message) use ($data) {
            $message->to($data['to'], $data['name'])->subject($data['subject']);
        });
    }
    /*Mail::send($data['view'], ['data' => $data['data']], function ($message) use ($data) {
        $message->to($data['to'], $data['name'])->subject($data['subject']);
    });*/
}

function getCustomerName($mandate){
    $subscription=Subscription::where('mandate',$mandate)->first();
    if (empty($subscription)){
        return null;
    }
    return User::where('id',$subscription['user_id'])->first();
}
?>
