<?php

namespace App\Http\Controllers;

use Image;
use Carbon\Carbon;
use App\BannerHomeBig;
use App\BannerFooterBig;
use App\BannerHomeSmall;
use App\BannerHomeMiddle;
use App\BannerProductBig;
use App\BannerFooterSmall;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('checkrolebanner');
    }

    public function bannerHomeBig()
    {
        $banners = BannerHomeBig::all();
        return view('backend.banners.homeBig', compact('banners'));
    }

    public function bannerHomeBigPost(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|mimes:png,webp,jpg,jpeg',
        ]);
        
        $banner_id =  BannerHomeBig::insertGetId([
            'banner_image' => $request->banner_image,
            'created_at'   => Carbon::now(),
        ]);

        $uploaded_image = $request->file('banner_image');
        $file_name = $banner_id. '.' .$uploaded_image->extension('banner_image');
        $location = public_path('uploads/banners/homepageBig/' . $file_name);
        Image::make($uploaded_image)->resize('1200, 415')->save($location);

        BannerHomeBig::findOrFail($banner_id)->update([
            'banner_image' => $file_name,
        ]);
        return back()->withSuccess('Banner added Successfully');
    }

    public function bannerHomeBigDelete($banner_id)
    {
        $banner_image = BannerHomeBig::findOrFail($banner_id);
        $location = public_path('uploads/banners/homepageBig/' . $banner_image->banner_image);
        unlink($location);
        $banner_image->delete();
        return back()->withSuccess('Banner Deleted');
    }

    public function bannerHomeSmall()
    {
        $banners = BannerHomeSmall::all();
        return view('backend.banners.homeSmall', compact('banners'));
    }
    public function bannerHomeSmallPost(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|mimes:png,webp,jpg,jpeg',
        ]);
        
        $banner_id =  BannerHomeSmall::insertGetId([
            'banner_image' => $request->banner_image,
            'created_at'   => Carbon::now(),
        ]);

        $uploaded_image = $request->file('banner_image');
        $file_name = $banner_id. '.' .$uploaded_image->extension('banner_image');
        $location = public_path('uploads/banners/homepageSmall/' . $file_name);
        Image::make($uploaded_image)->resize('390, 193')->save($location);

        BannerHomeSmall::findOrFail($banner_id)->update([
            'banner_image' => $file_name,
        ]);
        return back()->withSuccess('Banner added Successfully');
    }

    public function bannerHomeSmallDelete($banner_id)
    {
        $banner_image = BannerHomeSmall::findOrFail($banner_id);
        $location = public_path('uploads/banners/homepageSmall/' . $banner_image->banner_image);
        unlink($location);
        $banner_image->delete();
        return back()->withSuccess('Banner Deleted');
    }
    public function bannerHomeMiddle()
    {
        $banners = BannerHomeMiddle::all();
        return view('backend.banners.homeMiddle', compact('banners'));
    }

    public function bannerHomeMiddlePost(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|mimes:png,webp,jpg,jpeg',
        ]);
        
        $banner_id =  BannerHomeMiddle::insertGetId([
            'banner_image' => $request->banner_image,
            'created_at'   => Carbon::now(),
        ]);

        $uploaded_image = $request->file('banner_image');
        $file_name = $banner_id. '.' .$uploaded_image->extension('banner_image');
        $location = public_path('uploads/banners/homepageMiddle/' . $file_name);
        Image::make($uploaded_image)->resize('530, 285')->save($location);

        BannerHomeMiddle::findOrFail($banner_id)->update([
            'banner_image' => $file_name,
        ]);
        return back()->withSuccess('Banner added Successfully');
    }

    public function bannerHomeMiddleDelete($banner_id)
    {
        $banner_image = BannerHomeMiddle::findOrFail($banner_id);
        $location = public_path('uploads/banners/homepageMiddle/' . $banner_image->banner_image);
        unlink($location);
        $banner_image->delete();
        return back()->withSuccess('Banner Deleted');
    }

    public function bannerFooterBig()
    {
        $banners = BannerFooterBig::all();
        return view('backend.banners.footerBig', compact('banners'));
    }

    public function bannerFooterBigPost(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|mimes:png,webp,jpg,jpeg',
        ]);
        
        $banner_id =  BannerFooterBig::insertGetId([
            'banner_image' => $request->banner_image,
            'created_at'   => Carbon::now(),
        ]);

        $uploaded_image = $request->file('banner_image');
        $file_name = $banner_id. '.' .$uploaded_image->extension('banner_image');
        $location = public_path('uploads/banners/homepageFooterBig/' . $file_name);
        Image::make($uploaded_image)->resize('1090, 245')->save($location);

        BannerFooterBig::findOrFail($banner_id)->update([
            'banner_image' => $file_name,
        ]);
        return back()->withSuccess('Banner added Successfully');
    }

    public function bannerFooterBigDelete($banner_id)
    {
        $banner_image = BannerFooterBig::findOrFail($banner_id);
        $location = public_path('uploads/banners/homepageFooterBig/' . $banner_image->banner_image);
        unlink($location);
        $banner_image->delete();
        return back()->withSuccess('Banner Deleted');
    }

    public function bannerFooterSmall()
    {
        $banners = BannerFooterSmall::all();
        return view('backend.banners.footerSmall', compact('banners'));
    }

    public function bannerFooterSmallPost(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|mimes:png,webp,jpg,jpeg',
        ]);
        
        $banner_id =  BannerFooterSmall::insertGetId([
            'banner_image' => $request->banner_image,
            'created_at'   => Carbon::now(),
        ]);

        $uploaded_image = $request->file('banner_image');
        $file_name = $banner_id. '.' .$uploaded_image->extension('banner_image');
        $location = public_path('uploads/banners/homepageFooterSmall/' . $file_name);
        Image::make($uploaded_image)->resize('520, 240')->save($location);

        BannerFooterSmall::findOrFail($banner_id)->update([
            'banner_image' => $file_name,
        ]);
        return back()->withSuccess('Banner added Successfully');
    }

    public function bannerFooterSmallDelete($banner_id)
    {
        $banner_image = BannerFooterSmall::findOrFail($banner_id);
        $location = public_path('uploads/banners/homepageFooterSmall/' . $banner_image->banner_image);
        unlink($location);
        $banner_image->delete();
        return back()->withSuccess('Banner Deleted');
    }

    public function bannerProductBig()
    {
        $banners = BannerProductBig::all();
        return view('backend.banners.productBig', compact('banners'));
    }

    
    public function bannerProductBigPost(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|mimes:png,webp,jpg,jpeg',
        ]);
        
        $banner_id =  BannerProductBig::insertGetId([
            'banner_image' => $request->banner_image,
            'created_at'   => Carbon::now(),
        ]);

        $uploaded_image = $request->file('banner_image');
        $file_name = $banner_id. '.' .$uploaded_image->extension('banner_image');
        $location = public_path('uploads/banners/productpageBig/' . $file_name);
        Image::make($uploaded_image)->resize('1620, 392')->save($location);

        BannerProductBig::findOrFail($banner_id)->update([
            'banner_image' => $file_name,
        ]);
        return back()->withSuccess('Banner added Successfully');
    }

    public function bannerProductBigDelete($banner_id)
    {
        $banner_image = BannerProductBig::findOrFail($banner_id);
        $location = public_path('uploads/banners/productpageBig/' . $banner_image->banner_image);
        unlink($location);
        $banner_image->delete();
        return back()->withSuccess('Banner Deleted');
    }
   
  // END  
}
