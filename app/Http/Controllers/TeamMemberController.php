<?php

namespace App\Http\Controllers;

use App\Language;
use App\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $all_team_member = TeamMember::all()->groupBy('lang');
        return view('backend.pages.team-member')->with([
            'all_team_members' => $all_team_member
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'designation' => 'required|string|max:191',
            'image' => 'nullable|string',
            'icon_one' => 'nullable|string:max:191',
            'icon_two' => 'nullable|string:max:191',
            'icon_three' => 'nullable|string:max:191',
            'icon_one_url' => 'nullable|string:max:191',
            'icon_two_url' => 'nullable|string:max:191',
            'icon_three_url' => 'nullable|string:max:191',
            'lang' => 'nullable|string'
        ]);
        TeamMember::create($request->all());
        return redirect()->back()->with(['msg' => __('Item Added Successfully...'), 'type' => 'success']);
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'designation' => 'required|string|max:191',
            'image' => 'nullable|string',
            'icon_one' => 'nullable|string:max:191',
            'icon_two' => 'nullable|string:max:191',
            'icon_three' => 'nullable|string:max:191',
            'icon_one_url' => 'nullable|string:max:191',
            'icon_two_url' => 'nullable|string:max:191',
            'icon_three_url' => 'nullable|string:max:191',
            'lang' => 'nullable|string'
        ]);
        TeamMember::find($request->id)->update($request->all());
        return redirect()->back()->with(['msg' => __('Item Updated Successfully...'), 'type' => 'success']);
    }
    public function delete($id)
    {
        TeamMember::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Item Deleted Successfully...'), 'type' => 'danger']);
    }
    public function bulk_action(Request $request)
    {
        $all = TeamMember::find($request->ids);
        foreach ($all as $item) {
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }
}
