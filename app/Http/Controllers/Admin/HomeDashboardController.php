<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeDashboardController extends Controller
{
    //
    public function index()
    {

        $chart_options = [
            'chart_title' => 'Posts by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Post',

            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'line',

            'filter_field' => 'created_at',
            'filter_days' => 3600,
        ];
        $post_chart_options = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',

            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',

            'filter_field' => 'created_at',
            'filter_days' => 3600,
        ];

        $users_chart_options = new LaravelChart($chart_options);
        return view('admin.index', compact('post_chart_options', 'users_chart_options'));
    }
}
