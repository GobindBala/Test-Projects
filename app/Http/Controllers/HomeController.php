<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Redirect;
use Session;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $items = Item::get();
        return view('home')->with(compact('items'));
    }

    public function itemSave(Request $request) {

        if ($request->ajax()) {
            
            $request->validate([
                'id' => 'required|not_in:blank',
                'item' =>'required|string|max:255',
            ]);

            $data = array();
            $data['title'] = $request->item;
            $success = Item::create($data);
            if ($success != null) {
                $items = Item::get();
                return view('pages.main_item')->with( compact('items'));
            }
        }else{
            $request->session()->flash('message', '  <h4 class="text-center text-danger" >Somethings Were Problem Please Check It First ! </h4> ');
            return Redirect::back();
        }
    }
    
    public function itemAdd(Request $request) {
        if ($request->ajax()) {
            $request->validate([
                'item' => 'required|numeric',
            ]);
            $success = Item::where('id',$request->item)->update(['status'=> 0]);
            if ($success != null) {
                $items = Item::get();
                return view('pages.main_item')->with(compact('items'));
            }
        } else {
            $request->session()->flash('message', '  <h4 class="text-center text-danger" >Somethings Were Problem Please Check It First ! </h4> ');
            return Redirect::back();
        }
    }
    public function itemDelete(Request $request) {
        if ($request->ajax()) {
            $request->validate([
                'item' => 'required|numeric',
            ]);
            $success = Item::where('id',$request->item)->update(['status'=> 1]);
            if ($success != null) {
                $items = Item::get();
                return view('pages.main_item')->with(compact('items'));
            }
        } else {
            $request->session()->flash('message', '  <h4 class="text-center text-danger" >Somethings Were Problem Please Check It First ! </h4> ');
            return Redirect::back();
        }
    }
    
    

}
