<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Project;
use App\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MessengerController extends Controller
{
    public function index()
    {
        $this->verifyAccess();

        $input = json_decode(file_get_contents('php://input'), true);

        $id = $input['entry'][0]['messaging'][0]['sender']['id'];
        $message = '';

        if (isset($input['entry'][0]['messaging'][0]['postback']['payload'])) {
            $message = $input['entry'][0]['messaging'][0]['postback']['payload'];
        } else {
            $message = $input['entry'][0]['messaging'][0]['message']['text'];
        }

        $user    = json_decode($this->getUser($id));

        Cache::get('lang') == '' ? Cache::put('lang', 'ar', Carbon::tomorrow()) : '';
        $lang = Cache::get('lang');


        if ($message == __('bot.'. $lang .'.main_menu')){
            $response = $this->mainMenu($id, $user);
        } elseif ($message == __('bot.'. $lang .'.visit_website')) {
            $response = $this->visitWebsite($id);
        } elseif ($message == 'العربيه' || $message == 'English') {
            $this->switchLang($message);
            $response = $this->mainMenu($id, $user);
        } elseif ($message == __('bot.'. $lang .'.services')) {
            $response = $this->showServices($id);
        } elseif ($message == __('bot.'. $lang .'.projects')) {
            $response = $this->showProjects($id);
        } elseif ($message == __('bot.'. $lang .'.blog')) {
            $response = $this->showBlog($id);
        } elseif ($message == __('bot.' . $lang . '.contact_us')) {
            $response = $this->contactUs($id);
        } else {
            $response = $this->mainMenu($id, $user);
        }

        $this->sendMessage($response);
    }

    public function mainMenu($id, $user)
    {
        $lang = Cache::get('lang');
        return [
            'recipient' => ['id' => $id ],
            'messaging_type' => 'RESPONSE',
            'message'  => [
                'text' => "Welcome {$user->first_name}",
                'quick_replies' => [
                    [
                        "content_type" => "text",
                        "title" => __('bot.'. $lang .'.services'),
                        "payload" => "http://monraytravel.com/appointments"
                    ], [
                        "content_type" => "text",
                        "title" => __('bot.'. $lang .'.projects'),
                        "payload" => "http://monraytravel.com/appointments"
                    ], [
                        "content_type" => "text",
                        "title" => __('bot.'. $lang .'.blog'),
                        "payload" => "http://monraytravel.com/appointments"
                    ], [
                        "content_type" => "text",
                        "title" => 'العربيه',
                        "payload" => "http://monraytravel.com/appointments"
                    ], [
                        "content_type" => "text",
                        "title" => 'English',
                        "payload" => "http://monraytravel.com/appointments"
                    ], [
                        "content_type" => "text",
                        "title" => __('bot.'. $lang .'.visit_website'),
                        "payload" => "http://monraytravel.com/appointments"
                    ], [
                        "content_type" => "text",
                        "title" => __('admin.contact_us'),
                        "payload" => "http://monraytravel.com/appointments"
                    ]
                ]
            ]
        ];
    }

    public function contactUs($id)
    {
        $lang = Cache::get('lang');
        return [
            'recipient' => ['id'    => $id],
            'message'   => [
                'text'  => __('bot.'. $lang .'.call_us_on') .' '. setting('phone')
            ]
        ];
    }

    public function visitWebsite($id)
    {
        $lang = Cache::get('lang');
        return [
            'recipient' => ['id' => $id ],
            'message'  => [
                'attachment' => [
                    'type'  => 'template',
                    'payload' => [
                        'template_type' => 'generic',
                        'elements'  => [
                            [
                                'title'     => __('bot.'. $lang .'.welcome'),
                                'image_url' => 'https://www.freeimages.com/istockphoto/file?id=25644420&path=photo/lasagna-gm181096530-25644420&function=not_found&location=center&keyword=restaurnat&page=&sharedid=restaurnat&getty=181096530',
                                'subtitle'  => __('bot.'. $lang .'.hello_everyone'),
                                'default_action' => [
                                    'type' => 'web_url',
                                    'url'   => 'http://monraytravel.com',
                                    'webview_height_ratio'  => 'tall'
                                ], 'buttons'    => [
                                    [
                                        'type'  => 'web_url',
                                        'url'   => 'http://monraytravel.com',
                                        'title' => __('bot.'. $lang .'.visit_website')
                                    ], [
                                        'type'  => 'postback',
                                        'payload'   => __('bot.'. $lang .'.main_menu'),
                                        'title' => __('bot.'. $lang .'.main_menu')
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    public function switchLang($message)
    {
        $lang = $message == 'English' ? 'en' : 'ar';
        Cache::put('lang', $lang, Carbon::tomorrow());
    }

    public function showServices($id)
    {
        $lang = Cache::get('lang');
        $services = Service::orderBy('id', 'desc')->limit(3)->get()->toArray();
        $temp = [];
        for ($i = 0;$i < count($services); $i++) {
            array_push($temp,
            [
            'title' => $services[$i][$lang . '_title'],
                        'subtitle' => $services[$i][$lang . '_description'],
                        "image_url" => "https://www.google.com/imgres?imgurl=https%3A%2F%2Fgdb.voanews.com%2F31E6C56F-7AC8-48FC-8937-DF8FC6B2675C_w1080_h608_s.jpg&imgrefurl=https%3A%2F%2Flearningenglish.voanews.com%2Fa%2Fhot-drinks-linked-to-cancer%2F3550970.html&tbnid=3dBxGtq8b6YY0M&vet=12ahUKEwj05JS38cvrAhWPxeAKHfWABtgQMygBegUIARDQAQ..i&docid=rm2ShJhuKKONJM&w=1080&h=608&q=images%20hot%20drinks&ved=2ahUKEwj05JS38cvrAhWPxeAKHfWABtgQMygBegUIARDQAQ",
                        'default_action' => [
                "type" => "web_url",
                "url" => "http://monraytravel.com/services/{$services[$i]['id']}/{$services[$i][$lang.'_title']}",
                "webview_height_ratio" => "tall"
            ],
                'buttons' => [
                    [
                        "type" => "postback",
                        "payload" => $services[$i][$lang . '_title'],
                        "title" => $services[$i][$lang . '_title'],
                    ], [
                        "type" => "postback",
                        "payload" => __('bot.'. $lang .'.main_menu'),
                        "title" => __('bot.'. $lang .'.main_menu'),
                    ]
                ]
            ]);
        }

        return [
            'recipient' => ['id' => $id ],
            'message'  => [
                'attachment' => [
                    'type'  => 'template',
                    'payload' => [
                        'template_type' => 'generic',
                        'elements'  => $temp
                    ]
                ]
            ]
        ];
    }

    public function showProjects($id)
    {
        $lang = Cache::get('lang');
        $projects = Project::orderBy('id', 'desc')->limit(3)->get()->toArray();
        $temp = [];
        for ($i = 0;$i < count($projects); $i++) {
            array_push($temp,
                [
                    'title' => $projects[$i][$lang . '_title'],
                    'subtitle' => $projects[$i][$lang . '_description'],
                    "image_url" => "https://www.google.com/imgres?imgurl=https%3A%2F%2Fgdb.voanews.com%2F31E6C56F-7AC8-48FC-8937-DF8FC6B2675C_w1080_h608_s.jpg&imgrefurl=https%3A%2F%2Flearningenglish.voanews.com%2Fa%2Fhot-drinks-linked-to-cancer%2F3550970.html&tbnid=3dBxGtq8b6YY0M&vet=12ahUKEwj05JS38cvrAhWPxeAKHfWABtgQMygBegUIARDQAQ..i&docid=rm2ShJhuKKONJM&w=1080&h=608&q=images%20hot%20drinks&ved=2ahUKEwj05JS38cvrAhWPxeAKHfWABtgQMygBegUIARDQAQ",
                    'default_action' => [
                        "type" => "web_url",
                        "url" => "http://monraytravel.com/services/{$projects[$i]['id']}/{$projects[$i][$lang.'_title']}",
                        "webview_height_ratio" => "tall"
                    ],
                    'buttons' => [
                        [
                            "type" => "postback",
                            "payload" => $projects[$i][$lang . '_title'],
                            "title" => $projects[$i][$lang . '_title'],
                        ], [
                            "type" => "postback",
                            "payload" => __('bot.'. $lang .'.main_menu'),
                            "title" => __('bot.'. $lang .'.main_menu'),
                        ]
                    ]
                ]);
        }

        return [
            'recipient' => ['id' => $id ],
            'message'  => [
                'attachment' => [
                    'type'  => 'template',
                    'payload' => [
                        'template_type' => 'generic',
                        'elements'  => $temp
                    ]
                ]
            ]
        ];
    }

    public function showBlog($id)
    {
        $lang = Cache::get('lang');
        $blogs = Blog::orderBy('id', 'desc')->limit(3)->get()->toArray();
        $temp = [];
        for ($i = 0;$i < count($blogs); $i++) {
            array_push($temp,
                [
                    'title' => $blogs[$i][$lang . '_title'],
                    'subtitle' => strip_tags($blogs[$i][$lang . '_content']),
                    "image_url" => "https://www.google.com/imgres?imgurl=https%3A%2F%2Fgdb.voanews.com%2F31E6C56F-7AC8-48FC-8937-DF8FC6B2675C_w1080_h608_s.jpg&imgrefurl=https%3A%2F%2Flearningenglish.voanews.com%2Fa%2Fhot-drinks-linked-to-cancer%2F3550970.html&tbnid=3dBxGtq8b6YY0M&vet=12ahUKEwj05JS38cvrAhWPxeAKHfWABtgQMygBegUIARDQAQ..i&docid=rm2ShJhuKKONJM&w=1080&h=608&q=images%20hot%20drinks&ved=2ahUKEwj05JS38cvrAhWPxeAKHfWABtgQMygBegUIARDQAQ",
                    'default_action' => [
                        "type" => "web_url",
                        "url" => "http://monraytravel.com/services/{$blogs[$i]['id']}/{$blogs[$i][$lang.'_title']}",
                        "webview_height_ratio" => "tall"
                    ],
                    'buttons' => [
                        [
                            "type" => "postback",
                            "payload" => $blogs[$i][$lang . '_title'],
                            "title" => $blogs[$i][$lang . '_title'],
                        ], [
                            "type" => "postback",
                            "payload" => __('bot.'. $lang .'.main_menu'),
                            "title" => __('bot.'. $lang .'.main_menu'),
                        ]
                    ]
                ]);
        }

        return [
            'recipient' => ['id' => $id ],
            'message'  => [
                'attachment' => [
                    'type'  => 'template',
                    'payload' => [
                        'template_type' => 'generic',
                        'elements'  => $temp
                    ]
                ]
            ]
        ];
    }

    protected function getUser($id = null)
    {
        $url = "https://graph.facebook.com/v8.0/{$id}?fields=first_name,last_name,profile_pic&access_token=" . setting('facebook_token');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $user = curl_exec($ch);
        curl_close($ch);

        return $user;
    }

    protected function verifyAccess()
    {
        $local_token = env('FACEBOOK_WEBHOOK_MESSENGER_TOKEN');
        $hub_verify_token = request('hub_verify_token');

        if ($local_token == $hub_verify_token) {
            echo \request('hub_challenge');
            exit;
        }
    }

    protected function sendMessage($response)
    {
        $ch = curl_init('https://graph.facebook.com/v8.0/me/messages?access_token=' . setting('facebook_token'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_exec($ch);
        curl_close($ch);
    }
}
