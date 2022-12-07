<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Banners\BannerStoreRequest;
use App\Http\Requests\Banners\BannerUpdateRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $banners = Banner::all();
        return view("banners.index", compact("banners"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view("banners.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BannerStoreRequest $request
     * @return SymfonyResponse
     */
    public function store(BannerStoreRequest $request)
    {
        $request->validated();
        $banner = Banner::create([
            "title" => $request->input("title"),
            "image" => $request->imagePath(),
        ]);

        return redirect(status: SymfonyResponse::HTTP_CREATED)
            ->route(route: "banners.index")
            ->with("success", "({$banner->title}) banner stored successfully ");
    }

    /**
     * Display the specified resource.
     *
     * @param Banner $banner
     * @return View
     */
    public function show(Banner $banner): View
    {
        return view("banners.show", compact("banner"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Banner $banner
     * @return View
     */
    public function edit(Banner $banner): View
    {
        return View("banners.edit", compact("banner"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BannerUpdateRequest $request
     * @param Banner $banner
     * @return RedirectResponse
     */
    public function update(BannerUpdateRequest $request, Banner $banner)
    {
        $validated = $request->validated();
        $validated["image"] = $request->imagePath($banner);
        $banner->update($validated);
        return redirect(status: SymfonyResponse::HTTP_OK)
            ->route("banners.index")
            ->with("success", "({$banner->title}) banner has been updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Banner $banner
     * @return RedirectResponse
     */
    public function destroy(Banner $banner)
    {
        Storage::disk("public")->delete($banner->image);
        $banner->delete();
        return redirect(status: SymfonyResponse::HTTP_OK)
            ->route("banners.index")
            ->with("success", "({$banner->title}) banner has been deleted successfully");
    }

    public function getBanners()
    {
        $banners = Banner::paginate(perPage: 10, columns: ["*"], pageName: "page");
        return response(
            content: BannerResource::collection($banners),
            status: SymfonyResponse::HTTP_OK
        );
    }
}
