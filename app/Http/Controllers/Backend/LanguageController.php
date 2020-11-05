<?php

namespace App\Http\Controllers\Backend;

use App\Models\LanguageModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
   	public function language(Request $request)
   	{


   		  $getrecord = LanguageModel::orderBy('id', 'desc');
        // Search Box Start
        if (!empty($request->language_name)){
          $getrecord = $getrecord->where('language_name', 'like', '%' . $request->language_name . '%');
        }
        // Search Box End

        $getrecord = $getrecord->paginate(50);


        $data['getrecord'] = $getrecord;
   		  return view('backend.admin.language.list', $data);
   	}
   	public function add()
   	{
   		return view('backend.admin.language.add');
   	}

   
   	 public function insert(Request $request)
    {
        $record = new LanguageModel;
        $record->language_name = !empty($request->language_name) ? trim($request->language_name) : '';
        
        $record->save();

        return redirect('admin/language')->with('success', 'Language created successfully');
    }

     public function delete($id) {
        $record = LanguageModel::find($id);
       
        $record->delete();
        return redirect('admin/language')->with('success', 'Record successfully deleted');
    }

    public function edit($id) {
        $record = LanguageModel::find($id);
        $data['record'] = $record;
        return view('backend.admin.language.edit', $data);
    }

    public function update($id, Request $request) {

      $record = LanguageModel::find($id);
     
      $record->language_name = !empty($request->language_name) ? trim($request->language_name) : '';
     
      $record->save();
      return redirect('admin/language')->with('success', 'Language updated successfully');
    }
}
