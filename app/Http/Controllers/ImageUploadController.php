<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 28.02.19
 * Time: 09:09
 */

namespace App\Http\Controllers;


use App\File;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function imageUpload()
    {
        return view('imageUpload');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function imageUploadPost(Request $request)
    {
        request()->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);

        File::where('object_imei', '=', $request->input('vessel_imei'))->delete();
        File::create([
            'object_imei' => $request->input('vessel_imei'),
            'file_name' => $imageName
        ]);

        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName);
    }
}