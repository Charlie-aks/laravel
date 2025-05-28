<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Hiển thị danh sách Menu.
     */
    public function index()
    {
        $list = Menu::select('id', 'name', 'link', 'type', 'position', 'status', 'sort_order', 'parent_id')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('backend.menu.index', compact('list'));
    }

    /**
     * Hiển thị form thêm mới Menu.
     */
    public function create()
    {
        $list_parent = Menu::where('parent_id', 0)->get();
        return view('backend.menu.create', compact('list_parent'));
    }

    /**
     * Lưu thông tin Menu mới vào database.
     */
    public function store(StoreMenuRequest $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'type' => 'required|string|in:category,brand,page,topic,custom',
            'position' => 'required|string',
            'status' => 'required|boolean',
            'sort_order' => 'nullable|integer',
            'parent_id' => 'nullable|integer',
        ]);

        // Tạo menu mới
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->link = $request->link;
        $menu->type = $request->type;
        $menu->position = $request->position;
        $menu->status = $request->status;
        $menu->sort_order = $request->sort_order ?? 0;
        $menu->parent_id = $request->parent_id ?? 0;
        $menu->created_by = Auth::id() ?? 1; // Lấy ID người dùng hiện tại, mặc định 1 nếu không có
        $menu->created_at = now(); // Nếu không sử dụng timestamps trong model
        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Thêm menu thành công');
    }

    /**
     * Hiển thị form sửa menu.
     */
    public function edit(string $id)
    {
        $menu = Menu::find($id);
        $list_parent = Menu::where('parent_id', 0)->get();
        if (!$menu) {
            return redirect()->route('menu.index')->with('error', 'Menu không tồn tại');
        }
        return view('backend.menu.edit', compact('menu','list_parent'));
    }

    /**
     * Cập nhật thông tin menu.
     */
    public function update(Request $request, string $id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return redirect()->route('menu.index')->with('error', 'Không tìm thấy menu.');
        }

        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'type' => 'required|string',
            'position' => 'required|string',
            'status' => 'required|in:0,1',
            'sort_order' => 'nullable|integer',
            'parent_id' => 'nullable|integer',
        ]);

        // Kiểm tra link trùng lặp
        $existingMenu = Menu::where('link', $request->link)
            ->where('id', '!=', $id)
            ->first();

        if ($existingMenu) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['link' => 'Link này đã tồn tại trong menu khác.']);
        }

        // Cập nhật dữ liệu menu
        $menu->name = $request->name;
        $menu->link = $request->link;
        $menu->type = $request->type;
        $menu->position = $request->position;
        $menu->status = $request->status;
        $menu->sort_order = $request->sort_order ?? 0;
        $menu->parent_id = $request->parent_id ?? 0;
        $menu->updated_by = Auth::id() ?? 1;
        $menu->updated_at = now();

        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Cập nhật menu thành công!');
    }

    /**
     * Xóa menu.
     */
    public function destroy(string $id)
    {
        // Tìm menu theo ID
        $menu = Menu::onlyTrashed()->find($id); // Chỉ tìm các menu đã bị soft delete
    
        if (!$menu) {
            return redirect()->route('menu.index')->with('error', 'Menu không tồn tại hoặc đã được xóa vĩnh viễn');
        }
    
        // Xóa vĩnh viễn
        $menu->forceDelete(); // Sử dụng forceDelete() để xóa vĩnh viễn
    
        return redirect()->route('menu.trash')->with('success', 'Xóa vĩnh viễn menu thành công!');
    } 

    /**
     * Xóa menu (soft delete).
     */
    public function delete($id)
    {
        $menu = Menu::find($id);
        if($menu == null) {
            return redirect()->route('menu.index');
        }
        $menu->delete();
        return redirect()->route('menu.index');
    }

    /**
     * Hiển thị danh sách menu đã xóa.
     */
    public function trash()
    {
        $list = Menu::onlyTrashed()
            ->select('id', 'name', 'sort_order', 'status', 'deleted_at', 'link')
            ->orderBy('deleted_at', 'desc')
            ->paginate(5);

        return view('backend.menu.trash', compact('list'));
    }

    /**
     * Khôi phục menu đã xóa.
     */
    public function restore($id)
    {
        $menu = Menu::onlyTrashed()->find($id);
        if ($menu) {
            $menu->restore();
        }
        return redirect()->route('menu.trash');
    }

    /**
     * Thay đổi trạng thái của menu.
     */
    public function status($id)
    {
        $menu = Menu::find($id);
        if($menu == null) {
            return redirect()->route('menu.index');
        }
        $menu->status = $menu->status == 1 ? 0 : 1;
        $menu->updated_by = Auth::id() ?? 1;
        $menu->updated_at = now();
        $menu->save();
        return redirect()->route('menu.index');
    }
}
