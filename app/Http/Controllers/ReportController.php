<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\Status;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort');
        if($sort != 'asc' && $sort != 'desc')
        {
            $sort = 'desc';
        }

        $status = $request->input('status');
        $validate = $request->validate([
            'status' => 'exists:statuses,id'
        ]);
        if($validate)
        {
            $reports = Report::where('status_id', $status)->where('user_id', Auth::user()->id)->orderBy('created_at',$sort)->paginate(4);
        }
        else{
            $reports = Report::where('user_id', Auth::user()->id)->orderBy('created_at', $sort)->paginate(4);
        }
        $statuses = Status::all();

        return view('report.index', compact('reports', 'statuses', 'sort', 'status'));
    }

    public function store(Request $request, Report $report)
    {
        $data = $request -> validate([
            'number' => 'required|string',
            'des' => 'required|string'
        ]);
        $data ['user_id'] = Auth::user()->id;
        $data ['status_id'] = 1; 
        $report->create($data);
        return redirect()->route('reports.index');
    }

    public function edit(Report $report)
    {
        if(Auth::user()->id === $report->user_id)
            {
                return view('report.edit', compact('report'));
            }
        else{
            abort(403, "У вас нет доступа для редактирования этой заявки");
        }
    }

    public function update(Request $request, Report $report)
    {
        $data = $request -> validate([
            'number' => 'required|string',
            'des' => 'required|string'
        ]);
        $report->update($data);
        return redirect()->route('reports.index');
    }

    public function destroy(Report $report)
    {
        if(Auth::user()->id === $report->user_id)
            { 
                $report->delete();
                return redirect()->back();
            }
        else{
            abort(403, "У вас нет доступа для удаления этой заявки");
        }
    }
}
