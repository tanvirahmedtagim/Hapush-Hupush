<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Image;
use App\Http\Requests\PartnerRequest;
class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $partner = Partner::orderBy('id', 'desc')->get();
        $partnerCount = Partner::count();
         return view('admin.partner.index',['partner'=>$partner,'partnerCount'=> $partnerCount,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.partner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerRequest $request)
    {
        //
        $partner = Partner::create($request->all());

        if ($request->hasFile('logo')) {
            $this->_uploadImage($request, $partner);
        }
        return redirect()->route('partner.index')->with('success','Data inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        //
        return view('admin.partner.edit',[
            'edit' => $partner
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(PartnerRequest $request, Partner $partner)
    {
        //
        $partner->update($request->all());

        if ($request->hasFile('logo')) {
            @unlink('storage/'.$partner->logo);
            $this->_uploadImage($request, $partner);
        }
        return redirect()->route('partner.index')->with('success','Data inserted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        //
        if(!empty($partner->logo));
        @unlink('storage/'.$partner->logo);

        $partner->delete();
        return redirect()->route('partner.index')->with('status','Data deleted successfully!');
    }


    private function _uploadImage($request, $about)
    {
        # code...
        if( $request->hasFile('logo') ) {
            $image = $request->file('logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(118, 116)->save('storage' . $filename);
            $about->logo = $filename;
            $about->save();
        }

    }
}
