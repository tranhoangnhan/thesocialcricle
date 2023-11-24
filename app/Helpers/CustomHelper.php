<?php
use App\Events\Clients\Users\AllUsersEvent;
use App\Models\CoursesModel;
use App\Models\FriendsModel;
use App\Models\PostsModel;
use App\Models\UsersLogModel;
use App\Models\UsersModel;
use App\Models\ConversationsModel;
use App\Models\Conversations_UsersModel;
use App\Models\Conversations_MessagesModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redis;
use shweshi\OpenGraph\Facades\OpenGraphFacade as OpenGraph;

if (!function_exists('getName')) {
    function getName($id, $css = NULL)
    {
        $html = '';
        if (auth()->check()) {
            $user = UsersModel::where('user_id', $id)->first();
            $styleAttribute = isset($css) ? 'style="' . $css . '"' : '';
            $fullname = $user->user_fullname;
            if ($user->user_activated == 1) {
                $html .= '<div class="flex items-center">';
                $html .= '<son class="self-center line-clamp-1 ">' . $fullname . '</son>';
                $html .= '<img src="' . asset('clients/assets/images/icons/verify.png') . '" ' . $styleAttribute . ' style="width:20px;margin-left:2px">';
                $html .= '</div>';

            }

            if ($user->user_activated != 1) {
                $html .= '<div class="flex items-center">';
                $html .= '<son class="self-center line-clamp-1 ">' . $fullname . '</son>';
                $html .= '</div>';
            }
        }
        return $html;
    }

    function getNameC($id, $css = NULL)
    {
        $html = '';
        if (auth()->check()) {
            $user = UsersModel::where('user_id', $id)->first();

            $fullname = $user->user_fullname;
            if ($user) {
                $html .= $fullname;
            }
        }
        return $html;
    }

    function getNames($userIds, $type = "profile")
    {
        $html = '';

        if (auth()->check()) {
            $users = UsersModel::whereIn('user_id', $userIds)->get();
            foreach ($users as $user) {
                $fullname = $user->user_fullname;
                $html .= $fullname;
                if ($user !== $users->last()) {
                    $html .= ', ';
                }
            }
        }
        return $html;
    }
    function getAvatar($id, $type = NULL, $css = NULL, $classcss = NULL)
    {
        $user = UsersModel::where('user_id', $id)->first();
        $isOnline = checkOnline($id);
        $styleAttribute = isset($css) ? 'style="' . $css . '"' : '';
        $classCss = isset($classcss) ? $classcss : '';
        if (isset($user->user_avatar)) {
            $link = route('cacheProxy',['url' => base64_encode($user->user_avatar)]);
            $html = '<img ' . ($classCss ? $styleAttribute : 'id="profileImage"') . $styleAttribute . '  class="' . $classCss . ' lazyload inline-block h-10 w-10 rounded-full ring-2 ring-white dark:ring-gray-800" src="' . $user->user_avatar . '">';
        } else {
            $fullname = $user->user_fullname;
            $names = explode(' ', $fullname);
            $initials = '';
            foreach ($names as $name) {
                $initials .= $name[0];
            }
            $initials = strtoupper(trim($initials));
            if (strlen($initials) === 1) {
                $html = '<div ' . ($classCss ? $styleAttribute : 'id="profileImage"') . $styleAttribute . ' class="' . $classCss . ' lazyload inline-block h-10 w-10 rounded-full ring-2 ring-white dark:ring-gray-800">
                    ' . $initials . '</div>';
            } else {
                $html = '<div ' . ($classCss ? $styleAttribute : 'id="profileImage"') . $styleAttribute . ' class="' . $classCss . ' lazyload inline-block h-10 w-10 rounded-full ring-2 ring-white dark:ring-gray-800">
                    ' . $initials[0] . $initials[1] . '
                </div>';
            }
        }
        if ($type == 'online') {
            if ($isOnline) {
                $html .= '<span class="user_status status_online"></span>';
            }
        }
        return $html;
    }

    function getCover($id, $type = NULL, $css = NULL)
    {
        $user = UsersModel::where('user_id', $id)->first();
        if (isset($user->user_cover)) {
            $link = route('cacheProxy',['url' => base64_encode($user->user_cover)]);
            $html = '<img class="lazyload inline-block w-100 ring-2 ring-white dark:ring-gray-800" src="' . $user->user_cover . '" loading="lazy">';
        } else {
            $link = route('cacheProxy',['url' => base64_encode("https://c4.wallpaperflare.com/wallpaper/295/163/719/anime-anime-boys-picture-in-picture-kimetsu-no-yaiba-kamado-tanjir%C5%8D-hd-wallpaper-preview.jpg")]);
            $html = '<img class="lazyload" src="' . $link . '" loading="lazy">';
        }
        return $html;
    }

    function countFriend($id)
    {
        $user = UsersModel::where('user_id', $id)->first();

        if (isset($user)) {
            $friend = FriendsModel::where(function ($query) use ($user) {
                $query->where('user_one_id', $user->user_id)
                    ->orWhere('user_two_id', $user->user_id);
            })->where('status', "1")->count();
            return $friend;
        }
    }
    // Trong tệp helpers.php hoặc một nơi phù hợp khác
    function isFriendWith($user, $otherUserId)
    {
        $friends = FriendsModel::where('status', "1")
            ->where(function ($query) use ($user) {
                $query->where('user_one_id', $user->user_id)
                    ->orWhere('user_two_id', $user->user_id);
            })
            ->get();

        foreach ($friends as $friend) {
            if ($friend->user_one_id == $otherUserId || $friend->user_two_id == $otherUserId) {
                return true;
            }
        }

        return false;
    }


    // function getConversationMessages($conversation_id, $offset = 0, $last_message_id = null): Collection
    // {
    //     $user_id = auth()->user()->user_id;

    //     $us1 = Conversations_UsersModel::where('user_id', $user_id)
    //         ->pluck('conversations_id')
    //         ->toArray();

    //     $us2 = Conversations_UsersModel::where('user_id', $conversation_id)
    //         ->pluck('conversations_id')
    //         ->toArray();

    //     $common_conversations = array_intersect($us1, $us2);
    //     if (array_diff($us1, $us2) && array_diff($us2, $us1)) {
    //         $conversation_id = $common_conversations;
    //     } else {
    //         $conversation_id = null;
    //     }
    //     dd($conversation_id);
    //     $check_conversation = Conversations_UsersModel::where(function ($query) use ($conversation_id, $user_id) {
    //         $query->where('user_id', $user_id)
    //             ->orWhere(function ($query) use ($conversation_id) {
    //                 $query->where('user_id', $conversation_id);
    //             });
    //     })->count();

    //     dd($check_conversation);
    //     if ($check_conversation === 0) {
    //         throw new \Exception("Không có quyền xem!");
    //     }

    //     if ($last_message_id !== null) {
    //         $messages = Conversations_MessagesModel::where('conversations_id', $conversation_id)
    //             ->where('message_id', '>', $last_message_id)
    //             ->join('users', 'conversations_messages.user_id', '=', 'users.user_id')
    //             ->select('conversations_messages.message_id', 'conversations_messages.message', 'conversations_messages.source', 'conversations_messages.time', 'users.user_id', 'users.user_name', 'users.user_firstname', 'users.user_lastname', 'users.user_gender', 'users.user_picture', 'users.user_subscribed', 'users.user_verified')
    //             ->get();
    //     } else {
    //         $messages = Conversations_MessagesModel::where('conversations_id', $conversation_id)
    //             ->join('users', 'conversations_message.user_id', '=', 'users.user_id')
    //             ->select('conversations_message.message_id', 'conversations_message.message', 'conversations_message.source', 'conversations_message.time')
    //             ->orderByDesc('conversations_message.message_id')
    //             // ->offset(5)
    //             // ->limit(5)
    //             ->get();
    //     }
    //     return $messages;
    // }

    function formatTimeAgo($dateTime, $select = "main")
    {
        $carbonDateTime = new Carbon($dateTime);
        $now = Carbon::now();
        if ($select == 'select') {
            $diffInSeconds = $carbonDateTime->diffInSeconds($now);
            if ($diffInSeconds < 60) {
                return 'mới đây';
            } elseif ($diffInSeconds < 3600) {
                $minutesAgo = floor($diffInSeconds / 60);
                return $minutesAgo . ' phút trước';
            } elseif ($diffInSeconds < 86400) {
                $hoursAgo = floor($diffInSeconds / 3600);
                return $hoursAgo . ' giờ trước';
            } elseif ($diffInSeconds < 2592000) {
                $daysAgo = floor($diffInSeconds / 86400);
                return $daysAgo . ' ngày trước';
            } elseif ($diffInSeconds < 31536000) {
                $monthsAgo = floor($diffInSeconds / 2592000);
                return $monthsAgo . ' tháng trước';
            } else {
                $yearsAgo = floor($diffInSeconds / 31536000);
                return $yearsAgo . ' năm trước';
            }
        } else {
            $diffInDays = $carbonDateTime->diffInDays($now);
            if ($diffInDays >= 7) {
                return $carbonDateTime->isoFormat('dddd H:mm, D MMM, YYYY'); // 'dddd' để hiển thị tên ngày trong tiếng Việt
            } elseif ($diffInDays >= 1) {
                return $carbonDateTime->isoFormat('dddd, H:mm');
            } else {
                return $carbonDateTime->isoFormat('H:mm');
            }
        }

    }

    function checkOnline($id)
    {
        if (Auth::check()) {
            if (isset($id)) {
                $check = UsersModel::where('user_id', $id)->first();
                if (isset($check)) {
                    if ($id != Auth::user()->user_id) {
                        $cacheStatusKey = 'user_status_' . $id;
                        $status = Redis::get($cacheStatusKey);
                        if ($status === 'online') {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
            }
        }
    }

    function birthday($users)
    {
        if (isset($users) && $users->isNotEmpty()) {
            $html = '<p class="line-clamp-2 leading-6"><strong>';
            foreach ($users as $key => $user) {
                $html .= $user->user_fullname;
                if ($key < $users->count() - 1) {
                    $html .= ' và ';
                }
                if ($key == 1) {
                    break;
                }
            }
            $remainingUsersCount = $users->count() - 2;
            if ($remainingUsersCount > 0) {
                $html .= "</strong> và <strong>{$remainingUsersCount} người khác</strong>";
            } else {
                $html .= '</strong>';
            }
            $html .= " có sinh nhật trong tháng.</p>";
            return $html;
        } else {
            return '<p class="line-clamp-2 leading-6">Không có ai sinh nhật trong tháng.</p>';
        }
    }
    function google2FA_QRCODE($data = NULL)
    {
        if (isset($data)) {
            $google2fa = app('pragmarx.google2fa');
            return $google2fa->getQRCodeInline(
                'Social Circle, ' . $data->user_username,
                $data->user_email,
                $data->google2fa_secret
            );
        } else {
            $google2fa = app('pragmarx.google2fa');
            return $google2fa->getQRCodeInline(
                'Social Circle, ' . auth()->user()->user_username,
                auth()->user()->user_email,
                auth()->user()->google2fa_secret
            );
        }

    }

    function OpenGraphData($url)
    {
        $url = "https://facebook.com";
        $allMeta = true; // can be false
        $language = 'en'; // en-US,en;q=0.8,en-GB;q=0.6,es;q=0.4
        $data = OpenGraph::fetch($url, $allMeta, $language);
        // $openGraph = OpenGraph::fetch("https://google.com/", true);
        dd($data);
        return [
            'title' => $openGraph['title'],
            'description' => $openGraph['description'],
            'image' => $openGraph['image'],
            'url' => $openGraph['url'],
        ];
    }
    function checkLink($text)
    {
        $pattern = '/(https?:\/\/[^\s]+)/';
        if (preg_match($pattern, $text, $match)) {
            return $match[0];
        } else {
            return null;
        }
    }

    function vIpInfo()
    {
        $ip = null;
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
        } else {
            if (filter_var($ip, FILTER_VALIDATE_IP) === false) {
                $ip = $_SERVER["REMOTE_ADDR"];
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                }
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                }
            }
        }

        if (Cache::has($ip)) {
            $ipInfo = Cache::get($ip);
        } else {
            $fields = "status,country,countryCode,city,zip,lat,lon,timezone,currency,proxy,query,regionName";
            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/{$ip}?fields={$fields}");
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // $response = curl_exec($ch);
            // curl_close($ch);
            // $ipInfo = (object) json_decode($response, true);
            // Cache::forever($ip, $ipInfo);
            $ipInfo = Cache::rememberForever($ip, function () use ($ip, $fields) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/{$ip}?fields={$fields}");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                return (object) json_decode($response, true);
            });
        }
        $data['regionName'] = $ipInfo->regionName ?? "";
        $data['ip'] = $ipInfo->query ?? $ip;
        $data['country'] = $ipInfo->country ?? "Không xác định";
        $data['country_code'] = $ipInfo->countryCode ?? "Không xác định";
        $data['timezone'] = $ipInfo->timezone ?? "Không xác định";
        $data['city'] = $ipInfo->city ?? "Không xác định";
        $data['zip'] = $ipInfo->zip ?? "Không xác định";
        $data['latitude'] = $ipInfo->lat ?? "Không xác định";
        $data['longitude'] = $ipInfo->lon ?? "Không xác định";
        $data['location'] = $data['city'] . ', ' . $data['regionName'] . ', ' . $data['country'];
        $data['currency'] = $ipInfo->currency ?? "Không xác định";
        $data['proxy'] = $ipInfo->proxy ?? NULL;

        return (object) $data;
    }

    function vBrowser()
    {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $browsers = [
            '/msie/i' => 'Internet Explorer',
            '/firefox/i' => 'Firefox',
            '/safari/i' => 'Safari',
            '/chrome/i' => 'Chrome',
            '/edge/i' => 'Edge',
            '/opera/i' => 'Opera',
            '/netscape/i' => 'Netscape',
            '/maxthon/i' => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/mobile/i' => 'Handheld Browser',
        ];
        $agent_browser = "Unknown";
        foreach ($browsers as $key => $value) {
            if (preg_match($key, $agent)) {
                $agent_browser = $value;
            }
        }
        return $agent_browser;
    }
    function vPlatform()
    {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $platforms = [
            '/windows nt 10/i' => 'Windows 10',
            '/windows nt 6.3/i' => 'Windows 8.1',
            '/windows nt 6.2/i' => 'Windows 8',
            '/windows nt 6.1/i' => 'Windows 7',
            '/windows nt 6.0/i' => 'Windows Vista',
            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i' => 'Windows XP',
            '/windows xp/i' => 'Windows XP',
            '/windows nt 5.0/i' => 'Windows 2000',
            '/windows me/i' => 'Windows ME',
            '/win98/i' => 'Windows 98',
            '/win95/i' => 'Windows 95',
            '/win16/i' => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i' => 'Mac OS 9',
            '/linux/i' => 'Linux',
            '/ubuntu/i' => 'Ubuntu',
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile',
        ];
        $agent_platform = "Unknown";
        foreach ($platforms as $key => $value) {
            if (preg_match($key, $agent)) {
                $agent_platform = $value;
            }
        }
        return $agent_platform;
    }

    function countAll($type="user"){
        if ($type === 'user') {
            return UsersModel::count();
        }
        if($type === 'post'){
            return PostsModel::count();
        }
        if($type === 'loginLog'){
            return UsersLogModel::count();
        }
        if($type === 'course'){
            return CoursesModel::count();
        }
    }
    function statistical()
    {
        $today = Carbon::now()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

        $usersRegisteredToday = UsersModel::whereDate('user_registered', $today)->count();
        $usersRegisteredYesterday = UsersModel::whereDate('user_registered', $yesterday)->count();

        $comparison = ($usersRegisteredToday <=> $usersRegisteredYesterday);
        $percentageIncrease = ($usersRegisteredToday - $usersRegisteredYesterday) / ($usersRegisteredYesterday ?: 1) * 100;
        $percentageDecrease = ($usersRegisteredYesterday - $usersRegisteredToday) / ($usersRegisteredToday ?: 1) * 100;

        return [
            'comparison' => $comparison,
            'percentageIncrease' => $percentageIncrease,
            'percentageDecrease' => $percentageDecrease,
        ];
    }
    function displayStatistical()
    {
        $comparisonData = statistical();

        if ($comparisonData['comparison'] > 0) {
            $icon = '<i class="ri-arrow-right-up-line fs-13 align-middle"></i>';
            $percentage = number_format($comparisonData['percentageIncrease'], 2);
        } elseif ($comparisonData['comparison'] < 0) {
            $icon = '<i class="ri-arrow-right-down-line fs-13 align-middle"></i>';
            $percentage = number_format($comparisonData['percentageDecrease'], 2);
        } else {
            $icon = '<i class="ri-arrow-right-line fs-13 align-middle"></i>';
            $percentage = '0';
        }

        return "<h5 class=\"text-success fs-14 mb-0\">$icon +$percentage %</h5>";
    }


}
