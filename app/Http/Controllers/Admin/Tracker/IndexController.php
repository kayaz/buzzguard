<?php

namespace App\Http\Controllers\Admin\Tracker;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Bllim\Datatables\Facade\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;
use PragmaRX\Tracker\Vendor\Laravel\Support\Session;

class IndexController extends Controller
{
    function __construct(){
        $this->middleware('permission:event-list', ['only' => ['events']]);
    }

    public function index()
    {
        $pageViews = Tracker::pageViews(60 * 24 * 30)->toJson();
        return view('admin.tracker.index', ['list' => $pageViews]);
    }

    public function errors()
    {
        return view('admin.tracker.errors');
    }

    public function apiErrors(Session $session)
    {
        $query = Tracker::errors($session->getMinutes(), false);

        $query->select([
            'id',
            'error_id',
            'method',
            'path_id',
            'updated_at',
        ]);

        return Datatables::of($query)
            ->edit_column('updated_at', function ($row) {
                return "{$row->updated_at->diffForHumans()}";
            })
            ->make(true);
    }

    public function users()
    {
        return view('admin.tracker.users');
    }

    public function apiUsers(Session $session)
    {
        $username_column = Tracker::getConfig('authenticated_user_username_column');

        return Datatables::of(Tracker::users($session->getMinutes(), false))
            ->edit_column('user_id', function ($row) use ($username_column) {
                return "{$row->user->$username_column}";
            })
            ->edit_column('updated_at', function ($row) {
                return "{$row->updated_at->diffForHumans()}";
            })
            ->make(true);
    }

    public function events()
    {
        return view('admin.tracker.events');
    }

    public function apiEvents()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return Datatables::of(Notification::query()->orderBy('created_at', 'DESC')->where('notifiable_id', Auth::id()), false)
        ->edit_column('created_at', function ($row) {
            return "{$row->created_at->diffForHumans()}";
        })
        ->add_column('message', function ($row) {

            if($row->type == 'App\Notifications\NewPostNotification'){
                return 'Nowy wpis w projekcie: <a href="'.route('admin.project.show', $row->data->project_id).'">'.$row->data->project.'</a>';
            }

            if($row->type == 'App\Notifications\QANotification'){
                return 'Nowy wpis na czacie w projekcie: <a href="'.route('admin.project.chat', $row->data->project_id).'">'.$row->data->project.'</a>';
            }
        })
        ->add_column('status', function ($row) {
            return (!$row->read_at) ? '<span class="online"></span><span class="d-none">' . $row->read_at . '</span>' : '<span class="offline"></span><span class="d-none">' . $row->read_at . '</span>';
        })
        ->make(true);
    }

    public function event($id)
    {
        $event = DB::table('tracker_events')->where('id', $id)->first();
        $list = DB::table('tracker_events_log')
            ->join('tracker_log', 'tracker_events_log.log_id', '=', 'tracker_log.id')
            ->leftJoin('tracker_system_classes', 'tracker_events_log.class_id', '=', 'tracker_system_classes.id')
            ->leftJoin('tracker_sessions', 'tracker_log.session_id', '=', 'tracker_sessions.id')
            ->where('tracker_events_log.event_id', $id)
            ->select('tracker_events_log.created_at','name', 'client_ip')
            ->get();

        //dd($list);

        return view('admin.tracker.event', ['list' => $list, 'event' => $event]);
    }

    public function apiVisits(Session $session)
    {
        $username_column = Tracker::getConfig('authenticated_user_username_column');

        $query = Tracker::sessions($session->getMinutes(), false);

        $query->select([
            'id',
            'uuid',
            'user_id',
            'device_id',
            'agent_id',
            'client_ip',
            'referer_id',
            'cookie_id',
            'geoip_id',
            'language_id',
            'is_robot',
            'updated_at',
        ]);

        return Datatables::of($query)
            ->edit_column('id', function ($row) {
                $uri = route('admin.tracker.log', $row->uuid);

                return '<a href="'.$uri.'">'.$row->id.'</a>';
            })

            ->add_column('country', function ($row) {
                $cityName = $row->geoip && $row->geoip->city ? ' - '.$row->geoip->city : '';

                $countryName = ($row->geoip ? $row->geoip->country_name : '').$cityName;

                $countryCode = strtolower($row->geoip ? $row->geoip->country_code : '');

                $flag = $countryCode
                    ? "<span class=\"f16\"><span class=\"flag $countryCode\" alt=\"$countryName\" /></span></span>"
                    : '';

                return "$flag $countryName";
            })

            ->add_column('user', function ($row) use ($username_column) {
                return $row->user ? $row->user->$username_column : 'gość';
            })

            ->add_column('device', function ($row) {
                $model = ($row->device && $row->device->model && $row->device->model !== 'unavailable' ? '['.$row->device->model.']' : '');

                $platform = ($row->device && $row->device->platform ? ' ['.trim($row->device->platform.' '.$row->device->platform_version).']' : '');

                $mobile = ($row->device && $row->device->is_mobile ? ' [mobile device]' : '');

                return $model || $platform || $mobile
                    ? $row->device->kind.' '.$model.' '.$platform.' '.$mobile
                    : '';
            })

            ->add_column('browser', function ($row) {
                return $row->agent && $row->agent
                    ? $row->agent->browser.' ('.$row->agent->browser_version.')'
                    : '';
            })

            ->add_column('language', function ($row) {
                return $row->language && $row->language
                    ? $row->language->preference
                    : '';
            })

            ->add_column('referer', function ($row) {
                return $row->referer ? $row->referer->domain->name : '';
            })

            ->add_column('pageViews', function ($row) {
                return $row->page_views;
            })

            ->add_column('lastActivity', function ($row) {
                return $row->updated_at->diffForHumans();
            })

            ->make(true);
    }

    public function log($uuid)
    {
        return view('admin.tracker.log', ['uuid' => $uuid]);
    }

    public function apiLog($uuid)
    {
        $query = Tracker::sessionLog($uuid, false);

        $query->select([
            'id',
            'session_id',
            'method',
            'path_id',
            'query_id',
            'route_path_id',
            'is_ajax',
            'is_secure',
            'is_json',
            'wants_json',
            'error_id',
            'created_at',
        ]);

        return Datatables::of($query)
            ->edit_column('route_name', function ($row) {
                $path = $row->routePath;

                return    $row->routePath
                    ? $row->routePath->route->name.'<br>'.$row->routePath->route->action
                    : ($row->path ? $row->path->path : '');
            })
            ->edit_column('is_ajax', function ($row) {
                return    $row->is_ajax ? 'tak' : 'nie';
            })

            ->edit_column('is_secure', function ($row) {
                return    $row->is_secure ? 'tak' : 'nie';
            })

            ->edit_column('is_json', function ($row) {
                return    $row->is_json ? 'tak' : 'nie';
            })

            ->edit_column('wants_json', function ($row) {
                return    $row->wants_json ? 'tak' : 'nie';
            })

            ->edit_column('error', function ($row) {
                return    $row->error ? 'tak' : 'nie';
            })
            ->add_column('created', function ($row) {
                return $row->created_at->format('Y-m-d H:i');
            })
            ->make(true);
    }
}
