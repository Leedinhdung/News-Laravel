<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CatalogueRequest;
use App\Models\Catalogue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.catalogues.';
    const PATH_UPLOAD = 'catalogues';

    public function index()
    {
        $all = Catalogue::query()->count('id');
        $trash = Catalogue::onlyTrashed()->count('id');
        $data = Catalogue::with('children')->get();
        // dd($data);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'all', 'trash'));
    }
    public function trash()
    {

        $data = Catalogue::onlyTrashed()->get();
        $all = Catalogue::onlyTrashed()->count('id');

        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'all'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getCatalogues()
    {
        //Lấy danh sách danh mục trên cơ sở dữ liệu
        $data = Catalogue::query()->where('is_active', 1)->get();
        $listCategory = [];
        //Dùng hàm recursive được tạo trong model catalogue để xử lý dữ liệu và truyền vào các tham số cần thiết
        Catalogue::recursive($data, $parents = 0, $level = 1, $listCategory);
        return $listCategory;
    }
    public function create()
    {

        $data = $this->getCatalogues();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CatalogueRequest $request)
    {
        $data = $request->all();
        //        dd($data['tags']);
        $data['parent_id'] ??= 0;
        $data['slug'] = Str::slug($request->name);

        // dd($data);
        Catalogue::query()->create($data);
        return redirect()->route('admin.catalogues.index')->with('success', 'Thêm thành công ');
    }


    
    public function edit(string $id)
    {
        //Lấy dữ liệu theo id
        $catalogue = Catalogue::findOrFail($id);
       
        $data = $this->getCatalogues(); 
        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'catalogue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Bước 1 lấy dữ liệu từ form
        //Bước 2 Đi xem thằng id là thằng nào
        //Bước 3 đi cập nhật
        $updateData = Catalogue::query()->findOrFail($id);
        $data = $request->all();
        $data['is_active'] ??= 0;
        $data['slug'] = Str::slug($request->name);

        //    dd($request->all());

        $updateData->update($data);


        return redirect()->route('admin.catalogues.index')->with('success', 'Cập nhật thành công !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delSoft(string $id)
    {
        $catalogues = Catalogue::query()->findOrFail($id);
        $catalogues->update(['is_active' => false]);
        $catalogues->delete();
        return back()->with('success', 'Xóa thành công');
    }
    public function restore(string $id)
    {
        $catalogues = Catalogue::onlyTrashed()->findOrFail($id);
        $catalogues->update(['is_active' => true]);
        $catalogues->restore();
        return redirect()->route('admin.catalogues.trash')->with('success', 'Khôi phục thành công!');
    }
    public function destroy(string $id)
    {
        $catalogues = Catalogue::onlyTrashed()->findOrFail($id);
        $catalogues->forceDelete();
        return back();
    }
}
